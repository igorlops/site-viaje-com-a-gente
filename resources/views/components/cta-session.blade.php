@props(['cta'])

@php
    // Se o CTA não estiver ativo, não renderiza absolutamente nada
    if (!$cta || !$cta->active) {
        return;
    }

    // Lista de itens ativos ordenada pela coluna order
    $listItems = $cta->cta_session_list ? $cta->cta_session_list->where('active', true)->sortBy('order') : collect();
@endphp

@switch($cta->layout)
    @case('split')
        @include('components.cta-layouts.split', ['cta' => $cta, 'listItems' => $listItems])
        @break
    @case('image-highlight')
        @include('components.cta-layouts.image-highlight', ['cta' => $cta, 'listItems' => $listItems])
        @break
    @case('floating-card')
        @include('components.cta-layouts.floating-card', ['cta' => $cta, 'listItems' => $listItems])
        @break
    @default
        {{-- simple-band é o fallback/default --}}
        @include('components.cta-layouts.simple-band', ['cta' => $cta, 'listItems' => $listItems])
@endswitch

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