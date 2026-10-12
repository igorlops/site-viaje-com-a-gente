@extends('layouts.pacotes')

@section('title', $destination->title . ' – Bate e Volta – Viaje com a Gente')

@section('content')
    @php
        $whatsappUrl = $destination->whatsapp_link
            ?? (isset($socialLinks['whatsapp']) ? $socialLinks['whatsapp']->url : 'https://wa.me/+5585999166421');
        $whatsappMsg = urlencode('Olá! Tenho interesse no passeio ' . $destination->title . ' – Bate e Volta. Quero saber mais!');
        $whatsappBtnUrl = $whatsappUrl . (str_contains($whatsappUrl, '?') ? '&' : '?') . 'text=' . $whatsappMsg;
        $bannerUrl = $destination->banner_image_path
            ? asset('storage/' . $destination->banner_image_path)
            : ($destination->image_path ? asset('storage/' . $destination->image_path) : null);

        // Observations mapeadas por posição (ordem: 0=crianças, 1=pagamento, 2=urgência)
        $obsList         = $destination->observations;
        $childrenPolicy  = $obsList->get(0)?->text;
        $paymentInfo     = $obsList->get(1)?->text;
        $urgencyText     = $obsList->get(2)?->text;
    @endphp

    {{-- ============================== HERO BANNER ============================== --}}
    <section class="relative bg-[#001c3d] min-h-[480px] lg:min-h-[560px] py-8 flex items-end overflow-hidden"
        @if($bannerUrl) style="background-image: url('{{ $bannerUrl }}'); background-size: cover; background-position: center;" @endif>

        {{-- Overlay escuro --}}
        <div class="absolute inset-0 bg-gradient-to-t from-[#001c3d] via-[#001c3d]/75 to-[#001c3d]/30"></div>

        {{-- Badge "Bate e Volta" flutuante --}}
        <div class=" top-6 left-6 sm:top-8 sm:left-10 z-10">
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full pb-10 z-10">
            <div class="text-white max-w-3xl">

                <span class="inline-flex items-center gap-2 bg-orange-500 text-white text-[10px] font-black uppercase tracking-widest px-4 py-1.5 rounded-full shadow-lg">
                    <i class="fas fa-sun"></i> Bate e Volta
                </span>

                {{-- Título --}}
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-[#f3a908] leading-tight mb-3">
                    {{ $destination->title }}
                </h1>

                {{-- Subtítulo / Headline da Data --}}
                @if($destination->subtitle)
                    <p class="text-xl sm:text-2xl text-gray-100 font-semibold mb-4 leading-snug">
                        {{ $destination->subtitle }}
                    </p>
                @endif

                {{-- Descrição Curta --}}
                @if($destination->description)
                    <p class="text-sm sm:text-base text-gray-300 leading-relaxed mb-6 max-w-2xl">
                        {{ $destination->description }}
                    </p>
                @endif


{{-- Quick Info: Data, Preço, Urgência e CTA --}}
<div class="w-full max-w-[360px] space-y-1.5">

    {{-- PRIMEIRA LINHA: DATA + PREÇO --}}
    <div class="grid grid-cols-[minmax(0,1fr)_minmax(0,1fr)] gap-1.5">

        {{-- DATA --}}
        @if($destination->date_range)
            <div class="flex min-h-[64px] min-w-0 items-center gap-2 rounded-xl border border-[#0066a8] bg-gradient-to-br from-[#003f83] to-[#001b46] px-2.5 py-2 shadow-md">

                <i class="fas fa-calendar-alt shrink-0 text-[23px] text-[#ffcc00]"></i>

                <span class="min-w-0 text-[15px] font-extrabold leading-[1.15] text-white">
                    {{ $destination->date_range }}
                </span>

            </div>
        @endif

        {{-- PREÇO --}}
        @if($destination->price)
            <div class="flex min-h-[64px] min-w-0 items-center justify-center gap-1.5 rounded-xl bg-gradient-to-br from-[#ffbc00] via-[#ffcb00] to-[#ffe600] px-2 py-1.5 text-[#002252] shadow-md">

                <i class="fas fa-tag shrink-0 self-center text-[17px]"></i>

                <div class="flex min-w-0 flex-col items-center justify-center leading-none">

                    <span class="text-[13px] font-semibold">
                        A partir de
                    </span>

                    <div class="flex items-baseline whitespace-nowrap font-black tracking-[-0.06em]">
                        <span class="mr-0.5 text-[15px]">R$</span>
                        <span class="text-[39px] leading-[0.95]">
                            {{ number_format($destination->price, 2, ',', '.') }}
                        </span>
                    </div>

                    <span class="mt-0.5 text-[13px] font-bold">
                        por pessoa
                    </span>

                </div>
            </div>
        @endif

    </div>

    {{-- SEGUNDA LINHA: URGÊNCIA --}}
    @if($urgencyText)
        <div class="flex min-h-[27px] w-full items-center gap-2 rounded-lg bg-gradient-to-r from-[#ff2849] via-[#e82042] to-[#9b2340] px-4.5 py-2 text-white shadow-sm">

            <i class="fas fa-fire shrink-0 text-[15px]"></i>

            <span class="text-[17px] font-extrabold leading-tight">
                {{ $urgencyText }}
            </span>

        </div>
    @endif

    {{-- TERCEIRA LINHA: WHATSAPP --}}
    <a
        href="{{ $whatsappBtnUrl }}"
        target="_blank"
        rel="noopener noreferrer"
        class="flex min-h-[42px] w-full items-center justify-center py-3 gap-2.5 rounded-xl border border-[#00b957] bg-gradient-to-b from-[#09c75d] via-[#00a94e] to-[#00883e] px-3 py-2 text-white shadow-[0_4px_10px_rgba(0,0,0,0.25)] transition-all duration-200 hover:brightness-110 active:scale-[0.98]"
    >

        <i class="fab fa-whatsapp shrink-0 text-[23px]"></i>

        <span class="text-center text-[17px] font-black uppercase tracking-tight">
            Quero garantir minha vaga
        </span>

        <i class="fas fa-arrow-right shrink-0 text-[15px]"></i>

    </a>

</div>



            </div>
        </div>
    </section>

    @if(isset($cta_session) && ($ctaSession = $cta_session->firstWhere('order_position', 1)))
        <x-cta-session :cta="$ctaSession" />
    @endif

    {{-- ============================== LOGÍSTICA ============================== --}}
    @if($destination->departure_city || $destination->departure_date || $destination->return_date)
    <section class="bg-[#002752] py-8 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">

                {{-- Local de Embarque --}}
                @if($destination->departure_city)
                    <div class="flex flex-col items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-orange-500/20 border border-orange-500/40 flex items-center justify-center">
                            <i class="fas fa-map-marker-alt text-orange-400 text-lg"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Embarque / Desembarque</p>
                            <p class="text-lg font-semibold text-white leading-relaxed">{{ $destination->departure_city }}</p>
                        </div>
                    </div>
                @endif

                {{-- Horário de Saída --}}
                @if($destination->departure_date)
                    <div class="flex flex-col items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-emerald-500/20 border border-emerald-500/40 flex items-center justify-center">
                            <i class="fas fa-arrow-right text-emerald-400 text-lg"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Horário de Saída</p>
                            <p class="text-2xl font-black text-emerald-400">{{ $destination->departure_date }}</p>
                        </div>
                    </div>
                @endif

                {{-- Horário de Retorno --}}
                @if($destination->return_date)
                    <div class="flex flex-col items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-blue-500/20 border border-blue-500/40 flex items-center justify-center">
                            <i class="fas fa-arrow-left text-blue-400 text-lg"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Previsão de Retorno</p>
                            <p class="text-2xl font-black text-blue-400">{{ $destination->return_date }}</p>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </section>
    @endif

    {{-- ============================== CONTEÚDO PRINCIPAL ============================== --}}
    <div class="bg-white py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- ---- ITENS INCLUSOS ---- --}}
            @php $includedItems = $destination->includes->where('type', 'included'); @endphp
            @if($includedItems->count() > 0)
                <div class="mb-16">
                    <div class="text-center mb-10">
                        <h2 class="text-3xl font-black text-[#002752] uppercase tracking-tight">
                            O que está incluso
                        </h2>
                        <div class="w-20 h-1 bg-[#f3a908] mx-auto mt-4 rounded"></div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($includedItems as $include)
                            <div class="flex items-start gap-4 bg-gradient-to-br from-emerald-50 to-white border border-emerald-100 rounded-2xl p-5 hover:shadow-md hover:border-emerald-200 transition-all duration-300 group">
                                <div class="w-10 h-10 rounded-xl bg-emerald-100 group-hover:bg-emerald-500 flex items-center justify-center shrink-0 transition-colors duration-300">
                                    <i class="fa-solid fa-circle-check text-emerald-600 group-hover:text-white text-lg transition-colors duration-300"></i>
                                </div>
                                <div class="flex-1 pt-1">
                                    <p class="text-gray-700 text-sm font-semibold leading-relaxed">{{ $include->text }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- ---- BLOCO DE PREÇO + CTA ---- --}}
            @if($destination->price)
                <div class="mb-16">
                    <div class="bg-gradient-to-br from-[#002752] to-[#001c3d] rounded-3xl p-8 sm:p-12 text-white overflow-hidden relative">
                        {{-- Decoração --}}
                        <div class="absolute -top-8 -right-8 w-32 h-32 bg-[#f3a908]/10 rounded-full"></div>
                        <div class="absolute -bottom-12 -left-12 w-48 h-48 bg-[#109e4a]/10 rounded-full"></div>

                        <div class="relative flex flex-col lg:flex-row items-center justify-between gap-10">
                            <div class="max-w-lg">
                                <span class="inline-flex items-center gap-1.5 bg-[#f3a908]/20 text-[#f3a908] text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest mb-4">
                                    <i class="fas fa-sun"></i> Passeio de 1 Dia
                                </span>
                                <h2 class="text-2xl sm:text-3xl font-black mb-4">
                                    Uma experiência completa. <br>Sem pernoite, sem complicação.
                                </h2>
                                <ul class="space-y-3 text-sm text-gray-300">
                                    <li class="flex items-center gap-2">
                                        <i class="fas fa-check-circle text-[#109e4a]"></i>
                                        <span>Sem precisar tirar férias ou pagar hotel</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="fas fa-check-circle text-[#109e4a]"></i>
                                        <span>Tudo organizado — você só curte</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="fas fa-check-circle text-[#109e4a]"></i>
                                        <span>Retorno no mesmo dia para casa</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="text-center shrink-0">
                                <p class="text-gray-400 text-xs uppercase tracking-widest mb-2">Valor por pessoa</p>
                                <div class="text-5xl sm:text-6xl font-black text-[#f3a908] mb-1">
                                    R$ {{ number_format($destination->price, 2, ',', '.') }}
                                </div>
                                <p class="text-gray-400 text-xs mb-6">Consulte formas de pagamento</p>
                                <a href="{{ $whatsappBtnUrl }}" target="_blank" rel="noopener"
                                   class="inline-flex items-center justify-center gap-3 bg-[#109e4a] hover:bg-[#0d8c40] text-white font-black uppercase text-sm tracking-wider px-6 py-3.5 rounded-2xl transition-all duration-300 hover:scale-105 active:scale-95 shadow-lg shadow-emerald-500/30 w-full sm:w-auto min-w-[220px]">
                                    <i class="fab fa-whatsapp text-2xl"></i>
                                    <span>Reservar Agora</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if(isset($cta_session) && ($ctaSession = $cta_session->firstWhere('order_position', 2)))
                <x-cta-session :cta="$ctaSession" />
            @endif
            @if($destination->highlights->count() > 0)
                <!-- GLightbox CSS & JS -->
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
                <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

                <div class="mb-5">
                    <h2 class="text-3xl font-extrabold text-center text-[#002752] mb-2 uppercase">Conheça um pouco do destino</h2>
                    <div class="w-16 h-1 bg-[#109e4a] rounded mb-8 mx-auto"></div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($destination->highlights as $highlight)
                            <a href="{{ asset('storage/medias/' . $highlight->image_path) }}"
                               class="glightbox group cursor-pointer block"
                               data-gallery="galeria-fotos"
                               data-title="{{ $highlight->title }}"
                               @if($highlight->subtitle) data-description="{{ $highlight->subtitle }}" @endif>
                                <div class="relative h-48 rounded-xl overflow-hidden mb-4">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition duration-500" 
                                         src="{{ asset('storage/medias/' . $highlight->image_path) }}" 
                                         alt="{{ $highlight->title }}">
                                    <div class="absolute inset-0 bg-gradient-to-t from-[#001c3d] to-transparent opacity-60"></div>
                                    <div class="absolute bottom-4 left-4 right-4 text-white">
                                        <h3 class="font-bold text-lg">{{ $highlight->title }}</h3>
                                        @if($highlight->subtitle)
                                            <p class="text-sm text-gray-200">{{ $highlight->subtitle }}</p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const lightbox = GLightbox({
                            selector: '.glightbox',
                            touchNavigation: true,
                            loop: true,
                            zoomable: true,
                            draggable: true,
                        });
                    });
                </script>
            @endif


            <div class="flex flex-col gap-4 mb-4">
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-[#002752]">
                        INFORMAÇÕES
                    </h2>
                    <div class="w-20 h-1 bg-[#109e4a] mx-auto mt-4 rounded"></div>
                </div>
                @if($destination->departure_city)
                    <div class="flex flex-row items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-orange-500/20 border border-orange-500/40 flex items-center justify-center">
                            <i class="fas fa-map-marker-alt text-orange-400 text-lg"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Local de Embarque / Desembarque</p>
                            <p class="text-2xl font-black text-[#002752] leading-relaxed">{{ $destination->departure_city }}</p>
                        </div>
                    </div>
                @endif

                {{-- Horário de Saída --}}
                @if($destination->departure_date)
                    <div class="flex flex-row items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-emerald-500/20 border border-emerald-500/40 flex items-center justify-center">
                            <i class="fas fa-bus text-emerald-400 text-lg"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Horário de Saída</p>
                            <p class="text-2xl font-black text-emerald-400">{{ $destination->departure_date }}</p>
                        </div>
                    </div>
                @endif

                {{-- Horário de Retorno --}}
                @if($destination->return_date)
                    <div class="flex flex-row items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-blue-500/20 border border-blue-500/40 flex items-center justify-center">
                            <i class="fas fa-bus text-blue-400 text-lg"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Previsão de Retorno</p>
                            <p class="text-2xl font-black text-blue-400">{{ $destination->return_date }}</p>
                        </div>
                    </div>
                @endif
            </div>

            {{-- ---- BLOCOS INFORMATIVOS: CRIANÇAS, PAGAMENTO, URGÊNCIA ---- --}}
            @if($childrenPolicy || $paymentInfo || $urgencyText)
                <div class="mb-16">
                    <div class="text-center mb-10">
                        <h2 class="text-2xl font-black text-[#002752] uppercase tracking-tight">
                            OBSERVAÇÕES
                        </h2>
                        <div class="w-16 h-1 bg-[#109e4a] mx-auto mt-3 rounded"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        {{-- Política de Crianças --}}
                        @if($childrenPolicy)
                            <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6 flex flex-col gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                                        <i class="fas fa-child text-blue-600 text-lg"></i>
                                    </div>
                                    <h3 class="font-black text-blue-800 text-sm uppercase tracking-wide">Política para Crianças</h3>
                                </div>
                                <p class="text-sm text-blue-700/80 font-medium leading-relaxed">{{ $childrenPolicy }}</p>
                            </div>
                        @endif

                        {{-- Formas de Pagamento --}}
                        @if($paymentInfo)
                            <div class="bg-yellow-50 border border-yellow-100 rounded-2xl p-6 flex flex-col gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-yellow-100 flex items-center justify-center shrink-0">
                                        <i class="fas fa-credit-card text-yellow-600 text-lg"></i>
                                    </div>
                                    <h3 class="font-black text-yellow-800 text-sm uppercase tracking-wide">Formas de Pagamento</h3>
                                </div>
                                <p class="text-sm text-yellow-700/80 font-medium leading-relaxed">{{ $paymentInfo }}</p>
                            </div>
                        @endif

                        {{-- Alerta de Urgência --}}
                        @if($urgencyText)
                            <div class="bg-red-50 border border-red-200 rounded-2xl p-6 flex flex-col gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center shrink-0">
                                        <i class="fas fa-fire text-red-600 text-lg"></i>
                                    </div>
                                    <h3 class="font-black text-red-800 text-sm uppercase tracking-wide">Vagas Limitadas</h3>
                                </div>
                                <p class="text-sm text-red-700/80 font-medium leading-relaxed">{{ $urgencyText }}</p>
                                <a href="{{ $whatsappBtnUrl }}" target="_blank" rel="noopener"
                                   class="mt-auto inline-flex items-center justify-center gap-3 bg-red-500 hover:bg-red-600 text-white font-black uppercase text-sm tracking-wider px-6 py-3.5 rounded-2xl transition-all duration-300 hover:scale-105 active:scale-95 shadow-lg shadow-red-500/30 w-full sm:w-auto min-w-[220px]">
                                    <i class="fab fa-whatsapp text-2xl"></i>
                                    <span>Garantir minha vaga</span>
                                </a>
                            </div>
                        @endif

                    </div>
                </div>
            @endif
        <section class="bg-[#f3a908] py-10 text-[#002752] rounded-xl mt-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
                <div class="text-center lg:text-left flex items-center gap-5 flex-col sm:flex-row">
                    <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center text-[#109e4a] shrink-0 shadow-md">
                        <i class="fab fa-whatsapp text-4xl"></i>
                    </div>
                    <div>
                        <span class="block text-xl font-black uppercase tracking-wide">
                            Pronto para escapar da rotina?
                        </span>
                        <span class="block text-sm font-medium opacity-80">
                            Fale com nossa equipe agora e garanta sua vaga para {{ $destination->title }}!
                        </span>
                    </div>
                </div>
                <a href="{{ $whatsappBtnUrl }}" target="_blank" rel="noopener"
                   class="inline-flex items-center justify-center gap-3 bg-[#109e4a] hover:bg-[#0d9648] text-white font-black uppercase text-sm tracking-wider px-6 py-3.5 rounded-2xl transition-all duration-300 hover:scale-105 active:scale-95 shadow-lg shadow-emerald-500/30 w-full sm:w-auto min-w-[220px] shrink-0">
                    <i class="fab fa-whatsapp text-2xl"></i>
                    <span>FALAR COM UM CONSULTOR</span>
                </a>
            </div>
        </div>
    </section>
        </div>
    </div>

    @if(isset($cta_session) && ($ctaSession = $cta_session->firstWhere('order_position', 3)))
        <x-cta-session :cta="$ctaSession" />
    @endif

@endsection
