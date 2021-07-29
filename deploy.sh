composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo "**DONT FORGET**"
echo "Edit variable APP_DEBUG become FALSE in .env file"
exec $SHELL
