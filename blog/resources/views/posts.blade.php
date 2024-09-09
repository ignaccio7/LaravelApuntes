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

	<!--<a href="post/create" class="inline-block mx-auto my-2 border-1 p-4 rounded-sm border-gray-700 bg-blue-700 mb-4">-->
	<a href="{{ route('post.create') }}" class="inline-block mx-auto my-2 border-1 p-4 rounded-sm border-gray-700 bg-blue-700 mb-4">
		Crear nuevo
	</a>

	<ul class="max-w-5xl mx-auto">
	@foreach($posts as $post)
		<li class="p-2 hover:bg-gray-700 cursor-pointer">			
			{{--<a href="post/{{ $post->id }}" class="inline-block w-full hfull">--}}
			{{--<a href="{{ route('post.show',[$post->id]) }}" class="inline-block w-full hfull">--}}
			{{-- No es necesario pasarle solo el id post tambien si le pasamos $post laravel reconoce que queremos buscar ese registro por el id --}}
			<a href="{{ route('post.show',[$post]) }}" class="inline-block w-full hfull">
				<span class="text-red text-sm">
					{{ $post->id }} :
				</span>
				{{ $post->title }}
			</a>
		</li>
	@endforeach
	</ul>

	<h3>Paginacion - Esta paginacion funciona solo con tailwindcss</h3>
	{{ $posts->links() }}

@endsection