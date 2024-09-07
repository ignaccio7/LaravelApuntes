<!-- Con vista -->
@extends('layouts.app')

{{--@section('title')
	Laravel 11
@endsection--}}
@section('title', 'Laravel')

@push('css')
	<style>
		html{
			color-scheme: dark;
		}
	</style>
@endpush


@section('content')

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


{{-- Con componente <x-app-layout>--}}
{{--</x-app-layout>--}}

@endsection
