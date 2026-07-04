<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - Viaje com a Gente</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Vite CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-800 flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#001c3d] text-white flex flex-col shrink-0 shadow-lg hidden md:flex">
        <!-- Brand/Logo -->
        <div class="h-20 flex items-center justify-center border-b border-white/10 px-6">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <img class="h-10 w-auto bg-white p-1 rounded" src="{{ asset('assets/images/logo.jpeg') }}" alt="Logo">
                <span class="font-extrabold uppercase text-sm tracking-wider text-[#f3a908]">Painel Admin</span>
            </a>
        </div>
        
        <!-- Navigation Menu -->
        <nav class="flex-grow p-4 space-y-1.5">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold transition duration-200 {{ Route::is('admin.dashboard') ? 'bg-[#f3a908] text-[#00152b]' : 'hover:bg-white/5 text-gray-300 hover:text-white' }}">
                <i class="fas fa-chart-line text-lg w-6 text-center"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.contacts.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold transition duration-200 {{ Route::is('admin.contacts.*') ? 'bg-[#f3a908] text-[#00152b]' : 'hover:bg-white/5 text-gray-300 hover:text-white' }}">
                <i class="fas fa-envelope-open-text text-lg w-6 text-center"></i>
                <span>Mensagens</span>
            </a>
            
            <a href="{{ route('admin.banners.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold transition duration-200 {{ Route::is('admin.banners.*') ? 'bg-[#f3a908] text-[#00152b]' : 'hover:bg-white/5 text-gray-300 hover:text-white' }}">
                <i class="fas fa-images text-lg w-6 text-center"></i>
                <span>Banners</span>
            </a>
            
            <a href="{{ route('admin.destinations.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold transition duration-200 {{ Route::is('admin.destinations.*') ? 'bg-[#f3a908] text-[#00152b]' : 'hover:bg-white/5 text-gray-300 hover:text-white' }}">
                <i class="fas fa-map-marked-alt text-lg w-6 text-center"></i>
                <span>Destinos</span>
            </a>
            
            <a href="{{ route('admin.social.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold transition duration-200 {{ Route::is('admin.social.*') ? 'bg-[#f3a908] text-[#00152b]' : 'hover:bg-white/5 text-gray-300 hover:text-white' }}">
                <i class="fas fa-share-nodes text-lg w-6 text-center"></i>
                <span>Redes Sociais</span>
            </a>

            <a href="{{ route('admin.services.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold transition duration-200 {{ Route::is('admin.services.*') ? 'bg-[#f3a908] text-[#00152b]' : 'hover:bg-white/5 text-gray-300 hover:text-white' }}">
                <i class="fas fa-concierge-bell text-lg w-6 text-center"></i>
                <span>Serviços</span>
            </a>
            <a href="{{ route('admin.pages.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold transition duration-200 {{ Route::is('admin.pages.*') ? 'bg-[#f3a908] text-[#00152b]' : 'hover:bg-white/5 text-gray-300 hover:text-white' }}">
                <i class="fas fa-file-lines text-lg w-6 text-center"></i>
                <span>Páginas</span>
            </a>

            <a href="{{ route('admin.testimonials.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold transition duration-200 {{ Route::is('admin.testimonials.*') ? 'bg-[#f3a908] text-[#00152b]' : 'hover:bg-white/5 text-gray-300 hover:text-white' }}">
                <i class="fas fa-quote-left text-lg w-6 text-center"></i>
                <span>Depoimentos</span>
            </a>

            <div class="pt-2 pb-1">
                <span class="px-4 text-[10px] font-bold uppercase tracking-widest text-white/30">Sistema</span>
            </div>

            <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold transition duration-200 {{ Route::is('admin.settings.*') ? 'bg-[#f3a908] text-[#00152b]' : 'hover:bg-white/5 text-gray-300 hover:text-white' }}">
                <i class="fas fa-sliders text-lg w-6 text-center"></i>
                <span>Configurações Gerais</span>
            </a>
        </nav>
        
        <!-- User Info / Logout -->
        <div class="p-4 border-t border-white/10 bg-[#00152b]">
            <div class="flex items-center justify-between mb-3">
                <div class="truncate">
                    <span class="block text-xs text-gray-400 font-medium">Logado como:</span>
                    <span class="block text-sm font-bold text-white truncate">{{ Auth::user()->name }}</span>
                </div>
            </div>
            
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-red-600/20 hover:bg-red-600 text-red-400 hover:text-white font-bold text-xs uppercase py-2.5 rounded-lg transition duration-200">
                    <i class="fas fa-right-from-bracket"></i>
                    <span>Sair do Painel</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- CONTENT WRAPPER -->
    <div class="flex-grow flex flex-col min-h-screen overflow-x-hidden">
        <!-- TOP NAV BAR -->
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-6 md:px-8">
            <div class="flex items-center gap-4">
                <!-- Mobile menu toggle -->
                <button id="mobile-sidebar-toggle" class="md:hidden text-[#002752] text-xl focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="text-xl font-bold text-gray-800">@yield('page_title', 'Painel Administrativo')</h1>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-2 border border-gray-300 hover:bg-gray-50 text-gray-600 px-4 py-2 rounded-lg font-semibold text-xs transition duration-200">
                    <i class="fas fa-external-link-alt text-[10px]"></i>
                    <span>Ver Site</span>
                </a>
            </div>
        </header>
        
        <!-- MOBILE SIDEBAR DRAWER -->
        <div id="mobile-sidebar" class="fixed inset-0 z-50 bg-black/50 transition-opacity duration-300 ease-in-out opacity-0 pointer-events-none md:hidden">
            <aside class="w-64 bg-[#001c3d] h-full text-white flex flex-col transform -translate-x-full transition-transform duration-300 ease-in-out">
                <div class="h-20 flex items-center justify-between border-b border-white/10 px-6">
                    <div class="flex items-center gap-3">
                        <img class="h-10 w-auto bg-white p-1 rounded" src="{{ asset('assets/images/logo.jpeg') }}" alt="Logo">
                        <span class="font-extrabold uppercase text-sm tracking-wider text-[#f3a908]">Painel Admin</span>
                    </div>
                    <button id="mobile-sidebar-close" class="text-white text-xl">
                        <i class="fas fa-xmark"></i>
                    </button>
                </div>
                
                <nav class="flex-grow p-4 space-y-1.5">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold transition duration-200 {{ Route::is('admin.dashboard') ? 'bg-[#f3a908] text-[#00152b]' : 'hover:bg-white/5 text-gray-300 hover:text-white' }}">
                        <i class="fas fa-chart-line text-lg w-6 text-center"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('admin.contacts.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold transition duration-200 {{ Route::is('admin.contacts.*') ? 'bg-[#f3a908] text-[#00152b]' : 'hover:bg-white/5 text-gray-300 hover:text-white' }}">
                        <i class="fas fa-envelope-open-text text-lg w-6 text-center"></i>
                        <span>Mensagens</span>
                    </a>
                    
                    <a href="{{ route('admin.banners.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold transition duration-200 {{ Route::is('admin.banners.*') ? 'bg-[#f3a908] text-[#00152b]' : 'hover:bg-white/5 text-gray-300 hover:text-white' }}">
                        <i class="fas fa-images text-lg w-6 text-center"></i>
                        <span>Banners</span>
                    </a>
                    
                    <a href="{{ route('admin.destinations.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold transition duration-200 {{ Route::is('admin.destinations.*') ? 'bg-[#f3a908] text-[#00152b]' : 'hover:bg-white/5 text-gray-300 hover:text-white' }}">
                        <i class="fas fa-map-marked-alt text-lg w-6 text-center"></i>
                        <span>Destinos</span>
                    </a>
                    
                    <a href="{{ route('admin.social.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold transition duration-200 {{ Route::is('admin.social.*') ? 'bg-[#f3a908] text-[#00152b]' : 'hover:bg-white/5 text-gray-300 hover:text-white' }}">
                        <i class="fas fa-share-nodes text-lg w-6 text-center"></i>
                        <span>Redes Sociais</span>
                    </a>

                    <a href="{{ route('admin.services.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold transition duration-200 {{ Route::is('admin.services.*') ? 'bg-[#f3a908] text-[#00152b]' : 'hover:bg-white/5 text-gray-300 hover:text-white' }}">
                        <i class="fas fa-concierge-bell text-lg w-6 text-center"></i>
                        <span>Serviços</span>
                    </a>

                    <a href="{{ route('admin.pages.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold transition duration-200 {{ Route::is('admin.pages.*') ? 'bg-[#f3a908] text-[#00152b]' : 'hover:bg-white/5 text-gray-300 hover:text-white' }}">
                        <i class="fas fa-file-lines text-lg w-6 text-center"></i>
                        <span>Páginas</span>
                    </a>

                    <a href="{{ route('admin.testimonials.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold transition duration-200 {{ Route::is('admin.testimonials.*') ? 'bg-[#f3a908] text-[#00152b]' : 'hover:bg-white/5 text-gray-300 hover:text-white' }}">
                        <i class="fas fa-quote-left text-lg w-6 text-center"></i>
                        <span>Depoimentos</span>
                    </a>

                    <div class="pt-2 pb-1">
                        <span class="px-4 text-[10px] font-bold uppercase tracking-widest text-white/30">Sistema</span>
                    </div>

                    <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold transition duration-200 {{ Route::is('admin.settings.*') ? 'bg-[#f3a908] text-[#00152b]' : 'hover:bg-white/5 text-gray-300 hover:text-white' }}">
                        <i class="fas fa-sliders text-lg w-6 text-center"></i>
                        <span>Configurações Gerais</span>
                    </a>
                </nav>
                
                <div class="p-4 border-t border-white/10 bg-[#00152b]">
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 bg-red-600/20 hover:bg-red-600 text-red-400 hover:text-white font-bold text-xs uppercase py-2.5 rounded-lg transition duration-200">
                            <i class="fas fa-right-from-bracket"></i>
                            <span>Sair do Painel</span>
                        </button>
                    </form>
                </div>
            </aside>
        </div>

        <!-- MAIN CONTENT VIEW -->
        <main class="flex-grow p-6 md:p-8">
            <!-- FLASH MESSAGES -->
            @if(session('success'))
                <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-lg flex items-start gap-3 shadow-sm">
                    <i class="fas fa-check-circle text-emerald-500 text-lg mt-0.5"></i>
                    <div>
                        <p class="text-sm font-bold text-emerald-800">Sucesso!</p>
                        <p class="text-xs text-emerald-700 mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg flex items-start gap-3 shadow-sm">
                    <i class="fas fa-exclamation-circle text-red-500 text-lg mt-0.5"></i>
                    <div>
                        <p class="text-sm font-bold text-red-800">Erro!</p>
                        <p class="text-xs text-red-700 mt-0.5">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            @yield('admin_content')
        </main>
    </div>

    <!-- Sidebar toggles script -->
    <script>
        const openToggle = document.getElementById('mobile-sidebar-toggle');
        const closeToggle = document.getElementById('mobile-sidebar-close');
        const overlay = document.getElementById('mobile-sidebar');
        const aside = overlay.querySelector('aside');

        function openSidebar() {
            overlay.classList.remove('pointer-events-none', 'opacity-0');
            overlay.classList.add('opacity-100');
            aside.classList.remove('-translate-x-full');
            aside.classList.add('translate-x-0');
        }

        function closeSidebar() {
            overlay.classList.add('pointer-events-none', 'opacity-0');
            overlay.classList.remove('opacity-100');
            aside.classList.remove('translate-x-0');
            aside.classList.add('-translate-x-full');
        }

        openToggle.addEventListener('click', openSidebar);
        closeToggle.addEventListener('click', closeSidebar);
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) closeSidebar();
        });
    </script>
    
    @yield('scripts')
</body>
</html>
