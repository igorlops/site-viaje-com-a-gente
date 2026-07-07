@extends('layouts.pacotes')

@section('title', $destination->title . ' - Viaje com a Gente')

@section('content')
    @php
        $whatsappUrl = isset($socialLinks['whatsapp']) ? $socialLinks['whatsapp']->url : 'https://wa.me/5585999166421';
        $bannerUrl = $destination->banner_image_path ? asset('storage/' . $destination->banner_image_path) : asset('storage/' . $destination->image_path);
        $fullPrice = $destination->full_price ?? 'R$ ' . number_format($destination->price, 2, ',', '.');
    @endphp

    <!-- HERO BANNER -->
    <section class="relative bg-cover bg-center h-[500px] lg:h-[600px] flex items-end" style="background-image: url('{{ $bannerUrl }}');">
        <div class="absolute inset-0 bg-gradient-to-t from-[#001c3d] via-[#001c3d]/70 to-transparent"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full pb-2 z-10">
            <div class="text-white">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black mb-4 text-[#f3a908]">
                    {{ $destination->title }}
                </h1>
                
                @if($destination->subtitle)
                    <p class="text-xl sm:text-2xl text-gray-200 mb-6">
                        {{ $destination->subtitle }}
                    </p>
                @endif
                @if($destination->text_label_banner)
                    <p class="text-sm sm:text-lg text-gray-200 mb-6">
                        {{ $destination->text_label_banner }}
                    </p>
                @endif
                <div class="flex flex-wrap items-center gap-5 mb-6">
                    @if($destination->date_range)
                        <div class="flex items-center gap-2">
                            <i class="far fa-calendar-alt text-[#f3a908] text-xl"></i>
                            <span class="text-lg font-semibold">{{ $destination->date_range }}</span>
                        </div>
                    @endif

                    
                    <div class="flex items-center gap-2">
                        <i class="fa-sharp fa-solid fa-people-group text-[#f3a908] text-xl"></i>
                        <span class="text-lg font-semibold">Viagem em grupo</span>
                    </div>
                    

                    @if($destination->price)
                        <div class="">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-sack-dollar text-[#f3a908] text-xl "></i>
                                <span class="text-lg font-semibold">A partir de</span>
                                <span class="text-[#f3a908] text-2xl font-black">
                                    {{ $fullPrice }}
                                </span>
                                <div class="relative flex items-center gap-1 self-end mb-1">
                                    <span class="text-[#fff] text-xs font-bold">mensais</span>
                                    <span class="text-[#fff] text-xs font-bold">no PIX/BOLETO</span>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </section>

    <!-- QUICK INFO BAR -->
    <!-- <section class="bg-[#002752] text-white py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 text-center">
                {{-- @if($destination->trip_type) --}}
                    <div class="border-r border-[#003a66] pr-4">
                        <span class="block text-xs text-gray-400 uppercase mb-1">Tipo</span>
                        <span class="font-bold text-sm">{{-- $destination->trip_type --}} </span>
                    </div>
                {{-- @endif --}}
                
                {{-- @if($destination->departure_city) --}}
                    <div class="border-r border-[#003a66] pr-4">
                        <span class="block text-xs text-gray-400 uppercase mb-1">Origem</span>
                        <span class="font-bold text-sm">{{-- $destination->departure_city --}}</span>
                    </div>
                {{-- @endif --}}
                {{-- @if($destination->departure_date) --}}
                    <div class="border-r border-[#003a66] pr-4">
                        <span class="block text-xs text-gray-400 uppercase mb-1">Saída</span>
                        <span class="font-bold text-sm">{{-- $destination->departure_date --}}</span>
                    </div>
                {{-- @endif --}}
                
                {{-- @if($destination->return_date) --}}
                    <div class="border-r border-[#003a66] pr-4">
                        <span class="block text-xs text-gray-400 uppercase mb-1">Retorno</span>
                        <span class="font-bold text-sm">{{-- $destination->return_date --}}</span>
                    </div>
                {{-- @endif --}}
                
                {{-- @if($destination->nights) --}}
                    <div>
                        <span class="block text-xs text-gray-400 uppercase mb-1">Duração</span>
                        <span class="font-bold text-sm">{{ $destination->nights }}</span>
                    </div>
                {{-- @endif --}}
            </div>
        </div>
    </section> -->

    <!-- MAIN CONTENT -->
    <div class="bg-white py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- WHAT IS INCLUDED / NOT INCLUDED / PAYMENT -->
            @if($destination->includes->count() > 0)
                <div class="mb-5">
                    <h2 class="text-3xl font-black text-[#002752] text-center mb-2 uppercase tracking-wider">Informações do pacote</h2>
                    <div class="w-24 h-1 bg-[#109e4a] mx-auto rounded mb-12"></div>
                    <div class="flex flex-row itens-center gap-4 justify-between">
                        <!-- Left Column: Includes -->
                        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm w-full">
                            <span class="inline-block bg-[#109e4a] text-white px-4 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider mb-6">
                                O Pacote Inclui
                            </span>
                            <ul class="space-y-4">
                                @foreach($destination->includes->where('type', 'included') as $include)
                                    <li class="flex items-start gap-3">
                                        <i class="fa-solid fa-circle-check text-[#109e4a] text-lg mt-0.5"></i>
                                        <span class="text-gray-700 text-sm font-medium leading-relaxed">{{ $include->text }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Right Column: Not Included & Payment -->
                        <div class="space-y-8 w-full flex flex-col justify-between gap-2">
                            <!-- Card: Not Included -->
                            @if($destination->includes->where('type', 'not_included')->count() > 0)
                            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm basis-1/2">
                                <span class="inline-block bg-[#c22e2e] text-white px-4 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider mb-6">
                                    Não Inclui no Pacote
                                </span>
                                <ul class="space-y-4">
                                    @foreach($destination->includes->where('type', 'not_included') as $include)
                                        <li class="flex items-start gap-3">
                                            <i class="fa-solid fa-circle-xmark text-[#c22e2e] text-lg mt-0.5"></i>
                                            <span class="text-gray-700 text-sm font-medium leading-relaxed">{{ $include->text }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <!-- Card: Formas de Pagamento -->
                            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm basis-1/2">
                                <span class="inline-block bg-[#002752] text-white px-4 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider mb-6">
                                    Valor do pacote e formas de Pagamento
                                </span>
                                <ul class="space-y-6">
                                    @foreach($destination->paymentMethods as $payMethod)
                                        <li class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-full bg-{{ $payMethod->method->icon_color == 'emerald' ? 'emerald' : 'blue' }}-50 flex items-center justify-center shrink-0">
                                                <i class="{{ $payMethod->method->icon }} text-{{ $payMethod->method->icon_color == 'emerald' ? 'emerald' : 'blue' }}-600 text-lg"></i>
                                            </div>
                                            <div>
                                                <p class="text-gray-700 text-xs font-semibold leading-relaxed">
                                                    {!! $payMethod->text !!}
                                                </p>
                                                @if($payMethod->subtext)
                                                    <p class="text-gray-500 text-[10px] mt-0.5">{!! $payMethod->subtext !!}</p>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- HIGHLIGHTS -->
            @if($destination->highlights->count() > 0)
                <!-- GLightbox CSS & JS -->
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
                <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

                <div class="mb-5">
                    <h2 class="text-3xl font-extrabold text-center text-[#002752] mb-2 uppercase">Conheça um pouco do destino</h2>
                    <div class="w-16 h-1 bg-[#109e4a] rounded mb-8 mx-auto"></div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($destination->highlights as $highlight)
                            <a href="{{ asset('storage/' . $highlight->image_path) }}"
                               class="glightbox group cursor-pointer block"
                               data-gallery="galeria-fotos"
                               data-title="{{ $highlight->title }}"
                               @if($highlight->subtitle) data-description="{{ $highlight->subtitle }}" @endif>
                                <div class="relative h-48 rounded-xl overflow-hidden mb-4">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition duration-500" 
                                         src="{{ asset('storage/' . $highlight->image_path) }}" 
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

            <!-- DEPOIMENTOS -->
            @if(isset($testimonials) && $testimonials->count() > 0)
                <div class="mb-5">
                    <h2 class="text-3xl font-black text-[#002752] text-center mb-2 uppercase tracking-wider">O que dizem nossos viajantes</h2>
                    <div class="w-24 h-1 bg-[#f3a908] mx-auto rounded mb-12"></div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($testimonials as $testimonial)
                            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-[0_4px_20px_rgb(0,0,0,0.04)] flex flex-col gap-4 hover:shadow-[0_8px_30px_rgb(0,0,0,0.07)] transition-shadow duration-300">
                                {{-- Estrelas --}}
                                <div class="flex items-center gap-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star text-sm {{ $i <= $testimonial->rating ? 'text-[#f3a908]' : 'text-gray-200' }}"></i>
                                    @endfor
                                </div>

                                {{-- Texto --}}
                                <p class="text-gray-600 text-sm leading-relaxed flex-1 italic">
                                    "{{ $testimonial->content }}"
                                </p>

                                {{-- Autor --}}
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

            <!-- ITINERARY -->
            @if($destination->itineraryDays->count() > 0)
                <!-- Swiper CSS & JS -->
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
                <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

                <style>
                    /* Styling to make a connecting line behind the day badges */
                    .timeline-wrapper {
                        position: relative;
                    }
                    .timeline-line {
                        position: absolute;
                        top: 28px;
                        left: 20px;
                        right: 20px;
                        height: 2px;
                        background: #e2e8f0;
                        z-index: 0;
                    }
                    .itinerarySwiper .swiper-wrapper {
    align-items: stretch;
}

.itinerarySwiper .swiper-slide {
    height: auto !important;
}
                </style>

                <div class="mb-5">
                    <h2 class="text-3xl font-black text-[#002752] text-center mb-2 uppercase tracking-wider">Cronograma da Viagem</h2>
                    <div class="w-24 h-1 bg-[#109e4a] mx-auto rounded mb-12"></div>

                    <!-- Single Card Container for Itinerary -->
                    <div class="bg-white border border-gray-100 rounded-3xl p-6 md:p-8 shadow-[0_8px_30px_rgb(0,0,0,0.02)]">
                        <div class="relative timeline-wrapper">
                            <!-- Horizontal Connecting Line (Desktop) -->
                            <div class="timeline-line hidden lg:block"></div>
                            
                            <!-- Swiper -->
                            <div class="swiper itinerarySwiper overflow-visible">
                                <div class="swiper-wrapper">
                                    @foreach($destination->itineraryDays as $day)
                                        <div class="swiper-slide h-full">
                                            <div class="flex flex-col justify-between h-full bg-slate-50/50 hover:bg-slate-50 border border-slate-100 hover:border-slate-200 rounded-2xl p-5 transition-all duration-300 relative z-10 group">
                                                <div>
                                                    <!-- Day Badge & Connector Node -->
                                                    <div class="flex items-center justify-between mb-4">
                                                        <span class="inline-block bg-[#109e4a] text-white px-3 py-1 rounded-md text-[10px] font-extrabold uppercase tracking-wider relative z-10">
                                                            Dia {{ $day->day_number }}
                                                        </span>
                                                        <!-- Small decorative node on the line -->
                                                        <div class="w-3.5 h-3.5 rounded-full border-2 border-[#109e4a] bg-white group-hover:bg-[#109e4a] transition-colors duration-300 hidden lg:block"></div>
                                                    </div>

                                                    <!-- Date -->
                                                    @if($day->date)
                                                        <p class="text-[#109e4a] font-bold text-xs mb-3">{{ $day->date }}</p>
                                                    @endif

                                                    <!-- Label / Title -->
                                                    <h3 class="text-sm font-extrabold text-[#002752] mb-3 leading-snug">{{ $day->label }}</h3>

                                                    <!-- Activities -->
                                                    @if($day->activities->count() > 0)
                                                        <ul class="space-y-2 mb-4">
                                                            @foreach($day->activities as $activity)
                                                                <li class="flex items-start gap-2 text-xs text-gray-600 font-medium">
                                                                    <span class="text-gray-400 font-bold">•</span>
                                                                    <span class="leading-relaxed">{{ $activity->activity }}</span>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>

                                                <!-- Day Image -->
                                                @if($day->image_path)
                                                    <div class="mt-4 overflow-hidden rounded-xl h-40 w-full shadow-inner border border-slate-100 shrink-0">
                                                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                                                             src="{{ asset('storage/' . $day->image_path) }}" 
                                                             alt="Dia {{ $day->day_number }}">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <!-- Swiper Navigation Buttons -->
                                <div class="swiper-button-next !text-white !w-11 !h-11 !bg-[#002752] hover:!bg-[#f3a908] hover:!text-[#002752] rounded-full shadow-md border border-[#002752]/20 after:!text-xs -right-4 md:-right-6 hover:scale-105 active:scale-95 transition-all duration-300"></div>
                                <div class="swiper-button-prev !text-white !w-11 !h-11 !bg-[#002752] hover:!bg-[#f3a908] hover:!text-[#002752] rounded-full shadow-md border border-[#002752]/20 after:!text-xs -left-4 md:-left-6 hover:scale-105 active:scale-95 transition-all duration-300"></div>
                                
                                <!-- Swiper Pagination -->
                                <div class="swiper-pagination !-bottom-8"></div>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-500 text-xs text-left font-semibold leading-relaxed">
                        (Cronograma sujeito a alteração)
                    </p>
                    
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const swiper = new Swiper('.itinerarySwiper', {
                            slidesPerView: 1,
                            spaceBetween: 24,
                            grabCursor: true,
                            navigation: {
                                nextEl: '.swiper-button-next',
                                prevEl: '.swiper-button-prev',
                            },
                            pagination: {
                                el: '.swiper-pagination',
                                clickable: true,
                                dynamicBullets: true,
                            },
                            breakpoints: {
                                640: {
                                    slidesPerView: 2,
                                },
                                1024: {
                                    slidesPerView: 3,
                                },
                                1280: {
                                    slidesPerView: 4,
                                },
                                1536: {
                                    slidesPerView: 5,
                                }
                            }
                        });
                    });
                </script>
            @endif

            <!-- OBSERVAÇÕES -->
            @if($destination->observations->count() > 0)
                <div class="mb-5">
                    <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6 md:p-8">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-full bg-amber-100 flex items-center justify-center shrink-0">
                                <i class="fas fa-triangle-exclamation text-amber-600 text-sm"></i>
                            </div>
                            <div>
                                <h2 class="text-base font-black text-amber-800 uppercase tracking-wider">Observações Importantes</h2>
                                <p class="text-xs text-amber-600/70 mt-0.5">Leia com atenção antes de reservar.</p>
                            </div>
                        </div>
                        <ul class="space-y-3">
                            @foreach($destination->observations as $observation)
                                <li class="flex items-start gap-3">
                                    <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-amber-400 shrink-0"></span>
                                    <span class="text-sm text-amber-900 font-medium leading-relaxed">{{ $observation->text }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- PAYMENT INFO -->
            <div class="bg-gradient-to-br from-[#109e4a] to-[#0b803a] rounded-2xl p-8 sm:p-12 text-white">
                <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-black mb-4">Parcelamento Facilitado no Boleto</h2>
                        <ul class="space-y-3 text-sm">
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check-circle text-[#f3a908]"></i>
                                <span>Sem consulta ao SPC/Serasa</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check-circle text-[#f3a908]"></i>
                                <span>Você escolhe a melhor data para pagar</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check-circle text-[#f3a908]"></i>
                                <span>Mais liberdade para planejar sua viagem</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="text-center">
                        <div class="text-4xl font-black mb-2">{{ $fullPrice }} <span class="text-sm uppercase font-medium text-green-100">por pessoa</span></div>
                        
                        <a href="{{ $whatsappUrl }}" target="_blank" class="mt-4 inline-flex items-center justify-center bg-white text-[#002752] font-bold text-sm uppercase py-3 px-6 rounded-lg hover:bg-gray-100 transition duration-200 gap-2">
                            <i class="fab fa-whatsapp text-lg"></i>
                            <span>Falar com consultor</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection