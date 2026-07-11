{{-- Layout: split — Conteúdo dividido: texto à esquerda, botões à direita --}}
@php
    $primaryBtnStyles = [
        'primary'   => 'bg-[#002752] text-white hover:bg-[#001c3d] hover:scale-[1.02] shadow-lg shadow-[#002752]/30',
        'secondary' => 'bg-[#109e4a] text-white hover:bg-[#0d9648] hover:scale-[1.02] shadow-lg shadow-[#109e4a]/30',
        'warning'   => 'bg-[#f3a908] text-[#002752] hover:bg-[#db9807] hover:scale-[1.02] shadow-lg shadow-[#f3a908]/30',
        'outline'   => 'border-2 border-current hover:bg-black/5 hover:scale-[1.02]',
    ][$cta->button_variant ?? 'warning'] ?? 'bg-[#f3a908] text-[#002752]';

    $secondaryBtnStyles = [
        'primary'   => 'bg-[#002752] text-white hover:bg-[#001c3b] hover:scale-[1.02]',
        'secondary' => 'bg-[#109e4a] text-white hover:bg-[#0d9648] hover:scale-[1.02]',
        'warning'   => 'bg-[#f3a908] text-[#002752] hover:bg-[#db9807] hover:scale-[1.02]',
        'outline'   => 'border-2 border-current hover:bg-black/5 hover:scale-[1.02]',
        'ghost'     => 'underline underline-offset-2 hover:opacity-75',
    ][$cta->secondary_button_variant ?? 'ghost'] ?? 'underline underline-offset-2 hover:opacity-75';
@endphp

<section
    class="relative w-full overflow-hidden {{ $cta->padding_vertical ?? 'py-16' }}"
    style="background-color: {{ $cta->bg_color ?? '#001c3d' }}; color: {{ $cta->text_color ?? '#ffffff' }};"
    @if($cta->analytics_event_name) data-analytics-section="{{ $cta->analytics_event_name }}" @endif
>
    {{-- Decoração de fundo diagonal --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -right-16 top-0 bottom-0 w-1/3 opacity-5"
             style="background: linear-gradient(135deg, transparent 50%, {{ $cta->text_color ?? '#fff' }} 50%);"></div>
    </div>

    @if($cta->bg_image && $cta->bg_image !== 'none')
        <div class="absolute inset-0 z-0 bg-cover bg-center bg-no-repeat opacity-8"
             style="background-image: url('{{ $cta->bg_image }}');"></div>
    @endif

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-10">

            {{-- Coluna Esquerda: Texto e lista --}}
            <div class="flex-1 max-w-xl">
                @if($cta->title)
                    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight leading-tight mb-3">
                        {{ $cta->title }}
                    </h2>
                @endif
                @if($cta->subtitle)
                    <p class="text-base opacity-75 leading-relaxed mb-6">
                        {{ $cta->subtitle }}
                    </p>
                @endif

                {{-- Lista de Diferenciais --}}
                @if($listItems->count() > 0)
                    <ul class="space-y-3">
                        @foreach($listItems as $item)
                            <li class="flex items-center gap-3">
                                @if($item->icon)
                                    <span class="flex-shrink-0 w-8 h-8 rounded-lg flex items-center justify-center bg-white/10">
                                        <i class="{{ $item->icon }} text-sm"></i>
                                    </span>
                                @else
                                    <span class="flex-shrink-0 w-2 h-2 rounded-full bg-current opacity-50 mt-1"></span>
                                @endif
                                <span class="font-medium text-sm sm:text-base">{{ $item->title }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            {{-- Coluna Direita: Botões com card elevado --}}
            <div class="flex-shrink-0 w-full lg:w-auto">
                <div class="rounded-2xl p-8 flex flex-col gap-4 items-center text-center min-w-[260px] max-w-sm mx-auto"
                     style="background-color: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.12);">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-2"
                         style="background-color: rgba(255,255,255,0.1)">
                        <i class="fa-solid fa-paper-plane text-2xl"></i>
                    </div>
                    <p class="font-bold text-base opacity-90">Pronto para começar?</p>
                    <p class="text-xs opacity-60">Entre em contato com nossa equipe agora mesmo.</p>

                    @if($cta->button_label && $cta->button_url)
                        <a href="{{ $cta->button_url }}" target="{{ $cta->button_target }}"
                           @if($cta->analytics_event_name) onclick="trackCtaEvent('{{ $cta->analytics_event_name }}', 'primary')" @endif
                           class="w-full px-6 py-3.5 rounded-xl font-bold text-sm tracking-wide uppercase transition duration-200 flex items-center justify-center gap-2 transform {{ $primaryBtnStyles }}">
                            @if($cta->button_icon)<i class="{{ $cta->button_icon }} text-base"></i>@endif
                            <span>{{ $cta->button_label }}</span>
                        </a>
                    @endif
                    @if($cta->secondary_button_label && $cta->secondary_button_url)
                        <a href="{{ $cta->secondary_button_url }}" target="{{ $cta->secondary_button_target }}"
                           class="text-sm font-semibold transition duration-200 {{ $secondaryBtnStyles }}">
                            {{ $cta->secondary_button_label }}
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>
