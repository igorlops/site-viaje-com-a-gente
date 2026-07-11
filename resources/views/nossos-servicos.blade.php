@extends('layouts.site')

@section('title', 'Nossos Serviços - Viaje com a Gente')

@section('content')

    @php
        // $services é injetado pelo controller, ex:
        // Service::where('status', 'published')->get()
        $whatsappUrl = isset($socialLinks['whatsapp']) ? $socialLinks['whatsapp']->url : 'https://wa.me/5585999166421';
    @endphp

    <!-- SERVICES GRID -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <div class="inline-flex items-center justify-center gap-2 mb-2 text-[#002752] uppercase font-black tracking-widest text-sm">
                    <span>O que fazemos por você</span>
                    <i class="fas fa-handshake text-[#109e4a]"></i>
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#002752] tracking-tight">
                    Logística integrada e planejamento sob medida
                </h2>
                <div class="w-16 h-1 bg-[#109e4a] mx-auto mt-4 rounded"></div>
            </div>

            <!-- Services Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $service)
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-md hover:shadow-2xl hover:-translate-y-1 transition duration-300 overflow-hidden flex flex-col">
                        <!-- Image + Title Overlay -->
                        <div class="relative h-44 overflow-hidden">
                            <img src="{{ Storage::url($service->image_path) }}" alt="{{ $service->title }}"
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/40"></div>
                            <div class="absolute inset-0 flex items-end justify-center pb-4 px-4">
                                <h3 class="text-[#f3a908] font-black text-lg uppercase tracking-wide leading-tight text-center">
                                    {{ $service->title }}
                                </h3>
                            </div>
                        </div>

                        <!-- Body -->
                        <div class="p-6 flex flex-col flex-1">
                            <p class="text-gray-500 text-sm leading-relaxed mb-6 flex-1">
                                {{ $service->subtitle }}
                            </p>
                            <button type="button"
                                    data-service="{{ $service->title }}"
                                    onclick="selecionarServico(this)"
                                    class="cursor-pointer service-cta bg-[#109e4a] hover:bg-[#0d9648] text-center justify-center text-white px-8 py-4 rounded-lg font-black text-sm tracking-wider uppercase transition duration-300 shadow-md flex items-center gap-3 shrink-0">
                                Saiba Mais
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
    </section>

    @if($ctaSession = $cta_session->firstWhere('order_position', 1))
        <x-cta-session :cta="$ctaSession" />
    @endif

    <!-- WHY CHOOSE US / EXTRAORDINARY COPY -->
    <section class="relative py-24 bg-[#001c3d] overflow-hidden">
        <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-[#109e4a]/10 blur-3xl"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-[#f3a908]/10 blur-3xl"></div>

        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-8">
            <span class="inline-flex items-center gap-2 text-[#f3a908] uppercase font-black tracking-widest text-xs mb-4">
                <span class="w-8 h-px bg-[#f3a908]"></span>
                Por que escolher a gente
                <span class="w-8 h-px bg-[#f3a908]"></span>
            </span>
            <h2 class="text-3xl sm:text-4xl font-black text-white leading-tight mb-6">
                Não vendemos pacotes. <span class="text-[#f3a908]">Construímos viagens</span> que viram histórias pra contar.
            </h2>
            <p class="text-gray-300 text-base sm:text-lg leading-relaxed max-w-3xl mx-auto mb-16">
                Enquanto agências automatizadas entregam links e torcem para dar certo, a gente pega o telefone. Cada roteiro é desenhado por gente que já viajou, já resolveu imprevisto às 3h da manhã e sabe exatamente o que fazer diferente da próxima vez. É esse cuidado que transforma uma reserva em uma viagem tranquila do início ao fim.
            </p>

            <!-- Stats -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                <div class="bg-white/5 border border-white/10 rounded-2xl py-8 px-4 backdrop-blur-sm">
                    <span class="block text-3xl sm:text-4xl font-black text-[#f3a908] mb-1">+15</span>
                    <span class="block text-xs sm:text-sm text-gray-300 font-semibold uppercase tracking-wide">Anos de experiência</span>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-2xl py-8 px-4 backdrop-blur-sm">
                    <span class="block text-3xl sm:text-4xl font-black text-[#f3a908] mb-1">+8mil</span>
                    <span class="block text-xs sm:text-sm text-gray-300 font-semibold uppercase tracking-wide">Viajantes atendidos</span>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-2xl py-8 px-4 backdrop-blur-sm">
                    <span class="block text-3xl sm:text-4xl font-black text-[#f3a908] mb-1">24h</span>
                    <span class="block text-xs sm:text-sm text-gray-300 font-semibold uppercase tracking-wide">Suporte em viagem</span>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-2xl py-8 px-4 backdrop-blur-sm">
                    <span class="block text-3xl sm:text-4xl font-black text-[#f3a908] mb-1">98%</span>
                    <span class="block text-xs sm:text-sm text-gray-300 font-semibold uppercase tracking-wide">Clientes satisfeitos</span>
                </div>
            </div>
        </div>
    </section>

    <!-- LOGISTICS DIFFERENTIALS SECTION -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Text / Checklist -->
                <div>
                    <div class="inline-flex items-center justify-center gap-2 mb-2 text-[#002752] uppercase font-black tracking-widest text-xs">
                        <span>Nosso Diferencial</span>
                        <span class="w-2 h-2 rounded-full bg-[#109e4a]"></span>
                    </div>
                    <h3 class="text-3xl font-extrabold text-[#002752] mb-6 leading-tight">
                        Do primeiro clique até o retorno para casa: estamos com você
                    </h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-8">
                        Diferente das agências 100% automatizadas e sem suporte humano, nós acreditamos que uma viagem perfeita exige um acompanhamento de perto. É por isso que desenhamos um ecossistema de atendimento completo.
                    </p>

                    <!-- Checklist items -->
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-[#109e4a]/10 text-[#109e4a] flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <span class="block font-bold text-[#002752] text-sm">Suporte Emergencial 24 Horas</span>
                                <span class="block text-xs text-gray-500">Linha telefônica e de mensagens direta em caso de atrasos ou imprevistos em viagem.</span>
                            </div>
                        </li>

                        <li class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-[#109e4a]/10 text-[#109e4a] flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <span class="block font-bold text-[#002752] text-sm">Assessoria de Embarque</span>
                                <span class="block text-xs text-gray-500">Realizamos seu check-in e enviamos lembretes úteis antes do dia da sua partida.</span>
                            </div>
                        </li>

                        <li class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-[#109e4a]/10 text-[#109e4a] flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <span class="block font-bold text-[#002752] text-sm">Transparência Tarifária</span>
                                <span class="block text-xs text-gray-500">Sem taxas ocultas ou surpresas na contratação. Valores detalhados na proposta.</span>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Graphic Display -->
                <div class="bg-gradient-to-br from-[#002752] to-[#001c3d] rounded-2xl p-8 text-white relative shadow-xl overflow-hidden">
                    <div class="absolute -right-8 -bottom-8 w-64 h-64 rounded-full bg-blue-900/40 blur-2xl"></div>
                    <div class="relative z-10">
                        <span class="block text-[#f3a908] text-xs font-black uppercase tracking-widest mb-2">Compromisso</span>
                        <h4 class="text-2xl font-extrabold mb-6">Nosso Padrão de Atendimento</h4>

                        <!-- Timeline structure -->
                        <div class="space-y-6">
                            <div class="relative pl-8 border-l border-white/20">
                                <span class="absolute left-[-5px] top-1.5 w-2.5 h-2.5 rounded-full bg-[#f3a908]"></span>
                                <span class="block text-xs font-bold uppercase tracking-wider text-gray-400">1. Antes da Viagem</span>
                                <span class="block text-sm text-gray-200 mt-0.5">Planejamento, roteiros detalhados, emissão ágil e dicas exclusivas sobre o destino.</span>
                            </div>

                            <div class="relative pl-8 border-l border-white/20">
                                <span class="absolute left-[-5px] top-1.5 w-2.5 h-2.5 rounded-full bg-[#109e4a]"></span>
                                <span class="block text-xs font-bold uppercase tracking-wider text-gray-400">2. Durante o Embarque</span>
                                <span class="block text-sm text-gray-200 mt-0.5">Check-in automático, acompanhamento de eventuais conexões e suporte ao passageiro.</span>
                            </div>

                            <div class="relative pl-8">
                                <span class="absolute left-[-5px] top-1.5 w-2.5 h-2.5 rounded-full bg-[#f3a908]"></span>
                                <span class="block text-xs font-bold uppercase tracking-wider text-gray-400">3. No Destino</span>
                                <span class="block text-sm text-gray-200 mt-0.5">Suporte emergencial e acompanhamento opcional de guias locais nos passeios programados.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    @if($ctaSession = $cta_session->firstWhere('order_position', 2))
        <x-cta-session :cta="$ctaSession" />
    @endif

    <!-- CALL TO ACTION (CTA) -->
    <section class="bg-[#f3a908] py-12 text-[#002752]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
                <!-- Text block -->
                <div class="text-center lg:text-left">
                    <span class="block text-lg font-black uppercase tracking-wide">Pronto para a sua próxima aventura?</span>
                    <span class="block text-sm font-medium opacity-90">Deixe o planejamento com quem entende e garanta o melhor preço e suporte do mercado.</span>
                </div>

                <!-- Action Button -->
                <a href="{{ $whatsappUrl }}" target="_blank" class="bg-[#109e4a] hover:bg-[#0d9648] text-white px-8 py-4 rounded-lg font-black text-sm tracking-wider uppercase transition duration-300 shadow-md flex items-center gap-3 shrink-0">
                    <i class="fab fa-whatsapp text-2xl"></i>
                    <span>Conversar com um Consultor</span>
                </a>
            </div>
        </div>
    </section>

    <!-- CONTACT FORM -->
    <section id="contato-form" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-5 rounded-3xl overflow-hidden shadow-2xl border border-gray-100">

                <!-- Left: Persuasive info panel -->
                <div class="lg:col-span-2 bg-gradient-to-br from-[#002752] to-[#001c3d] text-white p-8 sm:p-10 flex flex-col justify-between relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-56 h-56 rounded-full bg-[#109e4a]/20 blur-2xl"></div>
                    <div class="relative z-10">
                        <span class="inline-block bg-[#f3a908] text-[#002752] px-4 py-1.5 rounded-lg text-xs font-black uppercase tracking-wider mb-6">
                            Fale com a gente
                        </span>
                        <h2 class="text-2xl sm:text-3xl font-black mb-4 leading-tight">
                            Conte pra gente o que você precisa, cuidamos do resto
                        </h2>
                        <p class="text-gray-300 text-sm leading-relaxed mb-8">
                            Preencha o formulário ao lado e um dos nossos consultores especializados retorna com um orçamento sob medida — sem robô, sem enrolação.
                        </p>

                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <i class="fas fa-bolt text-[#f3a908] mt-1"></i>
                                <span class="text-sm text-gray-200">Resposta em até 1 dia útil</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fas fa-user-tie text-[#f3a908] mt-1"></i>
                                <span class="text-sm text-gray-200">Atendimento humano e especializado</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fas fa-tags text-[#f3a908] mt-1"></i>
                                <span class="text-sm text-gray-200">Orçamento sem compromisso</span>
                            </li>
                        </ul>
                    </div>

                    <a href="{{ $whatsappUrl }}" target="_blank" class="relative z-10 mt-10 inline-flex items-center justify-center gap-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-xs uppercase tracking-wider py-3 px-5 rounded-lg transition duration-200 w-fit">
                        <i class="fab fa-whatsapp text-base"></i>
                        Prefere falar por WhatsApp?
                    </a>
                </div>

                <!-- Right: Form -->
                <div class="lg:col-span-3 bg-white">
                    <form action="{{ route('contact.submit') }}" method="POST" class="p-8 sm:p-10 space-y-5">
                        @csrf

                        {{-- Identifica a origem do contato --}}
                        <input type="hidden" name="type" id="contact-type" value="Contato: Nossos Serviços">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            {{-- Nome --}}
                            <div>
                                <label for="name" class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">
                                    Nome Completo
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-xs">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" name="name" id="name" required value="{{ old('name') }}"
                                        class="w-full pl-10 pr-3 py-2.5 bg-gray-50 border border-gray-200 focus:border-[#002752] focus:bg-white focus:outline-none text-xs rounded-lg transition duration-200"
                                        placeholder="Ex: João Silva">
                                </div>
                                @error('name')
                                    <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- E-mail --}}
                            <div>
                                <label for="email" class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">
                                    Seu E-mail
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-xs">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" name="email" id="email" required value="{{ old('email') }}"
                                        class="w-full pl-10 pr-3 py-2.5 bg-gray-50 border border-gray-200 focus:border-[#002752] focus:bg-white focus:outline-none text-xs rounded-lg transition duration-200"
                                        placeholder="Ex: joao@email.com">
                                </div>
                                @error('email')
                                    <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            {{-- WhatsApp / Telefone --}}
                            <div>
                                <label for="phone" class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">
                                    WhatsApp / Telefone
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-xs">
                                        <i class="fab fa-whatsapp"></i>
                                    </span>
                                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                        class="w-full pl-10 pr-3 py-2.5 bg-gray-50 border border-gray-200 focus:border-[#002752] focus:bg-white focus:outline-none text-xs rounded-lg transition duration-200"
                                        placeholder="Ex: (85) 99999-9999">
                                </div>
                                @error('phone')
                                    <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Serviço de interesse --}}
                            <div>
                                <label for="service_interest" class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">
                                    Serviço de Interesse
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-xs">
                                        <i class="fas fa-suitcase-rolling"></i>
                                    </span>
                                    <select name="service_interest" id="service_interest" onchange="atualizarTipo(this.value)"
                                        class="w-full pl-10 pr-3 py-2.5 bg-gray-50 border border-gray-200 focus:border-[#002752] focus:bg-white focus:outline-none text-xs rounded-lg transition duration-200 appearance-none">
                                        <option value="">Selecione um serviço</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->title }}">{{ $service->title }}</option>
                                        @endforeach
                                        <option value="Outro assunto">Outro assunto</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Mensagem --}}
                        <div>
                            <label for="message" class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">
                                O que você precisa?
                            </label>
                            <textarea name="message" id="message" rows="4" required
                                class="w-full p-3 bg-gray-50 border border-gray-200 focus:border-[#002752] focus:bg-white focus:outline-none text-xs rounded-lg transition duration-200 resize-none"
                                placeholder="Descreva detalhes como quantidade de pessoas, datas ou dúvidas sobre o serviço desejado...">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Botão Enviar --}}
                        <button type="submit"
                                class="w-full bg-[#109e4a] hover:bg-[#0d9648] text-white font-bold text-xs uppercase tracking-wider py-3.5 rounded-lg transition duration-200 shadow-md flex items-center justify-center gap-2">
                            <i class="fas fa-paper-plane"></i>
                            Enviar Solicitação
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Preenche automaticamente o assunto e rola até o formulário
        // quando o usuário clica em "Saiba Mais" em um dos cards de serviço.
        function selecionarServico(button) {
            const serviceTitle = button.getAttribute('data-service');
            const select = document.getElementById('service_interest');
            const hiddenType = document.getElementById('contact-type');
            const messageField = document.getElementById('message');

            if (select) {
                select.value = serviceTitle;
            }
            if (hiddenType) {
                hiddenType.value = 'Serviço: ' + serviceTitle;
            }
            if (messageField && !messageField.value) {
                messageField.value = 'Olá! Tenho interesse no serviço de ' + serviceTitle + '. Gostaria de solicitar um orçamento personalizado.';
            }

            document.getElementById('contato-form').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        // Mantém o campo oculto "type" sincronizado quando o usuário
        // troca o serviço diretamente no select do formulário.
        function atualizarTipo(value) {
            const hiddenType = document.getElementById('contact-type');
            if (hiddenType) {
                hiddenType.value = value ? ('Serviço: ' + value) : 'Contato: Nossos Serviços';
        }
    </script>

    @if($ctaSession = $cta_session->firstWhere('order_position', 3))
        <x-cta-session :cta="$ctaSession" />
    @endif

@endsection