<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    //
    /*public function __invoke() {
        return ("Aqui se mostraran todos los posts desde el controlador");
    }*/

    public function __invoke() {
        return view('posts');
    }
}
