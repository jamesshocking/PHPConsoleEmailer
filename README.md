# Mail 2 RU Client

## Update Composer
php composer.phar update

## CRON
Edit /etc/crontab

Add, to run daily at 12pm 

0 12 * * * php ~/PHPConsolerEmailer/src/main.php

##
