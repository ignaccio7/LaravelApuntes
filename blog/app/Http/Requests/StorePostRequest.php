<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // Este metodo se utiliza para validar que el usuario que esta intentando hacer un registro en la BD sea un usuario autorizado
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    // Aqui colocaremos todas las reglas de validacion a verificar
    public function rules(): array
    {
        return [
            'title' => 'required|min:5|max:255',
            'category' => ['required','min:5','max:100'],
            // Para indicarle que el slug sea unico en la tabla posts
            'slug' => 'required|unique:posts',
            'content' => 'required',
        ];
    }

    // Para personalizar los mensajes de error
    public function messages() {
        return [
            //'title.required' => 'El campo titulo es requerido',
            // Para que funcione el cambio que pusimos en los attributes deberiamos modificar el mensaje asi:
            'title.required' => 'El campo :attribute es requerido',
            'slug.required' => 'El campo slug es requerido',
        ];
    }

    // Otra manera de personalizar el campo podria ser title slug content etc es con los attributes
    // Pero para usar los attributes deberiamos modificar la funcion messages
    public function attributes() {
        return [
            'title' => 'Titulo',
            'slug' => 'Ruta',
            'content' => 'Contenido',
        ];
    }
}
