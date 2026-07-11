{{-- Layout: simple-band — Faixa full-width com conteúdo centralizado --}}
@php
    use Illuminate\Support\Str;
    $alignClasses = [
        'left'   => 'text-left items-start',
        'center' => 'text-center items-center',
        'right'  => 'text-right items-end',
    ][$cta->alignment ?? 'center'] ?? 'text-center items-center';

    $primaryBtnStyles = [
        'primary'   => 'bg-[#002752] text-white hover:bg-[#001c3d] hover:scale-[1.02] shadow-[#002752]/20',
        'secondary' => 'bg-[#109e4a] text-white hover:bg-[#0d9648] hover:scale-[1.02] shadow-[#109e4a]/20',
        'warning'   => 'bg-[#f3a908] text-[#002752] hover:bg-[#db9807] hover:scale-[1.02] shadow-[#f3a908]/20',
        'outline'   => 'border-2 border-current hover:bg-black/5 hover:scale-[1.02]',
    ][$cta->button_variant ?? 'primary'] ?? 'bg-[#002752] text-white';

    $secondaryBtnStyles = [
        'primary'   => 'bg-[#002752] text-white hover:bg-[#001c3b] hover:scale-[1.02]',
        'secondary' => 'bg-[#109e4a] text-white hover:bg-[#0d9648] hover:scale-[1.02]',
        'warning'   => 'bg-[#f3a908] text-[#002752] hover:bg-[#db9807] hover:scale-[1.02]',
        'outline'   => 'border-2 border-current hover:bg-black/5 hover:scale-[1.02]',
        'ghost'     => 'hover:bg-black/5 hover:scale-[1.02]',
    ][$cta->secondary_button_variant ?? 'outline'] ?? 'border-2 border-current hover:bg-black/5';
@endphp

<section
    class="relative w-full overflow-hidden {{ $cta->padding_vertical ?? 'py-16' }}"
    style="background-color: {{ $cta->bg_color ?? '#002752' }}; color: {{ $cta->text_color ?? '#ffffff' }};"
    @if($cta->analytics_event_name) data-analytics-section="{{ $cta->analytics_event_name }}" @endif
>
    {{-- Imagem de fundo opcional com overlay --}}
    @if($cta->bg_image && $cta->bg_image !== 'none')
        <div class="absolute inset-0 z-0 bg-cover bg-center bg-no-repeat opacity-10"
             style="background-image: url('{{ $cta->bg_image }}');"></div>
    @endif

    {{-- Elemento decorativo sutil --}}
    <div class="absolute -top-20 -right-20 w-72 h-72 rounded-full opacity-5 blur-3xl"
         style="background-color: {{ $cta->text_color ?? '#ffffff' }};"></div>
    <div class="absolute -bottom-20 -left-20 w-72 h-72 rounded-full opacity-5 blur-3xl"
         style="background-color: {{ $cta->text_color ?? '#ffffff' }};"></div>

    <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col {{ $alignClasses }} gap-6">

            {{-- Título e Subtítulo --}}
            @if($cta->title || $cta->subtitle)
                <div class="flex flex-col {{ $alignClasses }} gap-3 max-w-3xl">
                    @if($cta->title)
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight">
                            {{ $cta->title }}
                        </h2>
                    @endif
                    @if($cta->subtitle)
                        <p class="text-base sm:text-lg opacity-80 leading-relaxed">
                            {{ $cta->subtitle }}
                        </p>
                    @endif
                </div>
            @endif

            {{-- Lista de Diferenciais --}}
            @if($listItems->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 w-full max-w-2xl">
                    @foreach($listItems as $item)
                        <div class="flex items-center gap-3">
                            @if($item->icon)
                                <span class="flex-shrink-0 w-7 h-7 rounded-full flex items-center justify-center bg-white/10">
                                    <i class="{{ $item->icon }} text-sm"></i>
                                </span>
                            @endif
                            <span class="font-semibold text-sm">{{ $item->title }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Botões --}}
            @if($cta->button_label || $cta->secondary_button_label)
                <div class="flex flex-col sm:flex-row items-center gap-4 mt-2">
                    @if($cta->button_label && $cta->button_url)
                        <a href="{{ $cta->button_url }}" target="{{ $cta->button_target }}"
                           @if($cta->analytics_event_name) onclick="trackCtaEvent('{{ $cta->analytics_event_name }}', 'primary')" @endif
                           class="w-full sm:w-auto px-8 py-4 rounded-xl font-bold text-sm tracking-wide uppercase transition duration-200 shadow-lg hover:shadow-xl flex items-center justify-center gap-2 transform {{ $primaryBtnStyles }}">
                            @if($cta->button_icon)<i class="{{ $cta->button_icon }} text-base"></i>@endif
                            <span>{{ $cta->button_label }}</span>
                        </a>
                    @endif
                    @if($cta->secondary_button_label && $cta->secondary_button_url)
                        <a href="{{ $cta->secondary_button_url }}" target="{{ $cta->secondary_button_target }}"
                           class="w-full sm:w-auto px-8 py-4 rounded-xl font-bold text-sm tracking-wide uppercase transition duration-200 flex items-center justify-center gap-2 transform {{ $secondaryBtnStyles }}">
                            <span>{{ $cta->secondary_button_label }}</span>
                        </a>
                    @endif
                </div>
            @endif

        </div>
    </div>
</section>
