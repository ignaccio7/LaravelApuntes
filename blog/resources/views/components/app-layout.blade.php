<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>HomeView</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<!-- Aqui importariamos mas cosas como puede ser una fuente mas scripts etc -->
</head>
<body>

	<!-- Añadimos este nuevo header para toda la plantilla -->
	<header>
		<h1>Este sera un header para para toda la pagina </h1>
	</header>

	 <main>
	 	{{ $slot }}
	 </main>  


	<!-- Añadimos este nuevo footer para toda la plantilla -->
	<footer>
		<h1>Este sera un footer para para toda la pagina </h1>
	</footer>

</body>
</html>