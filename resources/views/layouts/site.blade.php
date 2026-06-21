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

    <!-- HEADER / NAVIGATION -->
    <header class="bg-[#002752] text-white sticky top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img class="h-14 w-auto object-contain rounded" src="{{ asset('assets/images/logo.jpeg') }}" alt="Viaje com a Gente Logo">
                    </a>
                </div>
                
                <!-- Desktop Navigation Links -->
                @php
                    $menuServices = $menuServices ?? \App\Models\Service::inMenu()->orderBy('title')->get(['id', 'title', 'slug']);
                @endphp
                <nav class="hidden xl:flex space-x-4 2xl:space-x-6 text-[11px] 2xl:text-xs font-semibold uppercase tracking-wider">
                    <a href="{{ route('home') }}" class=" {{ request()->routeIs('home') ? 'text-[#f2bd11] hover:text-[#fff]' : 'hover:text-[#fff] hover:text-[#f2bd11]' }} transition duration-200">Início</a>
                    <a href="{{ route('packages20262027') }}" class=" {{ request()->routeIs('packages20262027') ? 'text-[#f2bd11] hover:text-[#fff]' : 'hover:text-[#fff] hover:text-[#f2bd11]' }} transition duration-200">Pacotes 2026/2027</a>
                    <a href="{{ route('short-trips') }}" class=" {{ request()->routeIs('short-trips') ? 'text-[#f2bd11] hover:text-[#fff]' : 'hover:text-[#fff] hover:text-[#f2bd11]' }} transition duration-200">Bate e Volta</a>
                    <a href="{{ route('group-trips') }}" class=" {{ request()->routeIs('group-trips') ? 'text-[#f2bd11] hover:text-[#fff]' : 'hover:text-[#fff] hover:text-[#f2bd11]' }} transition duration-200">Viagens em Grupo</a>
                    <a href="{{ route('destination') }}" class=" {{ request()->routeIs('destinations') ? 'text-[#f2bd11] hover:text-[#fff]' : 'hover:text-[#fff] hover:text-[#f2bd11]' }} transition duration-200">Destinos</a>

                    <div
                        class="relative"
                        id="services-dropdown"
                    >
                        <button
                            type="button"
                            id="services-button"
                            class="flex items-center gap-1 {{
                                request()->routeIs('services') || request()->routeIs('service.show')
                                    ? 'text-[#f2bd11]'
                                    : 'text-gray-300 hover:text-white'
                            }} transition duration-200 uppercase tracking-wider font-semibold text-[11px] 2xl:text-xs"
                        >
                            Nossos Serviços
                            <i
                                id="services-arrow"
                                class="fas fa-chevron-down text-[9px] transition-transform duration-200"
                            ></i>
                        </button>

                        <div
                            id="services-menu"
                            class="absolute left-0 top-full w-64 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-[999] hidden"
                        >
                            <a
                                href="{{ route('services') }}"
                                class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-bold text-[#002752] hover:bg-gray-50 transition duration-150 border-b border-gray-100"
                            >
                                <i class="fas fa-th-list text-[#f2bd11] w-4"></i>
                                Ver Todos os Serviços
                            </a>

                            @forelse($menuServices as $svc)
                                <a
                                    href="{{ route('service.show', $svc->slug) }}"
                                    class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-semibold text-gray-600 hover:text-[#002752] hover:bg-gray-50 transition duration-150"
                                >
                                    <i class="fas fa-concierge-bell text-[#109e4a] w-4"></i>
                                    {{ $svc->title }}
                                </a>
                            @empty
                                <span class="block px-4 py-2.5 text-xs text-gray-400 italic">
                                    Em breve...
                                </span>
                            @endforelse
                        </div>
                    </div>

                    {{-- <a href="{{ route('home') }}#orcamento" class="hover:text-[#f2bd11] transition duration-200">Monte sua Viagem</a> --}}
                    <a href="{{ route('faq') }}" class=" {{ request()->routeIs('faq') ? 'text-[#f2bd11] hover:text-[#fff]' : 'hover:text-[#fff] hover:text-[#f2bd11]' }} transition duration-200">Dúvidas</a>
                    <a href="{{ route('contact') }}" class=" {{ request()->routeIs('contact') ? 'text-[#f2bd11] hover:text-[#fff]' : 'hover:text-[#fff] hover:text-[#f2bd11]' }} transition duration-200">Contato</a>
                </nav>
                
                <!-- WhatsApp Button / Action -->
                @php
                    $whatsappUrl = isset($socialLinks['whatsapp']) ? $socialLinks['whatsapp']->url : 'https://wa.me/5585999166421';
                @endphp
                <div class="hidden md:block">
                    <a href="{{ $whatsappUrl }}" target="_blank" class="flex items-center bg-[#109e4a] hover:bg-[#0d9648] text-white px-4 py-2.5 rounded-lg font-bold text-sm transition duration-300 shadow-sm gap-3">
                        <i class="fab fa-whatsapp text-2xl"></i>
                        <div class="text-left leading-tight">
                            <span class="block text-xs font-medium text-green-100">(85) 9 9916-6421</span>
                            <span class="block text-sm">Fale no WhatsApp</span>
                        </div>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="xl:hidden flex items-center">
                    <button type="button" id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Abrir menu principal</span>
                        <i id="menu-icon" class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu, show/hide based on menu state. -->
        <div class="hidden xl:hidden bg-[#001f42] border-t border-[#002d5e]" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-[#f2bd11] hover:bg-[#002752] hover:text-white">Início</a>
                <a href="{{ route('packages20262027') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#002752] hover:text-[#f2bd11]">Pacotes 2026/2027</a>
                <a href="{{ route('short-trips') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#002752] hover:text-[#f2bd11]">Bate e Volta</a>
                <a href="{{ route('group-trips') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#002752] hover:text-[#f2bd11]">Viagens em Grupo</a>
                <a href="{{ route('destination') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#002752] hover:text-[#f2bd11]">Destinos</a>

                {{-- Serviços mobile --}}
                <a href="{{ route('services') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#002752] hover:text-[#f2bd11]">Nossos Serviços</a>
                @foreach($menuServices as $svc)
                    <a href="{{ route('service.show', $svc->slug) }}" class="block px-3 py-2 ml-4 rounded-md text-sm font-medium text-gray-300 hover:bg-[#002752] hover:text-[#f2bd11]">
                        <i class="fas fa-concierge-bell mr-1 text-[#109e4a] text-xs"></i>
                        {{ $svc->title }}
                    </a>
                @endforeach

                <a href="{{ route('home') }}#orcamento" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#002752] hover:text-[#f2bd11]">Monte sua Viagem</a>
                <a href="{{ route('faq') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#002752] hover:text-[#f2bd11]">Dúvidas</a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#002752] hover:text-[#f2bd11]">Contato</a>
                
                <div class="mt-4 px-3 py-2">
                    <a href="{{ $whatsappUrl }}" target="_blank" class="flex items-center justify-center bg-[#109e4a] hover:bg-[#0d9648] text-white py-3 rounded-lg font-bold transition duration-300 w-full gap-2">
                        <i class="fab fa-whatsapp text-2xl"></i>
                        <span>Fale no WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="flex-grow">
        @include('layouts.header')
        @include('layouts.breadcrumb')
        @yield('content')
    </main>

    <!-- FOOTER -->
    @include('layouts.footer')
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

document.addEventListener('DOMContentLoaded', () => {

    const dropdown = document.getElementById('services-dropdown');
    const button = document.getElementById('services-button');
    const menu = document.getElementById('services-menu');
    const arrow = document.getElementById('services-arrow');

    let closeTimeout;

    function openMenu() {
        clearTimeout(closeTimeout);
        menu.classList.remove('hidden');
        arrow.classList.add('rotate-180');
    }

    function closeMenu() {
        closeTimeout = setTimeout(() => {
            menu.classList.add('hidden');
            arrow.classList.remove('rotate-180');
        }, 150);
    }

    // Desktop (hover)
    dropdown.addEventListener('mouseenter', openMenu);
    dropdown.addEventListener('mouseleave', closeMenu);

    // Mobile e touch (click)
    button.addEventListener('click', (e) => {
        e.preventDefault();
        menu.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');
    });

    // Fecha ao clicar fora
    document.addEventListener('click', (e) => {
        if (!dropdown.contains(e.target)) {
            menu.classList.add('hidden');
            arrow.classList.remove('rotate-180');
        }
    });

});
</script>
</body>
</html>
