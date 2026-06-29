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
@endsection

@section('content')
    @php
        $whatsappUrl = isset($socialLinks['whatsapp']) ? $socialLinks['whatsapp']->url : 'https://wa.me/5585999166421';
    @endphp

    {{-- ═══════════════════════════════════════════════════════
         HERO BANNER (PREMIUM GLASSMORPHISM)
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

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black leading-tight mb-3 text-white tracking-tight drop-shadow-md">
                    {{ $service->title }}
                </h1>

                @if($service->subtitle)
                    <p class="text-lg sm:text-xl text-gray-300 mb-0 font-light leading-relaxed max-w-2xl">
                        {{ $service->subtitle }}
                    </p>
                @endif
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════
         CONTEÚDO PRINCIPAL EM COLUNAS
    ═══════════════════════════════════════════════════════ --}}
    <section class="bg-gray-50 py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12 items-start">
                
                {{-- Coluna do Conteúdo (Esquerda) --}}
                <div class="lg:col-span-2 space-y-8">
                    @if(session('success'))
                        <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl shadow-sm flex gap-3 animate-fade-in">
                            <i class="fas fa-check-circle text-emerald-500 text-lg mt-0.5"></i>
                            <div>
                                <h4 class="font-bold text-emerald-900 text-sm">Mensagem Enviada!</h4>
                                <p class="text-xs text-emerald-700 mt-0.5">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    {{-- Resumo curto --}}
                    @if($service->summary)
                        <div class="bg-white rounded-2xl p-6 lg:p-8 border border-gray-50 shadow-sm relative overflow-hidden">
                            <div class="absolute top-0 left-0 w-2 h-full bg-[#f2bd11]"></div>
                            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Visão Geral</h3>
                            <div class="text-base text-gray-700 leading-relaxed italic">
                                {!! \Illuminate\Support\Str::markdown($service->summary, [
                                    'html_input' => 'strip',
                                    'allow_unsafe_links' => false,
                                ]) !!}
                            </div>
                        </div>
                    @endif

                    {{-- Texto Principal (Markdown Renderizado e Estilizado de Forma Premium) --}}
                    @if($htmlContent || $service->image_path)
                        <div class="bg-white rounded-2xl p-6 lg:p-8 border border-gray-50 shadow-sm space-y-8">
                            
                            @if($service->image_path)
                                <div class="relative rounded-xl overflow-hidden shadow-md group">
                                    <img src="{{ asset('storage/' . $service->image_path) }}"
                                         alt="{{ $service->title }}"
                                         class="w-full h-[250px] sm:h-[350px] object-cover transition-transform duration-500 group-hover:scale-105">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                                </div>
                            @endif

                            @if($htmlContent)
                                <div class="max-w-none text-gray-700 leading-relaxed text-sm sm:text-base
                                    [&_h1]:text-[#002752] [&_h1]:font-black [&_h1]:text-3xl [&_h1]:mb-6 [&_h1]:mt-8
                                    [&_h2]:text-[#002752] [&_h2]:font-extrabold [&_h2]:text-2xl [&_h2]:mt-10 [&_h2]:mb-4 [&_h2]:pb-2 [&_h2]:border-b [&_h2]:border-gray-100
                                    [&_h3]:text-[#002752] [&_h3]:font-bold [&_h3]:text-xl [&_h3]:mt-8 [&_h3]:mb-3
                                    [&_p]:text-gray-600 [&_p]:leading-relaxed [&_p]:mb-6
                                    [&_a]:text-[#109e4a] [&_a]:font-bold [&_a]:underline hover:[&_a]:text-[#0d9648]
                                    [&_strong]:text-[#002752] [&_strong]:font-bold
                                    [&_em]:italic [&_em]:text-gray-500
                                    [&_ul]:list-disc [&_ul]:pl-6 [&_ul]:space-y-2 [&_ul]:mb-6 [&_ul]:text-gray-650
                                    [&_ol]:list-decimal [&_ol]:pl-6 [&_ol]:space-y-2 [&_ol]:mb-6 [&_ol]:text-gray-650
                                    [&_li]:text-gray-600
                                    [&_blockquote]:border-l-4 [&_blockquote]:border-[#f2bd11] [&_blockquote]:pl-4 [&_blockquote]:italic [&_blockquote]:my-6 [&_blockquote]:text-gray-500
                                    [&_hr]:border-gray-150 [&_hr]:my-8">
                                    {!! $htmlContent !!}
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Coluna Lateral com Formulário de Contato e Info (Direita) --}}
                <div class="space-y-6 lg:sticky lg:top-24">
                    
                    {{-- Card do Formulário de Contato --}}
                    <div class="bg-white rounded-2xl border border-gray-50 shadow-md overflow-hidden">
                        <div class="bg-gradient-to-r from-[#002752] to-[#001c3d] p-6 text-white">
                            <span class="inline-block bg-[#f2bd11] text-[#001c3d] text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md mb-2">
                                Atendimento Personalizado
                            </span>
                            <h3 class="text-lg font-bold">Solicitar Orçamento</h3>
                            <p class="text-xs text-gray-300 mt-1">Preencha o formulário e um consultor entrará em contato em breve.</p>
                        </div>
                        
                        <form action="{{ route('contact.submit') }}" method="POST" class="p-6 space-y-4">
                            @csrf
                            
                            {{-- Input oculto identificando o Serviço --}}
                            <input type="hidden" name="type" value="Serviço: {{ $service->title }}">

                            {{-- Nome --}}
                            <div>
                                <label for="name" class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">
                                    Nome Completo
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-xs">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" name="name" id="name" required value="{{ old('name') }}"
                                        class="w-full pl-10 pr-3 py-2.5 bg-gray-50 border border-gray-200 focus:border-[#002752] focus:bg-white focus:outline-none text-xs rounded-lg transition duration-200"
                                        placeholder="Ex: João Silva">
                                </div>
                                @error('name')
                                    <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- E-mail --}}
                            <div>
                                <label for="email" class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">
                                    Seu E-mail
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-xs">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" name="email" id="email" required value="{{ old('email') }}"
                                        class="w-full pl-10 pr-3 py-2.5 bg-gray-50 border border-gray-200 focus:border-[#002752] focus:bg-white focus:outline-none text-xs rounded-lg transition duration-200"
                                        placeholder="Ex: joao@email.com">
                                </div>
                                @error('email')
                                    <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- WhatsApp / Telefone --}}
                            <div>
                                <label for="phone" class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">
                                    WhatsApp / Telefone
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-xs">
                                        <i class="fab fa-whatsapp"></i>
                                    </span>
                                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                        class="w-full pl-10 pr-3 py-2.5 bg-gray-50 border border-gray-200 focus:border-[#002752] focus:bg-white focus:outline-none text-xs rounded-lg transition duration-200"
                                        placeholder="Ex: (85) 99999-9999">
                                </div>
                                @error('phone')
                                    <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Mensagem --}}
                            <div>
                                <label for="message" class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">
                                    O que você precisa?
                                </label>
                                <textarea name="message" id="message" rows="4" required
                                    class="w-full p-3 bg-gray-50 border border-gray-200 focus:border-[#002752] focus:bg-white focus:outline-none text-xs rounded-lg transition duration-200 resize-none"
                                    placeholder="Descreva detalhes como quantidade de pessoas, datas ou dúvidas sobre o serviço de {{ $service->title }}...">{{ old('message', 'Olá! Tenho interesse no serviço de ' . $service->title . '. Gostaria de solicitar um orçamento personalizado.') }}</textarea>
                                @error('message')
                                    <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Botão Enviar --}}
                            <button type="submit"
                                    class="w-full bg-[#109e4a] hover:bg-[#0d9648] text-white font-bold text-xs uppercase tracking-wider py-3 rounded-lg transition duration-200 shadow-md flex items-center justify-center gap-2">
                                <i class="fas fa-paper-plane"></i>
                                Enviar Solicitação
                            </button>
                        </form>
                    </div>

                    {{-- Card Atalhos de Contato Rápido --}}
                    <div class="bg-gradient-to-br from-[#002752]/5 to-[#001c3d]/10 rounded-2xl p-6 border border-gray-50 shadow-md space-y-4">
                        <h4 class="text-sm font-bold text-[#002752] flex items-center gap-2">
                            <i class="fas fa-headset text-[#f2bd11]"></i>
                            Contato Imediato
                        </h4>
                        
                        <div class="space-y-3">
                            <a href="{{ $whatsappUrl }}?text=Olá!%20Tenho%20interesse%20no%20serviço%20de%20{{ urlencode($service->title) }}" target="_blank"
                               class="flex items-center gap-3 bg-[#109e4a] hover:bg-[#0d9648] text-white p-3 rounded-xl transition duration-200 shadow-sm">
                                <i class="fab fa-whatsapp text-xl"></i>
                                <div class="text-left">
                                    <span class="block text-[10px] text-green-100 font-medium">Chamar no WhatsApp</span>
                                    <span class="block text-xs font-bold">(85) 9 9916-6421</span>
                                </div>
                            </a>

                            <div class="flex items-center gap-3 bg-white p-3 rounded-xl border border-gray-50">
                                <div class="w-8 h-8 bg-gray-100 text-[#002752] rounded-lg flex items-center justify-center">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="text-left">
                                    <span class="block text-[10px] text-gray-400 font-medium">Telefone Fixo</span>
                                    <span class="block text-xs font-bold text-gray-700">(85) 3224-4400</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════
         OUTROS SERVIÇOS RELACIONADOS
    ═══════════════════════════════════════════════════════ --}}
    @if(isset($menuServices) && $menuServices->where('slug', '!=', $service->slug)->count() > 0)
        <section class="bg-white py-12 border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h3 class="text-xl font-extrabold text-[#002752] mb-6 text-center">Conheça Nossos Outros Serviços</h3>
                <div class="flex flex-wrap justify-center gap-3">
                    @foreach($menuServices->where('slug', '!=', $service->slug) as $otherService)
                        <a href="{{ route('service.show', $otherService->slug) }}"
                           class="inline-flex items-center gap-2 bg-gray-50 border border-gray-250 hover:border-[#002752] hover:bg-white text-gray-750 hover:text-[#002752] px-4 py-2.5 rounded-lg font-semibold text-xs transition duration-200 shadow-xs">
                            <i class="fas fa-concierge-bell text-[#f2bd11]"></i>
                            {{ $otherService->title }}
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection