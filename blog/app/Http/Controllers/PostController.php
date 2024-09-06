<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function getPostById($postId) {
        return "Aqui se mostrara el post Nº $postId";
    }

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
        return view("post.index", compact('postName'));
    }
}
