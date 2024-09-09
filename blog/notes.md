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


## Plantillas

Para compartir una misma estructura en diferentes vistas como puede ser el caso que importemos un mismo header o footer para diferentes vistas y no tener que estarlos repitiendo.

Primeramente seria lo mismo que crear un componente pero y en este envolveriamos todo en nuestro *slot*.

Se podria hacer de esta manera:
1. Mi componente: 
```php

<x-app-layout>

<h1>
Bienvenidos a la pagina principal desde la vista.
</h1>
<h2>Alert anonimo</h2>
{{-- <x-alert /> --}}
<x-alert type="success" class="mb-4">
<x-slot name="message">
Mensaje
</x-slot>
Aqui se mostrara el contenido de la alerta
</x-alert>
<h2>Alert con clase</h2>
<x-alert2 type="warning" class="mb-8">
<x-slot name="message">
Mensaje
</x-slot>
Aqui se mostrara el contenido de la alerta
</x-alert2>

</x-app-layout>
```
2. La vista:

```php

<x-app-layout>

<h1>
Bienvenidos a la pagina principal desde la vista.
</h1>
<h2>Alert anonimo</h2>
{{-- <x-alert /> --}}
<x-alert type="success" class="mb-4">
<x-slot name="message">
Mensaje
</x-slot>
Aqui se mostrara el contenido de la alerta
</x-alert>
<h2>Alert con clase</h2>
<x-alert2 type="warning" class="mb-8">
<x-slot name="message">
Mensaje
</x-slot>
Aqui se mostrara el contenido de la alerta
</x-alert2>

</x-app-layout>
```

Ahora otra manera de crear es creando una carpeta layouts y hacer lo siguiente:

Creando un archivo dentro de la carpeta *views/layouts/app.blade.php*

```php    

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HomeView</title>
<script src="https://cdn.tailwindcss.com"></script>
<!-- Aqui importariamos mas cosas como puede ser una fuente mas scripts etc -->
</head>
<body>

<!-- Añadimos este nuevo header para toda la plantilla -->
<header>
<h1>Este sera un header para para toda la pagina </h1>
</header>

<main>
<!-- Con yield indicamos que esta parte sera dibujado por un contenido variable -->
@yield('content')

</main>  


<!-- Añadimos este nuevo footer para toda la plantilla -->
<footer>
<h1>Este sera un footer para para toda la pagina </h1>
</footer>

</body>
</html>

```

Y la vista:

```php
<!-- Con vista -->
@extends('layouts.app')

@section('content')

<h1>
Bienvenidos a la pagina principal desde la vista.
</h1>
<h2>Alert anonimo</h2>
{{-- <x-alert /> --}}
<x-alert type="success" class="mb-4">
<x-slot name="message">
Mensaje
</x-slot>
Aqui se mostrara el contenido de la alerta
</x-alert>
<h2>Alert con clase</h2>
<x-alert2 type="warning" class="mb-8">
<x-slot name="message">
Mensaje
</x-slot>
Aqui se mostrara el contenido de la alerta
</x-alert2>


{{-- Con componente <x-app-layout>--}}
{{--</x-app-layout>--}}

@endsection

```

## Como conectamos otra base de datos que nose sea la por defecto SQLite

1. Lo que debemos hacer es modificar las credenciales en el archivo *.env* en la raiz del proyecto.

2. Ver que tipo de base de datos y que credenciales necesita cada gestor. Eso en el archivo *config/database.php* .

3. Ejecutar las migraciones para ver el cambio en el nuevo gestor con:

```bash
    php artisan migrate
```
### Para ejecutar migraciones

* Para crear una migracion y crear la estructura de una nueva tabla

```bash
    php artisan make:migration create_nombretabla_table
```

