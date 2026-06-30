@props([
    'whatsappUrl' => $whatsappUrl 
])

@php
    $url = $whatsappUrl;
@endphp

<a href="{{ $url }}" 
   target="_blank" 
   rel="noopener noreferrer" 
   class="fixed bottom-6 right-6 z-[9999] flex items-center justify-center w-14 h-14 bg-[#25D366] text-white rounded-full shadow-lg hover:bg-[#20ba5a] hover:scale-110 transition duration-300 group"
   aria-label="Fale conosco pelo WhatsApp">
   
    <span class="absolute inline-flex h-full w-full rounded-full bg-[#25D366] opacity-75 animate-ping group-hover:animate-none"></span>

    <i class="fab fa-whatsapp text-2xl relative z-10"></i>
</a>