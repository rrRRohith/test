
# Test application

Manage companes and employees

## Environment Variables

To run this project, you will need to update the following environment variables to your .env file

`DB_DATABASE`
`DB_USERNAME`
`DB_PASSWORD`

## Installation

Clone Test application

``` 
  git clone https://github.com/rrRRohith/test.git
```

Go to the project directory

```bash
  cd test
```
Copy .env.example to .env

Install dependencies

``` 
  composer install
```

Install node modules and run

``` 
  npm install && npm run dev
```

Run migration

``` 
  php artisan migrate
```

Run seeder

``` 
  php artisan db:seed
```

Start application

``` 
  php artisan serve
```

Login to admin

``` 
  email    : admin@admin.com
  password : password
```

Run the following commands if styles, scripts, or images are not loading

``` 
  php artisan storage:link
  npm run dev
  npm run build
```

Postman documentation

``` 
  https://documenter.getpostman.com/view/19727991/2s9YsNdVUu
```
