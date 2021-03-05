# voyager-demo
Voyager project is an admin interface using Laravel Framework (PHP).

## Getting Started

### Installing

A step by step how to get a development env running

1.  `$ git clone https://github.com/maulana20/voyager-demo`
2.  `$ composer install`
3.  Create **.env** file as per **.env.example**. #REQUIRED line must be change
4.  `$ php artisan key:generate`
5.  `$ php artisan storage:link` (Command to generate a symbolic link from public / storage to storage / app / public)
7.  `$ php artisan voyager:install --with-dummy` (Command to generate dummy data will include 1 admin account (if no users already exist), 1 demo page, 4 demo posts, 2 categories and 7 settings)
8.  `$ php artisan migrate --seed`
9.  Set DocumentRoot to {PROJECT_HOME} / public
10.  Access from Browser with http:domain/admin

### User Credential

`username : admin@admin.com`
`password : password`
