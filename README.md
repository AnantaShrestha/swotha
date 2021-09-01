# swotah-web
#####Steps to run in local environment
```
1. Clone the project
2. Make a database named swotah in your mysql
3. Export database from dumpdata
4. composer install(never do composer update)
5. rename .env.template to .env and change database name and password accordingly
6. run command "php artisan key:generate"
6. php artisan serve
```