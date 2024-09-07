# Para crear un nuevo proyecto en laravel se debe instalar de manera global luego de composer

```bash
composer global require laravel/installer
laravel new example-app
```

# Como creamos un nombre de dominio en windows

Ya que es un poco tedioso navegar constantemente a:
http://localhost/laravel/blog/public/
Entonces cambiaremos esto para solo ir a :
*blog.test*

Ejecutamos el block de notas como administrador y vamos a la siguiente carpeta:

**C:\Windows\System32\drivers\etc\**

Y abrimos este archivo **hosts**

Y adicionamos la siguiente configuracion:

```
127.0.0.1 blog.test
```

De esta manera le indicamos que la interfaz que tenemos de loopback apuntara la que ya conocemos *127.0.0.1* y tambien el dominio que pusimos *blog.test*

Ahora lo que debemos hacer es navegar a la siguiente ruta para configurar e indicarle a xampp que usaremos ese dominio:

**C:\xampp\apache\conf\extra\**

Y buscar el archivo:
**httpd-vhosts.conf**

Abrimos con el block de notas y añadimos la siguiente configuracion:

```bash
<VirtualHost *:80>
ServerName localhost
DocumentRoot "C:/xampp/htdocs"
</VirtualHost>

<VirtualHost *:80>
ServerName blog.test
DocumentRoot "C:/xampp/htdocs/laravel/blog/public"
</VirtualHost>
```
Y ahora si navegamos a blog.test tendremos la ruta de nuestro proyecto


# Notas del proyecto

## RUTAS

* El archivo web.php que esta ubicado en el directorio **routes/web.php** es el archivo que se encarga de manejar las rutas de nuestro proyecto.

## CONTROLADORES

* Como creas un controlador
En la ruta de nuestro proyecto ejecutar el sig comando:

```bash
php artisan make:controller HomeController
```

Esto te creara un archivo dentro de la carpeta *app/Http/Controllers*   de nombre HomeController.php

### Y como vinculamos el controlador con la ruta.

El controlador quedaria de la siguiente manera:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Funcion que renderizara la pagina '/'
    public function index() {
        return ("Bienvenidos a la pagina principal desde el controlador.");
    }

}
```

Y en la ruta modificariamos de esta manera:
Paso de esto:
```php
Route::get('/', function () {
    //return view('welcome');
    return ('welcome to the home page');
});
```
A esto:
Al cual el primer parametro es el controlador y el segundo la funcion.
```php
Route::get('/', [HomeController::class, 'index']);
```

### Que sucede cuando tenemos un controlador con una unica funcion para renderizar la vista
Para eso podemos usar el metodo *invoke* para reducir el codigo en nuestra ruta de la siguiente manera:

El controlador:
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    //
    public function __invoke() {
        return ("Aqui se mostraran todos los posts desde el controlador");
    }
}

```

La ruta:
```php
/*Route::get('/posts', function() {
    return ("Aqui se mostraran todos los posts");
});*/
Route::get('posts', PostsController::class);
```

## VISTAS

### Como hacemos para que el controlador nos retorne un documento HTML y no una cadena

Las vistas se ubican en *resources/views/* <- Ahi se crean las vistas pero con una extension particular *.blade.* ahi deberiamos crear una vista de la siguiente manera:
**home.blade.php** <- Ahi introducimos todo el html como ser:

¿Como las vinculamos?

en el *return* llamamos a un HELPER (funciones para el uso interno de laravel) 

```php
return view('home');
```

La vista seria:
* resources/views/home.blade.php *
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeView</title>
</head>
<body>
    <h1>
        Bienvenidos a la pagina principal desde la vista.
    </h1>
</body>
</html>
```

El metodo del controlador:
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Funcion que renderizara la pagina '/'
    /*public function index() {
        return ("Bienvenidos a la pagina principal desde el controlador.");
    }*/

    public function index() {
        return view("home");
    }

}

``` 

### Y que pasa si mandamos parametros

La vista:

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
</head>
<body>
    <h2>
        Aqui se mostrara el post con Nombre: 
        <?= $postName ?>
    </h2>
</body>
</html>
```

La funcion del controlador:
> NOTA: Si esta **post.index** es porque creamos una carpeta en *resources/views/post* <- ahi dentro esta el *index.blade.php* 

Le pasamos parametros por un array asociativo

```php
public function show($postName, $postCategory = null)
{
    if($postCategory){
        return "Aqui se mostrara el post con Nombre: $postName y con categoria: $postCategory";    
    }

     //return "Aqui se mostrara el postconNombre:$postName y sin categoria";
     /*return view("post.index",[
         "postName" => $postName
     ]);*/
     // Como alternativa a estar escribiendopostName=>$postName usamos el compact que hacelo mismo
     return view("post.index", compact('postName'));
}
```

## Componentes en Laravel

Existen de dos tipos:
* Componentes anonimos <- Que son los que creamos directamente colocando click derecho y crear un componente.blade.php
* Componentes de clase <- Que son los que creamos utilizando el comando *php artisan make:component <nombreComponente>*

