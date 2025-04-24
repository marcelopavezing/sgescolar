docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs && ./vendor/bin/sail up -d && npm install --save-dev vite laravel-vite-plugin && npm run build
