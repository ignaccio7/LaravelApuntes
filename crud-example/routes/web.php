<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;

Route::get('/', [PersonController::class,'index'])->name('personList');

Route::get('/{ci}', [PersonController::class,'delete'])->name('personDelete');

Route::post('/create', [PersonController::class,'create'])->name('personCreate');