@props([
    'nomeArquivo',
    'nomeArquivoMobile' => null,
    'alt' => '',
    'tipo' => 'miniatura',
    'class' => '',
])

@php
    $rawPath = ltrim((string)$nomeArquivo, '/');
    if (str_starts_with($rawPath, 'storage/')) {
        $rawPath = substr($rawPath, 8);
    }

    $rawPathMobile = $nomeArquivoMobile ? ltrim((string)$nomeArquivoMobile, '/') : null;
    if ($rawPathMobile && str_starts_with($rawPathMobile, 'storage/')) {
        $rawPathMobile = substr($rawPathMobile, 8);
    }

    $resolvePath = function(string $subfolder, string $file) {
        if (empty($file)) return '';

        $subfolderPath = $subfolder ? trim($subfolder, '/') . '/' . $file : $file;
        
        if (file_exists(public_path('storage/' . $subfolderPath))) {
            return asset('storage/' . $subfolderPath);
        }
        
        if (file_exists(public_path('storage/' . $file))) {
            return asset('storage/' . $file);
        }

        if (file_exists(storage_path('app/public/' . $subfolderPath))) {
            return asset('storage/' . $subfolderPath);
        }
        
        if (file_exists(storage_path('app/public/' . $file))) {
            return asset('storage/' . $file);
        }

        if (file_exists(public_path($file))) {
            return asset($file);
        }

        return asset('storage/' . $file);
    };

    if ($tipo === 'banner') {
        $srcGrande = $resolvePath('grandes', $rawPath);
        $srcMedia = $resolvePath('medias', $rawPath);

        if ($rawPathMobile) {
            $srcPequena = $resolvePath('pequenas', $rawPathMobile);
        } else {
            $srcPequena = $resolvePath('pequenas', $rawPath);
        }
    } else {
        $src = $resolvePath('pequenas', $rawPath);
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
