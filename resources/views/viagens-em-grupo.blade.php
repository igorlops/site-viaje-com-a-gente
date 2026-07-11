@extends('layouts.site')

@section('title', 'Viagens em Grupo - Viaje com a Gente')

@section('content')

    <!-- SEÇÃO INTRODUTÓRIA + LISTAGEM DE PACOTES IMEDIATA -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Descrição Conceitual de Viagens em Grupo (Copy de Conexão e Segurança) -->
            <div class="max-w-3xl mx-auto text-center mb-16">
                <span class="text-[#109e4a] text-xs font-black uppercase tracking-widest bg-[#109e4a]/10 px-4 py-1.5 rounded-full inline-block mb-4">
                    Explore em Boa Companhia
                </span>
                <h1 class="text-3xl sm:text-4xl font-black text-[#002752] tracking-tight mb-4">
                    Viajar sozinho é bom. Compartilhar o mundo é inesquecível.
                </h1>
                <p class="text-base text-gray-600 leading-relaxed">
                    Nossas <strong>Viagens em Grupo</strong> foram feitas para quem quer explorar os melhores destinos do Brasil e do mundo com total segurança, conforto e, claro, novas amizades. Você não precisa se preocupar com conexões, reservas ou burocracias: nós cuidamos de toda a logística desde o embarque em Fortaleza. É a oportunidade perfeita para colecionar memórias ao lado de pessoas que compartilham da mesma paixão que você por desbravar o mundo.
                </p>
                <div class="w-24 h-1 bg-[#f3a908] mx-auto mt-6 rounded"></div>
            </div>

            <!-- Grid de Pacotes (Abaixo do texto, direto e dinâmico) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-4">
                @php
                    $whatsappUrl = isset($socialLinks['whatsapp']) ? $socialLinks['whatsapp']->url : 'https://wa.me/5585999166421';
                @endphp

                @foreach($destinations as $pkg)
                   <x-card-pacotes :pkg="$pkg" :whatsappUrl="$whatsappUrl" />
                @endforeach
            </div>
            
    </section>

    @if($ctaSession = $cta_session->firstWhere('order_position', 1))
        <x-cta-session :cta="$ctaSession" />
    @endif

    <!-- GROUP BENEFITS SECTION (Infraestrutura e Vantagens Exclusivas) -->
    <section class="py-20 bg-gray-50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-[#002752] uppercase tracking-tight">
                    A Estrutura de um Grupo Perfeito
                </h2>
                <p class="text-sm text-gray-500 mt-2">Por que milhares de viajantes preferem rodar o mundo com a nossa bandeira</p>
                <div class="w-16 h-1 bg-[#109e4a] mx-auto mt-4 rounded"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Benefit 1 -->
                <div class="bg-white rounded-xl p-8 border border-gray-100 text-center shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 rounded-full bg-[#f3a908]/10 text-[#002752] flex items-center justify-center mx-auto mb-4 font-black">
                        <i class="fas fa-user-tie text-xl text-[#002752]"></i>
                    </div>
                    <h4 class="font-bold text-[#002752] mb-2 text-sm uppercase">Guia desde o Embarque</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Nossos guias credenciados acompanham o grupo saindo do aeroporto de Fortaleza, dando suporte total em check-in, bagagens e conexões.
                    </p>
                </div>

                <!-- Benefit 2 -->
                <div class="bg-white rounded-xl p-8 border border-gray-100 text-center shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 rounded-full bg-[#f3a908]/10 text-[#002752] flex items-center justify-center mx-auto mb-4 font-black">
                        <i class="fas fa-hand-holding-usd text-xl text-[#002752]"></i>
                    </div>
                    <h4 class="font-bold text-[#002752] mb-2 text-sm uppercase">Melhores Tarifas</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Negociamos tarifas corporativas diretamente com hotéis e companhias aéreas, garantindo vantagens econômicas imbatíveis no preço final.
                    </p>
                </div>

                <!-- Benefit 3 -->
                <div class="bg-white rounded-xl p-8 border border-gray-100 text-center shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 rounded-full bg-[#f3a908]/10 text-[#002752] flex items-center justify-center mx-auto mb-4 font-black">
                        <i class="fas fa-cocktail text-xl text-[#002752]"></i>
                    </div>
                    <h4 class="font-bold text-[#002752] mb-2 text-sm uppercase">Roteiros Integrados</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Inclusão de jantares de boas-vindas e momentos de confraternização desenhados para conectar pessoas e gerar amizades duradouras.
                    </p>
                </div>

                <!-- Benefit 4 -->
                <div class="bg-white rounded-xl p-8 border border-gray-100 text-center shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 rounded-full bg-[#f3a908]/10 text-[#002752] flex items-center justify-center mx-auto mb-4 font-black">
                        <i class="fas fa-heart text-xl text-[#002752]"></i>
                    </div>
                    <h4 class="font-bold text-[#002752] mb-2 text-sm uppercase">Preocupação Zero</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Cuidamos de toda a burocracia, horários de saída, traslados e reservas. Você só se preocupa em viver o momento e fotografar.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SESSÃO: O CHECKLIST DO VIAJANTE INTELIGENTE (Quebra de Objeção por Esforço) -->
    <section class="py-20 bg-white border-t border-gray-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-12">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#002752] uppercase tracking-tight">
                    O mundo aguarda você. Deixe o trabalho conosco.
                </h2>
                <p class="text-sm text-gray-500 mt-2">Como dividimos os papéis para garantir a sua melhor experiência</p>
                <div class="w-16 h-1 bg-[#109e4a] mx-auto mt-4 rounded"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Lado do Cliente -->
                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                    <h4 class="font-black text-sm text-gray-700 uppercase tracking-wide mb-4 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#f3a908]"></span> O que você traz:
                    </h4>
                    <ul class="space-y-3 text-xs text-gray-600 font-medium">
                        <li class="flex items-center gap-2"><i class="fas fa-check text-[#109e4a]"></i> Seus documentos pessoais (RG ou Passaporte)</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check text-[#109e4a]"></i> Malas prontas com seus looks favoritos</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check text-[#109e4a]"></i> Câmera do celular limpa para registrar tudo</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check text-[#109e4a]"></i> Coração aberto para conhecer novas histórias</li>
                    </ul>
                </div>

                <!-- Lado da Agência -->
                <div class="bg-[#109e4a]/5 rounded-2xl p-6 border border-[#109e4a]/20">
                    <h4 class="font-black text-sm text-[#002752] uppercase tracking-wide mb-4 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#109e4a]"></span> O que nós garantimos:
                    </h4>
                    <ul class="space-y-3 text-xs text-[#002752] font-semibold">
                        <li class="flex items-center gap-2"><i class="fas fa-shield-alt text-[#109e4a]"></i> Suporte completo no aeroporto e voos coordenados</li>
                        <li class="flex items-center gap-2"><i class="fas fa-hotel text-[#109e4a]"></i> Hotéis altamente qualificados com café da manhã</li>
                        <li class="flex items-center gap-2"><i class="fas fa-bus text-[#109e4a]"></i> Traslados exclusivos e seguros entre os passeios</li>
                        <li class="flex items-center gap-2"><i class="fas fa-user-shield text-[#109e4a]"></i> Coordenação integral de guias experientes</li>
                    </ul>
                </div>
        </div>
    </section>

    @if($ctaSession = $cta_session->firstWhere('order_position', 2))
        <x-cta-session :cta="$ctaSession" />
    @endif

    <!-- CTA FOOTER -->
    <section class="bg-[#f3a908] py-8 text-[#002752]">
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
    </section>

    @if($ctaSession = $cta_session->firstWhere('order_position', 3))
        <x-cta-session :cta="$ctaSession" />
    @endif

@endsection