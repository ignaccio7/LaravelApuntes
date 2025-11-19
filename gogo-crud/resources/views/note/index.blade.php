<x-app-layout>
  <a href="{{ route('note.create') }}">Crear una nueva nota</a>
  <h2>Nuestra lista de notas</h2>
  <ul>
    @forelse ($notes as $note)
        <li> 
          <a href="{{ route('note.show', $note->id) }}"> {{ $note->title }} </a> | 
          <a href="{{ route('note.edit', $note->id) }}">MODIFICAR </a> | 

          <form method="POST" action="{{ route('note.destroy', $note->id) }}">
            @method('DELETE')
            @csrf
            <input type="submit" value="ELIMINAR">
          </form>
        </li>
    @empty
        <p>No hay notas</p>  
    @endforelse
  </ul>
</x-app-layout>