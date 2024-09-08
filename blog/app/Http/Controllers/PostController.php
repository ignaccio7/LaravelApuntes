<?php

namespace App\Http\Controllers;

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

    public function show($postName, $postCategory = null)
    {
        if($postCategory){
            return "Aqui se mostrara el post con Nombre: $postName y con categoria: $postCategory";    
        }

        //return "Aqui se mostrara el post con Nombre: $postName y sin categoria";
     
        /*return view("post.index",[
            "postName" => $postName
        ]);*/

        // Como alternativa a estar escribiendo postName => $postName usamos el compact que hace lo mismo
        //return view("post.index", compact('postName'));

        $post = Post::find($postName);
        //return $post;

        return view("post.index", compact('post'));
    }

    // funcion para almacenar y guardar el post del form
    public function store(Request $request) {
        // Para recuperar datos que envian aqui
        //return request()->all(); o tambien
        //return request()->title; o tambien en parametro en la funcion

        // Para crear un nuevo post
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category = $request->category;
        $post->save();

        //return $request->all();
        return redirect('/posts');
    }

    public function edit($post) {

        $post = Post::find($post);

        return view("post.edit", compact('post'));
    }

    public function update(Request $request, $post) {
        $findPost = Post::find($post);
        
        $findPost->title = $request->title;
        $findPost->content = $request->content;
        $findPost->category = $request->category;
        $findPost->save();

        return redirect("/post/{$findPost->id}");

    }


}






