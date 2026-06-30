@extends('layouts.site')

@section('title', 'Bate e Volta - Viaje com a Gente')

@section('content')

    <!-- LISTING SECTION -->
    <section class="py-20 bg-white copyright-watermark">
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
                    <x-card-pacotes :pkg="$pkg" :whatsappUrl="$whatsappUrl" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS & INFO -->
    <section class="py-20 bg-gray-50 border-t border-gray-100 copyright-watermark">
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