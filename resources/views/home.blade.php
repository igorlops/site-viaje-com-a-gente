@extends('layouts.site')

@section('title', 'Viaje com a Gente - Viagens e Turismo')

@section('content')
@php
     $whatsappUrl = isset($socialLinks['whatsapp']) ? $socialLinks['whatsapp']->url : 'https://wa.me/5585999166421';

     $steps = [
        [
            'order' => 1,
            'title' => 'Escolha seu destino',
            'description' => 'Veja as opções de pacotes ou fale com um consultor.',
            'icon' => 'fas fa-search',
            'colorText' => '#fff',
            'stepColor' => '#109e4a',
        ],
        [
            'order' => 2,
            'title' => 'Receba sua proposta',
            'description' => 'Enviamos as melhores opções de acordo com seu perfil.',
            'icon' => 'far fa-file-alt',
            'colorText' => '#002752',
            'stepColor' => '#f2bd11',
        ],
        [
            'order' => 3,
            'title' => 'Forma de pagamento',
            'description' => 'Boleto, PIX ou cartão em até 12x.',
            'icon' => 'far fa-credit-card',
            'colorText' => '#fff',
            'stepColor' => '#109e4a',
        ],
        [
            'order' => 4,
            'title' => 'Prepare as malas',
            'description' => 'A gente cuida de tudo para você viajar tranquilo.',
            'icon' => 'fas fa-suitcase',
            'colorText' => '#002752',
            'stepColor' => '#f2bd11',
        ],
        [
            'order' => 5,
            'title' => 'Viaje tranquilo',
            'description' => 'Com suporte completo antes, durante e após sua viagem.',
            'icon' => 'fas fa-plane-departure',
            'colorText' => '#fff',
            'stepColor' => '#109e4a',
        ],
];

     $benefits = [
        [
            'title' => 'Parcelamento no Boleto',
            'description' => 'Mais facilidade para você realizar seu sonho.',
            'icon' => 'fas fa-barcode',
            'colorText' => '#109e4a',
            'stepColor' => '#109e4a',
        ],
        [
            'title' => 'Atendimento Humano',
            'description' => 'Fale com pessoas reais antes, durante e depois da viagem.',
            'icon' => 'fas fa-headset',
            'colorText' => '#109e4a',
            'stepColor' => '#109e4a',
        ],
        [
            'title' => 'Roteiros Completos',
            'description' => 'Tudo organizado para você não se preocupar com nada.',
            'icon' => 'fas fa-route',
            'colorText' => '#109e4a',
            'stepColor' => '#109e4a',
        ],
        [
            'title' => 'Segurança e Confiança',
            'description' => 'Trabalhamos com os melhores fornecedores e parceiros.',
            'icon' => 'fas fa-shield-alt',
            'colorText' => '#109e4a',
            'stepColor' => '#109e4a',
        ],
        [
            'title' => 'Grupo ou em Família',
            'description' => 'Opções para todos os perfis: casal, família, amigos e grupos.',
            'icon' => 'fas fa-users-cog',
            'colorText' => '#109e4a',
            'stepColor' => '#109e4a',
        ],
        [
            'title' => 'Suporte via WhatsApp',
            'description' => 'Tire dúvidas e receba suporte rápido e eficiente.',
            'icon' => 'fab fa-whatsapp',
            'colorText' => '#109e4a',
            'stepColor' => '#109e4a',
        ],
     ];
@endphp


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
                    Por que viajar com a gente?
                </h2>
                <div class="w-16 h-1 bg-[#f2bd11] mx-auto mt-4 rounded"></div>
            </div>
            
            <!-- Grid Benefits -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-8">
                <!-- Benefit 1 -->
                    @foreach ($benefits as $benefit)
                        <div class="text-center flex flex-col items-center">
                            <div class="w-16 h-16 rounded-full bg-[#f2bd11] text-[#002752] flex items-center justify-center mb-4 shadow-md">
                                <i class="{{ $benefit['icon'] }} text-2xl"></i>
                            </div>
                            <h3 class="text-sm font-bold uppercase mb-2 tracking-wide text-white">{{ $benefit['title'] }}</h3>
                            <p class="text-xs text-gray-300 leading-relaxed">
                                {{ $benefit['description'] }}
                            </p>
                        </div>
                    @endforeach

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
                    @foreach ($steps as $step)
                        <div class="text-center flex flex-col items-center">
                            <span class="w-8 h-8 rounded-full bg-[{{ $step['stepColor'] }}] text-[{{ $step['colorText'] }}] flex items-center justify-center font-bold text-sm mb-4">{{ $step['order'] }}</span>
                            <div class="w-20 h-20 rounded-full bg-white border border-gray-100 shadow-md flex items-center justify-center mb-4 hover:scale-105 transition duration-300">
                                <i class="{{ $step['icon'] }} text-[#002752] text-2xl"></i>
                            </div>
                            <h3 class="text-base font-bold text-[#002752] mb-2">{{ $step['title'] }}</h3>
                            <p class="text-xs text-gray-500 max-w-[200px] leading-relaxed">
                                {{ $step['description'] }}
                            </p>
                        </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </section>

    <!-- PROMOTIONAL BANNER -->
    <section class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Adicionado um mt-16 no card para garantir espaço para a imagem vazar para cima -->
        <div class="bg-gradient-to-br from-[#109e4a] to-[#0b803a] rounded-2xl shadow-xl text-white relative flex flex-col lg:flex-row items-center justify-between px-6 lg:px-12 pt-28 lg:pt-0 pb-0 gap-8 lg:gap-4 mt-16">
            
            <!-- Container da Imagem (self-end faz ela grudar em baixo no desktop) -->
            <div class="w-full hidden lg:block lg:w-auto flex justify-center lg:justify-start lg:self-end order-1 lg:order-none shrink-0">
                <img src="{{ asset('assets/images/mulher_com_mala_e_tickets_viagem_fortaleza.png') }}" 
                     alt="Mulher com mala" 
                     class="w-[200px] sm:w-[280px] lg:w-[450px] xl:w-[400px] -mt-36 lg:-mt-24 object-contain object-bottom relative z-10 drop-shadow-2xl">
            </div>
            
            <!-- Promo Text & Checklist -->
            <div class="w-full max-w-xl relative z-10 text-center lg:text-left py-0 lg:py-12 order-2 lg:order-none">
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
            <div class="relative z-10 flex flex-col items-center justify-center border-4 border-dashed border-white/40 p-6 rounded-xl bg-white/5 backdrop-blur-sm shrink-0 w-full sm:w-80 mb-8 lg:mb-0 lg:my-12 order-3 lg:order-none">
                <i class="fas fa-barcode text-5xl mb-3 text-[#f2bd11]"></i>
                <span class="text-xs uppercase tracking-widest font-medium text-green-100">Parcelamento</span>
                <span class="text-xl uppercase font-black tracking-wider text-white">Facilitado</span>
                <span class="text-sm uppercase font-bold text-[#f2bd11]">No Boleto</span>
            </div>
            
        </div>
    </div>
</section>

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