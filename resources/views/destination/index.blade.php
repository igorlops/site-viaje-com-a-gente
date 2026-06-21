@extends('layouts.pacotes')

@section('title', 'Viaje com a Gente - Pacotes')

@section('content')
    @php
        $whatsappUrl = isset($socialLinks['whatsapp']) ? $socialLinks['whatsapp']->url : 'https://wa.me/5585999166421';
    @endphp

    {{-- ══════════════════════════════════════════
         HERO SECTION (Topo Escuro Premium)
         ══════════════════════════════════════════ --}}
    <section class="relative bg-[#001c3d] pt-32 pb-24 w-full overflow-hidden">
        {{-- Gradientes e Brilhos Decorativos de Fundo --}}
        <div class="absolute inset-0 bg-gradient-to-b from-[#001c3d] to-[#001126]"></div>
        <div class="absolute -top-40 -right-40 w-[600px] h-[600px] rounded-full pointer-events-none opacity-20"
             style="background: radial-gradient(circle, #109e4a 0%, transparent 70%);"></div>
        <div class="absolute inset-0 opacity-10"
             style="background-image: radial-gradient(rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 24px 24px;">
        </div>

        <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 text-center md:text-left">
            {{-- Eyebrow --}}
            <span class="inline-flex items-center gap-2 mb-6 px-4 py-1.5 rounded-full text-[11px] font-bold tracking-widest uppercase text-[#4ecb81] bg-[#109e4a]/10 border border-[#109e4a]/20">
                <i class="fas fa-globe-americas text-[10px]"></i>
                Viva Novas Experiências
            </span>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black leading-tight tracking-tight text-white mb-4">
                Nossos <span class="text-[#f2bd11] bg-gradient-to-r from-[#f2bd11] to-[#ffda66] bg-clip-text text-transparent">Pacotes de Viagem</span>
            </h1>

            <p class="text-base sm:text-lg text-slate-400 max-w-xl leading-relaxed">
                Explore os melhores destinos nacionais e internacionais. Escolha o roteiro perfeito e prepare as malas!
            </p>
        </div>
    </section>

    {{-- ══════════════════════════════════════════
         BARRA DE FILTROS FLUTUANTE
         ══════════════════════════════════════════ --}}
    <div class="relative z-20 container mx-auto px-4 sm:px-6 lg:px-8 -mt-10">
        <div class="bg-white rounded-2xl p-5 shadow-[0_15px_50px_-12px_rgba(0,28,61,0.12)] border border-slate-100">
            <form action="{{ route('destination') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                
                {{-- Busca por Texto --}}
                <div class="md:col-span-6 lg:col-span-7">
                    <label for="search" class="block text-[10px] font-extrabold tracking-wider uppercase text-slate-400 mb-2">O que você está procurando?</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fas fa-search text-xs"></i>
                        </span>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                               placeholder="Ex: Rio de Janeiro, Bate e volta, Gramado..."
                               class="w-full bg-slate-50 border border-slate-200 text-slate-800 placeholder-slate-400 rounded-xl pl-10 pr-4 py-3 text-sm focus:outline-none focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/5 transition-all">
                    </div>
                </div>

                {{-- Tipo/Categoria --}}
                <div class="md:col-span-3 lg:col-span-3">
                    <label for="type" class="block text-[10px] font-extrabold tracking-wider uppercase text-slate-400 mb-2">Categoria</label>
                    <select name="type" id="type"
                            class="w-full bg-slate-50 border border-slate-200 text-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/5 transition-all appearance-none cursor-pointer">
                        <option value="">Todos os Tipos</option>
                        <option value="pacotes-2026-2027" {{ request('type') === 'pacotes-2026-2027' ? 'selected' : '' }}>Pacotes 2026-2027</option>
                        <option value="bate-e-volta" {{ request('type') === 'bate-e-volta' ? 'selected' : '' }}>Bate e Volta</option>
                        <option value="viagem-em-grupo" {{ request('type') === 'viagem-em-grupo' ? 'selected' : '' }}>Viagem em Grupo</option>
                    </select>
                </div>

                {{-- Botões de Ação --}}
                <div class="md:col-span-3 lg:col-span-2 flex gap-2">
                    <button type="submit" class="flex-1 bg-[#001c3d] hover:bg-[#001126] text-white text-xs font-bold tracking-wider uppercase py-3.5 rounded-xl transition-all shadow-md shadow-blue-900/10">
                        Buscar
                    </button>
                    @if(request('search') || request('type'))
                        <a href="{{ route('destination') }}" title="Limpar Filtros"
                           class="bg-slate-100 hover:bg-slate-200 text-slate-600 p-3.5 rounded-xl transition-all flex items-center justify-center">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- ══════════════════════════════════════════
         CONTEÚDO PRINCIPAL (Grid de Pacotes)
         ══════════════════════════════════════════ --}}
    <section class="bg-slate-50 pt-16 pb-24 w-full">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
                @forelse($destinations as $destination)
                    @php
                        $destWhatsapp = $destination->whatsapp_link
                            ?: $whatsappUrl . '?text=' . urlencode('Olá! Gostaria de saber mais detalhes sobre o pacote: ' . $destination->title);
                    @endphp

                    {{-- CARD PREMIUM --}}
                    <div class="group bg-white rounded-2xl overflow-hidden flex flex-col border border-slate-100 shadow-[0_4px_20px_rgba(0,28,61,0.03)] hover:shadow-[0_20px_40px_rgba(0,28,61,0.1)] hover:-translate-y-1.5 transition-all duration-300">
                        
                        {{-- Imagem de Capa do Destino --}}
                        <div class="relative h-56 overflow-hidden shrink-0 bg-slate-100">
                            <img src="{{ asset('storage/' . $destination->image_path) }}"
                                 alt="{{ $destination->title }}"
                                 loading="lazy"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">

                            {{-- Gradiente Suave sobre a Foto --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                            {{-- Badge de Categoria/Tag customizada --}}
                            @if($destination->tag)
                                <span class="absolute top-3 left-3 bg-[#f2bd11] text-[#001c3d] text-[9px] font-black tracking-widest uppercase px-2.5 py-1 rounded-md shadow-sm">
                                    {{ $destination->tag }}
                                </span>
                            @endif

                            {{-- Título fixado na base da Imagem --}}
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <h3 class="text-xl font-black leading-tight tracking-tight drop-shadow-md">
                                    {{ $destination->title }}
                                </h3>
                                @if($destination->subtitle)
                                    <p class="text-xs text-slate-200/90 font-medium tracking-wide mt-1 truncate">
                                        {{ $destination->subtitle }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        {{-- Corpo Técnico (Informações de Roteiro) --}}
                        <div class="flex flex-col flex-grow p-5">
                            
                            {{-- Informações de Duração e Segmento --}}
                            <div class="grid grid-cols-2 gap-2 py-2.5 px-3 bg-slate-50 rounded-xl mb-4 text-slate-600">
                                <div class="flex items-center gap-2 text-[11px] font-bold uppercase tracking-wide min-w-0">
                                    <i class="far fa-clock text-[#109e4a] text-xs shrink-0"></i>
                                    <span class="truncate">{{ $destination->duration }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-[11px] font-bold uppercase tracking-wide min-w-0 justify-end border-l border-slate-200 pl-2">
                                    <i class="fas fa-map-marker-alt text-[#109e4a] text-xs shrink-0"></i>
                                    <span class="truncate">{{ $destination->category }}</span>
                                </div>
                            </div>

                            {{-- Divisor Estilo Ticket de Embarque (Boarding Pass) --}}
                            <div class="flex items-center -mx-5 mb-4 relative">
                                <div class="w-4 h-4 rounded-full bg-slate-50 -ml-2 shrink-0 border border-slate-100 shadow-[inner_2px_0_4px_rgba(0,0,0,0.05)]"></div>
                                <div class="flex-1 border-t-2 border-dashed border-slate-200 mx-1"></div>
                                <div class="w-4 h-4 rounded-full bg-slate-50 -mr-2 shrink-0 border border-slate-100 shadow-[inner_-2px_0_4px_rgba(0,0,0,0.05)]"></div>
                            </div>

                            {{-- Preço e Condições comerciais --}}
                            <div class="mt-auto mb-5">
                                <span class="block text-[9px] font-extrabold tracking-widest uppercase text-slate-400 mb-0.5">Investimento</span>
                                <div class="flex items-baseline gap-1 leading-none">
                                    <span class="text-slate-400 text-xs font-bold">R$</span>
                                    <span class="text-[#109e4a] text-3xl font-black tracking-tight">
                                        {{ number_format($destination->price, 2, ',', '.') }}
                                    </span>
                                    <span class="text-slate-400 text-xs font-semibold">/parc</span>
                                </div>
                                <span class="inline-flex items-center gap-1 text-[9px] font-bold text-slate-400 uppercase tracking-wide mt-1 bg-slate-100 px-2 py-0.5 rounded">
                                    <i class="fas fa-barcode text-[10px]"></i> Facilidade no boleto
                                </span>
                            </div>

                            {{-- Ações do Card --}}
                            <div class="flex gap-2">
                                <a href="{{ route('destination.show', $destination->slug) }}" target="_blank"
                                   class="flex-1 inline-flex items-center justify-center gap-2 bg-[#001c3d] hover:bg-[#001126] text-white text-xs font-bold tracking-wider uppercase py-3.5 rounded-xl transition-colors duration-200">
                                    Ver Detalhes
                                    <i class="fas fa-arrow-right text-[10px]"></i>
                                </a>
                                <a href="{{ $destWhatsapp }}" target="_blank" aria-label="Fale Conosco pelo WhatsApp"
                                   class="w-12 h-12 flex items-center justify-center shrink-0 border border-emerald-500 text-emerald-500 hover:bg-emerald-500 hover:text-white rounded-xl transition-all text-xl shadow-sm">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                @empty
                    {{-- Estado Vazio --}}
                    <div class="col-span-full text-center py-16 bg-white rounded-2xl border border-slate-100 p-8">
                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400">
                            <i class="fas fa-map-marked-alt text-2xl"></i>
                        </div>
                        <h4 class="text-slate-800 font-bold text-base">Nenhum roteiro encontrado</h4>
                        <p class="text-slate-400 text-xs mt-1 max-w-xs mx-auto">Tente ajustar seus termos de busca ou mude a categoria selecionada.</p>
                    </div>
                @endforelse
            </div>

            {{-- Links de Paginação --}}
            @if($destinations->hasPages())
                <div class="mb-12 bg-white border border-slate-100 rounded-2xl p-4 flex justify-center shadow-sm">
                    {{ $destinations->appends(request()->query())->links() }}
                </div>
            @endif

            {{-- ══════════════════════════════════════════
                 CTA FINAL (Suporte Geral)
                 ══════════════════════════════════════════ --}}
            <div class="bg-gradient-to-r from-[#001c3d] to-[#001126] rounded-3xl p-8 lg:p-12 text-center relative overflow-hidden shadow-xl">
                <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full pointer-events-none opacity-10 bg-[#109e4a]" style="filter: blur(40px)"></div>
                
                <div class="relative z-10 max-w-2xl mx-auto">
                    <h3 class="text-2xl sm:text-3xl font-black text-white mb-2">Não achou o destino dos seus sonhos?</h3>
                    <p class="text-slate-400 text-sm sm:text-base mb-8">Monte um roteiro personalizado 100% sob medida com a nossa equipe especializada de consultores.</p>
                    
                    <a href="{{ $whatsappUrl }}" target="_blank"
                       class="inline-flex items-center gap-3 bg-[#109e4a] hover:bg-[#0d8c40] text-white text-xs font-black tracking-widest uppercase px-8 py-4 rounded-xl transition-all transform hover:-translate-y-0.5 shadow-lg shadow-emerald-900/20">
                        <i class="fab fa-whatsapp text-lg"></i>
                        Falar com Consultor no WhatsApp
                    </a>
                </div>
            </div>

        </div>
    </section>
@endsection