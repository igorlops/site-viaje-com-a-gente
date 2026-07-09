@props(['cta'])

@php
    // Se o CTA não estiver ativo, não renderiza absolutamente nada
    if (!$cta || !$cta->active) {
        return;
    }

    // Mapeamento de Alinhamento do Tailwind
    $alignClasses = [
        'left' => 'text-left justify-start items-start',
        'center' => 'text-center justify-center items-center',
        'right' => 'text-right justify-end items-end',
    ][$cta->alignment ?? 'center'] ?? 'text-center justify-center items-center';

    // Lista de itens ativos ordenada pela coluna order
    $listItems = $cta->cta_session_list ? $cta->cta_session_list->where('active', true)->sortBy('order') : collect();

    // Mapeamento de Estilos para o Botão Principal
    $primaryBtnStyles = [
        'primary' => 'bg-[#002752] text-white hover:bg-[#001c3d] hover:scale-[1.02] shadow-[#002752]/20',
        'secondary' => 'bg-[#109e4a] text-white hover:bg-[#0d9648] hover:scale-[1.02] shadow-[#109e4a]/20',
        'warning' => 'bg-[#f3a908] text-[#002752] hover:bg-[#db9807] hover:scale-[1.02] shadow-[#f3a908]/20',
        'outline' => 'border-2 border-current hover:bg-black/5 hover:scale-[1.02]',
    ][$cta->button_variant ?? 'primary'] ?? 'bg-[#002752] text-white';

    // Mapeamento de Estilos para o Botão Secundário
    $secondaryBtnStyles = [
        'primary' => 'bg-[#002752] text-white hover:bg-[#001c3b] hover:scale-[1.02]',
        'secondary' => 'bg-[#109e4a] text-white hover:bg-[#0d9648] hover:scale-[1.02]',
        'warning' => 'bg-[#f3a908] text-[#002752] hover:bg-[#db9807] hover:scale-[1.02]',
        'outline' => 'border-2 border-current hover:bg-black/5 hover:scale-[1.02]',
        'ghost' => 'hover:bg-black/5 hover:scale-[1.02]',
    ][$cta->secondary_button_variant ?? 'outline'] ?? 'border-2 border-current hover:bg-black/5';
@endphp

<section 
    class="relative w-full overflow-hidden transition-all duration-300 {{ $cta->padding_vertical ?? 'py-16' }}"
    style="background-color: {{ $cta->bg_color ?? '#ffffff' }}; color: {{ $cta->text_color ?? '#000000' }};"
    @if($cta->analytics_event_name) data-analytics-section="{{ $cta->analytics_event_name }}" @endif
>
    {{-- Efeito decorativo sutil de fundo se imagem não for 'none' --}}
    @if($cta->bg_image && $cta->bg_image !== 'none')
        <div class="absolute inset-0 z-0 bg-cover bg-center bg-no-repeat opacity-15" style="background-image: url('{{ $cta->bg_image }}');"></div>
    @endif

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col {{ $alignClasses }} max-w-4xl mx-auto gap-8">
            
            <!-- Cabeçalho (Título e Subtítulo) -->
            <div class="flex flex-col {{ $alignClasses }} gap-4 w-full">
                @if($cta->title)
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight">
                        {{ $cta->title }}
                    </h2>
                @endif

                @if($cta->subtitle)
                    <p class="text-base sm:text-lg opacity-85 leading-relaxed max-w-3xl">
                        {{ $cta->subtitle }}
                    </p>
                @endif
            </div>

            <!-- Lista de Diferenciais / Características -->
            @if($listItems->count() > 0)
                <div class="w-full my-2">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full text-left max-w-3xl mx-auto">
                        @foreach($listItems as $item)
                            <div class="flex items-start gap-3 p-3 rounded-xl transition duration-200 hover:bg-black/[0.02] border border-transparent hover:border-black/[0.04]">
                                @if($item->icon)
                                    <span class="flex-shrink-0 flex items-center justify-center w-8 h-8 rounded-lg bg-black/5" style="color: {{ $cta->text_color ?? '#000000' }}">
                                        <i class="{{ $item->icon }} text-base"></i>
                                    </span>
                                @endif
                                <div class="flex-grow">
                                    <p class="font-bold text-sm sm:text-base leading-tight mt-1">
                                        {{ $item->title }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Bloco de Ações (Botões) -->
            @if($cta->button_label || $cta->secondary_button_label)
                <div class="flex flex-col sm:flex-row items-center gap-4 w-full sm:w-auto mt-2">
                    
                    <!-- Botão Principal -->
                    @if($cta->button_label && $cta->button_url)
                        <a 
                            href="{{ $cta->button_url }}" 
                            target="{{ $cta->button_target }}"
                            @if($cta->analytics_event_name) onclick="trackCtaEvent('{{ $cta->analytics_event_name }}', 'primary')" @endif
                            class="w-full sm:w-auto px-8 py-4 rounded-xl font-bold text-sm tracking-wide uppercase transition duration-200 shadow-lg hover:shadow-xl flex items-center justify-center gap-2 transform {{ $primaryBtnStyles }}"
                        >
                            @if($cta->button_icon)
                                <i class="{{ $cta->button_icon }} text-base"></i>
                            @endif
                            <span>{{ $cta->button_label }}</span>
                        </a>
                    @endif

                    <!-- Botão Secundário -->
                    @if($cta->secondary_button_label && $cta->secondary_button_url)
                        <a 
                            href="{{ $cta->secondary_button_url }}" 
                            target="{{ $cta->secondary_button_target }}"
                            @if($cta->analytics_event_name) onclick="trackCtaEvent('{{ $cta->analytics_event_name }}', 'secondary')" @endif
                            class="w-full sm:w-auto px-8 py-4 rounded-xl font-bold text-sm tracking-wide uppercase transition duration-200 flex items-center justify-center gap-2 transform {{ $secondaryBtnStyles }}"
                        >
                            <span>{{ $cta->secondary_button_label }}</span>
                        </a>
                    @endif

                </div>
            @endif

        </div>
    </div>
</section>

<!-- Script de Suporte opcional para Analytics -->
@if($cta->analytics_event_name)
<script>
    if (typeof trackCtaEvent !== 'function') {
        function trackCtaEvent(eventName, type) {
            if (typeof dataLayer !== 'undefined') {
                dataLayer.push({
                    'event': eventName,
                    'cta_type': type
                });
            }
        }
    }
</script>
@endif