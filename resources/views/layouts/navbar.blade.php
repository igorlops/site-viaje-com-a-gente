<header class="bg-white text-[#001c3d] sticky top-0 z-50 shadow-md">
    <!-- Top Bar: Estilizada com base na referência da CVC -->
    <!-- Mudamos o fundo para uma cor clara/neutra e adicionamos uma borda sutil embaixo -->
    <div class="bg-[#f3a908]/70 border-b border-[#f3a908]/90">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Usamos 'justify-center sm:justify-end' para alinhar tudo à direita em telas maiores -->
            <div class="flex flex-wrap items-center justify-center sm:justify-end h-auto sm:h-10 py-2 sm:py-0 gap-x-6 gap-y-1 text-xs text-gray-600 font-medium">
                
                <!-- Item Telefone -->
                <a href="tel:{{ env('PHONE_NUMBER') }}" class="flex items-center hover:text-[#002752] transition duration-150">
                    <i class="fas fa-phone-alt text-[#002752] mr-2 text-[11px]"></i>
                    <span class="text-[#002752]">Central de Atendimento: <strong class="text-[#002752] font-semibold">{{ env('PHONE_NUMBER') }}</strong></span>
                </a>
                
                <!-- Divisor sutil entre os itens (visível a partir do mobile sm) -->
                <span class="hidden sm:inline text-[#002752]">|</span>

                <!-- Item E-mail / Suporte -->
                <a href="mailto:{{ env('EMAIL_ADDRESS') }}" class="flex items-center hover:text-[#002752] transition duration-150">
                    <i class="far fa-envelope text-[#002752] mr-2 text-[11px]"></i>
                    <span>Precisa de ajuda? <strong class="text-[#002752] font-semibold">{{ env('EMAIL_ADDRESS') }}</strong></span>
                </a>
                
            </div>
        </div>
    </div>

    <!-- Navbar Principal (Mantida e Ajustada) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img class="h-14 w-auto object-contain rounded" src="{{ site_setting_image('logo_navbar', 'assets/images/logo.jpeg') }}" alt="Viaje com a Gente Logo">
                </a>
            </div>
            
            <!-- Menu Desktop -->
            <nav class="hidden xl:flex space-x-4 2xl:space-x-6 text-[11px] 2xl:text-xs font-semibold uppercase tracking-wider">
                <a href="{{ route('home') }}" class=" {{ request()->routeIs('home') ? 'text-[#f3a908]' : 'hover:text-[#f3a908]' }} transition duration-200">Início</a>
                <a href="{{ route('services') }}" class=" {{ request()->routeIs('services') ? 'text-[#f3a908]' : 'hover:text-[#f3a908]' }} transition duration-200">Serviços</a>
                <a href="{{ route('group-trips') }}" class=" {{ request()->routeIs('group-trips') ? 'text-[#f3a908]' : 'hover:text-[#f3a908]' }} transition duration-200">Viagens em Grupo</a>
                <a href="{{ route('short-trips') }}" class=" {{ request()->routeIs('short-trips') ? 'text-[#f3a908]' : 'hover:text-[#f3a908]' }} transition duration-200">Bate e Volta</a>
                <a href="{{ route('destination') }}" class=" {{ request()->routeIs('destination') ? 'text-[#f3a908]' : 'hover:text-[#f3a908]' }} transition duration-200">Pacotes de viagem</a>
                <a href="{{ route('faq') }}" class=" {{ request()->routeIs('faq') ? 'text-[#f3a908]' : 'hover:text-[#f3a908]' }} transition duration-200">Dúvidas</a>
                <a href="{{ route('contact') }}" class=" {{ request()->routeIs('contact') ? 'text-[#f3a908]' : 'hover:text-[#f3a908]' }} transition duration-200">Contato</a>
            </nav>
            
            <!-- Mobile Menu Button -->
            <div class="xl:hidden flex items-center">
                <button type="button" id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-[#002752] hover:bg-gray-100 focus:outline-none" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Abrir menu principal</span>
                    <i id="menu-icon" class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu (Mantido) -->
    <div class="hidden xl:hidden bg-[#001f42] border-t border-[#002d5e]" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-[#f3a908] hover:bg-[#002752] hover:text-white">Início</a>
            <a href="{{ route('short-trips') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#002752] hover:text-[#f3a908]">Bate e Volta</a>
            <a href="{{ route('group-trips') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#002752] hover:text-[#f3a908]">Viagens em Grupo</a>
            <a href="{{ route('destination') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#002752] hover:text-[#f3a908]">Destinos</a>
            <a href="{{ route('services') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#002752] hover:text-[#f3a908]">Nossos Serviços</a>
            <a href="{{ route('home') }}#orcamento" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#002752] hover:text-[#f3a908]">Monte sua Viagem</a>
            <a href="{{ route('faq') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#002752] hover:text-[#f3a908]">Dúvidas</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#002752] hover:text-[#f3a908]">Contato</a>
        </div>
    </div>
</header>