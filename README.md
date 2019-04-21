# Laravel 5.8 + Angular 7

vagrant up

sudo apt-get install composer php7.2-xsl php7.2-zip php7.2-mbstring libapache2-mod-php7.2

cd /var/www/awesome &&
composer require "laravel/installer"
composer create-project laravel/laravel --prefer-dist

sudo service nginx stop 
cd /var/www/awesome/laravel/ && chmod -R 777 storage && chmod 777 bootstrap/cache && sudo service nginx stop && sudo php artisan serve  --host 0.0.0.0 --port 80

cd /var/www/awesome/ && mkdir angular && cd angular
sudo npm install -g @angular/cli
