import json
import pymysql
import os
import time
import random
from datetime import datetime

def convert_json_date(json_date):
    timestamp = int(json_date.strip("/Date()\\/")) // 1000
    return datetime.fromtimestamp(timestamp).strftime('%Y-%m-%d %H:%M:%S')
# convert_json_date---

cache_sam = {}
cache_upn = {}
def anonymize_sam(input: str) -> str:

    if input not in cache_sam :
        number = random.randint(1, 999)
        cache_sam[input] = f"SAM-00{number:03d}"
    return cache_sam[input]


def anonymize_upn(input: str) -> str:

    if "@" in input:
        local_part, domain = input.split("@", 1)  
        if local_part not in cache_upn:
            number = random.randint(1, 999)
            cache_upn[local_part] = f"UPN-00{number:03d}"  
        return f"{cache_upn[local_part]}@{domain}"
    else:
        if input not in cache_upn :
            number = random.randint(1, 999)
            cache_upn[input] = f"UPN-00{number:03d}"
        return cache_upn[input]

def process_objects(objects,dbConfig):

    connection = pymysql.connect(**dbConfig, cursorclass=pymysql.cursors.DictCursor)
    cursor = connection.cursor()

    for sid, obj in objects.items():
        objectClass = obj["objectClass"].lower()

        try:
            match objectClass:
                case "user":
                    sql = """
                        INSERT INTO ObjectUsers (objectSid, badPasswordTime,
                        lastLogon, lockoutTime, displayName, userPrincipalName, sAMAccountName, distinguishedName, accountExpires, whenChanged, whenCreated, userAccountControl, created_at, updated_at)
                        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, NOW(), NOW())
                        ON DUPLICATE KEY UPDATE
                        displayName = VALUES(displayName), userPrincipalName = VALUES(userPrincipalName), sAMAccountName = VALUES(sAMAccountName), distinguishedName = VALUES(distinguishedName), accountExpires = VALUES(accountExpires), whenChanged = VALUES(whenChanged), whenCreated = VALUES(whenCreated), userAccountControl = VALUES(userAccountControl), updated_at = NOW()
                    """
                    anonymized_sam = anonymize_sam(obj.get("sAMAccountName", ""))
                    cursor.execute(sql, (
                        obj["objectSid"],
                        obj.get("badPasswordTime", 0),
                        obj.get("lastlogon", 0),
                        obj.get("lockoutTime", 0),
                        anonymized_sam,
                        anonymize_upn(obj.get("userPrincipalName", "")),
                        anonymized_sam,
                        obj.get("distinguishedName", ""),
                        obj.get("accountExpires", 0),
                        convert_json_date(obj.get("whenChanged")),
                        convert_json_date(obj.get("whenCreated")),
                        obj.get("userAccountControl", 0)
                    ))

                case "group":
                    member = obj.get("member", [])
                    member = json.dumps(member, ensure_ascii=False)
                    sql = """
                        INSERT INTO objectgroup (objectSid, member, distinguishedName, whenChanged, whenCreated, created_at, updated_at)
                        VALUES (%s, %s, %s, %s, %s, NOW(), NOW())
                        ON DUPLICATE KEY UPDATE
                        member = VALUES(member), distinguishedName = VALUES(distinguishedName), whenChanged = VALUES(whenChanged), whenCreated = VALUES(whenCreated), updated_at = NOW()
                    """
                    cursor.execute(sql, (
                        obj["objectSid"],
                        member,
                        obj.get("distinguishedName", ""),
                        convert_json_date(obj.get("whenChanged")),
                        convert_json_date(obj.get("whenCreated"))
                    ))
                case "computer":
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
                case _:
                    print(f"objectClass inconnu ou manquant pour {sid}, objet ignoré.")
        except Exception as e:
            print(f"Erreur lors de l'insertion de l'objet {sid}: {e}")

    connection.commit()
    cursor.close()
    connection.close()
# process_objects---

if __name__ == "__main__":

    dbConfig = {
        "host": "127.0.0.1",
        "user": "root",
        "password": "",
        "database": "ads",
        "charset": "utf8mb4"
    }

    pathDir = "./partage/objects"
    print("Démarrage du traitement périodique des objets...")

    while True:
        for file in os.listdir(pathDir):
            if file.lower().endswith(".json"):
                filePath = os.path.join(pathDir, file)
                print(f"Traitement du fichier : {file}")

                with open(filePath, 'r', encoding='utf-8-sig') as jsonFile:
                    objectsFromJson = json.load(jsonFile)

                process_objects(objectsFromJson,dbConfig)

                os.remove(filePath)
        time.sleep(300)
# main---