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
         HERO BANNER
    ═══════════════════════════════════════════════════════ --}}
    <section class="relative bg-cover bg-center h-[480px] lg:h-[580px] flex items-end"
        @if($service->banner_path)
            style="background-image: url('{{ asset('storage/' . $service->banner_path) }}');"
        @else
            style="background: linear-gradient(135deg, #001c3d 0%, #002752 50%, #003a6e 100%);"
        @endif
    >
        <div class="absolute inset-0 bg-gradient-to-t from-[#001c3d] via-[#001c3d]/60 to-transparent"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full pb-14 z-10">
            <div class="max-w-3xl text-white">
                {{-- Breadcrumb --}}
                <nav class="flex items-center gap-2 text-xs text-gray-400 mb-6">
                    <a href="{{ route('home') }}" class="hover:text-[#f2bd11] transition duration-200">Início</a>
                    <i class="fas fa-chevron-right text-[10px]"></i>
                    <a href="{{ route('services') }}" class="hover:text-[#f2bd11] transition duration-200">Nossos Serviços</a>
                    <i class="fas fa-chevron-right text-[10px]"></i>
                    <span class="text-white">{{ $service->title }}</span>
                </nav>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black leading-tight mb-4 text-white">
                    {{ $service->title }}
                </h1>

                @if($service->subtitle)
                    <p class="text-xl sm:text-2xl text-gray-200 mb-6 leading-relaxed">
                        {{ $service->subtitle }}
                    </p>
                @endif

                @if($service->summary)
                    <div class="text-base text-gray-300 mb-8 max-w-2xl leading-relaxed [&_p]:m-0 [&_a]:text-[#f2bd11] [&_a]:underline hover:[&_a]:text-white [&_strong]:text-white [&_strong]:font-bold [&_em]:italic">
                        {!! \Illuminate\Support\Str::markdown($service->summary, [
                            'html_input' => 'strip',
                            'allow_unsafe_links' => false,
                        ]) !!}
                    </div>
                @endif

                <div class="flex flex-wrap gap-4">
                    <a href="{{ $whatsappUrl }}" target="_blank"
                       class="inline-flex items-center bg-[#109e4a] hover:bg-[#0d9648] text-white font-bold text-sm uppercase py-3.5 px-7 rounded-lg transition duration-200 gap-2 shadow-lg">
                        <i class="fab fa-whatsapp text-xl"></i>
                        <span>Solicitar Informações</span>
                    </a>
                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/30 text-white font-bold text-sm uppercase py-3.5 px-7 rounded-lg transition duration-200 gap-2">
                        <i class="fas fa-envelope text-sm"></i>
                        <span>Fale Conosco</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════
         CONTEÚDO PRINCIPAL
    ═══════════════════════════════════════════════════════ --}}
    @if($htmlContent || $service->image_path)
        <section class="bg-white py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if($service->image_path && $htmlContent)
                    {{-- Layout em 2 colunas: conteúdo + imagem destaque --}}
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
                        <div class="lg:col-span-2">
                            <div class="max-w-none text-gray-700 leading-relaxed
                                [&_h1]:text-[#002752] [&_h1]:font-black [&_h1]:text-3xl [&_h1]:mb-4
                                [&_h2]:text-[#002752] [&_h2]:font-black [&_h2]:text-2xl [&_h2]:border-b [&_h2]:border-gray-100 [&_h2]:pb-3 [&_h2]:mt-10 [&_h2]:mb-4
                                [&_h3]:text-[#002752] [&_h3]:font-black [&_h3]:text-xl [&_h3]:mt-8 [&_h3]:mb-3
                                [&_p]:text-gray-700 [&_p]:leading-relaxed [&_p]:mb-5
                                [&_a]:text-[#109e4a] [&_a]:font-semibold [&_a]:underline hover:[&_a]:text-[#0d9648]
                                [&_strong]:text-gray-800 [&_strong]:font-bold
                                [&_em]:italic
                                [&_ul]:list-disc [&_ul]:pl-6 [&_ul]:space-y-1 [&_ul]:mb-5
                                [&_ol]:list-decimal [&_ol]:pl-6 [&_ol]:space-y-1 [&_ol]:mb-5
                                [&_li]:text-gray-700
                                [&_hr]:border-gray-200 [&_hr]:my-8">
                                {!! $htmlContent !!}
                            </div>
                        </div>
                        <div class="lg:sticky lg:top-28">
                            <div class="relative rounded-2xl overflow-hidden shadow-xl">
                                <img src="{{ asset('storage/' . $service->image_path) }}"
                                     alt="{{ $service->title }}"
                                     class="w-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#001c3d]/40 to-transparent"></div>
                            </div>
                        </div>
                    </div>
                @elseif($htmlContent)
                    {{-- Apenas conteúdo (sem imagem de destaque) --}}
                    <div class="max-w-4xl mx-auto">
                        <div class="max-w-none text-gray-700 leading-relaxed
                            [&_h1]:text-[#002752] [&_h1]:font-black [&_h1]:text-3xl [&_h1]:mb-4
                            [&_h2]:text-[#002752] [&_h2]:font-black [&_h2]:text-2xl [&_h2]:border-b [&_h2]:border-gray-100 [&_h2]:pb-3 [&_h2]:mt-10 [&_h2]:mb-4
                            [&_h3]:text-[#002752] [&_h3]:font-black [&_h3]:text-xl [&_h3]:mt-8 [&_h3]:mb-3
                            [&_p]:text-gray-700 [&_p]:leading-relaxed [&_p]:mb-5
                            [&_a]:text-[#109e4a] [&_a]:font-semibold [&_a]:underline hover:[&_a]:text-[#0d9648]
                            [&_strong]:text-gray-800 [&_strong]:font-bold
                            [&_em]:italic
                            [&_ul]:list-disc [&_ul]:pl-6 [&_ul]:space-y-1 [&_ul]:mb-5
                            [&_ol]:list-decimal [&_ol]:pl-6 [&_ol]:space-y-1 [&_ol]:mb-5
                            [&_li]:text-gray-700
                            [&_hr]:border-gray-200 [&_hr]:my-8">
                            {!! $htmlContent !!}
                        </div>
                    </div>
                @elseif($service->image_path)
                    {{-- Apenas imagem de destaque (sem conteúdo escrito) --}}
                    <div class="max-w-3xl mx-auto">
                        <div class="relative rounded-2xl overflow-hidden shadow-xl">
                            <img src="{{ asset('storage/' . $service->image_path) }}"
                                 alt="{{ $service->title }}"
                                 class="w-full object-cover">
                        </div>
                    </div>
                @endif
            </div>
        </section>
    @endif

    {{-- ═══════════════════════════════════════════════════════
         OUTROS SERVIÇOS
    ═══════════════════════════════════════════════════════ --}}
    @if(isset($menuServices) && $menuServices->where('slug', '!=', $service->slug)->count() > 0)
        <section class="bg-gray-50 py-16 border-t border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-extrabold text-[#002752] mb-8 text-center">Outros Serviços</h2>
                <div class="flex flex-wrap justify-center gap-4">
                    @foreach($menuServices->where('slug', '!=', $service->slug) as $otherService)
                        <a href="{{ route('service.show', $otherService->slug) }}"
                           class="inline-flex items-center gap-2 bg-white border border-gray-200 hover:border-[#002752] hover:shadow-md text-gray-700 hover:text-[#002752] px-5 py-3 rounded-xl font-semibold text-sm transition duration-200">
                            <i class="fas fa-concierge-bell text-[#f2bd11]"></i>
                            {{ $otherService->title }}
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ═══════════════════════════════════════════════════════
         CALL TO ACTION FINAL
    ═══════════════════════════════════════════════════════ --}}
    <section class="bg-gradient-to-br from-[#002752] to-[#001c3d] py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="max-w-3xl mx-auto text-white">
                <div class="w-16 h-16 bg-[#f2bd11]/20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-paper-plane text-[#f2bd11] text-2xl"></i>
                </div>
                <h2 class="text-3xl sm:text-4xl font-black mb-4">
                    Pronto para começar?
                </h2>
                <p class="text-gray-300 text-lg mb-10 leading-relaxed">
                    Nossa equipe está preparada para te ajudar a planejar cada detalhe.
                    Entre em contato agora mesmo!
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    {{-- WhatsApp --}}
                    <a href="{{ $whatsappUrl }}" target="_blank"
                       class="inline-flex items-center gap-3 bg-[#109e4a] hover:bg-[#0d9648] text-white font-bold text-sm uppercase py-4 px-8 rounded-xl transition duration-200 shadow-lg w-full sm:w-auto justify-center">
                        <i class="fab fa-whatsapp text-2xl"></i>
                        <div class="text-left">
                            <span class="block text-xs font-medium text-green-100">(85) 9 9916-6421</span>
                            <span class="block">Fale no WhatsApp</span>
                        </div>
                    </a>

                    {{-- Contato --}}
                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center gap-3 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/20 text-white font-bold text-sm uppercase py-4 px-8 rounded-xl transition duration-200 w-full sm:w-auto justify-center">
                        <i class="fas fa-envelope text-xl"></i>
                        <span>Enviar Mensagem</span>
                    </a>

                    {{-- Solicitar Orçamento --}}
                    <a href="{{ $whatsappUrl }}?text=Olá!%20Tenho%20interesse%20no%20serviço%20de%20{{ urlencode($service->title) }}.%20Pode%20me%20dar%20mais%20informações?" target="_blank"
                       class="inline-flex items-center gap-3 bg-[#f2bd11] hover:bg-[#e0ad00] text-[#001c3d] font-bold text-sm uppercase py-4 px-8 rounded-xl transition duration-200 w-full sm:w-auto justify-center">
                        <i class="fas fa-calculator text-xl"></i>
                        <span>Solicitar Orçamento</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection