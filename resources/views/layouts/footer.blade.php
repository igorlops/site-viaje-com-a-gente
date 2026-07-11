<footer class="bg-[#00152b] text-white pt-16 pb-8 border-t-4 border-[#f3a908]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <!-- Column 1: Brand -->
                <div class="flex flex-col space-y-4">
                    <img class="h-16 w-auto object-contain self-start bg-white p-1 rounded" src="{{ site_setting_image('logo_navbar', 'assets/images/logo.jpeg') }}" alt="Viaje com a Gente Logo">
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Viaje com segurança, parcele no boleto e conte com a gente do planejamento ao retorno.
                    </p>
                    <!-- Social Media Links from DB -->
                </div>

                <!-- Column 2: Navigation Links -->
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-[#f3a908] mb-6">Navegação</h3>
                    <ul class="space-y-3.5 text-sm">
                        <li><a href="{{ route('packages20262027') }}" class="text-gray-400 hover:text-white transition duration-200">Pacotes 2026/2027</a></li>
                        <li><a href="{{ route('short-trips') }}" class="text-gray-400 hover:text-white transition duration-200">Bate e Volta</a></li>
                        <li><a href="{{ route('group-trips') }}" class="text-gray-400 hover:text-white transition duration-200">Viagens em Grupo</a></li>
                        <li><a href="{{ route('destination') }}" class="text-gray-400 hover:text-white transition duration-200">Destinos</a></li>
                        <li><a href="{{ route('services') }}" class="text-gray-400 hover:text-white transition duration-200">Nossos Serviços</a></li>
                        <li><a href="{{ route('home') }}#orcamento" class="text-gray-400 hover:text-white transition duration-200">Monte sua Viagem</a></li>
                        <li><a href="{{ route('home') }}#por-que-nos" class="text-gray-400 hover:text-white transition duration-200">Sobre Nós</a></li>
                        <li><a href="{{ route('faq') }}" class="text-gray-400 hover:text-white transition duration-200">Dúvidas Frequentes</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white transition duration-200">Contato</a></li>
                    </ul>
                </div>

                <!-- Column 3: Information Links -->
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-[#f3a908] mb-6">Informações</h3>
                    <ul class="space-y-3.5 text-sm">
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Quem Somos</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Política de Privacidade</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Termos de Uso</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Formas de Pagamento</a></li>
                    </ul>
                </div>

                <!-- Column 4: Contact/Support -->
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-[#f3a908] mb-6">Atendimento</h3>
                    <ul class="space-y-4 text-sm text-gray-400">
                        <li class="flex items-start gap-3">
                            <i class="fab fa-whatsapp text-lg text-green-500 mt-0.5"></i>
                            <div>
                                <span class="block text-white font-semibold">(85) 9 9916-6421</span>
                                <span class="text-xs">Clique e fale no WhatsApp</span>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="far fa-envelope text-lg text-[#f3a908] mt-0.5"></i>
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