> NOTA: En los componentes anonimos metemos toda la logica al recibir props dentro del mismo archivo. Mientras que en los componentes de clase luego de ejecutar el comando se crean dos archivos: Uno para la logica del negocio que es una clase en *app/View/Components* y otro para el componente que es una vista en *resources/views/components*.

> NOTA2: Cuando nosotros pasemos atributos a un componente los que no lo capturemos en las props se pasa a una variable $attributes

### Componentes anonimos

Para ello lo ideal es crear un directorio en el que se ubiquen todos los componentes que necesitemos.

Esto lo crearemos en la ruta *resources/views/components*

El componente que definimos para ejemplo sera:

```html
<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
  <span class="font-medium">Danger alert!</span> Change a few things up and try submitting again.
</div>
```
Y nosotros como lo utilizamos:
En nuestra vista lo llamaremos de la siguiente manera:

```html
<x-alert />
<!-- o -->
 <x-alert > </x-alert>
```
### SLOT en componentes
Y si nosotros queremos mostrar un contenido dentro de la alerta podemos hacerlo de la siguiente manera:

```html	
<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
  <span class="font-medium">Danger alert! </span> 
  {{ $slot }}
</div>
```

Y lo añadiriamos de la siguiente manera:
```php
<x-alert>
	Aqui se mostrara el contenido de la alerta
</x-alert>
```

> Como añadimos mas de un slot podemos hacerlo de la siguiente manera:

```php
<x-alert>
	<x-slot name="message">
		Mensaje
	</x-slot>
	Aqui se mostrara el contenido de la alerta
</x-alert>  

// Y el componente se veria asi:

<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
  <span class="font-medium">{{ $message ?? 'Info Alert' }}! </span> 
  {{ $slot }}
</div>
```	

Por ultimo para ver como funciona con los parametros que le pasemos al componente los trabajariamos de la siguiente manera:

```php
{{-- Para recibir las props en un componente --}}
@props(['type' => ''])

@php
  switch ($type) {
    case 'danger':
      $class = 'text-red-800 bg-red-50 dark:bg-gray-800 dark:text-red-400';
      break;
    case 'success':
      $class = 'text-green-800 bg-green-50 dark:bg-gray-800 dark:text-green-400';
      break;
    case 'warning':
      $class = 'text-yellow-800 bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400';
      break;
    default:
      $class = 'text-gray-800 bg-gray-50 dark:bg-gray-800 dark:text-gray-400';
      break;
  }
@endphp

{{-- <div class="{{ $class }} p-4 text-sm rounded-lg" role="alert">
  <span class="font-medium">{{ $message ?? 'Info Alert' }}! </span> 
  {{ $slot }}
</div> --}}
<div {{ $attributes->merge(["class" => "p-4 text-sm rounded-lg" . $class]) }} role="alert">
  <span class="font-medium">{{ $message ?? 'Info Alert' }}! </span> 
  {{ $slot }}
</div>
<p>Texto de prueba</p>
```

### Componentes de clase

Ejecutamos el siguiente comando:

```bash
    php artisan make:component Alert2
```

> Todo lo del controlador queda conectado con el componente

El archivo controller quedaria de la siguiente manera:

```php
<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert2 extends Component
{
    public $class = "";
    /**
     * Create a new component instance.
     */
    public function __construct($type = "", )
    {
        switch ($type) {
            case 'danger':
              $class = 'text-red-800 bg-red-50 dark:bg-gray-800 dark:text-red-400';
              break;
            case 'success':
              $class = 'text-green-800 bg-green-50 dark:bg-gray-800 dark:text-green-400';
              break;
            case 'warning':
              $class = 'text-yellow-800 bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400';
              break;
            default:
              $class = 'text-gray-800 bg-gray-50 dark:bg-gray-800 dark:text-gray-400';
              break;
          }
          
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert2');
    }
}

```

Y la vista:

```php
<div {{ $attributes->merge(["class" => "p-4 text-sm rounded-lg" . $class]) }} role="alert">
    <span class="font-medium">{{ $message ?? 'Info Alert' }}! </span> 
    {{ $slot }}
</div>
<p>Texto de prueba</p>
```















    ```php

    ```














    # Pasos para clonar el repositorio del proyecto

    1. Clonar el repositorio
    ```bash
    git clone https://github.com/laravel/blog.git <- url de prueba
    ```
    2. Instalar dependencias
    ```bash
    cd blog
    composer install
    ```
    3. Generar llave de seguridad
    ```bash
    php artisan key:generate
    ```
    4. Crear el archivo de variables de entorno
    Copiar el archivo .env.example a .env
    Cambiar las credenciales de las dependencias usadas

    5. Crear la base de datos (si es SQLite)
    Crear el archivo database/database.sqlite

    6. Correr las migraciones
```bash	
php artisan migrate
```








