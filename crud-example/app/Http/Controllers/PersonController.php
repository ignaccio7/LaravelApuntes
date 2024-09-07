<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;

class PersonController extends Controller
{
    //
    public function index() {
        $people = Person::all();

        return view('person', compact('people'));
    }

    public function create(Request $req) {

        $person = new Person();
        $person->ci = $req->ci;
        $person->name = $req->nombre;
        $person->lastName = $req->apellidos;
        $person->phone = $req->celular;

        $person->save();

        return redirect()->back();
    }

    public function list() {
        $people = Person::all();

        return $people;
    }

    public function delete($ci) {

        $findPerson = Person::where('ci','=',$ci)->first();

        if(!$findPerson) {return redirect()->back();};

        // Eliminar la persona
        //return $findPerson;
        $findPerson->delete();

        // Redirigir de vuelta con un mensaje de éxito
        return redirect()->back();
    }
}
