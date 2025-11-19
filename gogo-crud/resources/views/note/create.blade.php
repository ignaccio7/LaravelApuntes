<x-app-layout>

  <a href="{{ route('note.index') }}">Volver atras</a>

  <h2>Formulario para crear una nota</h2>

  <form 
    method="POST"
    action="{{route('note.store')}}"
    style="display: flex; flex-direction:column; gap:10px; max-width: 400px;"
  >
    @csrf

    <label for="title">
      Introduzca el titulo de la nota:
      <input type="text" name="title" id="title">
    </label>
    @error('title')
        <span style="color: red;">{{ $message }}</span>
    @enderror

    <label for="description">
      Introduzca la descripcion de la nota:
      <input type="text" name="description" id="description">
    </label>

    @error('description')
        <span style="color: red;">{{ $message }}</span>
    @enderror

    <input type="submit" value="Crear la nota">
  </form>

</x-app-layout>