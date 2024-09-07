<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Document</title>
	<style>
		html {
			color-scheme: dark;
			text-align: center;
		}
		form {
			width: 500px;
			margin-inline: auto;
		}
	</style>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
	<h1>Persona</h1>
	<h2>Create</h2>
	<form action="{{ route('personCreate') }}" method="POST">
		@csrf
		<label>
			<input type="text" name="ci" placeholder="ci" required>
		</label>
		<label>
			<input type="text" name="nombre" placeholder="nombre" required>
		</label>
		<label>
			<input type="text" name="apellidos" placeholder="apellidos" required>
		</label>
		<label>
			<input type="text" name="celular" placeholder="celular" required>
		</label>
		<button type="submit">Enviar</button>
	</form>

	<h2>List of Person</h2>

	<table>
		<thead>
			<tr>
				<td>CI</td>
				<td>NOMBRE</td>
				<td>APELLIDOS</td>
				<td>CELULAR</td>
				<td>ACCIONES</td>
			</tr>
		</thead>
		<tbody>
			@foreach ($people as $person)
			<tr>
				<td>{{ $person->ci }}</td>
				<td>{{ $person->name }}</td>
				<td>{{ $person->lastName }}</td>
				<td>{{ $person->phone }}</td>
				<td>
					<button data-ci="{{ $person->ci }}">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
							<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
							<path d="M4 7l16 0" />
							<path d="M10 11l0 6" />
							<path d="M14 11l0 6" />
							<path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
							<path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
						</svg>
					</button>
				</td>
			</tr>
			@endforeach				
		</tbody>
	</table>

	<script>
		const $buttons = document.querySelectorAll('table button');

		$buttons.forEach($button => $button.addEventListener('click', (event) => {
			let ci = $button.getAttribute('data-ci');
			alert('Deleting person with CI: ' + ci);

			fetch("{{ route('personDelete', '') }}/"+ci, {  // Cambia esto a la ruta correcta
				method: 'GET',
				headers: {
					'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
					'Content-Type': 'application/json'
				}
			})
			.then(res => {
				if (!res.ok) {
					throw new Error('Network response was not ok');
				}
				return res.text();
			})
			.then(data => {
				console.log(data);
				// Aquí puedes eliminar la fila de la tabla o recargar los datos
				//location.reload(); // Recargar la página para actualizar la lista
			})
			.catch(error => {
				console.error('Error:', error);
			});
		}));
	</script>

</body>
</html>