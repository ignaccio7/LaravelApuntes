<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>HomeView</title>
	<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
	<h1>
		Bienvenidos a la pagina principal desde la vista.
	</h1>
	<h2>Alert anonimo</h2>
	{{-- <x-alert /> --}}
	<x-alert type="success" class="mb-4">
		<x-slot name="message">
			Mensaje
		</x-slot>
		Aqui se mostrara el contenido de la alerta
	</x-alert>
	<h2>Alert con clase</h2>
	<x-alert2 type="warning" class="mb-8">
		<x-slot name="message">
			Mensaje
		</x-slot>
		Aqui se mostrara el contenido de la alerta
	</x-alert2>
</body>
</html>