<!-- HERO BANNER -->
@php
    $whatsappUrl = isset($socialLinks['whatsapp']) ? $socialLinks['whatsapp']->url : 'https://wa.me/5585999166421';
    $bannerUrl = $banner && $banner->image_path ? asset('storage/' . $banner->image_path) : asset('assets/images/page-home.jpeg');
    $bannerTitle = $banner && $banner->title ? $banner->title : 'Sua próxima viagem está';
    $bannerTitleDestaque = $banner && $banner->titulo_destaque ? $banner->titulo_destaque : 'mais perto do que você imagina!';
    $bannerSubtitle = $banner && $banner->subtitle ? $banner->subtitle : 'Viaje com segurança, parcele no boleto e conte com a gente do planejamento ao retorno.';
@endphp
<section class="relative bg-cover bg-center h-[550px] lg:h-[650px] flex items-center" style="background-image: url('{{ $bannerUrl }}');">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-[#001c3d]/90 via-[#001c3d]/60 to-transparent"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full z-10">
        <div class="max-w-xl lg:max-w-2xl text-white">
            <!-- Main Title -->
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black leading-tight mb-4 text-white">
                {{ $bannerTitle }} <span class="text-[#f3a908]">{{ $bannerTitleDestaque }}</span>
            </h1>
            
            <!-- Subtitle -->
            <p class="text-base sm:text-lg text-gray-200 mb-8 max-w-lg leading-relaxed">
                {{ $bannerSubtitle }}
            </p>
            
            <!-- Feature Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-8">
                <!-- Feature 1 -->
                @if($banner && $banner->featureBanners && $banner->featureBanners->isNotEmpty())
                    @foreach($banner->featureBanners as $feature)
                    <div class="flex items-center gap-3 bg-white/10 backdrop-blur-md px-3.5 py-3 rounded-lg border border-white/10">
                        <div class="w-10 h-10 rounded bg-[#109e4a] text-white flex items-center justify-center shrink-0">
                            <i class="{{ $feature->icon }} text-xl"></i>
                        </div>
                        <span class="text-[10px] sm:text-xs font-semibold leading-tight uppercase">{{ $feature->name }}</span>
                    </div>
                    @endforeach
                @endif
            </div>
            
            <!-- Buttons -->
            @if($banner && $banner->buttons && $banner->buttons->isNotEmpty())
                <div class="flex flex-col sm:flex-row gap-4" id="orcamento">
                    @foreach($banner->buttons as $button)
                        <a href="{{ $button->url }}" target="{{ $button->target }}" class="inline-flex justify-center items-center bg-{{ $button->color }} hover:bg-white text-{{ $button->color }} hover:text-{{ $button->color }} px-8 py-4 rounded-lg font-black text-sm tracking-wide uppercase transition duration-300 shadow-lg">
                            {{ $button->text }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>