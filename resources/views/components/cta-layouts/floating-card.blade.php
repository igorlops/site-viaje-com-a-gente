{{-- Layout: floating-card — Card branco elevado centralizado em fundo colorido --}}
@php
    $primaryBtnStyles = [
        'primary'   => 'bg-[#002752] text-white hover:bg-[#001c3d] shadow-[#002752]/20',
        'secondary' => 'bg-[#109e4a] text-white hover:bg-[#0d9648] shadow-[#109e4a]/20',
        'warning'   => 'bg-[#f3a908] text-[#002752] hover:bg-[#db9807] shadow-[#f3a908]/20',
        'outline'   => 'border-2 border-current hover:bg-black/5',
    ][$cta->button_variant ?? 'primary'] ?? 'bg-[#002752] text-white';

    $secondaryBtnStyles = [
        'primary'   => 'text-[#002752] hover:bg-[#002752]/5',
        'secondary' => 'text-[#109e4a] hover:bg-[#109e4a]/5',
        'warning'   => 'text-[#f3a908] hover:bg-[#f3a908]/5',
        'outline'   => 'border-2 border-current hover:bg-black/5',
        'ghost'     => 'text-gray-500 hover:text-gray-900 underline underline-offset-2',
    ][$cta->secondary_button_variant ?? 'ghost'] ?? 'text-gray-500 hover:text-gray-900 underline';
@endphp

<section
    class="relative w-full overflow-hidden {{ $cta->padding_vertical ?? 'py-20' }}"
    style="background-color: {{ $cta->bg_color ?? '#f8fafc' }};"
    @if($cta->analytics_event_name) data-analytics-section="{{ $cta->analytics_event_name }}" @endif
>
    {{-- Efeito visual ao redor --}}
    @if($cta->bg_image && $cta->bg_image !== 'none')
        <div class="absolute top-0 inset-x-0 h-[300px] z-0 bg-cover bg-center bg-no-repeat"
             style="background-image: url('{{ $cta->bg_image }}');">
             <div class="absolute inset-0 bg-black/40"></div>
        </div>
    @else
        <div class="absolute top-0 inset-x-0 h-[50%] z-0"
             style="background-color: {{ $cta->text_color ?? '#002752' }}; opacity: 0.05"></div>
    @endif

    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Card Flutuante --}}
        <div class="bg-white rounded-3xl shadow-[0_20px_50px_rgb(0,0,0,0.1)] p-8 sm:p-12 text-center transform transition duration-500 hover:-translate-y-1">

            {{-- Ícone/Badge de destaque --}}
            <div class="w-16 h-16 rounded-full bg-[#f3a908]/10 text-[#f3a908] flex items-center justify-center mx-auto mb-6">
                <i class="fa-solid fa-star text-2xl"></i>
            </div>

            @if($cta->title)
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight leading-tight mb-4">
                    {{ $cta->title }}
                </h2>
            @endif

            @if($cta->subtitle)
                <p class="text-base sm:text-lg text-gray-500 leading-relaxed max-w-2xl mx-auto mb-8">
                    {{ $cta->subtitle }}
                </p>
            @endif

            {{-- Lista de Diferenciais --}}
            @if($listItems->count() > 0)
                <div class="bg-gray-50 rounded-2xl p-6 mb-8 max-w-2xl mx-auto text-left">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-8">
                        @foreach($listItems as $item)
                            <div class="flex items-center gap-3">
                                <span class="flex-shrink-0 text-[#109e4a]">
                                    <i class="{{ $item->icon ?: 'fa-solid fa-check' }}"></i>
                                </span>
                                <span class="text-gray-700 font-medium text-sm">{{ $item->title }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Botões --}}
            @if($cta->button_label || $cta->secondary_button_label)
                <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                    @if($cta->button_label && $cta->button_url)
                        <a href="{{ $cta->button_url }}" target="{{ $cta->button_target }}"
                           @if($cta->analytics_event_name) onclick="trackCtaEvent('{{ $cta->analytics_event_name }}', 'primary')" @endif
                           class="w-full sm:w-auto px-8 py-3.5 rounded-xl font-bold text-sm tracking-wide uppercase transition duration-200 shadow-lg hover:shadow-xl flex items-center justify-center gap-2 {{ $primaryBtnStyles }}">
                            @if($cta->button_icon)<i class="{{ $cta->button_icon }} text-base"></i>@endif
                            <span>{{ $cta->button_label }}</span>
                        </a>
                    @endif
                    @if($cta->secondary_button_label && $cta->secondary_button_url)
                        <a href="{{ $cta->secondary_button_url }}" target="{{ $cta->secondary_button_target }}"
                           class="w-full sm:w-auto px-6 py-3.5 rounded-xl font-semibold text-sm transition duration-200 flex items-center justify-center gap-2 {{ $secondaryBtnStyles }}">
                            <span>{{ $cta->secondary_button_label }}</span>
                        </a>
                    @endif
                </div>
            @endif

        </div>
    </div>
</section>
