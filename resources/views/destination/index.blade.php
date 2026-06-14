@extends('layouts.site')

@section('title', 'Viaje com a Gente - Pacotes')

@section('content')
    @php
        $whatsappUrl = isset($socialLinks['whatsapp']) ? $socialLinks['whatsapp']->url : 'https://wa.me/5585999166421';
    @endphp

    {{-- ══════════════════════════════════════════
         HERO
    ══════════════════════════════════════════ --}}
    <section class="relative min-h-[600px] bg-cover bg-center flex items-end w-full overflow-hidden">

        {{-- Overlay gradiente --}}
        <div class="absolute inset-0 bg-gradient-to-t from-[#001c3d] via-[#001c3d]/80 to-[#001c3d]/30"></div>

        {{-- Brilho verde decorativo --}}
        <div class="absolute -top-24 -right-32 w-[500px] h-[500px] rounded-full pointer-events-none"
             style="background: radial-gradient(circle, rgba(16,158,74,0.15) 0%, transparent 70%);">
        </div>

        {{-- Textura sutil de pontos --}}
        <div class="absolute inset-0 opacity-30"
             style="background-image: radial-gradient(rgba(255,255,255,0.07) 1px, transparent 1px); background-size: 28px 28px;">
        </div>

        <div class="relative z-10 w-full">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 pb-14 pt-32">

                {{-- Eyebrow --}}
                <span class="inline-flex items-center gap-2 mb-5 px-4 py-1.5 rounded-full
                             text-[11px] font-bold tracking-widest uppercase
                             text-[#4ecb81] bg-[#109e4a]/15 border border-[#109e4a]/30">
                    <i class="fas fa-plane-departure text-[10px]"></i>
                    Melhores destinos
                </span>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black leading-[1.08] tracking-tight text-white mb-4">
                    Nossos <span class="text-[#f2bd11]">Pacotes</span>
                </h1>

                <p class="text-lg sm:text-xl text-slate-400 max-w-xl leading-relaxed mb-8">
                    Confira nossos pacotes de viagem e encontre o destino perfeito para você!
                </p>

                {{-- ── Filtros e Busca ── --}}
                <div class="mb-10 bg-slate-900/60 backdrop-blur-md border border-slate-800 rounded-2xl p-5 shadow-2xl">
                    <form action="{{ route('destination') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                        <div class="flex-1 w-full">
                            <label for="search" class="block text-[11px] font-bold tracking-widest uppercase text-slate-400 mb-2">Buscar por Nome/Categoria</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" name="search" id="search" value="{{ request('search') }}"
                                       placeholder="Ex: Rio de Janeiro, Bate e volta..."
                                       class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl pl-10 pr-4 py-3 text-sm focus:outline-none focus:border-[#109e4a] focus:ring-1 focus:ring-[#109e4a] transition-all">
                            </div>
                        </div>

                        <div class="w-full md:w-64">
                            <label for="type" class="block text-[11px] font-bold tracking-widest uppercase text-slate-400 mb-2">Filtrar por Tipo</label>
                            <select name="type" id="type"
                                    class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#109e4a] focus:ring-1 focus:ring-[#109e4a] transition-all">
                                <option value="">Todos os Tipos</option>
                                <option value="pacotes-2026-2027" {{ request('type') === 'pacotes-2026-2027' ? 'selected' : '' }}>Pacotes 2026-2027</option>
                                <option value="bate-e-volta" {{ request('type') === 'bate-e-volta' ? 'selected' : '' }}>Bate e Volta</option>
                                <option value="viagem-em-grupo" {{ request('type') === 'viagem-em-grupo' ? 'selected' : '' }}>Viagem em Grupo</option>
                            </select>
                        </div>

                        <div class="flex gap-2 w-full md:w-auto shrink-0">
                            <button type="submit"
                                    class="flex-1 md:flex-none bg-[#109e4a] hover:bg-[#0d8c40] text-white text-xs font-extrabold tracking-widest uppercase px-6 py-3.5 rounded-xl transition-all duration-200">
                                Filtrar
                            </button>
                            @if(request('search') || request('type'))
                                <a href="{{ route('destination') }}"
                                   class="flex-1 md:flex-none bg-slate-800 hover:bg-slate-700 text-white text-xs font-extrabold tracking-widest uppercase px-6 py-3.5 rounded-xl transition-all duration-200 text-center flex items-center justify-center">
                                    Limpar
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                {{-- ── Grid de cards ── --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 mb-10">

                    @forelse($destinations as $destination)
                        @php
                            $destWhatsapp = $destination->whatsapp_link
                                ?: $whatsappUrl . '?text=' . urlencode('Olá, gostaria de mais informações sobre o pacote ' . $destination->title);
                        @endphp

                        {{-- CARD --}}
                        <div class="group bg-white rounded-2xl overflow-hidden flex flex-col
                                    shadow-[0_2px_10px_rgba(0,28,61,0.08)]
                                    hover:shadow-[0_14px_40px_rgba(0,28,61,0.18)]
                                    hover:-translate-y-1.5 transition-all duration-300">

                            {{-- Imagem --}}
                            <div class="relative h-48 overflow-hidden shrink-0">
                                <img src="{{ asset('storage/' . $destination->image_path) }}"
                                     alt="{{ $destination->title }}"
                                     loading="lazy"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                                {{-- Overlay na imagem --}}
                                <div class="absolute inset-0"
                                     style="background: linear-gradient(to top, rgba(0,28,61,0.65) 0%, transparent 55%);">
                                </div>

                                {{-- Tag --}}
                                @if($destination->tag)
                                    <span class="absolute top-3 left-3 bg-[#f2bd11] text-[#001c3d]
                                                 text-[10px] font-extrabold tracking-widest uppercase
                                                 px-2.5 py-1 rounded-md shadow-sm">
                                        {{ $destination->tag }}
                                    </span>
                                @endif

                                {{-- Nome em destaque sobre a foto --}}
                                <div class="absolute bottom-3 left-3 right-3 text-white">
                                    <div class="text-xl font-black leading-tight tracking-tight drop-shadow">
                                        {{ $destination->title }}
                                    </div>
                                    @if($destination->subtitle)
                                        <div class="text-[11px] font-medium opacity-70 tracking-wide mt-0.5 truncate">
                                            {{ $destination->subtitle }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Corpo do card --}}
                            <div class="flex flex-col flex-grow p-5">

                                {{-- Meta: duração e categoria --}}
                                <div class="flex items-center gap-2.5 py-2
                                            border-y border-dashed border-slate-200 mb-4">
                                    <div class="flex items-center gap-1.5 text-[11px] font-bold
                                                uppercase tracking-wide text-slate-500">
                                        <i class="far fa-calendar-alt text-[#109e4a]"></i>
                                        {{ $destination->duration }}
                                    </div>
                                    <div class="w-px h-3.5 bg-slate-200"></div>
                                    <div class="flex items-center gap-1.5 text-[11px] font-bold
                                                uppercase tracking-wide text-slate-500 min-w-0">
                                        <i class="fas fa-plane-departure text-[#109e4a] text-[10px]"></i>
                                        <span class="truncate">{{ $destination->category }}</span>
                                    </div>
                                </div>

                                {{-- Perfuração (boarding pass) --}}
                                <div class="flex items-center -mx-5 px-3 mb-4">
                                    <div class="w-[18px] h-[18px] rounded-full bg-slate-50 -ml-[9px] shrink-0 z-10 border border-slate-100"></div>
                                    <div class="flex-1 border-t-2 border-dashed border-slate-200"></div>
                                    <div class="w-[18px] h-[18px] rounded-full bg-slate-50 -mr-[9px] shrink-0 z-10 border border-slate-100"></div>
                                </div>

                                {{-- Preço --}}
                                <div class="mt-auto mb-4">
                                    <span class="block text-[10px] font-bold tracking-widest uppercase text-slate-400 mb-0.5">
                                        A partir de
                                    </span>
                                    <div class="flex items-baseline gap-0.5 leading-none">
                                        <span class="text-[#109e4a] text-xs font-extrabold relative -top-0.5">R$</span>
                                        <span class="text-[#109e4a] text-[26px] font-black tracking-tight">
                                            {{ number_format($destination->price, 2, ',', '.') }}
                                        </span>
                                        <span class="text-[#109e4a] text-xs font-bold opacity-75">/mês</span>
                                    </div>
                                    <span class="block text-[10px] font-bold tracking-widest uppercase text-slate-300 mt-0.5">
                                        No boleto
                                    </span>
                                </div>

                                {{-- Ações --}}
                                <div class="flex gap-2">
                                    <a href="{{ route('destination.show', $destination->slug) }}" target="_blank"
                                       class="flex-1 inline-flex items-center justify-center gap-1.5
                                              bg-[#109e4a] hover:bg-[#0d8c40] text-white
                                              text-[11px] font-extrabold tracking-widest uppercase
                                              py-3 rounded-xl transition-colors duration-200">
                                        Ver Pacote
                                        <i class="fas fa-chevron-right text-[9px]"></i>
                                    </a>
                                    <a href="{{ $destWhatsapp }}" target="_blank" aria-label="WhatsApp"
                                       class="w-11 h-11 flex items-center justify-center shrink-0
                                              border-[1.5px] border-[#109e4a] text-[#109e4a]
                                              hover:bg-[#109e4a] hover:text-white
                                              rounded-xl transition-colors duration-200 text-lg">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </div>

                            </div>
                        </div>

                    @empty
                        <div class="col-span-full text-center py-16 text-slate-400">
                            <i class="fas fa-map-marked-alt text-4xl block mb-3 opacity-40"></i>
                            Nenhum pacote encontrado com os filtros selecionados.
                        </div>
                    @endforelse

                </div>

                {{-- ── Paginação ── --}}
                @if($destinations->hasPages())
                    <div class="mb-10 bg-slate-900/40 backdrop-blur-sm border border-slate-800/60 rounded-xl p-4 flex justify-center">
                        {{ $destinations->appends(request()->query())->links() }}
                    </div>
                @endif

                {{-- CTA WhatsApp --}}
                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <a href="{{ $whatsappUrl }}" target="_blank"
                       class="inline-flex items-center gap-2.5 bg-[#109e4a] hover:bg-[#0d8c40] text-white
                              text-sm font-extrabold tracking-widest uppercase px-8 py-4 rounded-xl
                              transition-all duration-200 hover:-translate-y-0.5 shadow-xl">
                        <i class="fab fa-whatsapp text-xl"></i>
                        Solicitar Orçamento
                    </a>
                </div>

            </div>
        </div>
    </section>

@endsection
