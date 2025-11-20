<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Este es una ruta con un parametro dinamico
// Para poner el parametro opcional note/{id?} en este caso en el controller deberiamos darle un valor por defecto
// Route::get('note/{id}', [NoteController::class, 'index'])->name('note.index');

// CRUD
// Route::get('/note', [NoteController::class, 'index'])->name('note.index');
// Route::get('/note/create', [NoteController::class, 'create'])->name('note.create');
// Route::post('/note/store', [NoteController::class, 'store'])->name('note.store');
// Route::get('/note/edit/{note}', [NoteController::class, 'edit'])->name('note.edit');
// Route::put('/note/update/{note}',[NoteController::class, 'update'])->name('note.update');
// Route::get('/note/show/{note}', [NoteController::class, 'show'])->name('note.show');
// Route::delete('/note/destroy/{note}',[NoteController::class, 'destroy'])->name('note.destroy');

// Para abreviar todo este CRUD lo podemos hacer con un resource
Route::resource('/note',NoteController::class);

Route::get('/products', [ProductsController::class, 'index'])->name('product.index');

