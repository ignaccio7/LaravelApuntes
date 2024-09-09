<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Post</title>
	<style>
		form{
			display: flex;
			flex-direction:column;
			gap:1rem;
			width: 500px;
		}
	</style>
</head>
<body>
	<h1>Formulario para crear un post</h1>

	{{--@if($errors -> any())
	<div>
		<h2>Errores</h2>
		<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
		</ul>
	</div>
	@endif--}}

	{{--<form action="/post" method="POST">--}}
	<form action="{{ route('post.store') }}" method="POST">
		@csrf
		<label for="title">
			Titulo:
			{{--Manejando validaciones aqui pondremos en el value el valor anterior luego de enviar el formulario--}}
			<input type="text" name="title" id="title" placeholder="titulo"
				value="{{old('title')}}">
		</label>		
		{{--Otra manera de mostrar errores--}}
		@error('title')
			<p>{{$message}}</p>
		@enderror

		<label for="category">
			Categoria:
			<input type="text" name="category" id="category" placeholder="Categoria"
			value="{{old('category')}}">
		</label>
		@error('category')
			<p>{{$message}}</p>
		@enderror

		<label for="slug">
			Slug:
			<input type="text" name="slug" id="slug" placeholder="Slug"
			value="{{old('slug')}}">
		</label>
		@error('slug')
			<p>{{$message}}</p>
		@enderror

		<label for="content">
			Contenido:
			<textarea rows="10" cols="50" name="content" id="content" placeholder="Contenido">{{old('content')}}</textarea>
		</label>
		@error('content')
			<p>{{$message}}</p>
		@enderror

		<button>
			Crear
		</button>
	</form>
</body>
</html>