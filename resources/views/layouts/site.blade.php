<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <nav class="hidden xl:flex space-x-4 2xl:space-x-6 text-[11px] 2xl:text-xs font-semibold uppercase tracking-wider">
                    <a href="{{ route('home') }}" class="text-[#f2bd11] hover:text-white transition duration-200">Início</a>
                    <a href="#destinos" class="hover:text-[#f2bd11] transition duration-200">Pacotes 2026/2027</a>
                    <a href="#como-funciona" class="hover:text-[#f2bd11] transition duration-200">Bate e Volta</a>
                    <a href="#depoimentos" class="hover:text-[#f2bd11] transition duration-200">Viagens em Grupo</a>
                    <a href="#orcamento" class="hover:text-[#f2bd11] transition duration-200">Monte sua Viagem</a>
                    <a href="#por-que-nos" class="hover:text-[#f2bd11] transition duration-200">Sobre</a>
                    <a href="#duvidas" class="hover:text-[#f2bd11] transition duration-200">Dúvidas</a>
                    <a href="#contato" class="hover:text-[#f2bd11] transition duration-200">Contato</a>
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
                <a href="#destinos" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#002752] hover:text-[#f2bd11]">Pacotes 2026/2027</a>
                <a href="#como-funciona" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#002752] hover:text-[#f2bd11]">Bate e Volta</a>
                <a href="#depoimentos" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#002752] hover:text-[#f2bd11]">Viagens em Grupo</a>
                <a href="#orcamento" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#002752] hover:text-[#f2bd11]">Monte sua Viagem</a>
                <a href="#por-que-nos" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#002752] hover:text-[#f2bd11]">Sobre</a>
                <a href="#duvidas" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#002752] hover:text-[#f2bd11]">Dúvidas</a>
                <a href="#contato" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#002752] hover:text-[#f2bd11]">Contato</a>
                
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
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-[#00152b] text-white pt-16 pb-8 border-t-4 border-[#f2bd11]" id="contato">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <!-- Column 1: Brand -->
                <div class="flex flex-col space-y-4">
                    <img class="h-16 w-auto object-contain self-start bg-white p-1 rounded" src="{{ asset('assets/images/logo.jpeg') }}" alt="Viaje com a Gente Logo">
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Viaje com segurança, parcele no boleto e conte com a gente do planejamento ao retorno.
                    </p>
                    <!-- Social Media Links from DB -->
                    <div class="flex space-x-3 pt-2">
                        @foreach($socialLinks as $link)
                            @if($link->active && strtolower($link->name) !== 'whatsapp')
                                <a href="{{ $link->url }}" target="_blank" class="w-10 h-10 rounded-full bg-[#002752] hover:bg-[#f2bd11] hover:text-[#00152b] text-white flex items-center justify-center transition duration-300 shadow-sm" title="{{ $link->name }}">
                                    <i class="{{ $link->icon }} text-lg"></i>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Column 2: Navigation Links -->
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-[#f2bd11] mb-6">Navegação</h3>
                    <ul class="space-y-3.5 text-sm">
                        <li><a href="#destinos" class="text-gray-400 hover:text-white transition duration-200">Pacotes 2026/2027</a></li>
                        <li><a href="#como-funciona" class="text-gray-400 hover:text-white transition duration-200">Bate e Volta</a></li>
                        <li><a href="#depoimentos" class="text-gray-400 hover:text-white transition duration-200">Viagens em Grupo</a></li>
                        <li><a href="#orcamento" class="text-gray-400 hover:text-white transition duration-200">Monte sua Viagem</a></li>
                        <li><a href="#por-que-nos" class="text-gray-400 hover:text-white transition duration-200">Sobre Nós</a></li>
                        <li><a href="#duvidas" class="text-gray-400 hover:text-white transition duration-200">Dúvidas Frequentes</a></li>
                        <li><a href="#contato" class="text-gray-400 hover:text-white transition duration-200">Contato</a></li>
                    </ul>
                </div>

                <!-- Column 3: Information Links -->
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-[#f2bd11] mb-6">Informações</h3>
                    <ul class="space-y-3.5 text-sm">
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Quem Somos</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Política de Privacidade</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Termos de Uso</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Formas de Pagamento</a></li>
                    </ul>
                </div>

                <!-- Column 4: Contact/Support -->
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-[#f2bd11] mb-6">Atendimento</h3>
                    <ul class="space-y-4 text-sm text-gray-400">
                        <li class="flex items-start gap-3">
                            <i class="fab fa-whatsapp text-lg text-green-500 mt-0.5"></i>
                            <div>
                                <span class="block text-white font-semibold">(85) 9 9916-6421</span>
                                <span class="text-xs">Clique e fale no WhatsApp</span>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="far fa-envelope text-lg text-[#f2bd11] mt-0.5"></i>
                            <div>
                                <span class="block text-white">atendimento@viajecomagente.com.br</span>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt text-lg text-red-500 mt-0.5"></i>
                            <div>
                                <span class="block text-white">Fortaleza - CE</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 mt-8 border-t border-gray-800 text-center text-xs text-gray-500 flex flex-col md:flex-row justify-between items-center gap-4">
                <p>&copy; {{ date('Y') }} Viaje com a Gente - Viagens e Turismo. Todos os direitos reservados.</p>
                <div class="flex gap-4">
                    <a href="{{ route('login') }}" class="text-gray-500 hover:text-white text-xs transition duration-200">
                        <i class="fas fa-lock mr-1"></i> Painel Admin
                    </a>
                </div>
            </div>
        </div>
    </footer>

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
