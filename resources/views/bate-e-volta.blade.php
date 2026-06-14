@extends('layouts.site')

@section('title', 'Bate e Volta - Viaje com a Gente')

@section('content')


    
    <!-- INNER PAGE HERO -->
    <section class="relative bg-[#001c3d] py-16 lg:py-24 overflow-hidden">
        <div class="absolute -right-10 -top-10 w-96 h-96 rounded-full bg-blue-900/20 blur-3xl"></div>
        <div class="absolute -left-10 -bottom-10 w-96 h-96 rounded-full bg-yellow-900/10 blur-3xl"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
            <!-- Breadcrumbs -->
            <nav class="flex mb-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                <a href="{{ route('home') }}" class="hover:text-[#f2bd11] transition duration-200">Início</a>
                <span class="mx-2 text-gray-600">/</span>
                <span class="text-[#f2bd11]">Bate e Volta</span>
            </nav>
            
            <!-- Title and Subtitle -->
            <div class="max-w-3xl">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white leading-tight mb-4">
                    Passeios <span class="text-[#f2bd11]">Bate e Volta</span>
                </h1>
                <p class="text-base sm:text-lg text-gray-300 leading-relaxed">
                    Viaje no final de semana ou feriado e retorne no mesmo dia. Conheça as melhores praias e serras pertinho de Fortaleza com segurança e conforto.
                </p>
            </div>
        </div>
    </section>

    <!-- LISTING SECTION -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <div class="inline-flex items-center justify-center gap-2 mb-2 text-[#002752] uppercase font-black tracking-widest text-sm">
                    <span>Aproveite o Final de Semana</span>
                    <i class="fas fa-calendar-day text-[#109e4a]"></i>
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#002752] tracking-tight">
                    Destinos Incríveis de 1 Dia Saindo de Fortaleza
                </h2>
                <div class="w-16 h-1 bg-[#109e4a] mx-auto mt-4 rounded"></div>
            </div>

            <!-- Packages Grid (Ready for Dynamic Loop - Styled exactly as home.blade.php) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                @php
                    $whatsappUrl = isset($socialLinks['whatsapp']) ? $socialLinks['whatsapp']->url : 'https://wa.me/5585999166421';
                @endphp

                @foreach($destinations as $pkg)
                    <div class="bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-100 overflow-hidden flex flex-col group transition duration-300 transform hover:-translate-y-1">
                        <!-- Card Image -->
                        <div class="relative h-48 bg-gray-200 overflow-hidden shrink-0">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition duration-500" src="{{ asset('storage/' . $pkg->image_path) }}" alt="{{ $pkg->title }}">
                            @if($pkg->tag)
                                <span class="absolute top-3 right-3 bg-[#f2bd11] text-[#002752] text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded">
                                    {{ $pkg->tag }}
                                </span>
                            @endif
                        </div>
                        
                        <!-- Card Body -->
                        <div class="p-5 flex-grow flex flex-col justify-between">
                            <div>
                                <h3 class="text-[#002752] text-xl font-bold leading-snug mb-1">
                                    {{ $pkg->title }}
                                </h3>
                                <p class="text-gray-500 text-sm font-medium mb-3">
                                    {{ $pkg->subtitle }}
                                </p>
                                
                                <!-- Info Badge -->
                                <div class="inline-flex items-center gap-2 text-gray-400 text-xs font-semibold uppercase tracking-wider border-t border-b border-gray-100 py-1.5 w-full mb-4">
                                    <i class="far fa-calendar-alt text-[#109e4a]"></i>
                                    <span>{{ $pkg->duration }}</span>
                                    <span class="text-gray-300">|</span>
                                    <i class="fas fa-bus text-[#109e4a] text-[10px]"></i>
                                    <span class="truncate">{{ $pkg->category }}</span>
                                </div>
                            </div>
                            
                            <div>
                                <!-- Price -->
                                <div class="mb-4">
                                    <span class="block text-gray-400 text-xs font-medium">A partir de</span>
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-[#109e4a] text-xs font-black">R$</span>
                                        <span class="text-[#109e4a] text-2xl font-black">
                                            {{ number_format($pkg->price, 2, ',', '.') }}
                                        </span>
                                        <span class="text-[#109e4a] text-xs font-bold">/por pessoa</span>
                                    </div>
                                    <span class="block text-gray-400 text-[10px] font-bold uppercase">Pagamento via PIX/Boleto</span>
                                </div>
                                
                                <!-- Actions -->
                                @php
                                    $pkgWhatsapp = $pkg->whatsapp_link ?: $whatsappUrl . '?text=' . urlencode('Olá, gostaria de mais informações sobre o Bate e Volta para ' . $pkg->title);
                                @endphp
                                <div class="flex gap-2">
                                    <a href="{{ route('destination.show', $pkg->slug) }}" target="_blank" class="flex-grow inline-flex justify-center items-center bg-[#109e4a] hover:bg-[#0d9648] text-white font-bold text-xs uppercase py-3 rounded-lg transition duration-200 gap-1.5 shadow-sm">
                                        <span>Reservar Vaga</span>
                                        <i class="fas fa-chevron-right text-[9px]"></i>
                                    </a>
                                    <a href="{{ $pkgWhatsapp }}" target="_blank" class="w-10 h-10 inline-flex items-center justify-center border border-[#109e4a] hover:bg-[#109e4a] text-[#109e4a] hover:text-white rounded-lg transition duration-200">
                                        <i class="fab fa-whatsapp text-lg"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS & INFO -->
    <section class="py-20 bg-gray-50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-[#002752] uppercase tracking-tight">
                    Como Funcionam Nossos Passeios Bate e Volta
                </h2>
                <div class="w-16 h-1 bg-[#109e4a] mx-auto mt-4 rounded"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Info 1 -->
                <div class="bg-white rounded-xl p-6 border border-gray-100 text-center shadow-sm">
                    <div class="w-12 h-12 rounded-full bg-[#002752]/5 text-[#002752] flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-bus-alt text-xl"></i>
                    </div>
                    <h4 class="font-bold text-[#002752] mb-2 text-sm uppercase">Transporte de Turismo</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Veículos modernos (ônibus, micro-ônibus ou vans), higienizados, equipados com ar-condicionado e motoristas profissionais credenciados.
                    </p>
                </div>

                <!-- Info 2 -->
                <div class="bg-white rounded-xl p-6 border border-gray-100 text-center shadow-sm">
                    <div class="w-12 h-12 rounded-full bg-[#002752]/5 text-[#002752] flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-map-marked-alt text-xl"></i>
                    </div>
                    <h4 class="font-bold text-[#002752] mb-2 text-sm uppercase">Guia Credenciado</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Acompanhamento integral de guia de turismo bilíngue credenciado pelo Ministério do Turismo (CADASTUR) durante todo o passeio.
                    </p>
                </div>

                <!-- Info 3 -->
                <div class="bg-white rounded-xl p-6 border border-gray-100 text-center shadow-sm">
                    <div class="w-12 h-12 rounded-full bg-[#002752]/5 text-[#002752] flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-umbrella-beach text-xl"></i>
                    </div>
                    <h4 class="font-bold text-[#002752] mb-2 text-sm uppercase">Ponto de Apoio</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Paramos sempre em barracas de praia ou restaurantes parceiros estruturados com banheiros, chuveiros, armários e excelente gastronomia.
                    </p>
                </div>

                <!-- Info 4 -->
                <div class="bg-white rounded-xl p-6 border border-gray-100 text-center shadow-sm">
                    <div class="w-12 h-12 rounded-full bg-[#002752]/5 text-[#002752] flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <h4 class="font-bold text-[#002752] mb-2 text-sm uppercase">Embarque Facilitado</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Pontos de embarque estratégicos em Fortaleza (Avenida Beira Mar, aeroporto e hotéis) facilitando o seu acesso ao transporte.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA FOOTER -->
    <section class="bg-[#f2bd11] py-8 text-[#002752]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-6">
                <!-- Text -->
                <div class="text-center lg:text-left flex items-center gap-4 flex-col sm:flex-row">
                    <div class="w-14 h-14 rounded-full bg-white flex items-center justify-center text-[#109e4a] shrink-0 shadow-sm">
                        <i class="fab fa-whatsapp text-3xl"></i>
                    </div>
                    <div>
                        <span class="block text-lg font-black uppercase tracking-wide">Ficou com alguma dúvida sobre os passeios?</span>
                        <span class="block text-sm font-medium">Chame no WhatsApp e tire todas as suas dúvidas com nossa equipe!</span>
                    </div>
                </div>
                
                <!-- Button -->
                <a href="{{ $whatsappUrl }}" target="_blank" class="bg-[#109e4a] hover:bg-[#0d9648] text-white px-8 py-3.5 rounded-lg font-black text-sm tracking-wider uppercase transition duration-300 shadow-md flex items-center gap-3 shrink-0">
                    <i class="fab fa-whatsapp text-2xl"></i>
                    <span>Tirar Dúvidas</span>
                </a>
            </div>
        </div>
    </section>

@endsection
