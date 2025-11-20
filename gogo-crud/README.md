# Comando utilizados en el proyecto

```bash
php artisan make:controller NoteController
php artisan make:model Note --migration
php artisan migrate
php artisan make:request NoteRequest
php artisan route:list
```

Para la (API)[https://laravel.com/docs/12.x/routing#api-routes]
```bash
php artisan install:api
php artisan make:controller PostController --resource
php artisan make:resource PostResource
```

Para los seeders
```bash 
php artisan make:model Products -mcr
php artisan make:seeder ProductsSedder
```