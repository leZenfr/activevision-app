import json
import os
import pymysql
import time
import random 
from datetime import datetime

def convert_json_date(json_date):
    timestamp = int(json_date.strip("/Date()\\/")) // 1000
    return datetime.fromtimestamp(timestamp).strftime('%Y-%m-%d %H:%M:%S')
# convert_json_date---

# cache_sam = {}
# cache_upn = {}
# def anonymize_sam(input: str) -> str:

#     if input not in cache_sam :
#         number = random.randint(1, 999)
#         cache_sam[input] = f"SAM-00{number:03d}"
#     return cache_sam[input]


# def anonymize_upn(input: str) -> str:

#     if input not in cache_upn :
#         number = random.randint(1, 999)
#         cache_upn[input] = f"UPN-00{number:03d}"
#     return cache_upn[input]

def get_identifier_id_log(cursor, event_id):
    sql = "SELECT idIdentifiedLog FROM identifiedlog WHERE idEvent = %s"
    cursor.execute(sql, (event_id,))
    result = cursor.fetchone()
    print(f"SQL Result for EventID {event_id}: {result}")

    if result and "idIdentifiedLog" in result:
        return result["idIdentifiedLog"]
    else:
        cursor.execute(
            "INSERT INTO identifiedlog (idEvent, created_at, updated_at) VALUES (%s, NOW(), NOW())",
            (event_id,)
        )
    
def process_events(events,userID,groupID,computerID,dbConfig):

    connection = pymysql.connect(**dbConfig, cursorclass=pymysql.cursors.DictCursor)
    cursor = connection.cursor()

    for event in events:
        try:
            eventID = event["EventID"]

            identified_event = event.get("EventID", 0)
            identifierID = get_identifier_id_log(cursor, eventID)
        
            timeCreated = convert_json_date(event["TimeCreated"])
            serverName = event["ServerName"]
            serverSID = event["ServerSID"]
            serverIP = event["ServerIP"]

            # print(f"EventID: {eventID}")  # Vérifie l'EventID
            # print(f"Identified Event: {identified_event}")  # Vérifie l'EventID récupéré
            # print(f"IdentifierID: {identifierID}") 

            if eventID in userID:
                    sql = """
                        INSERT INTO userlog (
                        identifierIdLog, dummy, targetUserName, targetDomainName, targetSid,
                        subjectUserSid, subjectUserName, subjectDomainName,
                        subjectLogonId, privilegeList, sAMAccountName, displayName, userPrincipalName,
                        homeDirectory, homePath, scriptPath, profilePath, userWorkstations,
                        passwordLastSet, accountExpires, primaryGroupId, allowedToDelegateTo,
                        oldUacValue, newUacValue, userAccountControl, userParameters, sidHistory,
                        logonHours, serverSid, serverName, serverIp, oldTargetUserName,
                        newTargetUserName, created_at, updated_at
                        )
                        VALUES (
                        %s, %s, %s, %s, %s, 
                        %s, %s, %s,
                        %s, %s, %s, %s, %s, 
                        %s, %s, %s, %s, %s, 
                        %s, %s, %s, %s,
                        %s, %s, %s, %s, %s, 
                        %s, %s, %s, %s, %s, %s, %s, %s
                        )

                        ON DUPLICATE KEY UPDATE
                        displayName = VALUES(displayName), userPrincipalName = VALUES(userPrincipalName), sAMAccountName = VALUES(sAMAccountName), accountExpires = VALUES(accountExpires), userAccountControl = VALUES(userAccountControl), updated_at = NOW()
                    """

                    cursor.execute(sql, (   
                        # event.get("EventID", 0),
                        identifierID,
                        event.get("Parameters", {}).get("Dummy", 0),
                        event.get("Parameters", {}).get("Parameters", {}).get("TargetUserName", 0),
                        event.get("Parameters", {}).get("Parameters", {}).get("TargetDomainName", ""),
                        event.get("Parameters", {}).get("TargetSid", ""),
                        event.get("Parameters", {}).get("SubjectUserSid", ""),
                        event.get("Parameters", {}).get("SubjectUserName", ""),
                        event.get("Parameters", {}).get("SubjectDomainName", 0),
                        event.get("Parameters", {}).get("SubjectLogonId", 0),
                        event.get("Parameters", {}).get("PrivilegeList", 0),
                        event.get("Parameters", {}).get("SamAccountName", 0),
                        event.get("Parameters", {}).get("DisplayName", 0),
                        event.get("Parameters", {}).get("UserPrincipalName", 0),
                        event.get("Parameters", {}).get("HomeDirectory", 0),
                        event.get("Parameters", {}).get("HomePath", 0),
                        event.get("Parameters", {}).get("ScriptPath", 0),
                        event.get("Parameters", {}).get("ProfilePath", 0),
                        event.get("Parameters", {}).get("UserWorkstations", 0),
                        event.get("Parameters", {}).get("PasswordLastSet", 0),
                        event.get("Parameters", {}).get("AccountExpires", 0),
                        event.get("Parameters", {}).get("PrimaryGroupId", 0),
                        event.get("Parameters", {}).get("AllowedToDelegateTo", 0),
                        event.get("Parameters", {}).get("OldUacValue", 0),
                        event.get("Parameters", {}).get("NewUacValue", 0),
                        event.get("Parameters", {}).get("UserAccountControl", 0),
                        event.get("Parameters", {}).get("UserParameters", 0),
                        event.get("Parameters", {}).get("SidHistory", 0),
                        event.get("Parameters", {}).get("LogonHours", 0),
                        event.get("ServerSID", 0),
                        event.get("ServerName", 0),
                        event.get("ServerIP", 0),
                        event.get("Parameters", {}).get("OldTargetUserName", 0),
                        event.get("Parameters", {}).get("NewTargetUserName", 0),
                        timeCreated,
                        timeCreated
                    ))
                    # print(event.get("Parameters", {}).get("TargetUserName", "Clé non trouvée"))

            elif eventID in groupID:
                    sql = """
                        INSERT INTO grouplog (
                        identifierIdLog, targetUserName, targetDomainName, targetSid,
                        subjectUserSid, subjectUserName, subjectDomainName,
                        subjectLogonId, privilegeList, samAccountName, sidHistory,
                        serverSid, serverName, serverIp, memberName, memberSid, groupTypeChange,
                        created_at, updated_at
                        )
                        VALUES (
                        %s, %s, %s, %s, %s, 
                        %s, %s, %s,
                        %s, %s, %s, %s,
                        %s, %s, %s, %s, %s, %s, %s
                        )

                        ON DUPLICATE KEY UPDATE
                        targetUserName = VALUES(targetUserName),  targetDomainName = VALUES(targetDomainName), samAccountName = VALUES(samAccountName), updated_at = NOW()
                    """
                    cursor.execute(sql, (
                        identifierID,
                        event.get("Parameters", {}).get("TargetUserName", 0),
                        event.get("Parameters", {}).get("TargetDomainName", ""),
                        event.get("Parameters", {}).get("TargetSid", ""),
                        event.get("Parameters", {}).get("SubjectUserSid", ""),
                        event.get("Parameters", {}).get("SubjectUserName", ""),
                        event.get("Parameters", {}).get("SubjectDomainName", 0),
                        event.get("Parameters", {}).get("SubjectLogonId", 0),
                        event.get("Parameters", {}).get("PrivilegeList", 0),
                        event.get("Parameters", {}).get("SamAccountName", 0),
                        event.get("Parameters", {}).get("SidHistory", 0),
                        event.get("ServerSID", 0),
                        event.get("ServerName", 0),
                        event.get("ServerIP", 0),
                        event.get("Parameters", {}).get("MemberName", 0),
                        event.get("Parameters", {}).get("MemberSid", 0),
                        event.get("Parameters", {}).get("GroupTypeChange", 0),
                        timeCreated,
                        timeCreated
                    ))

            elif eventID in computerID:
                    sql = """
                        INSERT INTO computerlog (
                        identifierIdLog, computerAccountChange, targetUserName, targetDomainName, targetSid,
                        subjectUserSid, subjectUserName, subjectDomainName,
                        subjectLogonId, privilegeList, samAccountName, displayName,
                        userPrincipalName, homeDirectory, homePath, scriptPath, profilePath,
                        userWorkstations, passwordLastSet, accountExpires, primaryGroupId,
                        allowedToDelegateTo, oldUacValue, newUacValue, userAccountControl,
                        userParameters, sidHistory, logonHours, dnsHostName, servicePrincipalNames,
                        service1, serverSid, serverName, serverIp,
                        created_at, updated_at
                        )
                        VALUES (
                        %s, %s, %s, %s, %s, 
                        %s, %s, %s,
                        %s, %s, %s, %s,
                        %s, %s, %s, %s, %s,
                        %s, %s, %s, %s,
                        %s, %s, %s, %s,
                        %s, %s, %s, %s, %s,
                        %s, %s, %s, %s,
                        %s, %s
                        )

                        ON DUPLICATE KEY UPDATE
                        targetUserName = VALUES(targetUserName),  targetDomainName = VALUES(targetDomainName), samAccountName = VALUES(samAccountName), updated_at = NOW()
                    """
                    cursor.execute(sql, (
                        identifierID,
                        event.get("Parameters", {}).get("ComputerAccountChange", 0),
                        event.get("Parameters", {}).get("TargetUserName", 0),
                        event.get("Parameters", {}).get("TargetDomainName", ""),
                        event.get("Parameters", {}).get("TargetSid", ""),
                        event.get("Parameters", {}).get("SubjectUserSid", ""),
                        event.get("Parameters", {}).get("SubjectUserName", ""),
                        event.get("Parameters", {}).get("SubjectDomainName", 0),
                        event.get("Parameters", {}).get("SubjectLogonId", 0),
                        event.get("Parameters", {}).get("PrivilegeList", 0),
                        event.get("Parameters", {}).get("SamAccountName", 0),
                        event.get("Parameters", {}).get("DisplayName", 0),
                        event.get("Parameters", {}).get("UserPrincipalName", 0),
                        event.get("Parameters", {}).get("HomeDirectory", 0),
                        event.get("Parameters", {}).get("HomePath", 0),
                        event.get("Parameters", {}).get("ScriptPath", 0),
                        event.get("Parameters", {}).get("ProfilePath", 0),
                        event.get("Parameters", {}).get("UserWorkstations", 0),
                        event.get("Parameters", {}).get("PasswordLastSet", 0),
                        event.get("Parameters", {}).get("AccountExpires", 0),
                        event.get("Parameters", {}).get("PrimaryGroupId", 0),
                        event.get("Parameters", {}).get("AllowedToDelegateTo", 0),
                        event.get("Parameters", {}).get("OldUacValue", 0),
                        event.get("Parameters", {}).get("NewUacValue", 0),
                        event.get("Parameters", {}).get("UserAccountControl", 0),
                        event.get("Parameters", {}).get("UserParameters", 0),
                        event.get("Parameters", {}).get("SidHistory", 0),
                        event.get("Parameters", {}).get("LogonHours", 0),
                        event.get("Parameters", {}).get("DnsHostName", 0),
                        event.get("Parameters", {}).get("ServicePrincipalNames", 0),
                        event.get("Parameters", {}).get("Service1", 0),
                        event.get("ServerSID", 0),
                        event.get("ServerName", 0),
                        event.get("ServerIP", 0),
                        timeCreated,
                        timeCreated
                    ))
        except Exception as e:
            print(f"Erreur lors du traitement de l'événement {eventID}: {e}")
            # print(f"EventID: {eventID}")  # Vérifie l'EventID
            # print(f"Identified Event: {identified_event}")  # Vérifie l'EventID récupéré
            # print(f"IdentifierID: {identifierID}") 

    connection.commit()
    cursor.close()
    connection.close()
# process_events---

if __name__ == "__main__":

    dbConfig = {
        "host": "127.0.0.1",
        "user": "root",
        "password": "",
        "database": "ads",
        "charset": "utf8mb4"
    }

    userID     = {4723, 4720, 4722, 4725, 4726, 4738, 4740, 4781}
    groupID    = {4731, 4732, 4733, 4734, 4735, 4727, 4737, 4728, 4729, 4730, 4754, 4755, 4756, 4757, 4758, 4764}
    computerID = {4741,4742,4743}

    pathDir = "./partage/events"
    print(f"Surveillance du répertoire : {pathDir}")

    while True:
        for file in os.listdir(pathDir):
            if file.lower().endswith(".json"):
                filePath = os.path.join(pathDir, file)
                print(f"Traitement du fichier : {file}")

                with open(filePath, 'r', encoding='utf-8-sig') as jsonFile:
                    eventsFromJson = json.load(jsonFile)

                process_events(eventsFromJson,userID,groupID,computerID,dbConfig)

                os.remove(filePath)
            time.sleep(120)  # Vérifie toutes les 2 minutes
# Main---