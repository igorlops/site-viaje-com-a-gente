@extends('layouts.site')

@section('title', 'Viaje com a Gente - Viagens e Turismo')

@section('content')
@php
     $whatsappUrl = isset($socialLinks['whatsapp']) ? $socialLinks['whatsapp']->url : 'https://wa.me/5585999166421';
@endphp

    <!-- NOVO HERO DE BOAS-VINDAS / INTRODUÇÃO PREMIUM -->
    <section class="relative bg-gradient-to-b from-[#002752]/10 via-white to-white py-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Copy Principal -->
                <div class="lg:col-span-7 text-center lg:text-left">
                    <span class="text-[#109e4a] text-xs font-black uppercase tracking-widest bg-[#109e4a]/10 px-4 py-1.5 rounded-full inline-block mb-4">
                        Sua Próxima História Começa Aqui
                    </span>
                    <h1 class="text-4xl sm:text-5xl font-black text-[#002752] tracking-tight leading-none mb-6">
                        O mundo é grande demais para você ficar no mesmo lugar.
                    </h1>
                    <p class="text-base sm:text-lg text-gray-600 leading-relaxed max-w-2xl mx-auto lg:mx-0 mb-8">
                        Planejamos, organizamos e executamos cada detalhe da sua viagem. Seja para um bate e volta revigorante no final de semana ou para desbravar novos horizons em grupos nacionais e internacionais, nós cuidamos de toda a logística para você focar apenas em viver o momento.
                    </p>
                    
                    <!-- Botões de Ação Rápida (Segmentação de Público) -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="#destinos" class="w-full sm:w-auto bg-[#002752] hover:bg-[#001c3b] text-white text-center px-8 py-4 rounded-xl font-black text-sm tracking-wide uppercase transition duration-300 shadow-lg shadow-[#002752]/20">
                            Explorar Destinos
                        </a>
                        <a href="{{ $whatsappUrl }}" target="_blank" class="w-full sm:w-auto bg-[#109e4a] hover:bg-[#0d9648] text-white text-center px-8 py-4 rounded-xl font-black text-sm tracking-wide uppercase transition duration-300 shadow-lg shadow-[#109e4a]/20 flex items-center justify-center gap-2">
                            <i class="fab fa-whatsapp text-lg"></i>
                            Falar com Consultor
                        </a>
                    </div>
                </div>

                <!-- Box de Destaque Comercial Lateral -->
                <div class="lg:col-span-5 bg-white border border-gray-100 rounded-3xl p-8 shadow-[0_20px_50px_rgba(0,39,82,0.05)] relative">
                    <div class="absolute -top-4 -right-4 bg-[#f3a908] text-[#002752] font-black text-xs uppercase px-4 py-1.5 rounded-lg shadow-md rotate-6">
                        Facilitado!
                    </div>
                    <h3 class="text-xl font-black text-[#002752] mb-4">Por que viajar conosco?</h3>
                    <div class="space-y-4">
                        <div class="flex gap-3">
                            <div class="w-8 h-8 rounded-lg bg-[#f3a908]/10 text-[#f3a908] flex items-center justify-center shrink-0"><i class="fas fa-barcode text-sm"></i></div>
                            <div>
                                <h4 class="font-bold text-sm text-gray-800">Boleto Sem Consulta</h4>
                                <p class="text-xs text-gray-500">Parcele sua viagem sem burocracia ou consultas ao SPC/Serasa.</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="w-8 h-8 rounded-lg bg-[#109e4a]/10 text-[#109e4a] flex items-center justify-center shrink-0"><i class="fas fa-headset text-sm"></i></div>
                            <div>
                                <h4 class="font-bold text-sm text-gray-800">Suporte 24h e Humanizado</h4>
                                <p class="text-xs text-gray-500">Consultores reais acompanhando seus embarques do início ao fim.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- DESTINOS EM DESTAQUE -->
    <section class="py-20 bg-white border-t border-gray-50" id="destinos">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16 relative">
                <div class="inline-flex items-center justify-center gap-2 mb-2 text-[#002752] uppercase font-black tracking-widest text-sm">
                    <span>Nossos Catálogos</span>
                    <i class="fas fa-paper-plane text-[#109e4a] transform rotate-12"></i>
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#002752] tracking-tight">
                    Os lugares mais desejados para você viajar com conforto e economia
                </h2>
                <div class="w-16 h-1 bg-[#109e4a] mx-auto mt-4 rounded"></div>
            </div>
            
            <!-- Destinations Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
                @forelse($destinations as $destination)
                   <x-card-pacotes :pkg="$destination" :whatsappUrl="$whatsappUrl" />
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">
                        Nenhum pacote em destaque cadastrado no momento.
                    </div>
                @endforelse
            </div>
            
            <!-- More Packages Button -->
            <div class="text-center">
                <a href="{{ route('destination') }}" class="inline-flex items-center justify-center border-2 border-[#002752] text-[#002752] hover:bg-[#002752] hover:text-white px-8 py-3.5 rounded-lg font-black text-sm tracking-wide uppercase transition duration-300 gap-2">
                    <span>Ver Todos os Pacotes</span>
                    <i class="fas fa-chevron-right text-xs"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- POR QUE VIAJAR COM A GENTE -->
    <section class="py-20 bg-[#002752] text-white" id="por-que-nos">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-extrabold uppercase tracking-tight">
                    A Experiência de Viajar Conosco
                </h2>
                <div class="w-16 h-1 bg-[#f3a908] mx-auto mt-4 rounded"></div>
            </div>
            
            <!-- Grid Benefits Premium -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Benefit 1 -->
                <div class="bg-white/5 border border-white/10 rounded-2xl p-8 hover:bg-white/10 transition duration-300">
                    <div class="w-12 h-12 rounded-xl bg-[#f3a908] text-[#002752] flex items-center justify-center mb-6 shadow-md">
                        <i class="fas fa-barcode text-xl"></i>
                    </div>
                    <h3 class="text-base font-bold uppercase mb-2 tracking-wide text-white">Parcelamento no Boleto Imbatível</h3>
                    <p class="text-xs text-gray-300 leading-relaxed">
                        Planeje suas viagens de forma inteligente sem comprometer o limite do seu cartão de crédito.
                    </p>
                </div>
                <!-- Benefit 2 -->
                <div class="bg-white/5 border border-white/10 rounded-2xl p-8 hover:bg-white/10 transition duration-300">
                    <div class="w-12 h-12 rounded-xl bg-[#f3a908] text-[#002752] flex items-center justify-center mb-6 shadow-md">
                        <i class="fas fa-headset text-xl"></i>
                    </div>
                    <h3 class="text-base font-bold uppercase mb-2 tracking-wide text-white">Atendimento 100% Humanizado</h3>
                    <p class="text-xs text-gray-300 leading-relaxed">
                        Nada de robôs chatos. Aqui você conversa com consultores especialistas antes, durante e depois do seu passeio.
                    </p>
                </div>
                <!-- Benefit 3 -->
                <div class="bg-white/5 border border-white/10 rounded-2xl p-8 hover:bg-white/10 transition duration-300">
                    <div class="w-12 h-12 rounded-xl bg-[#f3a908] text-[#002752] flex items-center justify-center mb-6 shadow-md">
                        <i class="fas fa-route text-xl"></i>
                    </div>
                    <h3 class="text-base font-bold uppercase mb-2 tracking-wide text-white">Logística e Roteiros Completos</h3>
                    <p class="text-xs text-gray-300 leading-relaxed">
                        Nossos roteiros são validados e integrados para que você aproveite cada minuto, sem imprevistos.
                    </p>
                </div>
                <!-- Benefit 4 -->
                <div class="bg-white/5 border border-white/10 rounded-2xl p-8 hover:bg-white/10 transition duration-300">
                    <div class="w-12 h-12 rounded-xl bg-[#f3a908] text-[#002752] flex items-center justify-center mb-6 shadow-md">
                        <i class="fas fa-shield-alt text-xl"></i>
                    </div>
                    <h3 class="text-base font-bold uppercase mb-2 tracking-wide text-white">Segurança Operacional</h3>
                    <p class="text-xs text-gray-300 leading-relaxed">
                        Trabalhamos exclusivamente com frotas seguras, motoristas experientes e operadoras credenciadas.
                    </p>
                </div>
                <!-- Benefit 5 -->
                <div class="bg-white/5 border border-white/10 rounded-2xl p-8 hover:bg-white/10 transition duration-300">
                    <div class="w-12 h-12 rounded-xl bg-[#f3a908] text-[#002752] flex items-center justify-center mb-6 shadow-md">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <h3 class="text-base font-bold uppercase mb-2 tracking-wide text-white">Viagens Adaptadas e Grupos</h3>
                    <p class="text-xs text-gray-300 leading-relaxed">
                        Formatos perfeitos para quem viaja sozinho fazer amizades, casais ou famílias completas.
                    </p>
                </div>
                <!-- Benefit 6 -->
                <div class="bg-white/5 border border-white/10 rounded-2xl p-8 hover:bg-white/10 transition duration-300">
                    <div class="w-12 h-12 rounded-xl bg-[#f3a908] text-[#002752] flex items-center justify-center mb-6 shadow-md">
                        <i class="fab fa-whatsapp text-xl"></i>
                    </div>
                    <h3 class="text-base font-bold uppercase mb-2 tracking-wide text-white">Plantão Exclusivo</h3>
                    <p class="text-xs text-gray-300 leading-relaxed">
                        Um canal direto no WhatsApp sempre ativo para sanar dúvidas urgentes durante os dias de viagem.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- COMO FUNCIONA (Linha de Processo Otimizada) -->
    <section class="py-20 bg-gray-50" id="como-funciona">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-20">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#002752] tracking-tight uppercase">
                    Do Clique ao Embarque
                </h2>
                <p class="text-sm text-gray-500 mt-2">Passo a passo simples para planejar suas próximas férias</p>
                <div class="w-16 h-1 bg-[#109e4a] mx-auto mt-4 rounded"></div>
            </div>
            
            <!-- Steps Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-8">
                <!-- Step 1 -->
                <div class="text-center flex flex-col items-center group">
                    <div class="w-20 h-20 rounded-2xl bg-white border border-gray-100 shadow-sm flex items-center justify-center mb-4 group-hover:scale-105 group-hover:border-[#109e4a]/30 transition duration-300 relative">
                        <span class="absolute -top-2 -right-2 w-6 m-0 h-6 rounded-full bg-[#109e4a] text-white flex items-center justify-center font-bold text-xs">1</span>
                        <i class="fas fa-search text-[#002752] text-2xl"></i>
                    </div>
                    <h3 class="text-sm font-bold text-[#002752] mb-1">Escolha seu destino</h3>
                    <p class="text-[11px] text-gray-500 max-w-[180px] leading-relaxed">
                        Navegue por nossas opções ou solicite apoio.
                    </p>
                </div>
                <!-- Step 2 -->
                <div class="text-center flex flex-col items-center group">
                    <div class="w-20 h-20 rounded-2xl bg-white border border-gray-100 shadow-sm flex items-center justify-center mb-4 group-hover:scale-105 group-hover:border-[#f3a908]/30 transition duration-300 relative">
                        <span class="absolute -top-2 -right-2 w-6 m-0 h-6 rounded-full bg-[#f3a908] text-[#002752] flex items-center justify-center font-bold text-xs">2</span>
                        <i class="far fa-file-alt text-[#002752] text-2xl"></i>
                    </div>
                    <h3 class="text-sm font-bold text-[#002752] mb-1">Receba a Proposta</h3>
                    <p class="text-[11px] text-gray-500 max-w-[180px] leading-relaxed">
                        Ajustamos tudo de acordo com as suas preferências.
                    </p>
                </div>
                <!-- Step 3 -->
                <div class="text-center flex flex-col items-center group">
                    <div class="w-20 h-20 rounded-2xl bg-white border border-gray-100 shadow-sm flex items-center justify-center mb-4 group-hover:scale-105 group-hover:border-[#109e4a]/30 transition duration-300 relative">
                        <span class="absolute -top-2 -right-2 w-6 m-0 h-6 rounded-full bg-[#109e4a] text-white flex items-center justify-center font-bold text-xs">3</span>
                        <i class="far fa-credit-card text-[#002752] text-2xl"></i>
                    </div>
                    <h3 class="text-sm font-bold text-[#002752] mb-1">Forma de Pagamento</h3>
                    <p class="text-[11px] text-gray-500 max-w-[180px] leading-relaxed">
                        Defina entre Boleto, PIX ou Cartão em até 10x.
                    </p>
                </div>
                <!-- Step 4 -->
                <div class="text-center flex flex-col items-center group">
                    <div class="w-20 h-20 rounded-2xl bg-white border border-gray-100 shadow-sm flex items-center justify-center mb-4 group-hover:scale-105 group-hover:border-[#f3a908]/30 transition duration-300 relative">
                        <span class="absolute -top-2 -right-2 w-6 m-0 h-6 rounded-full bg-[#f3a908] text-[#002752] flex items-center justify-center font-bold text-xs">4</span>
                        <i class="fas fa-suitcase text-[#002752] text-2xl"></i>
                    </div>
                    <h3 class="text-sm font-bold text-[#002752] mb-1">Organize as Malas</h3>
                    <p class="text-[11px] text-gray-500 max-w-[180px] leading-relaxed">
                        Enviamos seus vouchers e dicas cruciais sobre a região.
                    </p>
                </div>
                <!-- Step 5 -->
                <div class="text-center flex flex-col items-center group">
                    <div class="w-20 h-20 rounded-2xl bg-white border border-gray-100 shadow-sm flex items-center justify-center mb-4 group-hover:scale-105 group-hover:border-[#109e4a]/30 transition duration-300 relative">
                        <span class="absolute -top-2 -right-2 w-6 m-0 h-6 rounded-full bg-[#109e4a] text-white flex items-center justify-center font-bold text-xs">5</span>
                        <i class="fas fa-plane-departure text-[#002752] text-2xl"></i>
                    </div>
                    <h3 class="text-sm font-bold text-[#002752] mb-1">Embarque Garantido</h3>
                    <p class="text-[11px] text-gray-500 max-w-[180px] leading-relaxed">
                        Curta seu roteiro sabendo que damos retaguarda total.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- PROMOTIONAL BANNER -->
    <section class="py-10 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-[#109e4a] to-[#0b803a] rounded-2xl overflow-hidden shadow-xl text-white p-8 sm:p-12 relative flex flex-col lg:flex-row items-center justify-between gap-8">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,rgba(255,255,255,0.1),transparent)] pointer-events-none"></div>
                
                <div class="max-w-xl relative z-10 text-center lg:text-left">
                    <h2 class="text-2xl sm:text-3xl font-black mb-6 leading-tight">
                        Parcele sua viagem no <span class="underline decoration-[#f3a908] decoration-4">boleto</span> e realize seu sonho!
                    </h2>
                    
                    <ul class="space-y-3.5 inline-block text-left">
                        <li class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-[#f3a908] text-lg"></i>
                            <span class="font-semibold text-sm">Sem consulta ao SPC/Serasa</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-[#f3a908] text-lg"></i>
                            <span class="font-semibold text-sm">Você escolhe a melhor data para pagar</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-[#f3a908] text-lg"></i>
                            <span class="font-semibold text-sm">Mais liberdade para planejar sua viagem</span>
                        </li>
                    </ul>
                </div>
                
                <div class="relative z-10 flex flex-col items-center justify-center border-4 border-dashed border-white/40 p-6 rounded-xl bg-white/5 backdrop-blur-sm shrink-0 w-full sm:w-80">
                    <i class="fas fa-barcode text-5xl mb-3 text-[#f3a908]"></i>
                    <span class="text-xs uppercase tracking-widest font-medium text-green-100">Parcelamento</span>
                    <span class="text-xl uppercase font-black tracking-wider text-white">Facilitado</span>
                    <span class="text-sm uppercase font-bold text-[#f3a908]">No Boleto</span>
                </div>
            </div>
        </div>
    </section>

    <!-- DEPOIMENTOS DE CLIENTES -->
    <section class="py-16 bg-white border-t border-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(isset($testimonials) && $testimonials->count() > 0)
                <div class="mb-5">
                    <h2 class="text-3xl font-black text-[#002752] text-center mb-2 uppercase tracking-wider">O que dizem nossos viajantes</h2>
                    <div class="w-24 h-1 bg-[#f3a908] mx-auto rounded mb-12"></div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($testimonials as $testimonial)
                            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-[0_4px_20px_rgb(0,0,0,0.04)] flex flex-col gap-4 hover:shadow-[0_8px_30px_rgb(0,0,0,0.07)] transition-shadow duration-300">
                                <div class="flex items-center gap-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star text-sm {{ $i <= $testimonial->rating ? 'text-[#f3a908]' : 'text-gray-200' }}"></i>
                                    @endfor
                                </div>

                                <p class="text-gray-600 text-sm leading-relaxed flex-1 italic">
                                    "{{ $testimonial->content }}"
                                </p>

                                <div class="flex items-center gap-3 pt-3 border-t border-gray-100">
                                    @if($testimonial->author_photo)
                                        <img src="{{ asset('storage/' . $testimonial->author_photo) }}"
                                                alt="{{ $testimonial->author_name }}"
                                                class="w-10 h-10 rounded-full object-cover shrink-0 border-2 border-[#f3a908]/30">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#002752] to-[#004a9a] flex items-center justify-center shrink-0">
                                            <span class="text-white font-bold text-sm">{{ strtoupper(substr($testimonial->author_name, 0, 1)) }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-bold text-gray-800 text-sm">{{ $testimonial->author_name }}</p>
                                        @if($testimonial->author_role)
                                            <p class="text-xs text-gray-400">{{ $testimonial->author_role }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- Onde quer que fique a CTA de ordem 1 --}}
    @if($ctaSession = $cta_session->firstWhere('order_position', 1))
        <x-cta-session :cta="$ctaSession" />
    @endif

    <!-- ... Outros blocos de código, banners ou conteúdos do seu HTML aqui ... -->

    {{-- Onde quer que fique a CTA de ordem 2 --}}
    @if($ctaSession = $cta_session->firstWhere('order_position', 2))
        <x-cta-session :cta="$ctaSession" />
    @endif

@endsection