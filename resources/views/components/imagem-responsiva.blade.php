@props([
    'nomeArquivo',
    'alt' => '',
    'tipo' => 'miniatura',
    'class' => '',
])

@php
    $path = ltrim($nomeArquivo, '/');

    if ($tipo === 'banner') {
        $srcGrande = asset('storage/grandes/' . $path);
        $srcMedia = asset('storage/medias/' . $path);
        $srcPequena = asset('storage/pequenas/' . $path);
    } else {
        $src = asset('storage/pequenas/' . $path);
    }
@endphp

@if($tipo === 'banner')
    <picture>
        <source media="(min-width: 1024px)" srcset="{{ $srcGrande }}">
        <source media="(min-width: 640px)" srcset="{{ $srcMedia }}">
        <img 
            src="{{ $srcPequena }}" 
            alt="{{ $alt }}" 
            loading="lazy" 
            class="w-full {{ $class }}"
        >
    </picture>
@else
    <img 
        src="{{ $src }}" 
        alt="{{ $alt }}" 
        loading="lazy" 
        class="{{ $class }}"
    >
@endif
