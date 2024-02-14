# TP1-REDIS
**README - Gestion des connexions utilisateurs avec Redis et MySQL**

Ce projet présente un système de gestion des connexions utilisateurs qui utilise Redis pour suivre le nombre de connexions actives et MySQL pour l'authentification des utilisateurs.

### Installation et Configuration

#### Prérequis

- Python installé sur votre système.
- WampServer (ou tout autre serveur web local) pour exécuter le code PHP et accéder à MySQL.
- Redis Server installé localement pour la gestion des connexions utilisateurs.

#### Configuration de Redis

1. Assurez-vous que Redis est installé et en cours d'exécution sur votre système local. Vous pouvez télécharger Redis à partir du site officiel : [Redis.io](https://redis.io/download).
2. Par défaut, Redis doit écouter sur le port 6379. Veuillez vérifier que ce port est disponible et accessible sur votre machine.

#### Configuration de WampServer

1. Installez WampServer sur votre système si ce n'est pas déjà fait.
2. Assurez-vous que le serveur MySQL de WampServer est en cours d'exécution.

### Utilisation

#### Structure du Code

Le code est divisé en trois parties principales :

1. **Connexion à Redis et MySQL :** La première partie du code établit les connexions avec Redis et MySQL en utilisant les bibliothèques Redis et MySQL Connector pour Python.

2. **Fonctions de Gestion des Connexions :** Les fonctions `verifier_autorisation_utilisateur` et `gerer_connexion_utilisateur` permettent respectivement de vérifier si un utilisateur est autorisé à se connecter et de gérer les connexions utilisateur en utilisant Redis pour le suivi du nombre de connexions.

3. **Exécution du Code :** Le script teste les fonctions en simulant la connexion d'un utilisateur.
#### Exécution du Code

Pour exécuter le code :

1. Assurez-vous que Redis Server est en cours d'exécution.
2. Exécutez le script Python en utilisant Python.
3. Assurez-vous que le serveur MySQL de WampServer est en cours d'exécution pour l'authentification utilisateur.

