{{-- Layout: image-highlight — Fundo com imagem em destaque e overlay escuro --}}
@php
    $primaryBtnStyles = [
        'primary'   => 'bg-[#002752] text-white hover:bg-[#001c3d]',
        'secondary' => 'bg-[#109e4a] text-white hover:bg-[#0d9648]',
        'warning'   => 'bg-[#f3a908] text-[#002752] hover:bg-[#db9807]',
        'outline'   => 'border-2 border-white text-white hover:bg-white/10',
    ][$cta->button_variant ?? 'warning'] ?? 'bg-[#f3a908] text-[#002752]';

    $secondaryBtnStyles = [
        'primary'   => 'bg-white text-[#002752] hover:bg-gray-100',
        'secondary' => 'bg-white text-[#109e4a] hover:bg-gray-100',
        'warning'   => 'bg-white text-[#002752] hover:bg-gray-100',
        'outline'   => 'border-2 border-white/60 text-white hover:border-white',
        'ghost'     => 'text-white/80 hover:text-white underline underline-offset-2',
    ][$cta->secondary_button_variant ?? 'outline'] ?? 'border-2 border-white/60 text-white';
@endphp

<section
    class="relative w-full overflow-hidden {{ $cta->padding_vertical ?? 'py-20' }}"
    @if($cta->analytics_event_name) data-analytics-section="{{ $cta->analytics_event_name }}" @endif
>
    {{-- Imagem de fundo com overlay --}}
    <div class="absolute inset-0 z-0">
        @if($cta->bg_image && $cta->bg_image !== 'none')
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                 style="background-image: url('{{ $cta->bg_image }}');"></div>
        @else
            {{-- Fallback: gradiente abstrato vibrante --}}
            <div class="absolute inset-0"
                 style="background: linear-gradient(135deg, {{ $cta->bg_color ?? '#002752' }} 0%, #1a3a6b 50%, #0d2540 100%);"></div>
        @endif
        {{-- Overlay escuro --}}
        <div class="absolute inset-0"
             style="background: linear-gradient(to top, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.4) 60%, rgba(0,0,0,0.2) 100%);"></div>
    </div>

    {{-- Padrão decorativo --}}
    <div class="absolute inset-0 z-0 opacity-5"
         style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 32px 32px;"></div>

    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">

        {{-- Título principal --}}
        @if($cta->title)
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight mb-5 drop-shadow-lg">
                {{ $cta->title }}
            </h2>
        @endif

        @if($cta->subtitle)
            <p class="text-lg sm:text-xl text-white/80 leading-relaxed mb-8 max-w-2xl mx-auto">
                {{ $cta->subtitle }}
            </p>
        @endif

        {{-- Lista de Diferenciais em linha --}}
        @if($listItems->count() > 0)
            <div class="flex flex-wrap justify-center gap-x-6 gap-y-2 mb-10">
                @foreach($listItems as $item)
                    <span class="flex items-center gap-2 text-white/90 text-sm font-semibold">
                        @if($item->icon)
                            <i class="{{ $item->icon }} text-[#f3a908]"></i>
                        @else
                            <i class="fa-solid fa-circle-check text-[#f3a908]"></i>
                        @endif
                        {{ $item->title }}
                    </span>
                @endforeach
            </div>
        @endif

        {{-- Botões --}}
        @if($cta->button_label || $cta->secondary_button_label)
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                @if($cta->button_label && $cta->button_url)
                    <a href="{{ $cta->button_url }}" target="{{ $cta->button_target }}"
                       @if($cta->analytics_event_name) onclick="trackCtaEvent('{{ $cta->analytics_event_name }}', 'primary')" @endif
                       class="w-full sm:w-auto px-10 py-4 rounded-xl font-bold text-sm tracking-widest uppercase transition-all duration-200 shadow-xl hover:shadow-2xl hover:scale-[1.03] flex items-center justify-center gap-2 {{ $primaryBtnStyles }}">
                        @if($cta->button_icon)<i class="{{ $cta->button_icon }} text-base"></i>@endif
                        <span>{{ $cta->button_label }}</span>
                    </a>
                @endif
                @if($cta->secondary_button_label && $cta->secondary_button_url)
                    <a href="{{ $cta->secondary_button_url }}" target="{{ $cta->secondary_button_target }}"
                       class="w-full sm:w-auto px-10 py-4 rounded-xl font-bold text-sm tracking-widest uppercase transition-all duration-200 hover:scale-[1.02] flex items-center justify-center gap-2 {{ $secondaryBtnStyles }}">
                        {{ $cta->secondary_button_label }}
                    </a>
                @endif
            </div>
        @endif

    </div>
</section>
