<!-- HERO BANNER -->
@php
    $whatsappUrl = isset($socialLinks['whatsapp']) ? $socialLinks['whatsapp']->url : 'https://wa.me/+5585999166421';
    $bannerUrl = $banner && $banner->image_path ? asset('storage/' . $banner->image_path) : asset('assets/images/page-home.jpeg');
    $bannerUrlMobile = $banner && $banner->image_path_mobile ? asset('storage/' . $banner->image_path_mobile) : $bannerUrl;
    $bannerTitle = $banner && $banner->title ? $banner->title : 'Sua próxima viagem';
    $bannerTitleDestaque = $banner && $banner->titulo_destaque ? $banner->titulo_destaque : 'está mais perto do que você imagina!';
    $bannerSubtitle = $banner && $banner->subtitle ? $banner->subtitle : 'Viaje com segurança, parcele no boleto e conte com a gente do planejamento ao retorno.';
@endphp

<section id="hero-banner" class="relative bg-cover bg-center min-h-[550px] lg:min-h-[650px] py-12 lg:py-20 flex items-center" style="background-image: url('{{ $bannerUrl }}');">
    <script>
        (function() {
            function updateBannerBg() {
                var hero = document.getElementById('hero-banner');
                if (!hero) return;
                if (window.innerWidth <= 768) {
                    hero.style.backgroundImage = 'url("{{ $bannerUrlMobile }}")';
                } else {
                    hero.style.backgroundImage = 'url("{{ $bannerUrl }}")';
                }
            }
            updateBannerBg();
            window.addEventListener('resize', updateBannerBg);
        })();
    </script>
    <!-- Overlay -->
    <div class="absolute inset-0 bg-gradient-to-b md:bg-gradient-to-r from-[#001c3d]/95 via-[#001c3d]/80 to-[#001c3d]/40 md:to-transparent"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full z-10">
        <div class="max-w-xl lg:max-w-2xl text-white">
            <!-- Main Title -->
            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black leading-tight mb-4 text-white">
                {{ $bannerTitle }} <span class="text-[#f3a908]">{{ $bannerTitleDestaque }}</span>
            </h1>
            
            <!-- Subtitle -->
            @if($bannerSubtitle)
                <p class="text-sm sm:text-lg text-gray-200 mb-6 max-w-lg leading-relaxed">
                    {{ $bannerSubtitle }}
                </p>
            @endif
            
            <!-- Feature Cards -->
            @if($banner && $banner->featureBanners && $banner->featureBanners->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-8">
                    @foreach($banner->featureBanners as $feature)
                    <div class="flex items-center gap-2.5 p-2.5 rounded-lg bg-[#001c3d]/40 backdrop-blur-sm border border-white/10 sm:bg-transparent sm:p-0 sm:border-none">
                        <div class="w-10 h-10 rounded-full bg-[#109e4a] text-white flex items-center justify-center shrink-0">
                            <i class="{{ $feature->icon }} text-lg"></i>
                        </div>
                        <span class="text-xs font-bold leading-tight uppercase text-gray-100">{{ $feature->name }}</span>
                    </div>
                    @endforeach
                </div>
            @endif
            
            <!-- Buttons -->
            @if($banner && $banner->buttons && $banner->buttons->isNotEmpty())
                <div class="flex flex-col sm:flex-row gap-3" id="orcamento">
                    @foreach($banner->buttons as $button)
                        <a href="{{ $button->url }}" 
                        target="{{ $button->target }}" 
                        style="--btn-bg: {{ $button->bg_color }}; --btn-hover: {{ $button->bg_hover_color }}; --btn-color: {{ $button->color }};"
                        class="inline-flex justify-center items-center bg-[var(--btn-bg)] hover:bg-[var(--btn-hover)] text-[var(--btn-color)] px-6 py-3.5 rounded-xl font-extrabold text-xs sm:text-sm tracking-wide uppercase transition duration-300 shadow-lg text-center">
                            {{ $button->text }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>