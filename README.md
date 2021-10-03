# Steps
- Run 
```sh
composer install --ignore-platform-reqs && cp .env.example .env && php artisan key:generate && php artisan jwt:secret
```
