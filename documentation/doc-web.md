# Installation de l'application web

### Étape 1 : Installer le projet

Préparer tous les packages nécessaires
```
sudo apt update && sudo apt install apache2 php php-cli php-mbstring php-xml php-bcmath php-curl php-mysql unzip curl mariadb-server mariadb-client phpmyadmin composer git python3 python3-pip python3-venv npm -y
```
Pour le serveur web sélectionner faire `espace` puis `entrer`

Installer le projet dans le répertoire `/var/www/`
```
cd /var/www/
sudo git clone https://github.com/leZenfr/activevision.git
```
Il faut ensuite installer les dépendances 
```
cd activevision/
```
```
sudo composer install
```
```
sudo npm install
```
### Étape 2 : Configurer l'application et la base de données

IMPORTANT : Il faut rester dans le répertoire `/var/www/activevision`

Créer la base de données
```
sudo mysql -u root -p -e "CREATE DATABASE ads;"
```

Créer l'utilisateur pour la base de données
```
DB_NAME="ads"
DB_USER="mon_user"
DB_PASS="mon_mot_de_passe"

sudo mysql -u root -p <<EOF
CREATE USER '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASS}';
GRANT ALL PRIVILEGES ON ${DB_NAME}.* TO '${DB_USER}'@'localhost';
FLUSH PRIVILEGES;
EOF
```

Sauvegarder et configurer le fichier d'environnement
```
sudo cp .env.example .env
```
Mettre les informations de la base de données
```
sudo nano .env
```
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ads
DB_USERNAME=VOTRE_USER
DB_PASSWORD=VOTRE_MOT_DE_PASSE
```

Paramétrer mysql pour rendre la base compatible
```
nano /etc/mysql/my.cnf
```

Rajouter cette ligne à la fin
```
[mysqld]
sql_mode=""
```
Redémarrer le service
```
sudo systemctl restart mysql
```

Build l'application
```
sudo npm run build
```

Faire les migrations
```
php artisan migrate
```

Créer la clé 
```
sudo php artisan key:generate
```

Préremplir la base 
```
php artisan db:seed
```

### Étape 3 : Démarrer l'application 
```
sudo php artisan serve --host=0.0.0.0 --port=8000
```

Mot de passe par défaut l'app :

Identifiants : admin@activevision.fr
MDP : admin1234
