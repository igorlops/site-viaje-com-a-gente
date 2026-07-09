@extends('layouts.site')

@section('title', 'Viaje com a Gente - Pacotes 2026/2027')

@section('content')

@php
    $whatsappUrl = isset($socialLinks['whatsapp']) ? $socialLinks['whatsapp']->url : 'https://wa.me/5585999166421';
@endphp

    <!-- SEÇÃO INTRODUTÓRIA + LISTAGEM DE PACOTES IMEDIATA -->
    <section class="py-16 bg-white" id="destinos">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Descrição Conceitual dos Pacotes (Copy de Planejamento Inteligente) -->
            <div class="max-w-3xl mx-auto text-center mb-16">
                <span class="text-[#109e4a] text-xs font-black uppercase tracking-widest bg-[#109e4a]/10 px-4 py-1.5 rounded-full inline-block mb-4">
                    Temporada 2026 / 2027
                </span>
                <h1 class="text-3xl sm:text-4xl font-black text-[#002752] tracking-tight mb-4">
                    Quem planeja a próxima viagem compra memórias por metade do preço.
                </h1>
                <p class="text-base text-gray-600 leading-relaxed">
                    Viajar bem é, acima de tudo, viajar com inteligência. Ao garantir o seu lugar nas temporadas de **2026 e 2027**, você assume o controle do seu calendário de férias, bloqueia o aumento de preços e tarifas sazonais, e garante as melhores opções de hospedagem com total flexibilidade de pagamento. Escolha o seu destino e descubra como o planejamento transforma grandes roteiros em experiências incrivelmente econômicas e confortáveis.
                </p>
                <div class="w-24 h-1 bg-[#f3a908] mx-auto mt-6 rounded"></div>
            </div>
            
            <!-- Destinations Grid (Estrutura original de 4 colunas mantida e otimizada) -->
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

    <!-- INFRAESTRUTURA & SEGURANÇA LOGÍSTICA -->
   <section class="py-20 bg-gray-50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-[#002752] uppercase tracking-tight">
                    Padrão de Conforto Garantido
                </h2>
                <p class="text-sm text-gray-500 mt-2">A tranquilidade de viajar com uma estrutura desenhada para você</p>
                <div class="w-16 h-1 bg-[#109e4a] mx-auto mt-4 rounded"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Info 1 -->
                <div class="bg-white rounded-xl p-6 border border-gray-100 text-center shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-full bg-[#002752]/5 text-[#002752] flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-bus-alt text-xl"></i>
                    </div>
                    <h4 class="font-bold text-[#002752] mb-2 text-sm uppercase">Transporte de Turismo</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Veículos modernos (ônibus, micro-ônibus ou vans), higienizados, equipados com ar-condicionado e motoristas profissionais credenciados.
                    </p>
                </div>

                <!-- Info 2 -->
                <div class="bg-white rounded-xl p-6 border border-gray-100 text-center shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-full bg-[#002752]/5 text-[#002752] flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-map-marked-alt text-xl"></i>
                    </div>
                    <h4 class="font-bold text-[#002752] mb-2 text-sm uppercase">Guia Credenciado</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Acompanhamento integral de guia de turismo bilíngue credenciado pelo Ministério do Turismo (CADASTUR) durante todo o passeio.
                    </p>
                </div>

                <!-- Info 3 -->
                <div class="bg-white rounded-xl p-6 border border-gray-100 text-center shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-full bg-[#002752]/5 text-[#002752] flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-umbrella-beach text-xl"></i>
                    </div>
                    <h4 class="font-bold text-[#002752] mb-2 text-sm uppercase">Ponto de Apoio</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Paramos sempre em barracas de praia ou restaurantes parceiros estruturados com banheiros, chuveiros, armários e excelente gastronomia.
                    </p>
                </div>

                <!-- Info 4 -->
                <div class="bg-white rounded-xl p-6 border border-gray-100 text-center shadow-sm hover:shadow-md transition-shadow">
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

    <!-- SESSÃO: O CHECKLIST DO VIAJANTE INTELIGENTE (Planejar vs Executar) -->
    <section class="py-20 bg-white border-t border-gray-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-12">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#002752] uppercase tracking-tight">
                    Por que garantir sua vaga com antecedência?
                </h2>
                <p class="text-sm text-gray-500 mt-2">Compare as vantagens de fazer parte do grupo dos planejados</p>
                <div class="w-16 h-1 bg-[#109e4a] mx-auto mt-4 rounded"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Lado do Risco (Deixar para última hora) -->
                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                    <h4 class="font-black text-sm text-gray-700 uppercase tracking-wide mb-4 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#f3a908]"></span> O risco de deixar para depois:
                    </h4>
                    <ul class="space-y-3 text-xs text-gray-600 font-medium">
                        <li class="flex items-center gap-2"><i class="fas fa-times text-red-500"></i> Tarifas muito mais caras devido à alta demanda</li>
                        <li class="flex items-center gap-2"><i class="fas fa-times text-red-500"></i> Risco alto de esgotamento de vagas nas melhores datas</li>
                        <li class="flex items-center gap-2"><i class="fas fa-times text-red-500"></i> Poucas opções de parcelamento sem juros</li>
                        <li class="flex items-center gap-2"><i class="fas fa-times text-red-500"></i> Estresse de planejar roteiros na correria</li>
                    </ul>
                </div>

                <!-- Lado do Benefício (Garantir Agora) -->
                <div class="bg-[#109e4a]/5 rounded-2xl p-6 border border-[#109e4a]/20">
                    <h4 class="font-black text-sm text-[#002752] uppercase tracking-wide mb-4 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#109e4a]"></span> O que você ganha reservando hoje:
                    </h4>
                    <ul class="space-y-3 text-xs text-[#002752] font-semibold">
                        <li class="flex items-center gap-2"><i class="fas fa-check text-[#109e4a]"></i> Preços congelados (sem reajustes de inflação)</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check text-[#109e4a]"></i> Prioridade na escolha de assentos e melhores quartos</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check text-[#109e4a]"></i> Parcelamento facilitado e suave até a data do embarque</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check text-[#109e4a]"></i> Tempo de sobra para planejar seus roteiros opcionais</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA FOOTER (Otimizado para Conversão e Esclarecimento de Prazos) -->
    <section class="bg-[#f3a908] py-8 text-[#002752]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-6">
                <!-- Text -->
                <div class="text-center lg:text-left flex items-center gap-4 flex-col sm:flex-row">
                    <div class="w-14 h-14 rounded-full bg-white flex items-center justify-center text-[#109e4a] shrink-0 shadow-sm">
                        <i class="fab fa-whatsapp text-3xl"></i>
                    </div>
                    <div>
                        <span class="block text-lg font-black uppercase tracking-wide">Quer montar um cronograma de pagamento sob medida?</span>
                        <span class="block text-sm font-medium">Fale com nossos consultores e congele os valores da nova temporada agora mesmo!</span>
                    </div>
                </div>
                
                <!-- Button -->
                <a href="{{ $whatsappUrl }}" target="_blank" class="bg-[#109e4a] hover:bg-[#0d9648] text-white px-8 py-3.5 rounded-lg font-black text-sm tracking-wider uppercase transition duration-300 shadow-md flex items-center gap-3 shrink-0">
                    <i class="fab fa-whatsapp text-2xl"></i>
                    <span>Garantir Tarifa de Hoje</span>
                </a>
            </div>
        </div>
    </section>

@endsection