@extends('layouts.site')

@section('title', 'Viaje com a Gente - Viagens e Turismo')

@section('content')

    <!-- HERO BANNER -->
    @php
        $whatsappUrl = isset($socialLinks['whatsapp']) ? $socialLinks['whatsapp']->url : 'https://wa.me/5585999166421';
        $bannerUrl = $banner && $banner->image_path ? asset('storage/' . $banner->image_path) : asset('assets/images/page-home.jpeg');
        $bannerTitle = $banner && $banner->title ? $banner->title : 'Sua próxima viagem está mais perto do que você imagina!';
        $bannerSubtitle = $banner && $banner->subtitle ? $banner->subtitle : 'Viaje com segurança, parcele no boleto e conte com a gente do planejamento ao retorno.';
    @endphp
    <section class="relative bg-cover bg-center h-[550px] lg:h-[650px] flex items-center" style="background-image: url('{{ $bannerUrl }}');">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#001c3d]/90 via-[#001c3d]/60 to-transparent"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full z-10">
            <div class="max-w-xl lg:max-w-2xl text-white">
                <!-- Main Title -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black leading-tight mb-4 text-white">
                    {!! str_replace('perto do que você imagina!', '<span class="text-[#f2bd11]">perto do que você imagina!</span>', e($bannerTitle)) !!}
                </h1>
                
                <!-- Subtitle -->
                <p class="text-base sm:text-lg text-gray-200 mb-8 max-w-lg leading-relaxed">
                    {{ $bannerSubtitle }}
                </p>
                
                <!-- Feature Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-8">
                    <!-- Feature 1 -->
                    <div class="flex items-center gap-3 bg-white/10 backdrop-blur-md px-3.5 py-3 rounded-lg border border-white/10">
                        <div class="w-10 h-10 rounded bg-[#109e4a] text-white flex items-center justify-center shrink-0">
                            <i class="fas fa-barcode text-xl"></i>
                        </div>
                        <span class="text-[10px] sm:text-xs font-bold leading-tight uppercase">Parcelamento Facilitado no Boleto</span>
                    </div>
                    <!-- Feature 2 -->
                    <div class="flex items-center gap-3 bg-white/10 backdrop-blur-md px-3.5 py-3 rounded-lg border border-white/10">
                        <div class="w-10 h-10 rounded bg-[#109e4a] text-white flex items-center justify-center shrink-0">
                            <i class="fas fa-headset text-xl"></i>
                        </div>
                        <span class="text-[10px] sm:text-xs font-bold leading-tight uppercase">Atendimento Humano pelo WhatsApp</span>
                    </div>
                    <!-- Feature 3 -->
                    <div class="flex items-center gap-3 bg-white/10 backdrop-blur-md px-3.5 py-3 rounded-lg border border-white/10">
                        <div class="w-10 h-10 rounded bg-[#109e4a] text-white flex items-center justify-center shrink-0">
                            <i class="fas fa-user-shield text-xl"></i>
                        </div>
                        <span class="text-[10px] sm:text-xs font-bold leading-tight uppercase">Suporte antes, durante e após a viagem</span>
                    </div>
                </div>
                
                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-4" id="orcamento">
                    <a href="{{ $whatsappUrl }}" target="_blank" class="inline-flex justify-center items-center bg-[#f2bd11] hover:bg-white text-[#002752] hover:text-[#002752] px-8 py-4 rounded-lg font-black text-sm tracking-wide uppercase transition duration-300 shadow-lg">
                        Quero um Orçamento
                    </a>
                    <a href="#destinos" class="inline-flex justify-center items-center bg-transparent hover:bg-white/10 text-white px-8 py-4 rounded-lg font-black text-sm tracking-wide uppercase border-2 border-white transition duration-300">
                        Ver Pacotes 2026/2027
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- DESTINOS EM DESTAQUE -->
    <section class="py-20 bg-white" id="destinos">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16 relative">
                <div class="inline-flex items-center justify-center gap-2 mb-2 text-[#002752] uppercase font-black tracking-widest text-sm">
                    <span>Destinos em Destaque</span>
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
                    <!-- Destination Card -->
                    <div class="bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-100 overflow-hidden flex flex-col group transition duration-300 transform hover:-translate-y-1">
                        <!-- Card Image Header -->
                        <div class="relative h-48 bg-gray-200 overflow-hidden shrink-0">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition duration-500" src="{{ asset('storage/' . $destination->image_path) }}" alt="{{ $destination->title }}">
                            
                            @if($destination->tag)
                                <span class="absolute top-3 right-3 bg-[#f2bd11] text-[#002752] text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded">
                                    {{ $destination->tag }}
                                </span>
                            @endif
                        </div>
                        
                        <!-- Card Body -->
                        <div class="p-5 flex-grow flex flex-col justify-between">
                            <div>
                                <h3 class="text-[#002752] text-xl font-bold leading-snug mb-1">
                                    {{ $destination->title }}
                                </h3>
                                @if($destination->subtitle)
                                    <p class="text-gray-500 text-sm font-medium mb-3">
                                        {{ $destination->subtitle }}
                                    </p>
                                @endif
                                
                                <!-- Info Badge -->
                                <div class="inline-flex items-center gap-2 text-gray-400 text-xs font-semibold uppercase tracking-wider border-t border-b border-gray-100 py-1.5 w-full mb-4">
                                    <i class="far fa-calendar-alt text-[#109e4a]"></i>
                                    <span>{{ $destination->duration }}</span>
                                    <span class="text-gray-300">|</span>
                                    <i class="fas fa-plane-departure text-[#109e4a] text-[10px]"></i>
                                    <span class="truncate">{{ $destination->category }}</span>
                                </div>
                            </div>
                            
                            <div>
                                <!-- Price -->
                                <div class="mb-4">
                                    <span class="block text-gray-400 text-xs font-medium">A partir de</span>
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-[#109e4a] text-xs font-black">R$</span>
                                        <span class="text-[#109e4a] text-2xl font-black">
                                            {{ number_format($destination->price, 2, ',', '.') }}
                                        </span>
                                        <span class="text-[#109e4a] text-xs font-bold">/mês</span>
                                    </div>
                                    <span class="block text-gray-400 text-[10px] font-bold uppercase">No boleto</span>
                                </div>
                                
                                <!-- Actions -->
                                @php
                                    $destWhatsapp = $destination->whatsapp_link ?: $whatsappUrl . '?text=' . urlencode('Olá, gostaria de mais informações sobre o pacote ' . $destination->title);
                                @endphp
                                <div class="flex gap-2">
                                    <a href="{{ $destWhatsapp }}" target="_blank" class="flex-grow inline-flex justify-center items-center bg-[#109e4a] hover:bg-[#0d9648] text-white font-bold text-xs uppercase py-3 rounded-lg transition duration-200 gap-1.5 shadow-sm">
                                        <span>Ver Pacote</span>
                                        <i class="fas fa-chevron-right text-[9px]"></i>
                                    </a>
                                    <a href="{{ $destWhatsapp }}" target="_blank" class="w-10 h-10 inline-flex items-center justify-center border border-[#109e4a] hover:bg-[#109e4a] text-[#109e4a] hover:text-white rounded-lg transition duration-200">
                                        <i class="fab fa-whatsapp text-lg"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">
                        Nenhum pacote em destaque cadastrado no momento.
                    </div>
                @endforelse
            </div>
            
            <!-- More Packages Button -->
            <div class="text-center">
                <a href="{{ $whatsappUrl }}" target="_blank" class="inline-flex items-center justify-center border-2 border-[#002752] text-[#002752] hover:bg-[#002752] hover:text-white px-8 py-3.5 rounded-lg font-black text-sm tracking-wide uppercase transition duration-300 gap-2">
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
                    Por que viajar com a gente?
                </h2>
                <div class="w-16 h-1 bg-[#f2bd11] mx-auto mt-4 rounded"></div>
            </div>
            
            <!-- Grid Benefits -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-8">
                <!-- Benefit 1 -->
                <div class="text-center flex flex-col items-center">
                    <div class="w-16 h-16 rounded-full bg-[#f2bd11] text-[#002752] flex items-center justify-center mb-4 shadow-md">
                        <i class="fas fa-barcode text-2xl"></i>
                    </div>
                    <h3 class="text-sm font-bold uppercase mb-2 tracking-wide text-white">Parcelamento no Boleto</h3>
                    <p class="text-xs text-gray-300 leading-relaxed">
                        Mais facilidade para você realizar seu sonho.
                    </p>
                </div>
                <!-- Benefit 2 -->
                <div class="text-center flex flex-col items-center">
                    <div class="w-16 h-16 rounded-full bg-[#f2bd11] text-[#002752] flex items-center justify-center mb-4 shadow-md">
                        <i class="fas fa-headset text-2xl"></i>
                    </div>
                    <h3 class="text-sm font-bold uppercase mb-2 tracking-wide text-white">Atendimento Humano</h3>
                    <p class="text-xs text-gray-300 leading-relaxed">
                        Fale com pessoas reais antes, durante e depois da viagem.
                    </p>
                </div>
                <!-- Benefit 3 -->
                <div class="text-center flex flex-col items-center">
                    <div class="w-16 h-16 rounded-full bg-[#f2bd11] text-[#002752] flex items-center justify-center mb-4 shadow-md">
                        <i class="fas fa-route text-2xl"></i>
                    </div>
                    <h3 class="text-sm font-bold uppercase mb-2 tracking-wide text-white">Roteiros Completos</h3>
                    <p class="text-xs text-gray-300 leading-relaxed">
                        Tudo organizado para você não se preocupar com nada.
                    </p>
                </div>
                <!-- Benefit 4 -->
                <div class="text-center flex flex-col items-center">
                    <div class="w-16 h-16 rounded-full bg-[#f2bd11] text-[#002752] flex items-center justify-center mb-4 shadow-md">
                        <i class="fas fa-shield-alt text-2xl"></i>
                    </div>
                    <h3 class="text-sm font-bold uppercase mb-2 tracking-wide text-white">Segurança e Confiança</h3>
                    <p class="text-xs text-gray-300 leading-relaxed">
                        Trabalhamos com os melhores fornecedores e parceiros.
                    </p>
                </div>
                <!-- Benefit 5 -->
                <div class="text-center flex flex-col items-center">
                    <div class="w-16 h-16 rounded-full bg-[#f2bd11] text-[#002752] flex items-center justify-center mb-4 shadow-md">
                        <i class="fas fa-users-cog text-2xl"></i>
                    </div>
                    <h3 class="text-sm font-bold uppercase mb-2 tracking-wide text-white">Grupo ou em Família</h3>
                    <p class="text-xs text-gray-300 leading-relaxed">
                        Opções para todos os perfis: casal, família, amigos e grupos.
                    </p>
                </div>
                <!-- Benefit 6 -->
                <div class="text-center flex flex-col items-center">
                    <div class="w-16 h-16 rounded-full bg-[#f2bd11] text-[#002752] flex items-center justify-center mb-4 shadow-md">
                        <i class="fab fa-whatsapp text-2xl"></i>
                    </div>
                    <h3 class="text-sm font-bold uppercase mb-2 tracking-wide text-white">Suporte via WhatsApp</h3>
                    <p class="text-xs text-gray-300 leading-relaxed">
                        Tire dúvidas e receba suporte rápido e eficiente.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- COMO FUNCIONA -->
    <section class="py-20 bg-gray-50" id="como-funciona">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#002752] tracking-tight uppercase">
                    Como Funciona
                </h2>
                <div class="w-16 h-1 bg-[#109e4a] mx-auto mt-4 rounded"></div>
            </div>
            
            <!-- Steps -->
            <div class="relative">
                <!-- Line background on desktop -->
                <div class="hidden lg:block absolute top-10 left-16 right-16 h-0.5 bg-gray-200 -z-0"></div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-12 relative z-10">
                    <!-- Step 1 -->
                    <div class="text-center flex flex-col items-center">
                        <span class="w-8 h-8 rounded-full bg-[#109e4a] text-white flex items-center justify-center font-bold text-sm mb-4">1</span>
                        <div class="w-20 h-20 rounded-full bg-white border border-gray-100 shadow-md flex items-center justify-center mb-4 hover:scale-105 transition duration-300">
                            <i class="fas fa-search text-[#002752] text-2xl"></i>
                        </div>
                        <h3 class="text-base font-bold text-[#002752] mb-2">Escolha seu destino</h3>
                        <p class="text-xs text-gray-500 max-w-[200px] leading-relaxed">
                            Veja as opções de pacotes ou fale com um consultor.
                        </p>
                    </div>
                    <!-- Step 2 -->
                    <div class="text-center flex flex-col items-center">
                        <span class="w-8 h-8 rounded-full bg-[#f2bd11] text-[#002752] flex items-center justify-center font-bold text-sm mb-4">2</span>
                        <div class="w-20 h-20 rounded-full bg-white border border-gray-100 shadow-md flex items-center justify-center mb-4 hover:scale-105 transition duration-300">
                            <i class="far fa-file-alt text-[#002752] text-2xl"></i>
                        </div>
                        <h3 class="text-base font-bold text-[#002752] mb-2">Receba sua proposta</h3>
                        <p class="text-xs text-gray-500 max-w-[200px] leading-relaxed">
                            Enviamos as melhores opções de acordo com seu perfil.
                        </p>
                    </div>
                    <!-- Step 3 -->
                    <div class="text-center flex flex-col items-center">
                        <span class="w-8 h-8 rounded-full bg-[#109e4a] text-white flex items-center justify-center font-bold text-sm mb-4">3</span>
                        <div class="w-20 h-20 rounded-full bg-white border border-gray-100 shadow-md flex items-center justify-center mb-4 hover:scale-105 transition duration-300">
                            <i class="far fa-credit-card text-[#002752] text-2xl"></i>
                        </div>
                        <h3 class="text-base font-bold text-[#002752] mb-2">Forma de pagamento</h3>
                        <p class="text-xs text-gray-500 max-w-[200px] leading-relaxed">
                            Boleto, PIX ou cartão em até 12x.
                        </p>
                    </div>
                    <!-- Step 4 -->
                    <div class="text-center flex flex-col items-center">
                        <span class="w-8 h-8 rounded-full bg-[#f2bd11] text-[#002752] flex items-center justify-center font-bold text-sm mb-4">4</span>
                        <div class="w-20 h-20 rounded-full bg-white border border-gray-100 shadow-md flex items-center justify-center mb-4 hover:scale-105 transition duration-300">
                            <i class="fas fa-suitcase text-[#002752] text-2xl"></i>
                        </div>
                        <h3 class="text-base font-bold text-[#002752] mb-2">Prepare as malas</h3>
                        <p class="text-xs text-gray-500 max-w-[200px] leading-relaxed">
                            A gente cuida de tudo para você viajar tranquilo.
                        </p>
                    </div>
                    <!-- Step 5 -->
                    <div class="text-center flex flex-col items-center">
                        <span class="w-8 h-8 rounded-full bg-[#109e4a] text-white flex items-center justify-center font-bold text-sm mb-4">5</span>
                        <div class="w-20 h-20 rounded-full bg-white border border-gray-100 shadow-md flex items-center justify-center mb-4 hover:scale-105 transition duration-300">
                            <i class="fas fa-plane-departure text-[#002752] text-2xl"></i>
                        </div>
                        <h3 class="text-base font-bold text-[#002752] mb-2">Viaje tranquilo</h3>
                        <p class="text-xs text-gray-500 max-w-[200px] leading-relaxed">
                            Com suporte completo antes, durante e após sua viagem.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROMOTIONAL BANNER -->
    <section class="py-10 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-[#109e4a] to-[#0b803a] rounded-2xl overflow-hidden shadow-xl text-white p-8 sm:p-12 relative flex flex-col lg:flex-row items-center justify-between gap-8">
                <!-- Decorative background elements -->
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,rgba(255,255,255,0.1),transparent)] pointer-events-none"></div>
                
                <!-- Promo Text & Checklist -->
                <div class="max-w-xl relative z-10 text-center lg:text-left">
                    <h2 class="text-2xl sm:text-3xl font-black mb-6 leading-tight">
                        Parcele sua viagem no <span class="underline decoration-[#f2bd11] decoration-4">boleto</span> e realize seu sonho!
                    </h2>
                    
                    <ul class="space-y-3.5 inline-block text-left">
                        <li class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-[#f2bd11] text-lg"></i>
                            <span class="font-semibold text-sm">Sem consulta ao SPC/Serasa</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-[#f2bd11] text-lg"></i>
                            <span class="font-semibold text-sm">Você escolhe a melhor data para pagar</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-[#f2bd11] text-lg"></i>
                            <span class="font-semibold text-sm">Mais liberdade para planejar sua viagem</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Promo Stamp -->
                <div class="relative z-10 flex flex-col items-center justify-center border-4 border-dashed border-white/40 p-6 rounded-xl bg-white/5 backdrop-blur-sm shrink-0 w-full sm:w-80">
                    <i class="fas fa-barcode text-5xl mb-3 text-[#f2bd11]"></i>
                    <span class="text-xs uppercase tracking-widest font-medium text-green-100">Parcelamento</span>
                    <span class="text-xl uppercase font-black tracking-wider text-white">Facilitado</span>
                    <span class="text-sm uppercase font-bold text-[#f2bd11]">No Boleto</span>
                </div>
            </div>
        </div>
    </section>

    <!-- O QUE NOSSOS CLIENTES DIZEM -->
    <section class="py-20 bg-gray-50" id="depoimentos">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#002752] tracking-tight uppercase">
                    O que nossos clientes dizem
                </h2>
                <div class="w-16 h-1 bg-[#109e4a] mx-auto mt-4 rounded"></div>
            </div>
            
            <!-- Testimonials Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-8 rounded-xl shadow-md border border-gray-100 flex flex-col justify-between hover:shadow-lg transition duration-300">
                    <div>
                        <!-- Stars -->
                        <div class="flex text-[#f2bd11] gap-1 mb-4">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-gray-600 italic text-sm leading-relaxed mb-6">
                            "Foi minha primeira viagem de avião e deu tudo certo! A equipe me deu todo o suporte. Recomendo demais!"
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-blue-100 text-[#002752] flex items-center justify-center font-bold">
                            JM
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-[#002752]">Juliana M.</span>
                            <span class="block text-xs text-gray-400">Fortaleza - CE</span>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="bg-white p-8 rounded-xl shadow-md border border-gray-100 flex flex-col justify-between hover:shadow-lg transition duration-300">
                    <div>
                        <!-- Stars -->
                        <div class="flex text-[#f2bd11] gap-1 mb-4">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-gray-600 italic text-sm leading-relaxed mb-6">
                            "Parcelar no boleto facilitou muito para a gente. Já viajamos 2 vezes com a Viaje com a Gente!"
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-green-100 text-[#109e4a] flex items-center justify-center font-bold">
                            CA
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-[#002752]">Carlos e Ana</span>
                            <span class="block text-xs text-gray-400">Caucaia - CE</span>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="bg-white p-8 rounded-xl shadow-md border border-gray-100 flex flex-col justify-between hover:shadow-lg transition duration-300">
                    <div>
                        <!-- Stars -->
                        <div class="flex text-[#f2bd11] gap-1 mb-4">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-gray-600 italic text-sm leading-relaxed mb-6">
                            "Organização impecável e atendimento maravilhoso! Já indiquei para todos os meus amigos."
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-yellow-100 text-[#f2bd11] flex items-center justify-center font-bold">
                            MF
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-[#002752]">Maria Fernanda</span>
                            <span class="block text-xs text-gray-400">Eusébio - CE</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PRONTO PARA VIAJAR -->
    <section class="bg-[#f2bd11] py-8 text-[#002752]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-6">
                <!-- Text block -->
                <div class="flex items-center gap-4 text-center lg:text-left flex-col sm:flex-row">
                    <div class="w-14 h-14 rounded-full bg-white flex items-center justify-center text-[#109e4a] shrink-0">
                        <i class="fab fa-whatsapp text-3xl"></i>
                    </div>
                    <div>
                        <span class="block text-lg font-black uppercase tracking-wide">Pronto para viajar?</span>
                        <span class="block text-sm font-medium">Fale agora com um consultor e receba sua proposta personalizada!</span>
                    </div>
                </div>
                
                <!-- Button -->
                <a href="{{ $whatsappUrl }}" target="_blank" class="bg-[#109e4a] hover:bg-[#0d9648] text-white px-8 py-3.5 rounded-lg font-black text-sm tracking-wider uppercase transition duration-300 shadow-md flex items-center gap-3 shrink-0">
                    <i class="fab fa-whatsapp text-2xl"></i>
                    <span>(85) 9 9916-6421 Clique e fale no WhatsApp</span>
                </a>
            </div>
        </div>
    </section>

@endsection
