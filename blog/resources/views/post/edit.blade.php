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
			& input,
			& textarea{
				border:1px solid white;
			}
		}
	</style>
@endpush

@section('content')

<h1>Formulario para editar un post</h1>

@if($errors -> any())
	<div>
		<h2>Errores</h2>
		<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
		</ul>
	</div>
	@endif

{{--<form action="/post/{{ $post->id }}" method="POST">--}}
<form action="{{ route('post.update', [$post]) }}" method="POST">

	@csrf

	@method('PUT')

	<label for="title">
		Titulo:
		{{--Ya manejando validaciones entonces usamos el old pero con un segundo parametro que sera el valor que obtenemos de la base de datos
		y cambiamos
			value="{{ $post->title }}" 
		por
			value="{{old('title',$post->title)}}"
		--}}
		<input 
			value="{{old('title',$post->title)}}"
			type="text" name="title" id="title" placeholder="titulo">
	</label>		

	<label for="category">
		Categoria:
		<input 
			value="{{old('category',$post->category)}}"			
			type="text" name="category" id="category" placeholder="Categoria">
	</label>

	<label for="slug">
			Slug:
			<input 
				value="{{old('slug',$post->slug)}}"
				type="text" name="slug" id="slug" placeholder="Slug">
		</label>

	<label for="content">
		Contenido:
		<textarea name="content" id="content" placeholder="Contenido"
		rows="10" cols="50">{{old('content',$post->content)}}</textarea>
	</label>

	<button class="bg-blue-700">
		Actualizar
	</button>
</form>

@endsection