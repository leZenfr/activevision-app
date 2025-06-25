# Documentation

## Étape 1 : Mettre les scripts dans le répertoire dédié

```
cd /activevision-app/
```

```
sudo cp agents/object-agent.py /srv/
sudo cp agents/event-agent.py /srv/
```

## Étape 2 : Configurer le script d'installation et le script de lancement
```
sudo cp conf/install-lib.sh /srv/
sudo cp conf/start.sh /srv/
```

```
cd /srv/
```

```
sudo chmod +x install-lib.sh
sudo chmod +x start.sh
```

## Étape 3 : Configurer la base de données des scripts python

```
sudo nano event-agent.py
```

Puis modifier les informations de la base dans le script.

```
    dbConfig = {
        "host": "127.0.0.1",
        "user": "VOTRE_UTILISATEUR",
        "password": "VOTRE_MOT_DE_PASSE",
        "database": "ads",
        "charset": "utf8mb4"
    }
```

## Étape 4 : Exécuter les scripts dans l'ordre

Installation des librairies requises dans un venv
```
sudo ./install-lib.sh
```

Démarrer les agents python
```
sudo bash start.sh
```

