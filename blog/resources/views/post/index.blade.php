<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Post</title>
	<style>
		html{
			font-family: system-ui;
			color-scheme:dark;
		}
		.post{
			width: 500px;
			margin-inline:auto;
			border:1px solid gray;
			padding: 2rem;
			border-radius:1rem;

			& h2 {
				color:#09f;
			}

			& h3 {
				color:tomato;
			}
		}
	</style>
</head>
<body>

	<a href="/posts">Volver a la lista</a>

	<div class="post">
		<h2>
			Titulo: 
			{{ $post->title }}
		</h2>
		<h3> {{ $post->category }} </h3>
		<p>
			{{ $post->content }}
		</p>
	</div>

	<a href="/post/{{ $post->id }}/edit">Editar Post</a>

	@if (true)
	<p>Contenido de prueba</p>
	@endif	

</body>
</html>