<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// para los mutadores y accesores
use Illuminate\Database\Eloquent\Casts\Attribute;

class Post extends Model
{
    use HasFactory;

    // aqui especificamos que campos queremos compartir
    protected $fillable = [
        'title',
        'slug',
        'category',
        'content',
    ];

    // tambien podemos especificar que campos queremoe evitar que nose guarden con asignacion masiva
    protected $guarded = [
        'is_active',
    ];

    // aqui vamos a espeficiar que tabla va administrar
    // Nota: Si nosotros no especificamos la siguiente linea para especificar con que tabla trabajara entonces lo que hara es trabajar por defecto si la tabla se llama "Post" entonces la tabla trabajada sera "posts" esa convencion sigue
    protected $table = 'posts';
    // eloquent es un framework escrito en ingles se deberia trabajar de esa forma

    /*  CAST  */
    // Por defecto eloquent nos devuelve los valores de la BD como una cadena asi sea una fecha o un boleano para poder castearlos tanto al recibir como al registrar usamos esta funcion
    // Hacemos esto porque un claro ejemplo cuando tratamos de manejar fechas lo maneja como cadena y no tiene los mismos metodos y is es un bool entonces true es 1
    protected function casts() : array {
        // aqui indicariamos lo campos que queremos que castee en y desde la BD
        return [
            "published_at" => 'datetime', //2024-06-06
            "is_active" => 'boolean',
        ];
    }

    /* Como la utilizamos los mutadores y accesores */
    // hacemos este metodo para que cuando quieran almacenar una cadena en el campo title como ser "EsTE SErA Un...." y lo convertira a "este sera un..." SET
    // Ahora como hacemos para cuando el post se recupere el title la primera letra este en mayucula GET
    protected function title():Attribute {
        return Attribute::make(            
            // este metodo seria antes de registrar en la BD: muta el valor antes de almacenar en la BD
            set: function($value){
                return strtolower($value);
            },
            // este seria al obtener (accesor) de la BD: no modifica la BD solo la salida al usuario
            get: function($value){
                return ucfirst($value);
            }
        );
    }
    // para probar la fecha
    protected function createdAt():Attribute {
        return Attribute::make(
            get: function($value) {
                return $value."get";
            }
        );
    }

    // Para la url amigable e indicarle a laravel que el campo por defecto que busque no sea el id sino por el slug
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Para obtener los comentarios de un post
    public function comments(){
        return $this->hasMany(Comment::class);
    }

}
