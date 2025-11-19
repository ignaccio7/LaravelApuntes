<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    // campos que se permitiran insertar en la tabla a traves de lo que tengamos en el controller
    protected $fillable = [
        'title',
        'description'
    ];
}
