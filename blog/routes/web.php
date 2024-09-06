<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PostController;

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





























