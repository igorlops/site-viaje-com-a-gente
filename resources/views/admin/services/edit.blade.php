@extends('layouts.admin')

@section('page_title', 'Editar Serviço')

@section('admin_content')
    <div class="mb-6">
        <a href="{{ route('admin.services.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-gray-500 hover:text-[#002752] transition duration-200">
            <i class="fas fa-arrow-left"></i>
            Voltar para Serviços
        </a>
    </div>

    <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- INFORMAÇÕES BÁSICAS --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50">
                <h2 class="font-bold text-gray-800 text-sm flex items-center gap-2">
                    <i class="fas fa-info-circle text-[#002752]"></i>
                    Informações Básicas
                </h2>
            </div>
            <div class="p-6 space-y-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    {{-- Título --}}
                    <div>
                        <label for="title" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Título <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title', $service->title) }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                            placeholder="Ex: Intercâmbio Estudantil">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Subtítulo --}}
                    <div>
                        <label for="subtitle" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Subtítulo</label>
                        <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle', $service->subtitle) }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                            placeholder="Ex: Aprenda um novo idioma no exterior">
                        @error('subtitle')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- IMAGENS --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50">
                <h2 class="font-bold text-gray-800 text-sm flex items-center gap-2">
                    <i class="fas fa-images text-[#002752]"></i>
                    Imagens
                </h2>
            </div>
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                {{-- Imagem de Destaque --}}
                <div>
                    <label for="image" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                        Imagem de Destaque
                    </label>
                    @if($service->image_path)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $service->image_path) }}" alt="Imagem atual"
                                 class="h-32 w-32 object-cover rounded-lg border border-gray-200">
                            <p class="text-[10px] text-gray-400 mt-1">Imagem atual. Envie novo arquivo para substituir.</p>
                        </div>
                    @endif
                    <input type="file" name="image" id="image" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-black file:uppercase file:bg-gray-100 file:text-[#002752] hover:file:bg-gray-200 file:cursor-pointer cursor-pointer border border-gray-300 rounded-lg p-1">
                    <p class="text-[10px] text-gray-400 mt-1.5">Exibida no corpo da página. Máximo: 5MB.</p>
                    @error('image')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const easyMDE = new EasyMDE({
                    element: document.getElementById('content'),
                    spellChecker: false,
                    nativeSpellcheck: false,
                    forceSync: true,
                    status: false,
                    renderingConfig: {
                        singleLineBreaks: false
                    },
                    toolbar: [
                        "bold", "italic", "heading", "|",
                        "quote", "unordered-list", "ordered-list", "|",
                        "link", "image", "table", "horizontal-rule", "|",
                        "preview", "side-by-side", "fullscreen", "|",
                        "guide"
                    ]
                });
            });
        </script>

        {{-- BOTÕES --}}
        <div class="flex items-center gap-3">
            <button type="submit" class="bg-[#109e4a] hover:bg-[#0d9648] text-white px-8 py-3 rounded-lg font-bold text-xs uppercase tracking-wider transition duration-200 shadow-sm">
                <i class="fas fa-save mr-2"></i> Salvar Alterações
            </button>
            <a href="{{ route('admin.services.index') }}" class="border border-gray-300 hover:bg-gray-50 text-gray-600 px-6 py-3 rounded-lg font-bold text-xs uppercase tracking-wider transition duration-200">
                Cancelar
            </a>
        </div>
    </form>
@endsection
