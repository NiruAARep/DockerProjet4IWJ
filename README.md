## Instructions d'installation

### Étape 1 : Construction de l'image de base PHP

Pour construire l'image de base PHP, ouvrez un terminal à la racine du projet et exécutez la commande suivante :

    docker build -f Dockerfile.php -t base-php .

- `-f` spécifie le fichier Dockerfile à utiliser pour la construction.
- `-t` permet de tagger l'image résultante pour une référence facile.
- Le `.` indique que le répertoire actuel est le contexte de construction, où Docker cherchera les fichiers référencés dans le Dockerfile.

### Étape 2 : Variable d'environnements

Il y a deux fichiers d'environnement à configurer. Le premier se trouve à la racine du projet et permet de configurer la création de la base de données PostgreSQL. Trois variables sont nécessaires :
- POSTGRES_DB : Nom de la base de données
- POSTGRES_USER : Nom du rôle
- POSTGRES_PASSWORD : Mot de passe du rôle

Attention : 
- Pour la variable POSTGRES_DB, les noms "postgres", "template0" et "template1" ne sont pas corrects car ils sont déjà utilisés lors de l'initialisation de PostgreSQL. 
- De même, pour la variable POSTGRES_USER, la valeur "postgres" n'est pas autorisée car c'est l'utilisateur par défaut.
- Par défaut, si les variables d'environnement ne sont pas configurées, les valeurs seront "app" pour le nom de la base de données et l'utilisateur, et "password" pour le mot de passe.

Un fichier .env.example est présent dans le projet pour rappeler les variables à saisir dans le fichier .env.

Le second fichier à configurer est le fichier d'environnement du projet Symfony. La valeur à changer est la chaîne de connexion à la base de données :

DATABASE_URL="postgresql://`<POSTGRES_USER:-"app">`:`<POSTGRES_PASSWORD:-"password">`@postgres:5432/`<POSTGRES_DB:-"app">`?serverVersion=16&charset=utf8"

### Étape 3 : Construction et démarrage des conteneurs

Toujours depuis la racine du projet, lancez la construction et le démarrage des conteneurs en exécutant :

    docker compose up --build

Cette commande effectue les opérations suivantes :
- Construit les images des conteneurs si elles n'ont pas encore été construites ou si des modifications ont été apportées aux Dockerfiles.
- Démarre les conteneurs après la construction. Si les images existent déjà et qu'aucune modification n'a été apportée, elle démarre simplement les conteneurs.

### Étape 4 : Construction de la base de données

Vérifiez si le projet contient déjà une migration. Si ce n'est pas le cas :

- Créer une migration avec la commande : 
    docker exec `<id ou nom du containeur>` php bin/console make:migration

- Si le projet contient une migration OU après avoir exécuté la commande pour créer la migration, exécutez cette dernière avec la commande : 
    docker exec `<id ou nom du containeur>` php bin/console d:m:m

- Pour éxécuter des fixtures utiliser la commande : 
    docker exec `<id ou nom du containeur>` php bin/console doctrine:fixture:load