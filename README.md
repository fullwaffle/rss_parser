# Requirements for project
1. Installed Docker (For Windows: https://docs.docker.com/docker-for-windows/install/, Linux: https://docs.docker.com/engine/install/) and Mac: https://docs.docker.com/docker-for-mac/install/)
2. Installed Cron for automation (For Ubuntu: `sudo apt install cron`, Fedora: `dnf install cronie`)
# Install
1. Copy project to your directory `git clone https://github.com/fullwaffle/rss_parser && cd rss_parser`
2. Type `./vendor/bin/sail up` (-d for background work)  in console to launch server instance
# Cron guide
1. (OPTIONAL) Replace `rss_parser_laravel.test_1` with your container id or name in the script
2. Replace `* * * * *` in the script according to your needs (https://crontab.guru/)
```
 .---------------- minute (0 - 59)
 |  .------------- hour (0 - 23)
 |  |  .---------- day of month (1 - 31)
 |  |  |  .------- month (1 - 12) OR jan,feb,mar,apr …
 |  |  |  |  .---- day of week (0-6) (Sunday=0 or 7)
 |  |  |  |  |            OR sun,mon,tue,wed,thr,fri,sat
 |  |  |  |  |               
 *  *  *  *  *  
```
3. Type `crontab -e` in console to edit crontab file
4. Add script Below to crontab file
```
MAILTO=""
SHELL=/bin/bash

* * * * * docker exec -t rss_parser_laravel.test_1 bash -c "php artisan migrate; php /var/www/html/public/index.php"
```
