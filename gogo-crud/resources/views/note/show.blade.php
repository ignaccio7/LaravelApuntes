<x-app-layout>

  <a href="{{ route('note.index') }}">Volver atras</a>

  <h2>Contenido de la nota</h2>

  <h3>Titulo: {{ $note->title }}</h3>
  <p>{{ $note->description }}</p>

</x-app-layout>