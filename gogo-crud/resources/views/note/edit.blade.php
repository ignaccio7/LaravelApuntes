<x-app-layout>

  <a href="{{ route('note.index') }}">Volver atras</a>

  <h2>Formulario para la modificacion de una nota</h2>

  <form 
    method="POST"
    action="{{route('note.update', $note->id)}}"
    style="display: flex; flex-direction:column; gap:10px; max-width: 400px;"
  >
    @method('PUT')
    @csrf

    <label for="title">
      Introduzca el nuevo titulo de la nota:
      <input type="text" name="title" id="title" value="{{ $note->title }}" >
    </label>

    <label for="description">
      Introduzca la nueva descripcion de la nota:
      <input type="text" name="description" id="description" value="{{ $note->description }}">
    </label>

    <input type="submit" value="Actualizar la nota">
  </form>

</x-app-layout>