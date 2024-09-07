<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		@yield('title', 'Valor por defecto')
	</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<!-- Aqui importariamos mas cosas como puede ser una fuente mas scripts etc -->

	<!-- Aqui entraria un contenido variable 
	La diferencia entre yield y stack es que con yield solo podriamos definir 1 unico contenido mientras que con stack podriamos definir mas de uno y no se solaparia
	-->
	 @stack('css')
</head>
<body>

	<!-- Añadimos este nuevo header para toda la plantilla -->
	<header>
		<h1>Este sera un header para para toda la pagina </h1>
	</header>

	<main>
		<!-- Con yield indicamos que esta parte sera dibujado por un contenido variable -->
		@yield('content')

	</main>


	<!-- Añadimos este nuevo footer para toda la plantilla -->
	<footer>
		<h1>Este sera un footer para para toda la pagina </h1>
	</footer>

</body>
</html>