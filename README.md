## Instructions d'installation

### Étape 1 : Construction de l'image de base PHP

Pour construire l'image de base PHP, ouvrez un terminal à la racine du projet et exécutez la commande suivante :

    docker build -f ./projet_docker/Dockerfile.php -t base-php .

- `-f` spécifie le fichier Dockerfile à utiliser pour la construction.
- `-t` permet de tagger l'image résultante pour une référence facile.
- Le `.` indique que le répertoire actuel est le contexte de construction, où Docker cherchera les fichiers référencés dans le Dockerfile.

### Étape 2 : Construction et démarrage des conteneurs

Toujours depuis la racine du projet, lancez la construction et le démarrage des conteneurs en exécutant :

    docker compose up --build

Cette commande effectue les opérations suivantes :
- Construit les images des conteneurs si elles n'ont pas encore été construites ou si des modifications ont été apportées aux Dockerfiles.
- Démarre les conteneurs après la construction. Si les images existent déjà et qu'aucune modification n'a été apportée, elle démarre simplement les conteneurs.

### Étape 3 : Construction de la base de données

Vérifiez si le projet contient déjà une migration. Si ce n'est pas le cas :

- Créer une migration avec la commande : 
    docker exec `<id ou nom du containeur>` php bin/console make:migration

- Si le projet contient une migration OU après avoir exécuté la commande pour créer la migration, exécutez cette dernière avec la commande : 
    docker exec `<id ou nom du containeur>` php bin/console d:m:m

- Pour éxécuter des fixtures utiliser la commande : 
    docker exec `<id ou nom du containeur>` php bin/console doctrine:fixture:load