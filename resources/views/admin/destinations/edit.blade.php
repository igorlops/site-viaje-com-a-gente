@extends('layouts.admin')

@section('page_title', 'Editar Destino')

@section('admin_content')
    <div class="max-w-3xl bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="font-bold text-gray-800 text-base">Informações do Pacote</h2>
        </div>

        <form action="{{ route('admin.destinations.update', $destination->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Título (Cidade / Local)</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $destination->title) }}" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                        placeholder="Ex: Gramado">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Subtitle -->
                <div>
                    <label for="subtitle" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Subtítulo (Atrações / Detalhes)</label>
                    <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle', $destination->subtitle) }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                        placeholder="Ex: Canela + Bento Gonçalves">
                    @error('subtitle')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Duration -->
                <div>
                    <label for="duration" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Duração da Viagem</label>
                    <input type="text" name="duration" id="duration" value="{{ old('duration', $destination->duration) }}" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                        placeholder="Ex: 7 DIAS">
                    @error('duration')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Categoria</label>
                    <input type="text" name="category" id="category" value="{{ old('category', $destination->category) }}" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                        placeholder="Ex: AÉREO + HOTEL + PASSEIOS">
                    @error('category')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Preço Mensal (Boleto)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 font-bold text-sm">R$</span>
                        <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $destination->price) }}" required
                            class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                            placeholder="Ex: 69.99">
                    </div>
                    @error('price')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tag -->
                <div>
                    <label for="tag" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Tag de Destaque (Opcional)</label>
                    <input type="text" name="tag" id="tag" value="{{ old('tag', $destination->tag) }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                        placeholder="Ex: MAIS VENDIDO">
                    @error('tag')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Image Upload and Preview -->
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Imagem Ilustrativa</label>
                <div class="flex flex-col sm:flex-row gap-6 items-start">
                    @if($destination->image_path)
                        <div class="shrink-0">
                            <span class="block text-xs font-semibold text-gray-400 mb-1">Imagem atual:</span>
                            <img src="{{ asset('storage/' . $destination->image_path) }}" alt="{{ $destination->title }}" class="w-32 h-24 object-cover rounded-lg shadow-sm border border-gray-200">
                        </div>
                    @endif
                    
                    <div class="flex-grow w-full">
                        <span class="block text-xs font-semibold text-gray-400 mb-1">Enviar nova imagem (deixe em branco para manter a atual):</span>
                        <input type="file" name="image" id="image" accept="image/*"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-black file:uppercase file:bg-gray-100 file:text-[#002752] hover:file:bg-gray-200 file:cursor-pointer cursor-pointer border border-gray-300 rounded-lg p-1">
                        <p class="text-[10px] text-gray-400 mt-1.5 font-medium">Formatos suportados: JPG, JPEG, PNG, GIF. Tamanho máximo: 5MB.</p>
                        @error('image')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- WhatsApp Link -->
            <div>
                <label for="whatsapp_link" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Link WhatsApp Personalizado (Opcional)</label>
                <input type="url" name="whatsapp_link" id="whatsapp_link" value="{{ old('whatsapp_link', $destination->whatsapp_link) }}"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                    placeholder="Ex: https://wa.me/5585999166421?text=Olá, tenho interesse...">
                <p class="text-[10px] text-gray-400 mt-1.5 font-medium">Se deixado em branco, o site usará o link padrão do WhatsApp.</p>
                @error('whatsapp_link')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Checkboxes -->
            <div class="flex flex-col sm:flex-row gap-6">
                <label class="flex items-center gap-2.5 cursor-pointer select-none">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $destination->is_featured) ? 'checked' : '' }}
                        class="w-4 h-4 rounded text-[#002752] focus:ring-[#002752] border-gray-300">
                    <span class="text-sm font-bold text-gray-700 uppercase tracking-wide">Exibir na Home</span>
                </label>
            </div>

            <!-- Buttons -->
            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="bg-[#109e4a] hover:bg-[#0d9648] text-white px-6 py-3 rounded-lg font-bold text-xs uppercase tracking-wider transition duration-200 shadow-sm">
                    Salvar Alterações
                </button>
                <a href="{{ route('admin.destinations.index') }}" class="border border-gray-300 hover:bg-gray-50 text-gray-600 px-6 py-3 rounded-lg font-bold text-xs uppercase tracking-wider transition duration-200">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection
