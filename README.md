# Library example project

Example project on the Lumen PHP Framework.

## Requirements

* The minimum required PHP version is PHP 7.2.5.
* MySQL or PostgreSQL
* composer

## Installation

```shell script
composer install
php artisan migrate
php artisan db:seed
```

## Configuration

Configuration are stored in the .env file.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```
