# Requirements for project
1. Installed Docker (For Windows: https://docs.docker.com/docker-for-windows/install/, Linux: https://docs.docker.com/engine/install/ and Mac: https://docs.docker.com/docker-for-mac/install/)
2. Installed Cron for automation (For Ubuntu: `sudo apt install cron`, Fedora: `dnf install cronie`)
# Install
1. Copy project `git clone -b laravel_command_with_admin https://github.com/fullwaffle/rss_parser && cd rss_parser`
2. Type `./vendor/bin/sail up` (add `-d` key for background work)  in console to launch server instance
3. Wait for it to finish
4. Install admin panel and run migrations `./vendor/bin/sail artisan voyager:install`
5. Add admin user `./vendor/bin/sail artisan voyager:admin your@email.com --create`
6. Admin panel accessible with `admin` prefix e.g. `localhost/admin`
# Cron guide
1. Replace `everyMinute()` in `app\Console\Kernel.php` (https://laravel.com/docs/8.x/scheduling#schedule-frequency-options)
2. Type `crontab -e` in console to edit crontab file
3. Add script to crontab file
```
MAILTO=""
SHELL=/bin/bash

* * * * * docker exec -t rbc_rss_parser php artisan schedule:run
```
# Admin panel guide
1. Open `/admin/database` and add BREAD to `news` and `logs` table. Model names are `App\Models\News` and `App\Models\Log`. You can leave controller name empty.
