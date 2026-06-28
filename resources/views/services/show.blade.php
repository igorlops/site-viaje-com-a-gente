@extends('layouts.servico')

@section('title', ($service->meta_title ?: $service->title) . ' - Viaje com a Gente')

@section('meta')
    @if($service->meta_description)
        <meta name="description" content="{{ $service->meta_description }}">
    @endif
    @if($service->meta_keywords)
        <meta name="keywords" content="{{ $service->meta_keywords }}">
    @endif

    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $service->og_title ?: $service->meta_title ?: $service->title }}">
    <meta property="og:description" content="{{ $service->og_description ?: $service->meta_description ?: $service->summary }}">
    <meta property="og:type" content="website">
    @if($service->og_image)
        <meta property="og:image" content="{{ asset('storage/' . $service->og_image) }}">
    @elseif($service->banner_path)
        <meta property="og:image" content="{{ asset('storage/' . $service->banner_path) }}">
    @endif
    <style>
        /* Customização para renderizar o Markdown corretamente */
        .conteudo-markdown h1 {
            font-size: 2.25rem !important;
            font-weight: 700 !important;
            margin-top: 1.5rem !important;
            margin-bottom: 1rem !important;
            display: block !important;
        }

        .conteudo-markdown h2 {
            font-size: 1.75rem !important;
            font-weight: 600 !important;
            margin-top: 1.5rem !important;
            margin-bottom: 0.75rem !important;
            display: block !important;
        }

        .conteudo-markdown h3 {
            font-size: 1.35rem !important;
            font-weight: 600 !important;
            margin-top: 1.25rem !important;
            margin-bottom: 0.5rem !important;
            display: block !important;
        }

        .conteudo-markdown p {
            margin-bottom: 1rem !important;
            line-height: 1.6 !important;
            color: #333333 !important;
        }

        .conteudo-markdown ul {
            list-style-type: disc !important;
            padding-left: 1.5rem !important;
            margin-bottom: 1rem !important;
        }

        .conteudo-markdown ol {
            list-style-type: decimal !important;
            padding-left: 1.5rem !important;
            margin-bottom: 1rem !important;
        }

        .conteudo-markdown li {
            margin-bottom: 0.25rem !important;
        }

        .conteudo-markdown hr {
            margin: 2rem 0 !important;
            border: 0 !important;
            border-top: 1px solid #e2e8f0 !important;
        }
    </style>
@endsection

