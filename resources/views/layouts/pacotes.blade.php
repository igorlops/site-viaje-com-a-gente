<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if($banner?->page)
        <meta name="title" content="{{ $banner?->page?->meta_title ?? 'Viaje com a Gente - Viagens e Turismo' }}">
        <meta name="description" content="{{ $banner?->page?->meta_description ?? 'Viaje com a Gente - Viagens e Turismo' }}">
        <meta name="keywords" content="{{ $banner?->page?->meta_keywords ?? 'Viaje com a Gente - Viagens e Turismo' }}">
    @endif
    <title>@yield('title', 'Viaje com a Gente - Viagens e Turismo')</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Vite CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>
<body class="font-sans bg-gray-50 text-gray-800 antialiased flex flex-col min-h-screen">

    @include('layouts.navbar')

    <!-- MAIN CONTENT -->
    <main class="flex-grow">
        @yield('content')
    </main>
    
    <!-- FOOTER -->
    @include('layouts.footer')
    <x-btn-whatsapp :whatsappUrl="$whatsappUrl"/>
    <!-- Mobile Menu Toggle Script -->
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            var menu = document.getElementById('mobile-menu');
            var icon = document.getElementById('menu-icon');
            
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-xmark');
            } else {
                menu.classList.add('hidden');
                icon.classList.remove('fa-xmark');
                icon.classList.add('fa-bars');
            }
        });
    </script>
</body>
</html>
