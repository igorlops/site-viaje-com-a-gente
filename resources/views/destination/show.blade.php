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
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full pb-12 z-10">
            <div class="text-white">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black mb-4">
                    {{ $destination->title }}
                </h1>
                
                @if($destination->subtitle)
                    <p class="text-xl sm:text-2xl text-gray-200 mb-6">
                        {{ $destination->subtitle }}
                    </p>
                @endif

                <div class="flex flex-wrap items-center gap-6 mb-6">
                    @if($destination->date_range)
                        <div class="flex items-center gap-2">
                            <i class="far fa-calendar-alt text-[#f2bd11] text-xl"></i>
                            <span class="text-lg font-semibold">{{ $destination->date_range }}</span>
                        </div>
                    @endif
                    
                    <div class="text-3xl font-black text-[#f2bd11]">
                        {{ $fullPrice }}
                        <span class="text-sm font-medium text-gray-300">/por pessoa</span>
                    </div>
                </div>

                <a href="{{ $whatsappUrl }}" target="_blank" class="inline-flex items-center bg-[#109e4a] hover:bg-[#0d9648] text-white font-bold text-sm uppercase py-4 px-8 rounded-lg transition duration-200 gap-2 shadow-lg">
                    <i class="fab fa-whatsapp text-xl"></i>
                    <span>Falar com consultor</span>
                </a>
            </div>
        </div>
    </section>

    <!-- QUICK INFO BAR -->
    <section class="bg-[#002752] text-white py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 text-center">
                @if($destination->trip_type)
                    <div class="border-r border-[#003a66] pr-4">
                        <span class="block text-xs text-gray-400 uppercase mb-1">Tipo</span>
                        <span class="font-bold text-sm">{{ $destination->trip_type }}</span>
                    </div>
                @endif
                
                @if($destination->departure_city)
                    <div class="border-r border-[#003a66] pr-4">
                        <span class="block text-xs text-gray-400 uppercase mb-1">Origem</span>
                        <span class="font-bold text-sm">{{ $destination->departure_city }}</span>
                    </div>
                @endif
                @if($destination->departure_date)
                    <div class="border-r border-[#003a66] pr-4">
                        <span class="block text-xs text-gray-400 uppercase mb-1">Saída</span>
                        <span class="font-bold text-sm">{{ $destination->departure_date }}</span>
                    </div>
                @endif
                
                @if($destination->return_date)
                    <div class="border-r border-[#003a66] pr-4">
                        <span class="block text-xs text-gray-400 uppercase mb-1">Retorno</span>
                        <span class="font-bold text-sm">{{ $destination->return_date }}</span>
                    </div>
                @endif
                
                @if($destination->nights)
                    <div>
                        <span class="block text-xs text-gray-400 uppercase mb-1">Duração</span>
                        <span class="font-bold text-sm">{{ $destination->nights }}</span>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <div class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- WHAT IS INCLUDED / NOT INCLUDED -->
            @if($destination->includes->count() > 0)
                <div class="mb-20">
                    <h2 class="text-3xl font-extrabold text-[#002752] mb-2">O que está incluso</h2>
                    <div class="w-16 h-1 bg-[#109e4a] rounded mb-8"></div>
                    
                    <div class="grid md:grid-cols-2 gap-12">
                        <!-- Included -->
                        <div>
                            <h3 class="text-lg font-bold text-[#109e4a] mb-4 flex items-center gap-2">
                                <i class="fas fa-check-circle"></i>
                                <span>Incluso no Pacote</span>
                            </h3>
                            <ul class="space-y-3">
                                @foreach($destination->includes->where('type', 'included') as $include)
                                    <li class="flex items-start gap-3">
                                        <i class="fas fa-check text-[#109e4a] mt-1"></i>
                                        <span class="text-gray-700">{{ $include->text }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Not Included -->
                        @if($destination->includes->where('type', 'not_included')->count() > 0)
                            <div>
                                <h3 class="text-lg font-bold text-red-500 mb-4 flex items-center gap-2">
                                    <i class="fas fa-times-circle"></i>
                                    <span>Não Incluso</span>
                                </h3>
                                <ul class="space-y-3">
                                    @foreach($destination->includes->where('type', 'not_included') as $include)
                                        <li class="flex items-start gap-3">
                                            <i class="fas fa-times text-red-500 mt-1"></i>
                                            <span class="text-gray-700">{{ $include->text }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- HIGHLIGHTS -->
            @if($destination->highlights->count() > 0)
                <div class="mb-20">
                    <h2 class="text-3xl font-extrabold text-[#002752] mb-2">Destaques da Viagem</h2>
                    <div class="w-16 h-1 bg-[#109e4a] rounded mb-8"></div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($destination->highlights as $highlight)
                            <div class="group cursor-pointer">
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
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- ITINERARY -->
            @if($destination->itineraryDays->count() > 0)
                <div class="mb-20">
                    <h2 class="text-3xl font-extrabold text-[#002752] mb-2">Cronograma da Viagem</h2>
                    <div class="w-16 h-1 bg-[#109e4a] rounded mb-8"></div>
                    
                    <div class="space-y-8">
                        @foreach($destination->itineraryDays as $day)
                            <div class="border border-gray-200 rounded-xl p-6">
                                <div class="flex items-center gap-4 mb-4">
                                    <span class="w-12 h-12 rounded-full bg-[#002752] text-white flex items-center justify-center font-bold text-lg">
                                        {{ $day->day_number }}
                                    </span>
                                    <div>
                                        <h3 class="text-xl font-bold text-[#002752]">{{ $day->label ?? 'Dia ' . $day->day_number }}</h3>
                                        @if($day->date)
                                            <p class="text-gray-500">{{ $day->date }}</p>
                                        @endif
                                    </div>
                                </div>
                                
                                @if($day->activities->count() > 0)
                                    <ul class="space-y-2 ml-16">
                                        @foreach($day->activities as $activity)
                                            <li class="flex items-start gap-2">
                                                <i class="fas fa-circle text-[#109e4a] text-xs mt-1.5"></i>
                                                <span class="text-gray-700">{{ $activity->activity }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endforeach
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
                                <i class="fas fa-check-circle text-[#f2bd11]"></i>
                                <span>Sem consulta ao SPC/Serasa</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check-circle text-[#f2bd11]"></i>
                                <span>Você escolhe a melhor data para pagar</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check-circle text-[#f2bd11]"></i>
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