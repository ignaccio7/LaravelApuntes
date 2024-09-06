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
