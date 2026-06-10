@extends('layouts.admin')

@section('page_title', 'Editar Banner Principal')

@section('admin_content')
    <div class="max-w-3xl bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="font-bold text-gray-800 text-base">Formulário de Edição</h2>
        </div>

        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label for="title" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Título do Banner</label>
                <input type="text" name="title" id="title" value="{{ old('title', $banner->title) }}"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                    placeholder="Sua próxima viagem está mais perto do que você imagina!">
                @error('title')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Subtitle -->
            <div>
                <label for="subtitle" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Subtítulo do Banner</label>
                <textarea name="subtitle" id="subtitle" rows="3"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                    placeholder="Viaje com segurança, parcele no boleto...">{{ old('subtitle', $banner->subtitle) }}</textarea>
                @error('subtitle')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image Upload and Preview -->
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Imagem de Fundo</label>
                <div class="flex flex-col sm:flex-row gap-6 items-start">
                    @if($banner->image_path)
                        <div class="shrink-0">
                            <span class="block text-xs font-semibold text-gray-400 mb-1">Imagem atual:</span>
                            <img src="{{ asset('storage/' . $banner->image_path) }}" alt="Banner" class="w-48 h-28 object-cover rounded-lg shadow-sm border border-gray-200">
                        </div>
                    @endif
                    
                    <div class="flex-grow">
                        <span class="block text-xs font-semibold text-gray-400 mb-1">Enviar nova imagem:</span>
                        <input type="file" name="image" id="image" accept="image/*"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-black file:uppercase file:bg-gray-100 file:text-[#002752] hover:file:bg-gray-200 file:cursor-pointer cursor-pointer border border-gray-300 rounded-lg p-1">
                        <p class="text-[10px] text-gray-400 mt-1.5">Formatos suportados: JPG, JPEG, PNG, GIF. Tamanho máximo: 5MB.</p>
                        @error('image')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Active Checkbox -->
            <div>
                <label class="flex items-center gap-2.5 cursor-pointer select-none">
                    <input type="checkbox" name="active" value="1" {{ old('active', $banner->active) ? 'checked' : '' }}
                        class="w-4 h-4 rounded text-[#002752] focus:ring-[#002752] border-gray-300">
                    <span class="text-sm font-bold text-gray-700 uppercase tracking-wide">Banner Ativo</span>
                </label>
            </div>

            <!-- Buttons -->
            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="bg-[#109e4a] hover:bg-[#0d9648] text-white px-6 py-3 rounded-lg font-bold text-xs uppercase tracking-wider transition duration-200 shadow-sm">
                    Salvar Alterações
                </button>
                <a href="{{ route('admin.banners.index') }}" class="border border-gray-300 hover:bg-gray-50 text-gray-600 px-6 py-3 rounded-lg font-bold text-xs uppercase tracking-wider transition duration-200">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection
