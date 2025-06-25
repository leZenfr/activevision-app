Voici une documentation permettant de configurer le partage SMB via kerberos entre un serveur Linux et le Contrôleur de Domaine.

**IMPORTANT :** il s'agit d'une documentation. Modifiez les paramètres en fonction de votre matériel et de vos exigences.

AD = srv-shareflers.cat.love | 192.168.150.90
SV = srv-ActiveV | 192.168.150.22

---
```
sudo apt -y install winbind libpam-winbind libnss-winbind krb5-config samba
sudo mv /etc/samba/smb.conf /etc/samba/smb.conf.back
sudo nano /etc/samba/cmb.conf
```
Pendant l'installation vous allez être invité à préciser votre nom de domaine, **majuscule obligatoire** 
![[PJ/Pasted image 20250622153500.png]]
préciser votre serveur AD pour les deux prochaines entrées.
![[PJ/Pasted image 20250622172857.png]]

**/etc/samba/smb.conf**
```
workgroup = CAT
password server = srv-shareflers.cat.love
realm = CAT.LOVE
security = ADS
idmap config * : range = 16777216-33554431
template homedir = /home/%D/%U
template shell = /bin/bash
winbind use default domain = true

[partage]
        path = /srv/partage/
        valid users = "@CAT\GDL_SVAD_SMB-WO"
        force group = "GDL_SVAD_SMB-WO"
        writable = yes
        read only = no
        force create mode = 0660
        create mask = 0777
        directory mask = 0333
        access based share enum = yes
        hide unreadable = yes
```

Il faut mettre l'ip du serveur AD en DNS principal
```
echo "dns-nameservers $ipServerAD"| sudo tee -a 
/etc/network/interfaces
```

```
sudo systemctl restart networking.service
net ads join -U "DLGUSER01"
sudo mkdir /srv/partage
sudo chmod 333 /srv/partage
mkdir /srv/partage/objects
mkdir /srv/partage/events
systemctl restart winbind smbd nmbd
```

