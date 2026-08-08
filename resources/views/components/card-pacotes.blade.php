@props([
    'pkg',
    'whatsappUrl',
])

<div class="bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-100 overflow-hidden flex flex-col group transition duration-300 transform hover:-translate-y-1 h-full">
    <!-- Card Image -->
    <div class="relative h-48 bg-gray-200 overflow-hidden shrink-0 w-full">
        <img class="w-full h-full object-cover group-hover:scale-105 transition duration-500" 
             src="{{ asset('storage/' . $pkg->image_path) }}" 
             alt="{{ $pkg->title }}"
             onerror="">
    </div>
    
    <!-- Card Body -->
    <div class="p-5 flex-grow flex flex-col justify-between">
        <div>
            <!-- Título padronizado com altura fixa (máx 2 linhas) -->
            <h3 class="text-[#002752] text-xl font-bold leading-snug mb-1 h-[3.5rem] line-clamp-2" title="{{ $pkg->title_card ?? $pkg->title }}">
                {{ $pkg->title_card ?? $pkg->title }}
            </h3>

            <!-- Subtítulo padronizado com altura fixa (máx 3 linhas) -->
            <p class="text-gray-500 text-sm font-medium mb-3 h-[3.75rem] line-clamp-3" title="{{ $pkg->subtitle_card ?? $pkg->subtitle }}">
                {{ $pkg->subtitle_card ?? $pkg->subtitle }}
            </p>

            <div class="flex items-center gap-2 min-h-[10px]">
                @if(!empty($pkg->tag))
                    <span class="relative text-[11px] px-2 bg-[#f3a908] text-white font-black tracking-wider py-1 rounded truncate max-w-full">
                        {{ $pkg->tag }}
                    </span>
                @endif
            </div>
            <div class="inline-flex items-center">
                <span class="text-[11px] px-2 bg-[#f3a908] text-white font-black tracking-wider py-1 rounded">
                    {{ $pkg->trip_type }}
                </span>
            </div>
            <!-- Info Badge -->
            <div class="flex flex-row justify-between items-center gap-2 border-t border-b border-gray-100 py-1.5 mb-4 mt-1">
                <div class="inline-flex items-center gap-2 text-gray-400 text-xs font-semibold tracking-wider">
                    <i class="far fa-calendar text-[#109e4a]"></i>
                    <span>
                        @if($pkg->duration) 
                            {{ $pkg->duration }} {{ $pkg->duration > 1 ? 'Dias' : 'Dia' }} 
                        @endif 
                        @if($pkg->nights > 0) 
                            e {{ $pkg->nights }} {{ $pkg->nights > 1 ? 'Noites' : 'Noite' }} 
                        @endif
                    </span>
                </div>
                
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
                    <span>Saiba mais</span>
                </a>
                <a href="{{ $pkgWhatsapp }}" target="_blank" class="w-10 h-10 shrink-0 inline-flex items-center justify-center border border-[#109e4a] hover:bg-[#109e4a] text-[#109e4a] hover:text-white rounded-lg transition duration-200">
                    <i class="fab fa-whatsapp text-lg"></i>
                </a>
            </div>
        </div>
    </div>
</div>