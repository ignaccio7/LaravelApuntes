@extends('layouts.app')

@section('title','Editar Post')

@push('css')
	<style>
		html{
			color-scheme: dark;
		}
	</style>
@endpush

@push('css')
<style>
		form {
			display: flex;
			flex-direction: column;
			gap:1rem;
			width: 500px;
			text-align:left;
		}
	</style>
@endpush

@section('content')

<h1>Formulario para editar un post</h1>
<form action="/post/{{ $post->id }}" method="POST">

	@csrf

	@method('PUT')

	<label for="title">
		Titulo:
		<input 
			value="{{ $post->title }}" 
			type="text" name="title" id="title" placeholder="titulo">
	</label>		

	<label for="category">
		Categoria:
		<input 
			value="{{ $post->category }}" 
			type="text" name="category" id="category" placeholder="Categoria">
	</label>

	<label for="content">
		Contenido:
		<textarea name="content" id="content" placeholder="Contenido"
		rows="10" cols="50">{{ $post->content }}</textarea>
	</label>

	<button class="bg-blue-700">
		Actualizar
	</button>
</form>

@endsection