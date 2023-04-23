@echo off
php artisan cache:clear
php artisan config:cache
php artisan serve -vvv
pause