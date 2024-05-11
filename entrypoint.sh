set -e

until pg_isready -h postgres -p 5432; do
    echo "Attente de la disponibilité de PostgreSQL..."
    sleep 1
done

echo "PostgreSQL est pret!"

MIGRATIONS_DIR="/app/migrations"
FIXTURES_DIR="/app/src/DataFixtures"

cd /app

if [ ! -d "$MIGRATIONS_DIR" ]; then
    echo "Le dossier de migration n'existe pas, lancement du serveur de développement..."
    php -S 0.0.0.0:8000 -t public
    exit 0
fi


if [ "$(ls $MIGRATIONS_DIR)" ]; then
    echo "Des fichiers de migration existent déjà."
else
    echo "Aucun fichier de migration trouvé, création d'une nouvelle migration..."
    php bin/console make:migration --no-interaction
fi

echo "Exécution des fichiers de migration."
php bin/console doctrine:migrations:migrate --no-interaction

if [ "$(ls $FIXTURES_DIR)" ]; then
    echo "Exécution des fixtures."
    php bin/console doctrine:fixtures:load --no-interaction 
else
    echo "Aucun fichier de fixture trouvé."
fi

php -S 0.0.0.0:8000 -t public