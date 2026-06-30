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
                   <x-card-pacotes :pkg="$pkg" :whatsappUrl="$whatsappUrl" />
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
