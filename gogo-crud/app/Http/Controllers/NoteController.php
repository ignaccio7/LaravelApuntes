<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NoteController extends Controller
{
    //si el parametro seria dinamico entonces deberiamos colocar un valor por defecto algo asi ($id = 1)
    // public function index($id) {
    //     $note = Note::find($id);
    //     return view('note.index', compact('id'));
    //     return $note;
    // }

    public function index(): View {
        $notes = Note::all();
        return view('note.index', compact('notes'));
    }

    public function create(): View {
        return view('note.create');
    }

    public function store(NoteRequest $request): RedirectResponse {
        // $note = new Note();
        // $note->title = $request->title;
        // $note->desciption = $request->desciption;
        // $note->save();

        // Note::create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        // ]);

        // Enves de esto creamos un nuevo NoteRequest y aho pasamos las validaciones
        // $request->validate([
        //     'title' => 'required|max:255|min:3',
        //     'description' => 'required|max:255|min:3'
        // ]);

        Note::create($request->all());

        return redirect()->route('note.index');
    }

    // Si recibe o mediante el parametro de busqueda que sea unico nosotros podemos saltarnos la busqueda y poner en el parametro Note $note y automaticamente laravel nos devuelve la nota buscada
    // public function edit($note) {
    //     $note = Note::find($note);
    public function edit(Note $note) : View {
        return view('note.edit', compact('note'));
    }

    // public function update(Request $request, Note $note) : RedirectResponse {
    // Agregamos la validacion del nuevo request que creamos con las reglas que colocamos en ese archivo 
    public function update(NoteRequest $request, Note $note) : RedirectResponse {
        $note->update($request->all());
        return redirect()->route('note.index');
    }

    public function show(Note $note) : View {
        return view('note.show', compact('note'));
    }

    public function destroy(Request $request, Note $note) : RedirectResponse {
        $note->delete();
        return redirect()->route('note.index');
    }

}








