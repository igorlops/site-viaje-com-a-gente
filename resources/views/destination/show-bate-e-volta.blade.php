@extends('layouts.pacotes')

@section('title', $destination->title . ' – Bate e Volta – Viaje com a Gente')

@section('content')
    @php
        $whatsappUrl = $destination->whatsapp_link
            ?? (isset($socialLinks['whatsapp']) ? $socialLinks['whatsapp']->url : 'https://wa.me/5585999166421');
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

                {{-- Alerta de urgência no topo da hero --}}
                @if($urgencyText)
                    <div class="inline-flex items-center gap-2 bg-red-500/90 text-white text-xs font-bold px-4 py-2 rounded-lg mb-4 backdrop-blur-sm">
                        <i class="fas fa-fire animate-pulse"></i>
                        <span>{{ $urgencyText }}</span>
                    </div>
                @endif

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

                {{-- Quick Info: Horários e Preço --}}
                <div class="flex flex-wrap items-center gap-4 mb-8">
                    @if($destination->date_range)
                        <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-lg">
                            <i class="fas fa-calendar-alt text-[#f3a908]"></i>
                            <span class="text-sm font-semibold">{{ $destination->date_range }}</span>
                        </div>
                    @endif
                    @if($destination->departure_date)
                        <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-lg">
                            <i class="fas fa-arrow-right text-emerald-400"></i>
                            <span class="text-sm font-semibold">Saída: {{ $destination->departure_date }}</span>
                        </div>
                    @endif
                    @if($destination->return_date)
                        <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-lg">
                            <i class="fas fa-arrow-left text-blue-400"></i>
                            <span class="text-sm font-semibold">Retorno: {{ $destination->return_date }}</span>
                        </div>
                    @endif
                    @if($destination->price)
                        <div class="flex items-center gap-2 bg-[#f3a908] text-[#001c3d] px-5 py-2 rounded-lg shadow-lg">
                            <i class="fas fa-tag font-black"></i>
                            <span class="font-black text-xl">R$ {{ number_format($destination->price, 2, ',', '.') }}</span>
                            <span class="text-xs font-bold opacity-70">por pessoa</span>
                        </div>
                    @endif
                </div>

                {{-- CTA Principal --}}
                <a href="{{ $whatsappBtnUrl }}" target="_blank" rel="noopener"
                   class="inline-flex items-center gap-3 bg-[#109e4a] hover:bg-[#0d8c40] text-white font-black uppercase text-sm tracking-wider px-8 py-4 rounded-xl shadow-lg shadow-emerald-500/30 transition-all duration-300 hover:scale-105 active:scale-95">
                    <i class="fab fa-whatsapp text-2xl"></i>
                    <span>Garantir Minha Vaga!</span>
                    <i class="fas fa-arrow-right text-sm opacity-70"></i>
                </a>
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
                            <p class="text-sm font-semibold text-white leading-relaxed">{{ $destination->departure_city }}</p>
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
                        <span class="text-[#109e4a] text-xs font-black uppercase tracking-widest bg-[#109e4a]/10 px-4 py-1.5 rounded-full inline-block mb-3">
                            O que está incluso
                        </span>
                        <h2 class="text-3xl font-black text-[#002752] uppercase tracking-tight">
                            Tudo que você vai aproveitar
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
                                        <span>Volta no mesmo dia para casa</span>
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
                                   class="inline-flex items-center gap-3 bg-[#109e4a] hover:bg-[#0d8c40] text-white font-black text-sm uppercase tracking-wider px-8 py-4 rounded-xl transition-all duration-300 hover:scale-105 active:scale-95 shadow-lg shadow-emerald-500/30 w-full justify-center">
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

            <div class="flex flex-col gap-4 mb-4">
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-[#002752]">
                        Informações
                    </h2>
                    <div class="w-20 h-1 bg-[#f3a908] mx-auto mt-4 rounded"></div>
                </div>
                @if($destination->departure_city)
                    <div class="flex flex-row items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-orange-500/20 border border-orange-500/40 flex items-center justify-center">
                            <i class="fas fa-map-marker-alt text-orange-400 text-lg"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Local de Embarque / Desembarque</p>
                            <p class="text-sm font-semibold text-[#002752] leading-relaxed">{{ $destination->departure_city }}</p>
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
                            Informações Importantes
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
                                   class="mt-auto inline-flex items-center justify-center gap-2 bg-red-500 hover:bg-red-600 text-white font-bold text-xs uppercase tracking-wider px-5 py-2.5 rounded-xl transition-all duration-200">
                                    <i class="fab fa-whatsapp text-base"></i>
                                    Garantir minha vaga
                                </a>
                            </div>
                        @endif

                    </div>
                </div>
            @endif

        </div>
    </div>

    {{-- ============================== CTA RODAPÉ ============================== --}}
    <section class="bg-[#f3a908] py-10 text-[#002752]">
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
                            Fale com nossa equipe agora e garanta sua vaga no {{ $destination->title }}!
                        </span>
                    </div>
                </div>
                <a href="{{ $whatsappBtnUrl }}" target="_blank" rel="noopener"
                   class="bg-[#109e4a] hover:bg-[#0d9648] text-white px-10 py-4 rounded-xl font-black text-sm tracking-wider uppercase transition-all duration-300 shadow-md hover:shadow-lg flex items-center gap-3 shrink-0 hover:scale-105 active:scale-95">
                    <i class="fab fa-whatsapp text-2xl"></i>
                    <span>Reservar pelo WhatsApp</span>
                </a>
            </div>
        </div>
    </section>

    @if(isset($cta_session) && ($ctaSession = $cta_session->firstWhere('order_position', 3)))
        <x-cta-session :cta="$ctaSession" />
    @endif

@endsection
