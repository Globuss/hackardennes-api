#!/usr/bin/env sh

php bin/console doctrine:schema:drop --force
php bin/console doctrine:schema:create
#php bin/console hautelook_alice:doctrine:fixtures:load

php bin/console app:ImportItinerairesCommand y
php bin/console app:ImportChateauPathCommand
