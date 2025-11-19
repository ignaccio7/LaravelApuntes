<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Este modelo sera para una API entonces colocamos []
    // Si el array de elementos protegidos es vacio entonces todos lo campos seran accesibles 
    protected $guarded = [];
}