Esto nos creara una nueva migracion con una estructura para crear una tabla y la podremos ver en *database/migrations/*

Ahi podremos editar de la siguiente manera:
El comando a usar sera:

```bash
    php artisan make:migration create_posts_table    
```

Nos daria lo siguiente:
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

```

Ahi editaremos para crear nuevos campos

```php

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            
            $table->string('title');
            $table->text('content');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};


```

Y ahora para ejecutar la migracion:

```bash
    php artisan migrate
```

Si nosotros quisieramos hacer un rollback

```bash
    php artisan migrate:rollback
```
> NOTA: Este rollback se hara solo al ultimo lote que hayamos ejecutado. Los lotes lo podremos identificar en le tabla migrations en la columna batch. Conforme nosotros vayamos ejecutando migraciones este lote incrementara

Que pasa si queremos ejecutar varias migraciones de diferentes lotes.

Una opcion seria ejectura el rollback uno por uno hasta llegar hasta donde queremos y luego ir migrando de nuevo.

Para ejecutar todos los metodos down de todas las migraciones y luego posteriormente las up:

Y ya todas las migraciones estaran en el mismo lote.

```bash
    php artisan migrate:refresh
```

A parte de eso tenemos este comando fresh. El cambio esque este metodo eliminara las tablas y luego ejecutara las migraciones. Por lo cual todos los datos que tengammos comenzaran como si fueran nuevos.

```bash
    php artisan migrate:fresh
```

Si esque quisieramos modificar una columan de una tabla la consulta para la migracion seria (suponiendo que queremos modificar la tabla user):

```bash
    php artisan make:migration add_avatar_to_users_table
```

Esto convertira nuestra migracion y podremos ver el cambio en las lineas:
Schema::create('users'  a  Schema::table('users'

Y la manera en la que podriamos adicionar un campo es de la siguiente:

```php
en el metodo UP
agregariamos algo asi:

$table->string('avatar');
$table->string('avatar')->nullable(); para que tome el valor por edfecto de null
$table->string('avatar')->nullable()->after('email'); para que el campo se coloque despues del email

Y tambien deberiamos modificar el metodo DOWN
$table->dropColumn('avatar');

```

# Eloquent en php es un ORM que viene instalado por defecto

Un ejemplo para ver como esta funcionando creariamos una nueva vista en la pagina y una serie de operaciones en nuestro modelo:

Para crear el modelo:

```bash
    php artisan make:model Post
```

El modelo que se crearia estaria en  *app/Models/Post.php* y quedaria de la siguiente forma:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // aqui vamos a espeficiar que tabla va administrar
    // Nota: Si nosotros no especificamos la siguiente linea para especificar con que tabla trabajara entonces lo que hara es trabajar por defecto si la tabla se llama "Post" entonces la tabla trabajada sera "posts" esa convencion sigue
    protected $table = 'posts';
    // eloquent es un framework escrito en ingles se deberia trabajar de esa forma

    // Como la utilizamos
}

```

Y la ruta para como lo vamos a usar:

```php
Route::get('prueba', function () {
    /*
    CREAR UN NUEVO POST
    // Para usar al modelo haremos uso del modelo Post
    $post = new Post;
    // agregamos los valores que iran en el registro
    $post->title = 'Titulo de prueba2';
    $post->content = 'Contenido de prueba2';
    $post->categoria = 'Categoria de prueba2';
    // Guardamos el registro
    $post->save();
     */

     /* OBTENER UN POST */
     // Para bsucarlo por el id
    //  $post = Post::find(1);
     //  Para buscarlo por el title
    //  $post = Post::where('title','=','Titulo de prueba1')->first();
    //  // Si quisieramos modificar este post
    //  $post->categoria = 'Categoria FrontEnd';
    //  $post->save();

    // return $post;

    /* OBTENER TODOS LOS POSTS O MAS DE UN REGISTRO*/
    //$posts = Post::all();
    // Registros con condicion id >= 2
    /*$posts = Post::where('id', '>=', 2)->get();
    // podemos ordenar los registros
    $posts = Post::orderBy('id', 'desc')->get();
    // Para seleccionar los campos requeridos o cantidad de registros
    $posts = Post::orderBy('id', 'desc')
                ->select('id', 'title', 'content')
                ->take(2)
                ->get();

    return $posts;*/

    /* ELIMINAR UN POST */
    $post = Post::find(1);
    $post->delete();

    return "Post eliminado";
});

