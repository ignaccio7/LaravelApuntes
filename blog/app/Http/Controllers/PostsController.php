<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostsController extends Controller
{
    //
    /*public function __invoke() {
        return ("Aqui se mostraran todos los posts desde el controlador");
    }*/

    public function __invoke() {

        // Como recuperamos el listado de la base de datos
        //$posts = Post::all();
        $posts = Post::orderBy('id', 'desc')->get();

        return view('posts', compact('posts'));
    }
}
