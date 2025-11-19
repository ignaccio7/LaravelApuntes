<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    // Este metodo se encargara de transformar la respuesta que nos devuelve el controller 
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => 'Title: '. $this->title,
            'description' => $this->description,
            'example' => 'This is another field for example'
        ];
    }
}
