<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // aqui vamos a espeficiar que tabla va administrar
    protected $table = 'posts';
    // sino le pasamos

    // Como la utilizamos
}
