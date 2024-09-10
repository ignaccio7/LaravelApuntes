<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PostController;
use App\Models\Phone;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

/*Route::get('/', function () {
    //return view('welcome');
    return ('welcome to the home page');
});*/

Route::get('/', [HomeController::class, 'index']);

// Para crear una nueva ruta
/*Route::get('/posts', function() {
    return ("Aqui se mostraran todos los posts");
});*/
//Route::get('posts', PostsController::class);
// Como definimos rutas con nombre eso si quisieramos cambiar el posts por articulos en la ruta
Route::get('articulos', PostsController::class)->name('posts');


// Si quisieramos una ruta get /create tendriamos que definirla aqui arriba ya que si lo definimos abajo del que detecta parametro lo detectara "create" como param
/*Route::get('post/create', function() {
    return "Aqui podras crear lo que querais";
});*/
//Route::get('post/create', [PostController::class, 'createPost']);
Route::get('post/create', [PostController::class, 'createPost'])
    ->name('post.create');

// esta sera la ruta para crear el post con metodo POST
//Route::post('post', [PostController::class,'store']);
Route::post('post', [PostController::class,'store'])
    ->name('post.store');

// esta sera la ruta para editar el registro por el metodo GET
//Route::get('post/{post}/edit', [PostController::class,'edit']); // obtiene la vista
Route::get('post/{post}/edit', [PostController::class,'edit'])
    ->name('post.edit');

//Route::put('post/{post}', [PostController::class,'update']); // edita el contenido
Route::put('post/{post}', [PostController::class,'update'])
    ->name('post.update');

// PASANDO A RUTAS CON NOMBRE



Route::delete('post/{post}', [PostController::class,'destroy']); // eliminar el contenido


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

//Route::get('post/{postName}/{postCategory?}', [PostController::class, 'show']);
Route::get('post/{post}', [PostController::class, 'show'])
    ->name('post.show');

Route::get('prueba', function () {
    
    //CREAR UN NUEVO POST
    // Para usar al modelo haremos uso del modelo Post
    $post = new Post;
    // agregamos los valores que iran en el registro
    $post->title = 'Titulo de prueba1 PRObanDO';
    $post->content = 'Contenido de prueba1';
    $post->categoria = 'Categoria de prueba1'; // category
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

    /* OBTENER TODOS LOS POSTS O MAS DE UN REGISTRO*/
    //$posts = Post::all();
    //return $posts;
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
    //$post = Post::find(1);
    //$post->delete();

    //return "Post eliminado";
});


Route::get('pruebauser', function () {
    
    // User::create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    //     'password' => bcrypt('secret'),
    // ]);

    // Phone::create([
    //     'number' => '123456789',
    //     'user_id' => 13
    // ]);

    // $user = User::where('id',13)
    //             ->with('phone')
    //             ->first();

    // return $user;

    // $comment = new Comment;
    // $comment->content = 'Este es un comentario';
    // $comment->post_id = 1;
    // $comment->save();
    // return $comment;

    // Comment::create([
    //     'content' => 'Este es un comentario',
    //     'post_id' => 1
    // ]);

    // return 'Comentario creado';

    // $comments = Post::find(1)->comments;
    // return $comments;

    $post = Post::find(1);
    $post->comments()->create([
        'content' => 'Este es un comentario asociado al post'
    ]);

    return 'Comentario creado';

});