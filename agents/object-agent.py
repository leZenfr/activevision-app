import json
import pymysql
import re
import os
import time
from datetime import datetime

# Configuration de la base de données
db_config = {
    "host": "127.0.0.1",
    "user": "root",
    "password": "",
    "database": "ads",
    "charset": "utf8mb4"
}

# Fonction pour convertir les dates JSON au format MySQL
def convert_json_date(json_date):
    if not json_date or not isinstance(json_date, str):
        return None
    try:
        # Extraire les chiffres du format /Date(1747383403000)/
        timestamp_ms = int(''.join(filter(str.isdigit, json_date)))
        timestamp = timestamp_ms // 1000  # Convertir en secondes
        # Si la valeur est trop basse ou trop haute pour être une date raisonnable
        if timestamp <= 0 or timestamp >= 9999999999:
            return None
        return datetime.fromtimestamp(timestamp).strftime('%Y-%m-%d %H:%M:%S')
    except Exception:
        return None

# Connexion à la base de données
def connect_db():
    return pymysql.connect(**db_config)

# Traitement des objets
def process_objects(json_file):
    with open(json_file, 'r', encoding='utf-8-sig') as file:
        data = json.load(file)

    connection = connect_db()
    cursor = connection.cursor()

    # Pour chaque SID/object du JSON
    for sid, obj in data.items():
        if not isinstance(obj, dict):
            continue
        object_class = obj.get("objectClass", "").lower()
        try:
            if object_class == "user":
                sql = """
                    INSERT INTO ObjectUsers (objectSid, badPasswordTime, lastLogon, lockoutTime, displayName, userPrincipalName, sAMAccountName, distinguishedName, accountExpires, whenChanged, whenCreated, userAccountControl, created_at, updated_at)
                    VALUES (%s, %s, %s, %s, %s, %s, %s, %s, FROM_UNIXTIME(%s), %s, %s, %s, NOW(), NOW())
                    ON DUPLICATE KEY UPDATE
                    displayName = VALUES(displayName), userPrincipalName = VALUES(userPrincipalName), sAMAccountName = VALUES(sAMAccountName), distinguishedName = VALUES(distinguishedName), accountExpires = VALUES(accountExpires), whenChanged = VALUES(whenChanged), whenCreated = VALUES(whenCreated), userAccountControl = VALUES(userAccountControl), updated_at = NOW()
                """
                cursor.execute(sql, (
                    obj["objectSid"],
                    obj.get("badPasswordTime", 0),
                    obj.get("lastlogon", 0),
                    obj.get("lockoutTime", 0),
                    obj.get("DisplayName", ""),
                    obj.get("userPrincipalName", ""),
                    obj.get("sAMAccountName", ""),
                    obj.get("distinguishedName", ""),
                    obj.get("accountExpires", 0),
                    convert_json_date(obj.get("whenChanged")),
                    convert_json_date(obj.get("whenCreated")),
                    obj.get("userAccountControl", 0)
                ))
            elif object_class == "group":
                sql = """
                    INSERT INTO objectgroup (objectSid, member, distinguishedName, whenChanged, whenCreated, created_at, updated_at)
                    VALUES (%s, %s, %s, %s, %s, NOW(), NOW())
                    ON DUPLICATE KEY UPDATE
                    member = VALUES(member), distinguishedName = VALUES(distinguishedName), whenChanged = VALUES(whenChanged), whenCreated = VALUES(whenCreated), updated_at = NOW()
                """
                cursor.execute(sql, (
                    obj["objectSid"],
                    obj.get("member", ""),
                    obj.get("distinguishedName", ""),
                    convert_json_date(obj.get("whenChanged")),
                    convert_json_date(obj.get("whenCreated"))
                ))
            elif object_class == "computer":
                sql = """
                    INSERT INTO objectcomputers (objectSid, logonCount, operatingSystem, distinguishedName, userAccountControl, created_at, updated_at)
                    VALUES (%s, %s, %s, %s, %s, NOW(), NOW())
                    ON DUPLICATE KEY UPDATE
                    logonCount = VALUES(logonCount), operatingSystem = VALUES(operatingSystem), distinguishedName = VALUES(distinguishedName), userAccountControl = VALUES(userAccountControl), updated_at = NOW()
                """
                cursor.execute(sql, (
                    obj["objectSid"],
                    obj.get("logonCount", 0),
                    obj.get("operatingSystem", ""),
                    obj.get("distinguishedName", ""),
                    obj.get("userAccountControl", 0)
                ))
            else:
                print(f"objectClass inconnu ou manquant pour {sid}, objet ignoré.")
        except Exception as e:
            print(f"Erreur lors de l'insertion de l'objet {sid}: {e}")

    connection.commit()
    cursor.close()
    connection.close()

    os.remove(json_file)
    print(f"Fichier {json_file} supprimé après traitement.")

# Main
if __name__ == "__main__":
    objects_dir = "./partage/objects"
    print("Démarrage du traitement périodique des objets...")

    while True:
        for filename in os.listdir(objects_dir):
            if filename.lower().endswith(".json"):
                file_path = os.path.join(objects_dir, filename)
                print(f"Traitement du fichier : {file_path}")
                process_objects(file_path)
        print("Attente de 5 minutes avant le prochain traitement...")
        time.sleep(300)
