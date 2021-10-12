# Steps
- Run 
```sh
composer install --ignore-platform-reqs && cp .env.example .env && php artisan key:generate && php artisan jwt:secret
```
- Generate Fake Products
``` 
php artisan db:seed
```

- Generate Admin
```
php artisan tinker
$admin = new Admin
$admin->name="admin"
$admin->email="admin@admin.com"
$admin->password=Hash::make("your_pass")
$admin->save()
```
