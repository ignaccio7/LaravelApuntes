<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Database\Factories\ProductsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[UseFactory(ProductsFactory::class)]
class Products extends Model
{
    use HasFactory;
    //
    protected $table = 'products';
}
