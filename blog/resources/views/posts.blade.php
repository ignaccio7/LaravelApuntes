@extends('layouts.app')

@section('title','Articulos')

@push('css')
	<style>
		html{
			color-scheme:dark;
			font-size:1rem;
		}
	</style>
@endpush

@section('content')
	<h2 class="text-2xl text-center font-bold">Listado de posts</h2>

	<a href="post/create" class="inline-block mx-auto my-2 border-1 p-4 rounded-sm border-gray-700 bg-blue-700 mb-4">
		Crear nuevo
	</a>

	<ul class="max-w-5xl mx-auto">
	@foreach($posts as $post)
		<li class="p-2 hover:bg-gray-700 cursor-pointer">
			<a href="post/{{ $post->id }}" class="block w-full hfull">
				{{ $post->title }}
			</a>
		</li>
	@endforeach
	</ul>

@endsection