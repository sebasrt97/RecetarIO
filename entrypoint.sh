#!/bin/sh

# Si no existe vendor/autoload.php, no arranca Laravel
if [ ! -f /var/www/html/vendor/autoload.php ]; then
  composer install
fi

if [ ! -f public/build/manifest.json ]; then
  npm install && npm run build
fi

if [ ! -f /var/www/html/.env ]; then
  cp /var/www/html/.env.example /var/www/html/.env
fi

if ! grep -q "^APP_KEY=" .env; then
  php artisan key:generate
fi

php artisan serve --host=0.0.0.0 --port=8000
