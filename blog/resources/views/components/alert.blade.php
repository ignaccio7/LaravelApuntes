{{-- Para recibir las props en un componente --}}
@props(['type' => ''])

@php
  switch ($type) {
    case 'danger':
      $class = 'text-red-800 bg-red-50 dark:bg-gray-800 dark:text-red-400';
      break;
    case 'success':
      $class = 'text-green-800 bg-green-50 dark:bg-gray-800 dark:text-green-400';
      break;
    case 'warning':
      $class = 'text-yellow-800 bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400';
      break;
    default:
      $class = 'text-gray-800 bg-gray-50 dark:bg-gray-800 dark:text-gray-400';
      break;
  }
@endphp

{{-- <div class="{{ $class }} p-4 text-sm rounded-lg" role="alert">
  <span class="font-medium">{{ $message ?? 'Info Alert' }}! </span> 
  {{ $slot }}
</div> --}}
<div {{ $attributes->merge(["class" => "p-4 text-sm rounded-lg" . $class]) }} role="alert">
  <span class="font-medium">{{ $message ?? 'Info Alert' }}! </span> 
  {{ $slot }}
</div>
<p>Texto de prueba</p>