@section('content')
    @php
        $whatsappUrl = isset($socialLinks['whatsapp']) ? $socialLinks['whatsapp']->url : 'https://wa.me/5585999166421';
        $whatsappQuoteUrl = $whatsappUrl . '?text=Olá!%20Tenho%20interesse%20no%20serviço%20de%20' . urlencode($service->title) . '.%20Pode%20me%20dar%20mais%20informações?';
    @endphp

    {{-- ═══════════════════════════════════════════════════════
         HERO BANNER
    ═══════════════════════════════════════════════════════ --}}
    <section class="relative overflow-hidden"
        style="min-height: 600px; display: flex; align-items: flex-end;">

        {{-- Imagem de fundo --}}
        @if($service->banner_path)
            <div class="absolute inset-0 bg-cover bg-center"
                 style="background-image: url('{{ asset('storage/' . $service->banner_path) }}');"></div>
        @else
            <div class="absolute inset-0" style="background: linear-gradient(135deg, #001c3d 0%, #003a6e 100%);"></div>
        @endif

        {{-- Overlay escuro gradiente --}}
        <div class="absolute inset-0" style="background: linear-gradient(to top, #001c3d 30%, rgba(0,28,61,0.55) 65%, rgba(0,28,61,0.15) 100%);"></div>

        {{-- Conteúdo hero --}}
        <div class="relative w-full z-10" style="padding: 0 1rem 4rem;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                {{-- Breadcrumb --}}
                <nav class="flex items-center gap-2 mb-6" style="font-size: 12px; color: rgba(255,255,255,0.55);">
                    <a href="{{ route('home') }}" class="hover:text-[#f2bd11] transition-colors duration-200">Início</a>
                    <i class="fas fa-chevron-right" style="font-size: 9px;"></i>
                    <a href="{{ route('services') }}" class="hover:text-[#f2bd11] transition-colors duration-200">Nossos Serviços</a>
                    <i class="fas fa-chevron-right" style="font-size: 9px;"></i>
                    <span style="color: rgba(255,255,255,0.85);">{{ $service->title }}</span>
                </nav>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-end">
                    <div>
                        {{-- Badge de serviço --}}
                        <span class="inline-flex items-center gap-2 mb-5 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest"
                              style="background: rgba(242,189,17,0.18); color: #f2bd11; border: 1px solid rgba(242,189,17,0.35);">
                            <i class="fas fa-concierge-bell"></i>
                            Nossos Serviços
                        </span>

                        <h1 class="font-black text-white leading-tight mb-4"
                            style="font-size: clamp(2.2rem, 5vw, 3.5rem); text-shadow: 0 2px 20px rgba(0,0,0,0.4);">
                            {{ $service->title }}
                        </h1>

                        @if($service->subtitle)
                            <p class="mb-5 leading-relaxed" style="font-size: 1.2rem; color: rgba(255,255,255,0.8);">
                                {{ $service->subtitle }}
                            </p>
                        @endif

                        @if($service->summary)
                            <div class="mb-8 leading-relaxed" style="font-size: 0.97rem; color: rgba(255,255,255,0.7); max-width: 560px;
                                [&_p]:m-0 [&_a]:text-[#f2bd11] [&_strong]:text-white">
                                {!! \Illuminate\Support\Str::markdown($service->summary, [
                                    'html_input' => 'strip',
                                    'allow_unsafe_links' => false,
                                ]) !!}
                            </div>
                        @endif

                        {{-- CTAs hero --}}
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ $whatsappUrl }}" target="_blank"
                               class="inline-flex items-center gap-2.5 font-bold uppercase transition-all duration-200 hover:scale-105"
                               style="background: #109e4a; color: #fff; padding: 0.85rem 1.75rem; border-radius: 10px; font-size: 0.82rem; letter-spacing: 0.05em;">
                                <i class="fab fa-whatsapp" style="font-size: 1.2rem;"></i>
                                Fale pelo WhatsApp
                            </a>
                            <a href="{{ route('contact') }}"
                               class="inline-flex items-center gap-2.5 font-bold uppercase transition-all duration-200 hover:bg-white/20"
                               style="background: rgba(255,255,255,0.1); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.25); color: #fff; padding: 0.85rem 1.75rem; border-radius: 10px; font-size: 0.82rem; letter-spacing: 0.05em;">
                                <i class="fas fa-envelope" style="font-size: 0.9rem;"></i>
                                Fale Conosco
                            </a>
                        </div>
                    </div>

                    {{-- Card de destaque / chamada rápida --}}
                    <div class="hidden lg:block">
                        <div class="rounded-2xl p-7" style="background: rgba(255,255,255,0.07); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.15);">
                            <p class="text-xs font-bold uppercase tracking-widest mb-4" style="color: #f2bd11;">
                                Solicite um orçamento
                            </p>
                            <p class="text-white text-lg font-semibold leading-snug mb-2">
                                {{ $service->title }}
                            </p>
                            <p class="mb-5 text-sm" style="color: rgba(255,255,255,0.6);">
                                Nossa equipe entra em contato em até 24 horas.
                            </p>
                            <a href="{{ $whatsappQuoteUrl }}" target="_blank"
                               class="flex items-center justify-center gap-2.5 w-full font-bold uppercase transition-all duration-200 hover:brightness-105"
                               style="background: #f2bd11; color: #001c3d; padding: 0.9rem 1.5rem; border-radius: 10px; font-size: 0.82rem; letter-spacing: 0.05em;">
                                <i class="fas fa-calculator"></i>
                                Solicitar Orçamento
                            </a>
                            <div class="flex items-center justify-center gap-2 mt-4" style="color: rgba(255,255,255,0.45); font-size: 0.78rem;">
                                <i class="fas fa-shield-alt"></i>
                                Sem compromisso · Resposta rápida
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════
         BARRA DE DESTAQUES / BENEFÍCIOS
    ═══════════════════════════════════════════════════════ --}}
    <section style="background: #f2bd11;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 divide-x divide-yellow-400">
                @foreach([
                    ['fas fa-headset', 'Atendimento', 'Personalizado'],
                    ['fas fa-map-marked-alt', 'Destinos', 'Nacionais e Internacionais'],
                    ['fas fa-shield-alt', 'Viagem', 'com Segurança'],
                    ['fas fa-star', 'Experiência', '+10 anos no mercado'],
                ] as $benefit)
                    <div class="flex items-center gap-3 py-4 px-5">
                        <i class="{{ $benefit[0] }} text-xl" style="color: #001c3d; opacity: 0.8;"></i>
                        <div>
                            <p class="font-black text-sm leading-tight" style="color: #001c3d;">{{ $benefit[1] }}</p>
                            <p class="text-xs leading-tight" style="color: rgba(0,28,61,0.65);">{{ $benefit[2] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════
         CONTEÚDO PRINCIPAL
    ═══════════════════════════════════════════════════════ --}}
    @if($service->content || $service->image_path)
        <section style="background: #fff; padding: 5rem 0;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                @if($service->image_path && $service->content)
                    {{-- Layout 2 colunas: conteúdo + sidebar --}}
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-14 items-start">

                        {{-- Conteúdo principal --}}
                        <div class="lg:col-span-2 conteudo-markdown">
                            <x-markdown>
                                {!! $service->content !!}
                            </x-markdown>
                        </div>

                        {{-- Sidebar --}}
                        <div class="space-y-6" style="position: sticky; top: 7rem;">

                            {{-- Imagem destaque --}}
                            <div class="rounded-2xl overflow-hidden" style="box-shadow: 0 8px 40px rgba(0,28,61,0.12);">
                                <img src="{{ asset('storage/' . $service->image_path) }}"
                                     alt="{{ $service->title }}"
                                     class="w-full object-cover">
                            </div>

                            {{-- Card de contato --}}
                            <div class="rounded-2xl p-6 border" style="border-color: #e5e7eb; background: #f9fafb;">
                                <p class="font-black mb-1" style="color: #002752; font-size: 1.05rem;">Pronto para contratar?</p>
                                <p class="text-sm mb-5" style="color: #6b7280;">Fale com um consultor agora mesmo.</p>
                                <div class="flex flex-col gap-3">
                                    <a href="{{ $whatsappUrl }}" target="_blank"
                                       class="flex items-center justify-center gap-2 w-full font-bold text-sm uppercase py-3 rounded-xl transition-all duration-200 hover:brightness-105"
                                       style="background: #109e4a; color: #fff;">
                                        <i class="fab fa-whatsapp text-lg"></i>
                                        Falar no WhatsApp
                                    </a>
                                    <a href="{{ $whatsappQuoteUrl }}" target="_blank"
                                       class="flex items-center justify-center gap-2 w-full font-bold text-sm uppercase py-3 rounded-xl transition-all duration-200 hover:brightness-105"
                                       style="background: #f2bd11; color: #001c3d;">
                                        <i class="fas fa-calculator"></i>
                                        Solicitar Orçamento
                                    </a>
                                    <a href="{{ route('contact') }}"
                                       class="flex items-center justify-center gap-2 w-full font-bold text-sm uppercase py-3 rounded-xl transition-all duration-200"
                                       style="background: transparent; color: #002752; border: 1.5px solid #002752;">
                                        <i class="fas fa-envelope text-sm"></i>
                                        Enviar Mensagem
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>


                @elseif($service->image_path)
                    {{-- Apenas imagem --}}
                    <div class="max-w-3xl mx-auto rounded-2xl overflow-hidden" style="box-shadow: 0 8px 40px rgba(0,28,61,0.12);">
                        <img src="{{ asset('storage/' . $service->image_path) }}"
                             alt="{{ $service->title }}"
                             class="w-full object-cover">
                    </div>
                @endif
            </div>
        </section>
    @endif

    {{-- ═══════════════════════════════════════════════════════
         OUTROS SERVIÇOS
    ═══════════════════════════════════════════════════════ --}}
    @if(isset($menuServices) && $menuServices->where('slug', '!=', $service->slug)->count() > 0)
        <section style="background: #f3f4f6; padding: 4.5rem 0; border-top: 1px solid #e5e7eb;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10">
                    <p class="text-xs font-bold uppercase tracking-widest mb-2" style="color: #f2bd11;">
                        Explore mais
                    </p>
                    <h2 class="font-extrabold" style="color: #002752; font-size: 1.7rem;">
                        Outros Serviços
                    </h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($menuServices->where('slug', '!=', $service->slug) as $otherService)
                        <a href="{{ route('service.show', $otherService->slug) }}"
                           class="group flex items-center gap-4 p-5 rounded-xl transition-all duration-200 hover:-translate-y-0.5"
                           style="background: #fff; border: 1px solid #e5e7eb; box-shadow: 0 1px 4px rgba(0,0,0,0.04);">
                            <div class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center transition-colors duration-200 group-hover:bg-[#002752]"
                                 style="background: #f0f4fa;">
                                <i class="fas fa-concierge-bell text-sm transition-colors duration-200 group-hover:text-white"
                                   style="color: #002752;"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-sm truncate transition-colors duration-200 group-hover:text-[#002752]"
                                   style="color: #374151;">
                                    {{ $otherService->title }}
                                </p>
                            </div>
                            <i class="fas fa-arrow-right text-xs transition-all duration-200 group-hover:translate-x-1"
                               style="color: #9ca3af;"></i>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ═══════════════════════════════════════════════════════
         CALL TO ACTION FINAL
    ═══════════════════════════════════════════════════════ --}}
    <section style="background: linear-gradient(135deg, #002752 0%, #001c3d 100%); padding: 6rem 0; position: relative; overflow: hidden;">

        {{-- Elementos decorativos de fundo --}}
        <div style="position: absolute; top: -80px; right: -80px; width: 320px; height: 320px; border-radius: 50%; background: rgba(242,189,17,0.06);"></div>
        <div style="position: absolute; bottom: -60px; left: -60px; width: 240px; height: 240px; border-radius: 50%; background: rgba(255,255,255,0.03);"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl mx-auto text-center text-white">

                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl mb-6"
                     style="background: rgba(242,189,17,0.15); border: 1px solid rgba(242,189,17,0.25);">
                    <i class="fas fa-paper-plane" style="color: #f2bd11; font-size: 1.5rem;"></i>
                </div>

                <h2 class="font-black mb-4" style="font-size: clamp(1.8rem, 4vw, 2.5rem);">
                    Pronto para começar?
                </h2>
                <p class="mb-10 leading-relaxed" style="color: rgba(255,255,255,0.65); font-size: 1.05rem;">
                    Nossa equipe está preparada para te ajudar a planejar cada detalhe.
                    Entre em contato agora mesmo!
                </p>

                {{-- 3 botões de CTA --}}
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">

                    <a href="{{ $whatsappUrl }}" target="_blank"
                       class="inline-flex items-center gap-3 font-bold text-sm uppercase transition-all duration-200 hover:brightness-110 hover:scale-105 w-full sm:w-auto justify-center"
                       style="background: #109e4a; color: #fff; padding: 1rem 2rem; border-radius: 12px; letter-spacing: 0.05em;">
                        <i class="fab fa-whatsapp" style="font-size: 1.4rem;"></i>
                        <div class="text-left">
                            <span class="block" style="font-size: 0.7rem; font-weight: 500; color: rgba(255,255,255,0.75); letter-spacing: 0;">
                                (85) 9 9916-6421
                            </span>
                            <span class="block">Fale no WhatsApp</span>
                        </div>
                    </a>

                    <a href="{{ $whatsappQuoteUrl }}" target="_blank"
                       class="inline-flex items-center gap-3 font-bold text-sm uppercase transition-all duration-200 hover:brightness-110 hover:scale-105 w-full sm:w-auto justify-center"
                       style="background: #f2bd11; color: #001c3d; padding: 1rem 2rem; border-radius: 12px; letter-spacing: 0.05em;">
                        <i class="fas fa-calculator" style="font-size: 1.1rem;"></i>
                        Solicitar Orçamento
                    </a>

                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center gap-3 font-bold text-sm uppercase transition-all duration-200 hover:bg-white/20 w-full sm:w-auto justify-center"
                       style="background: rgba(255,255,255,0.08); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.18); color: #fff; padding: 1rem 2rem; border-radius: 12px; letter-spacing: 0.05em;">
                        <i class="fas fa-envelope" style="font-size: 1.1rem;"></i>
                        Enviar Mensagem
                    </a>

                </div>

                {{-- Selos de confiança --}}
                <div class="flex flex-wrap items-center justify-center gap-6 mt-10"
                     style="color: rgba(255,255,255,0.35); font-size: 0.78rem;">
                    <span class="flex items-center gap-1.5">
                        <i class="fas fa-lock"></i> Dados protegidos
                    </span>
                    <span class="flex items-center gap-1.5">
                        <i class="fas fa-clock"></i> Resposta em até 24h
                    </span>
                    <span class="flex items-center gap-1.5">
                        <i class="fas fa-star"></i> Atendimento especializado
                    </span>
                </div>
            </div>
        </div>
    </section>

@endsection

{{-- ═══════════════════════════════════════════════════════
     COMPONENTE INLINE: conteúdo HTML do serviço
     (pode ser extraído para resources/views/components/service-content.blade.php)
═══════════════════════════════════════════════════════ --}}
@once
    @push('components')
        {{-- Classe utilitária de prosa para o conteúdo --}}
    @endpush
@endonce