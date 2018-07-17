# Laravel-Datatable
A simple example of using Datatable.js with Laravel 5.6

# Usage

#### Change these fields to your database config in the .env file
```
DB_DATABASE=db_name
DB_USERNAME=db_username
DB_PASSWORD=db_password
```

#### Migrate Users' Table
```php
php artisan migrate
```

#### Seed Users' Table
```php
php artisan tinker
```
```php
factory(App\User::class, 100)->create();
```
```php
exit
```

## Run
```php
php artisan serve
```

#### Enjoy!
