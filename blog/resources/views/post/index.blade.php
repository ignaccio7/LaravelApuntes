<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Post</title>
</head>
<body>
	<h2>
		Aqui se mostrara el post con Nombre: 
		<?= $postName ?>		
	</h2>
	<p>
		Como estamos en una archivo de blade tambien se puede mostrar de la siguiente manera el nombre: {{ $postName }}
	</p>

	@if (true)
		<p>Contenido de prueba</p>
	@endif	

</body>
</html>