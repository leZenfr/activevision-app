# Activevision

## 📖 Présentation du projet

Ce projet a pour objectif la mise en place d’une solution de supervision d’un environnement Active Directory on-premise, permettant à la fois une étude en temps réel et rétrospective des événements.

La solution proposée a pour objectif de surveiller les événements critiques au sein de l’infrastructure Active Directory. Elle permettra notamment :

- **La supervision des logs de sécurité**, incluant la création, la modification et la suppression des objets utilisateurs, groupes et ordinateurs ainsi que le verrouillage des comptes.

- **Le suivi des modifications d’attributs** en utilisant un ensemble d’attributs relatifs aux objets utilisateurs, groupes et ordinateurs sera collecté à chaque analyse. Cela permettra de détecter les modifications, d’en conserver un historique, et ainsi de faciliter les audits.

- **La mise en place d’un système d’alerte** pour remonter des notifications qui seront générées en cas de détection de comportements suspects ou d’activités anormales. 

**Le développement d’une plateforme web** afin de retranscrire tous les événements détectés.

## 📥 Installation du projet 

```
sudo git clone https://github.com/leZenfr/activevision-app.git
```

## ⚙️ Configuration du projet

- [Documentation : Partage SMB via Kerberos](https://github.com/leZenfr/activevision-app/blob/main/documentation/doc-share.md)
- [Documentation : Application Web](https://github.com/leZenfr/activevision-app/blob/main/documentation/doc-web.md)
- [Documentation : Agents Python](https://github.com/leZenfr/activevision-app/blob/main/documentation/doc-agents.md)
- [Documentation : Active Directory](https://github.com/leZenfr/activevision-app/blob/main/documentation/doc-agents.md)