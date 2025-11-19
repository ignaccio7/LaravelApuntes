<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    //si el parametro seria dinamico entonces deberiamos colocar un valor por defecto algo asi ($id = 1)
    // public function index($id) {
    //     $note = Note::find($id);
    //     return view('note.index', compact('id'));
    //     return $note;
    // }

    public function index() {
        $notes = Note::all();
        return view('note.index', compact('notes'));
    }

    public function create() {
        return view('note.create');
    }

    public function store(Request $request) {
        // $note = new Note();
        // $note->title = $request->title;
        // $note->desciption = $request->desciption;
        // $note->save();

        // Note::create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        // ]);

        Note::create($request->all());

        return redirect()->route('note.index');
    }

    // Si recibe o mediante el parametro de busqueda que sea unico nosotros podemos saltarnos la busqueda y poner en el parametro Note $note y automaticamente laravel nos devuelve la nota buscada
    // public function edit($note) {
    //     $note = Note::find($note);
    public function edit(Note $note) {
        return view('note.edit', compact('note'));
    }

    public function update(Request $request, Note $note) {
        $note->update($request->all());
        return redirect()->route('note.index');
    }

    public function show(Note $note) {
        return view('note.show', compact('note'));
    }

    public function destroy(Request $request, Note $note) {
        $note->delete();
        return redirect()->route('note.index');
    }

}