```

## Mutadores Accesores y Casting 

Lo podremos ver en el siguientes archivos con descripcion en los comentarios

Adicionando 2 nuevos campos a nuestra tabla POST en la migracion.

```php
Schema::create('posts', function (Blueprint $table) {
    $table->id();
            
    $table->string('title');
    $table->string('categoria');
    $table->text('content');
    // nuevos campos para probar el casting
    $table->timestamp('published_at')->default(NOW());
    $table->boolean('is_active')->default(true);

    $table->timestamps();
});
```

Como tal nosotros hariamos las modificaciones respectivas en el modelo que habriamos creado anteriormente

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// para los mutadores y accesores
use Illuminate\Database\Eloquent\Casts\Attribute;

class Post extends Model
{
    use HasFactory;

    // aqui vamos a espeficiar que tabla va administrar
    // Nota: Si nosotros no especificamos la siguiente linea para especificar con que tabla trabajara entonces lo que hara es trabajar por defecto si la tabla se llama "Post" entonces la tabla trabajada sera "posts" esa convencion sigue
    protected $table = 'posts';
    // eloquent es un framework escrito en ingles se deberia trabajar de esa forma

    /*  CAST  */
    // Por defecto eloquent nos devuelve los valores de la BD como una cadena asi sea una fecha o un boleano para poder castearlos tanto al recibir como al registrar usamos esta funcion
    // Hacemos esto porque un claro ejemplo cuando tratamos de manejar fechas lo maneja como cadena y no tiene los mismos metodos y is es un bool entonces true es 1
    protected function casts() : array {
        // aqui indicariamos lo campos que queremos que castee en y desde la BD
        return [
            "published_at" => 'datetime', //2024-06-06
            "is_active" => 'boolean',
        ];
    }

    /* Como la utilizamos los mutadores y accesores */
    // hacemos este metodo para que cuando quieran almacenar una cadena en el campo title como ser "EsTE SErA Un...." y lo convertira a "este sera un..." SET
    // Ahora como hacemos para cuando el post se recupere el title la primera letra este en mayucula GET
    protected function title():Attribute {
        return Attribute::make(            
            // este metodo seria antes de registrar en la BD: muta el valor antes de almacenar en la BD
            set: function($value){
                return strtolower($value);
            },
            // este seria al obtener (accesor) de la BD: no modifica la BD solo la salida al usuario
            get: function($value){
                return ucfirst($value);
            }
        );
    }
    // para probar la fecha
    protected function createdAt():Attribute {
        return Attribute::make(
            get: function($value) {
                return $value."get";
            }
        );
    }    

}

```

Y la manera de utilizarla en nuestra ruta seria similar

```php
Route::get('prueba', function () {
    
    //CREAR UN NUEVO POST
    // Para usar al modelo haremos uso del modelo Post
    $post = new Post;
    // agregamos los valores que iran en el registro
    $post->title = 'Titulo de prueba1 PRObanDO';
    $post->content = 'Contenido de prueba1';
    $post->categoria = 'Categoria de prueba1';
    // Guardamos el registro
    $post->save();
    /* */

     /* OBTENER UN POST */
     // Para bsucarlo por el id
    $post = Post::find(1);
     //  Para buscarlo por el title
    //  $post = Post::where('title','=','Titulo de prueba1')->first();
    //  // Si quisieramos modificar este post
    //  $post->categoria = 'Categoria FrontEnd';
    //  $post->save();

    // formatemos la fecha de published luego de castearla para poder usar el format
    $formattedPublishedAt = $post->published_at ? $post->published_at->format('d-m-Y') : null;

    // Devolver el post junto con la fecha formateada
    return response()->json([
        'post' => $post,
        'published_at' => $formattedPublishedAt
    ]);

    return $post;
```

## Para los seeders

Los encontramos en la ruta *database/seeders* ahi podriamos indicar que datos queremos por defecto en nuestra base de datos

