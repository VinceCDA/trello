# Test project for CI/CD

1. Get dependencies
composer upgrade
2. Launch database
docker compose up -d
3. Add migrations to the database
php bin/console d:m:m
4. Create test database
php bin/console d:d:c --env=test
5. Add migrations to the test database
php bin/console d:m:m --env=test
6. Add fixtures to the test database
php bin/console doctrine:fixtures:load --env=test