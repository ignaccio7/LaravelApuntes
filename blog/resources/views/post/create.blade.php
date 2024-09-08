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
	<form action="/post" method="POST">
		@csrf
		<label for="title">
			Titulo:
			<input type="text" name="title" id="title" placeholder="titulo">
		</label>		

		<label for="category">
			Categoria:
			<input type="text" name="category" id="category" placeholder="Categoria">
		</label>

		<label for="content">
			Contenido:
			<textarea rows="10" cols="50" name="content" id="content" placeholder="Contenido"> </textarea>
		</label>

		<button>
			Crear
		</button>
	</form>
</body>
</html>