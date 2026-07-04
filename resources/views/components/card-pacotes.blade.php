@props([
    'pkg',
    'whatsappUrl',
])

<div class="bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-100 overflow-hidden flex flex-col group transition duration-300 transform hover:-translate-y-1">
    <!-- Card Image -->
    <div class="relative h-48 bg-gray-200 overflow-hidden shrink-0 w-full">
        <img class="w-full h-full object-cover group-hover:scale-105 transition duration-500" src="{{ asset('storage/' . $pkg->image_path) }}" alt="{{ $pkg->title }}">

    </div>
    
    <!-- Card Body -->
    <div class="p-5 flex-grow flex flex-col justify-between">
        <div>
            <h3 class="text-[#002752] text-xl font-bold leading-snug mb-1">
                {{ $pkg->title_card ?? $pkg->title }}
            </h3>
            <p class="text-gray-500 text-sm font-medium mb-3">
                {{ $pkg->subtitle_card ?? $pkg->subtitle }}
            </p>
            @if($pkg->tag)
                <span class="relative text-[11px] px-2 bg-[#f3a908] text-white font-black tracking-wider py-1 rounded" style="width: 80%">
                    {{ $pkg->tag }}
                </span>
            @endif
            <!-- Info Badge -->
            <div class="inline-flex items-center gap-2 text-gray-400 text-xs font-semibold tracking-wider border-t border-b border-gray-100 py-1.5 w-full mb-4 mt-1">
                    <i class="far fa-calendar text-[#109e4a]"></i>
                    <span>{{ $pkg->duration }} Dias @if($pkg->nights) e {{ $pkg->nights }} Noites @endif</span>
                </div>
        </div>
        
        <div>
            <!-- Price -->
            <div class="mb-4">
                <span class="block text-gray-400 text-xs font-medium">A partir de</span>
                <div class="flex items-baseline gap-1">
                    <span class="text-[#109e4a] text-xs font-black">R$</span>
                    <span class="text-[#109e4a] text-2xl font-black">
                        {{ number_format($pkg->price, 2, ',', '.') }}
                    </span>
                    <span class="text-[#109e4a] text-xs font-bold">/por pessoa</span>
                </div>
                <span class="block text-gray-400 text-[10px] font-bold">Pagamento via PIX/BOLETO</span>
            </div>
            
            <!-- Actions -->
            @php
                $pkgWhatsapp = $pkg->whatsapp_link ?: $whatsappUrl . '?text=' . urlencode('Olá, gostaria de mais informações sobre o Bate e Volta para ' . $pkg->title);
            @endphp
            <div class="flex gap-2">
                <a href="{{ route('destination.show', $pkg->slug) }}" target="_blank" class="flex-grow inline-flex justify-center items-center bg-[#109e4a] hover:bg-[#0d9648] text-white font-bold text-xs uppercase py-3 rounded-lg transition duration-200 gap-1.5 shadow-sm">
                    <span>Reservar Vaga</span>
                    <i class="fas fa-chevron-right text-[9px]"></i>
                </a>
                <a href="{{ $pkgWhatsapp }}" target="_blank" class="w-10 h-10 inline-flex items-center justify-center border border-[#109e4a] hover:bg-[#109e4a] text-[#109e4a] hover:text-white rounded-lg transition duration-200">
                    <i class="fab fa-whatsapp text-lg"></i>
                </a>
            </div>
        </div>
    </div>
</div>