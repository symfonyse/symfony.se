#!/bin/bash

php app/console cache:clear --env=dev --no-warmup;
php app/console cache:clear --env=prod --no-warmup;

chmod -R 777 app/cache
chmod -R 777 app/logs
