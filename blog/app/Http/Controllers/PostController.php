<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // ahora solo estamos usando al metodo show
    //public function getPostById($postId) {
    //    return "Aqui se mostrara el post Nº $postId";
    //}

    public function createPost() {
        //return "Aqui podras crear lo que querais";
        return view("post.create");
    }

    //public function show($postName, $postCategory = null)
    public function show(Post $post)
    {      
        //$fpost = Post::where('slug', $post)->first();  
          
        //if($postCategory){
          //  return "Aqui se mostrara el post con Nombre: $postName y con categoria: $postCategory";    
        //}

        //return "Aqui se mostrara el post con Nombre: $postName y sin categoria";
     
        /*return view("post.index",[
            "postName" => $postName
        ]);*/

        // Como alternativa a estar escribiendo postName => $postName usamos el compact que hace lo mismo
        //return view("post.index", compact('postName'));        

        //$post = Post::find($postName);
        //return $post;

        return view("post.index", compact('post'));
    }

    // funcion para almacenar y guardar el post del form
    //public function store(Request $request) {
    // Para agregar las validaciones
    public function store(StorePostRequest $request) {
        // Para recuperar datos que envian aqui
        //return request()->all(); o tambien
        //return request()->title; o tambien en parametro en la funcion

        // Para crear un nuevo post
        /*$post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->slug = $request->slug;
        $post->category = $request->category;
        $post->save();*/
        // Una manera de hacer mas corto esto ya que es un lio estar poniendo campo por campo todos los que mandamos podriamos validar que campos nos estan llegando de los formularios para ello lo hacemos en el modelo en el atributo filleable cuales campos aceptara

        // como agregamos validaciones Si esque hubiera errores nos retorna una variable $errors a la cual veremos en la vista
        // $request->validate([
        //     'title' => 'required|min:5|max:255',
        //     'category' => ['required','min:5','max:100'],
        //     // Para indicarle que el slug sea unico en la tabla posts
        //     'slug' => 'required|unique:posts',
        //     'content' => 'required',
        // ]);

        Post::create($request->all());

        //return $request->all();
        //return redirect('/posts');
        return redirect()->route('posts');
    }

    // Para acortar un poco esto se le puede decir automaticamente a laravel que busque ese post al recibir el parametro y asi nos ahorramos una linea
    //public function edit($post) {
    //    $post = Post::find($post);
    public function edit(Post $post) {

        return view("post.edit", compact('post'));
    }

    public function update(Request $request, $post) {

        //$findPost = Post::find($post);
        $findPost = Post::where('slug',$post)->first();
        //return $findPost;

        $request->validate([
            'title' => 'required|min:5|max:255',
            'category' => ['required','min:5','max:100'],
            // Para indicarle que el slug sea unico en la tabla posts Pero como es edicion que excluya este registro
            'slug' => "required|unique:posts,slug,{$findPost->id}",
            'content' => 'required',
        ]);        
        
        /*$findPost->title = $request->title;
        $findPost->content = $request->content;
        $findPost->slug = $request->slug;
        $findPost->category = $request->category;
        $findPost->save();*/

        // El metodo update tambien sirve para asignacion masiva
        $findPost->update($request->all());

        //return redirect("/post/{$findPost->id}");
        return redirect()->route('post.show',[$findPost->slug]);

    }

    public function destroy($post) {
        //return "Eliminando el post {$post}";
        $post = Post::find($post);
        $post->delete();

        //return redirect('/posts');
        return redirect()->route('posts');
    }


}






