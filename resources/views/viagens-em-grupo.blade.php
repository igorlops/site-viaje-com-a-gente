@extends('layouts.site')

@section('title', 'Viagens em Grupo - Viaje com a Gente')

@section('content')


    <!-- LISTING SECTION -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <div class="inline-flex items-center justify-center gap-2 mb-2 text-[#002752] uppercase font-black tracking-widest text-sm">
                    <span>Explore em Boa Companhia</span>
                    <i class="fas fa-users text-[#109e4a]"></i>
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#002752] tracking-tight">
                    Nossos Próximos Grupos Confirmados para 2026/2027
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
                                    <i class="fas fa-plane-departure text-[#109e4a] text-[10px]"></i>
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
                                        <span class="text-[#109e4a] text-xs font-bold">/mês</span>
                                    </div>
                                    <span class="block text-gray-400 text-[10px] font-bold uppercase">No boleto bancário facilitado</span>
                                </div>
                                
                                <!-- Actions -->
                                @php
                                    $pkgWhatsapp = $pkg->whatsapp_link ?: $whatsappUrl . '?text=' . urlencode('Olá, gostaria de mais informações sobre a Viagem em Grupo para ' . $pkg->title);
                                @endphp
                                <div class="flex gap-2">
                                    <a href="{{ route('destination.show', $pkg->slug) }}" target="_blank" class="flex-grow inline-flex justify-center items-center bg-[#109e4a] hover:bg-[#0d9648] text-white font-bold text-xs uppercase py-3 rounded-lg transition duration-200 gap-1.5 shadow-sm">
                                        <span>Solicitar Vaga</span>
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

    <!-- GROUP BENEFITS SECTION -->
    <section class="py-20 bg-gray-50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-[#002752] uppercase tracking-tight">
                    Por que viajar em grupo com a gente?
                </h2>
                <div class="w-16 h-1 bg-[#109e4a] mx-auto mt-4 rounded"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Benefit 1 -->
                <div class="bg-white rounded-xl p-8 border border-gray-100 text-center shadow-sm">
                    <div class="w-14 h-14 rounded-full bg-[#f2bd11]/10 text-[#002752] flex items-center justify-center mx-auto mb-4 font-black">
                        <i class="fas fa-user-tie text-xl text-[#002752]"></i>
                    </div>
                    <h4 class="font-bold text-[#002752] mb-2 text-sm uppercase">Guia desde o Embarque</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Nossos guias credenciados acompanham o grupo saindo do aeroporto de Fortaleza, dando suporte total em check-in, bagagens e conexões.
                    </p>
                </div>

                <!-- Benefit 2 -->
                <div class="bg-white rounded-xl p-8 border border-gray-100 text-center shadow-sm">
                    <div class="w-14 h-14 rounded-full bg-[#f2bd11]/10 text-[#002752] flex items-center justify-center mx-auto mb-4 font-black">
                        <i class="fas fa-hand-holding-usd text-xl text-[#002752]"></i>
                    </div>
                    <h4 class="font-bold text-[#002752] mb-2 text-sm uppercase">Melhores Tarifas</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Negociamos tarifas de grupo diretamente com hotéis e companhias aéreas, repassando descontos incríveis no preço final para você.
                    </p>
                </div>

                <!-- Benefit 3 -->
                <div class="bg-white rounded-xl p-8 border border-gray-100 text-center shadow-sm">
                    <div class="w-14 h-14 rounded-full bg-[#f2bd11]/10 text-[#002752] flex items-center justify-center mx-auto mb-4 font-black">
                        <i class="fas fa-cocktail text-xl text-[#002752]"></i>
                    </div>
                    <h4 class="font-bold text-[#002752] mb-2 text-sm uppercase">Confraternizações</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Nossos roteiros incluem jantares de boas-vindas e encontros de integração, perfeitos para fazer amizades que duram para a vida inteira.
                    </p>
                </div>

                <!-- Benefit 4 -->
                <div class="bg-white rounded-xl p-8 border border-gray-100 text-center shadow-sm">
                    <div class="w-14 h-14 rounded-full bg-[#f2bd11]/10 text-[#002752] flex items-center justify-center mx-auto mb-4 font-black">
                        <i class="fas fa-heart text-xl text-[#002752]"></i>
                    </div>
                    <h4 class="font-bold text-[#002752] mb-2 text-sm uppercase">Viaje Sem Preocupações</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Cuidamos de toda a burocracia, horários de saída, translados e reservas. Você só se preocupa em tirar belas fotos e se divertir.
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
                        <span class="block text-lg font-black uppercase tracking-wide">Quer criar um grupo de viagem exclusivo?</span>
                        <span class="block text-sm font-medium">Empresas, famílias ou turmas de amigos — montamos a logística perfeita para o seu grupo!</span>
                    </div>
                </div>
                
                <!-- Button -->
                <a href="{{ $whatsappUrl }}" target="_blank" class="bg-[#109e4a] hover:bg-[#0d9648] text-white px-8 py-3.5 rounded-lg font-black text-sm tracking-wider uppercase transition duration-300 shadow-md flex items-center gap-3 shrink-0">
                    <i class="fab fa-whatsapp text-2xl"></i>
                    <span>Grupo Personalizado</span>
                </a>
            </div>
        </div>
    </section>

@endsection
