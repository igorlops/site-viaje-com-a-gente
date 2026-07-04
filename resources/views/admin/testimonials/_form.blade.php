{{-- Partial compartilhado entre create e edit de Depoimentos --}}
<div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

    {{-- Nome do Autor --}}
    <div>
        <label for="author_name" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
            Nome do Autor <span class="text-red-500">*</span>
        </label>
        <input type="text" name="author_name" id="author_name"
               value="{{ old('author_name', $testimonial->author_name ?? '') }}" required
               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
               placeholder="Ex: Maria Silva">
        @error('author_name')
            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
        @enderror
    </div>

    {{-- Cargo / Papel --}}
    <div>
        <label for="author_role" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
            Cargo / Papel
        </label>
        <input type="text" name="author_role" id="author_role"
               value="{{ old('author_role', $testimonial->author_role ?? '') }}"
               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
               placeholder="Ex: Viajante, Cliente desde 2023">
        @error('author_role')
            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
        @enderror
    </div>

    {{-- Avaliação (estrelas) --}}
    <div>
        <label for="rating" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
            Avaliação (Estrelas) <span class="text-red-500">*</span>
        </label>
        <select name="rating" id="rating" required
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white">
            @for($i = 5; $i >= 1; $i--)
                <option value="{{ $i }}" {{ old('rating', $testimonial->rating ?? 5) == $i ? 'selected' : '' }}>
                    {{ $i }} {{ $i === 1 ? 'Estrela' : 'Estrelas' }}
                </option>
            @endfor
        </select>
        @error('rating')
            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
        @enderror
    </div>

    {{-- Ordem --}}
    <div>
        <label for="order" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
            Ordem de Exibição
        </label>
        <input type="number" name="order" id="order" min="0"
               value="{{ old('order', $testimonial->order ?? 0) }}"
               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
               placeholder="0">
        @error('order')
            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
        @enderror
    </div>

    {{-- Texto do Depoimento --}}
    <div class="sm:col-span-2">
        <label for="content" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
            Texto do Depoimento <span class="text-red-500">*</span>
        </label>
        <textarea name="content" id="content" rows="4" required
                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white resize-none"
                  placeholder="Escreva o depoimento do cliente aqui...">{{ old('content', $testimonial->content ?? '') }}</textarea>
        @error('content')
            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
        @enderror
    </div>

    {{-- Foto do Autor --}}
    <div class="sm:col-span-2">
        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
            Foto do Autor
        </label>
        <div class="flex items-start gap-5">
            @if(isset($testimonial) && $testimonial->author_photo)
                <div class="shrink-0">
                    <img src="{{ asset('storage/' . $testimonial->author_photo) }}"
                         alt="{{ $testimonial->author_name }}"
                         class="w-16 h-16 rounded-full object-cover border-2 border-gray-200">
                    <p class="text-[10px] text-gray-400 text-center mt-1">Foto atual</p>
                </div>
            @endif
            <div class="flex-1">
                <input type="file" name="author_photo" id="author_photo"
                       accept="image/jpeg,image/png,image/gif,image/webp"
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#002752]/5 file:text-[#002752] hover:file:bg-[#002752]/10 transition duration-200 cursor-pointer">
                <p class="text-[10px] text-gray-400 mt-1.5">JPEG, PNG ou WebP. Máx. 3MB. Será exibida em formato circular.</p>
                @error('author_photo')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    {{-- Status Ativo --}}
    <div class="sm:col-span-2">
        <label class="flex items-center gap-3 cursor-pointer select-none w-fit">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" id="is_active" value="1"
                   class="w-5 h-5 rounded border-gray-300 text-[#109e4a] focus:ring-[#109e4a]/20 transition"
                   {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }}>
            <span class="text-sm font-semibold text-gray-700">Exibir este depoimento no site</span>
        </label>
        <p class="text-[10px] text-gray-400 mt-1 ml-8">Apenas depoimentos ativos aparecem na página pública.</p>
    </div>
</div>
