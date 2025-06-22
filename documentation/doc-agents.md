# Documentation

## Étape 1 : Mettre les scripts dans le répertoire dédié

```
cd /activevision-app/
```

```
sudo cp agents/object-agent.py /srv/
sudo cp agents/event-agent.py /srv/
```

## Étape 3 : Configurer le script d'installation et le script de lancement
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

## Étape 4 : Exécuter les scripts dans l'ordre

Installation des librairies requises dans un venv
```
sudo ./install-lib.sh
```

Démarrer les agents python
```
sudo bash start.sh
```

