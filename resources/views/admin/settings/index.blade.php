@extends('layouts.admin')

@section('page_title', 'Configurações Gerais')

@section('admin_content')

@php
    $groupLabels = [
        'identidade' => ['icon' => 'fa-paint-brush', 'label' => 'Identidade Visual', 'color' => 'blue'],
        'contato'    => ['icon' => 'fa-address-book', 'label' => 'Informações de Contato', 'color' => 'green'],
        'seo'        => ['icon' => 'fa-magnifying-glass-chart', 'label' => 'SEO & Metadados', 'color' => 'purple'],
    ];
    $colorMap = [
        'blue'   => ['bg' => 'bg-blue-50', 'text' => 'text-blue-600', 'border' => 'border-blue-200', 'badge' => 'bg-blue-100 text-blue-700'],
        'green'  => ['bg' => 'bg-green-50', 'text' => 'text-green-600', 'border' => 'border-green-200', 'badge' => 'bg-green-100 text-green-700'],
        'purple' => ['bg' => 'bg-purple-50', 'text' => 'text-purple-600', 'border' => 'border-purple-200', 'badge' => 'bg-purple-100 text-purple-700'],
    ];
@endphp

<div class="space-y-8">
    {{-- Cabeçalho --}}
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-black text-[#002752] flex items-center gap-3">
                <span class="w-10 h-10 bg-[#002752] text-white rounded-xl flex items-center justify-center">
                    <i class="fas fa-sliders text-sm"></i>
                </span>
                Configurações Gerais
            </h2>
            <p class="text-sm text-gray-500 mt-1 ml-13">Gerencie as configurações globais do site</p>
        </div>
    </div>

    {{-- Grupos de configurações --}}
    @foreach($settingsGrouped as $group => $settings)
        @php
            $meta   = $groupLabels[$group] ?? ['icon' => 'fa-gear', 'label' => ucfirst($group), 'color' => 'blue'];
            $colors = $colorMap[$meta['color']] ?? $colorMap['blue'];
        @endphp

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            {{-- Cabeçalho do grupo --}}
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3 {{ $colors['bg'] }}">
                <div class="w-9 h-9 rounded-lg {{ $colors['bg'] }} {{ $colors['text'] }} flex items-center justify-center border {{ $colors['border'] }}">
                    <i class="fas {{ $meta['icon'] }} text-sm"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 text-base">{{ $meta['label'] }}</h3>
                    <p class="text-xs text-gray-500">{{ $settings->count() }} {{ $settings->count() === 1 ? 'configuração' : 'configurações' }}</p>
                </div>
            </div>

            {{-- Items da configuração --}}
            <div class="divide-y divide-gray-50">
                @foreach($settings as $setting)
                <div class="px-6 py-5 flex items-start gap-4 group hover:bg-gray-50/50 transition-colors duration-150">
                    <div class="flex-grow min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="font-semibold text-sm text-gray-700">{{ $setting->label }}</span>
                            <span class="text-[10px] font-mono uppercase px-1.5 py-0.5 rounded {{ $colors['badge'] }} shrink-0">
                                {{ $setting->type }}
                            </span>
                        </div>

                        @if($setting->type === 'image')
                            <div class="flex items-center gap-4 mt-2">
                                @if($setting->value)
                                    @if(str_starts_with($setting->value, 'settings/') || str_starts_with($setting->value, 'banners/'))
                                        <img src="{{ asset('storage/' . $setting->value) }}"
                                             alt="{{ $setting->label }}"
                                             class="h-12 w-auto max-w-[120px] rounded-lg border border-gray-200 object-contain bg-gray-50 p-1">
                                    @else
                                        <img src="{{ asset($setting->value) }}"
                                             alt="{{ $setting->label }}"
                                             class="h-12 w-auto max-w-[120px] rounded-lg border border-gray-200 object-contain bg-gray-50 p-1">
                                    @endif
                                @else
                                    <div class="h-12 w-20 rounded-lg border border-dashed border-gray-300 bg-gray-50 flex items-center justify-center text-gray-400 text-xs">
                                        Sem imagem
                                    </div>
                                @endif
                                <span class="text-xs text-gray-400 font-mono truncate max-w-[200px]">{{ $setting->value ?: '—' }}</span>
                            </div>
                        @elseif($setting->type === 'textarea')
                            <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $setting->value ?: '—' }}</p>
                        @else
                            <p class="text-sm text-gray-500 mt-1 truncate">{{ $setting->value ?: '—' }}</p>
                        @endif
                    </div>

                    <a href="{{ route('admin.settings.edit', $setting) }}"
                       class="shrink-0 inline-flex items-center gap-1.5 border border-gray-200 hover:border-[#002752] hover:bg-[#002752] hover:text-white text-gray-600 text-xs font-semibold px-3 py-2 rounded-lg transition-all duration-200 opacity-0 group-hover:opacity-100">
                        <i class="fas fa-pencil text-[10px]"></i>
                        Editar
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>

@endsection
