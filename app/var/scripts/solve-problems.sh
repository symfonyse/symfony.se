#!/bin/bash
# v4

#################################################
#                                               #
#     This file clears the cache and runs       #
#     assets install and assetic dump           #
#                                               #
#     @Author Tobias Nyholm                     #
#                                               #
#################################################

ENV='prod'

while [ "$1" != "" ]; do
    case $1 in
        --prod )                shift
                                ENV='prod'
                                ;;
        --dev )                 ENV='dev'
                                ;;
    esac
    shift
done

echo "Solving problems for [$ENV]:"

echo " * Clearing Symfony cache..."
php app/console cache:clear --no-warmup --env=$ENV > /dev/null

echo " * Installing assets..."
php app/console assets:install web > /dev/null
echo " - ok"

echo " * Dumping assetic..."
php app/console assetic:dump --env=$ENV > /dev/null
echo " - ok"

echo "If it doesn't work now, then you are wrong."