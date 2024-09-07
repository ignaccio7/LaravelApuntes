<div {{ $attributes->merge(["class" => "p-4 text-sm rounded-lg" . $class]) }} role="alert">
    <span class="font-medium">{{ $message ?? 'Info Alert' }}! </span> 
    {{ $slot }}
</div>
<p>Texto de prueba</p>