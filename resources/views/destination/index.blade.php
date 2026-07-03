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
                Nossos <span class="text-[#f3a908] bg-gradient-to-r from-[#f3a908] to-[#ffda66] bg-clip-text text-transparent">Pacotes de Viagem</span>
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

                    <x-card-pacotes :pkg="$destination" :whatsappUrl="$destWhatsapp" />
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