Para ejectuar una migracions hacemos uso del comando

```bash
    php artisan db:seed
```

De que manera podriamos hacer un fresh(delete de las tablas) y un seed

```bash
    php artisan migrate:fresh --seed
```

Como creamos un archivo para nuestro seed de una tabla

```bash
    php artisan make:seeder UserSeeder
```

Nuestro archivo seed creado de post como ejemplo seria:

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $post = new Post();

        $post->title = 'Post 1';
        $post->content = "Contenido 1";
        $post->category = "Categoria 1";
        $post->published_at = now();

        $post->save();

        $post = new Post();

        $post->title = 'Post 2';
        $post->content = "Contenido 2";
        $post->category = "Categoria 2";

        $post->save();

        $post = new Post();

        $post->title = 'Post 3';
        $post->content = "Contenido 3";
        $post->category = "Categoria 3";

        $post->save();
    }
}

```

Y el Database seeder que es el que se ejecutara cuando coloquemos *seed* en la cli

```php
<?php

namespace Database\Seeders;

//use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Database\Seeders\UserSeeder;
use Database\Seeders\PostSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */
        // Aqui llamamos a nuestros seeders
        $this->call([
            UserSeeder::class,
            PostSeeder::class
        ]);

    }
}

```

## Factory 

Los factoris funcionan como fabricas a los cuales nosotros especificaremos un modelos y laravel con su libreria **faker** de php nos creara datos de prueba que no son reales pero que nos serviran para desarrollo.

Para crear un factori en este caso de post:

> NOTA: es importante seguir la convencion: <nombreModelo>Factory

```bash
    php artisan make:factory PostFactory
```

Esto crearia un factori dentor de la carpeta *database/factories*

El factori final seria:

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $post = new Post();

        $post->title = 'Post 1';
        $post->content = "Contenido 1";
        $post->category = "Categoria 1";
        $post->published_at = now();

        $post->save();

        $post = new Post();

        $post->title = 'Post 2';
        $post->content = "Contenido 2";
        $post->category = "Categoria 2";

        $post->save();

        $post = new Post();

        $post->title = 'Post 3';
        $post->content = "Contenido 3";
        $post->category = "Categoria 3";

        $post->save();

        Post::factory(20)->create();
    }
}

```

Lo usaremos en nuestro seeder Post

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $post = new Post();

        $post->title = 'Post 1';
        $post->content = "Contenido 1";
        $post->category = "Categoria 1";
        $post->published_at = now();

        $post->save();

        $post = new Post();

        $post->title = 'Post 2';
        $post->content = "Contenido 2";
        $post->category = "Categoria 2";

        $post->save();

        $post = new Post();

        $post->title = 'Post 3';
        $post->content = "Contenido 3";
        $post->category = "Categoria 3";

        $post->save();

        Post::factory(20)->create();
    }
}

```

## Rutas con nombre

Si nosotros quisieramos añadir rutas con nombre y cambiar la url de *posts* a *articulos*. Enves de estar cambiando directamente en todas las partes de nuestro codigo podriamos definirlo de la siguinte manera:

La ruta definida seria asi /<nombreRuta>/ y el name seria como nosotros accederemos y redireccionaremos a esa ruta en nuestra aplicacion.

```php
//Route::get('posts', PostsController::class);
// Como definimos rutas con nombre eso si quisieramos cambiar el posts por articulos en la ruta
Route::get('articulos', PostsController::class)->name('posts');
```

Y para redireccionar o mandar desde la aplicacion o controlador cambiaria a esto

```php
/* app  */
{{--<a href="/posts">Volver a la lista</a>--}}
<a href="{{ route('posts') }}">Volver a la lista</a>

/* controller  */
//return redirect('/posts');
return redirect()->route('posts');
```

> NOTA: La convencion para el colocar un nombre a la ruta para manejarla en la aplicacion es ->name(<nombreRuta><nombreMetodo>) 






























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
php artisan migrate:refresh <- Downs | Ups
```








