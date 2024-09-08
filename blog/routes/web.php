<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PostController;
use App\Models\Post;

/*Route::get('/', function () {
    //return view('welcome');
    return ('welcome to the home page');
});*/

Route::get('/', [HomeController::class, 'index']);

// Para crear una nueva ruta
/*Route::get('/posts', function() {
    return ("Aqui se mostraran todos los posts");
});*/
Route::get('posts', PostsController::class);


// Si quisieramos una ruta get /create tendriamos que definirla aqui arriba ya que si lo definimos abajo del que detecta parametro lo detectara "create" como param
/*Route::get('post/create', function() {
    return "Aqui podras crear lo que querais";
});*/
Route::get('post/create', [PostController::class, 'createPost']);


// Rutas con parametros
/*Route::get('posts/{postId}', function($postId) {
    return "Aqui se mostrara el post Nº $postId";
});*/
//Route::get('post/{postId}', [PostController::class, 'getPostById']);


// Como pasamos multiples parametros
/*Route::get('post/{postName}/{postCategory}', function($postName, $postCategory) {
    return "Aqui se mostrara el post con Nombre: $postName y con categoria: $postCategory";
});*/
// Ahora como pasamos una segunda variable de manera opcional 

/*Route::get('post/{postName}/{postCategory?}', function($postName, $postCategory = null) {

    if($postCategory){
        return "Aqui se mostrara el post con Nombre: $postName y con categoria: $postCategory";    
    }

    return "Aqui se mostrara el post con Nombre: $postName y sin categoria";    
});*/

Route::get('post/{postName}/{postCategory?}', [PostController::class, 'show']);

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
