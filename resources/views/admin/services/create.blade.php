@extends('layouts.admin')

@section('page_title', 'Novo Serviço')

@section('admin_content')
    <div class="mb-6">
        <a href="{{ route('admin.services.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-gray-500 hover:text-[#002752] transition duration-200">
            <i class="fas fa-arrow-left"></i>
            Voltar para Serviços
        </a>
    </div>

    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

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
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                            placeholder="Ex: Intercâmbio Estudantil"
                            oninput="generateSlug(this.value)">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    <div>
                        <label for="slug" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Slug (URL) <span class="text-red-500">*</span>
                        </label>
                        <div class="flex items-center gap-1">
                            <span class="text-xs text-gray-400 whitespace-nowrap">/servicos/</span>
                            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200 font-mono"
                                placeholder="intercambio-estudantil">
                        </div>
                        @error('slug')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Subtítulo --}}
                    <div>
                        <label for="subtitle" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Subtítulo</label>
                        <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                            placeholder="Ex: Aprenda um novo idioma no exterior">
                        @error('subtitle')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Resumo --}}
                    <div>
                        <label for="summary" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Resumo Curto</label>
                        <input type="text" name="summary" id="summary" value="{{ old('summary') }}" maxlength="500"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                            placeholder="Breve descrição do serviço (até 500 caracteres)">
                        @error('summary')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Status e Menu --}}
                <div class="flex flex-col sm:flex-row gap-6 pt-2">
                    <div>
                        <label for="status" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" id="status" required
                            class="px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200 bg-white">
                            <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>📝 Rascunho</option>
                            <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>✅ Publicado</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-end pb-1">
                        <label class="flex items-center gap-2.5 cursor-pointer select-none">
                            <input type="checkbox" name="show_in_menu" value="1" {{ old('show_in_menu') ? 'checked' : '' }}
                                class="w-4 h-4 rounded text-[#002752] focus:ring-[#002752] border-gray-300">
                            <span class="text-sm font-bold text-gray-700 uppercase tracking-wide">Exibir no Menu Principal</span>
                        </label>
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
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                {{-- Banner --}}
                <div>
                    <label for="banner" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                        Banner Principal (Hero)
                    </label>
                    <input type="file" name="banner" id="banner" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-black file:uppercase file:bg-gray-100 file:text-[#002752] hover:file:bg-gray-200 file:cursor-pointer cursor-pointer border border-gray-300 rounded-lg p-1">
                    <p class="text-[10px] text-gray-400 mt-1.5">Recomendado: 1920x600px. Máximo: 5MB.</p>
                    @error('banner')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Imagem de Destaque --}}
                <div>
                    <label for="image" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                        Imagem de Destaque
                    </label>
                    <input type="file" name="image" id="image" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-black file:uppercase file:bg-gray-100 file:text-[#002752] hover:file:bg-gray-200 file:cursor-pointer cursor-pointer border border-gray-300 rounded-lg p-1">
                    <p class="text-[10px] text-gray-400 mt-1.5">Exibida no corpo da página. Máximo: 5MB.</p>
                    @error('image')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- CONTEÚDO MARKDOWN COM EASYMDE --}}
        <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
        <style>
            .editor-preview-active, .editor-preview-active-side {
                background: white !important;
                color: #333 !important;
            }
            .EasyMDEContainer {
                border-radius: 0.5rem;
                overflow: hidden;
            }
            .editor-toolbar {
                border-color: #d1d5db !important;
                background-color: #f9fafb !important;
                border-top-left-radius: 0.5rem !important;
                border-top-right-radius: 0.5rem !important;
            }
            .CodeMirror {
                border-color: #d1d5db !important;
                border-bottom-left-radius: 0.5rem !important;
                border-bottom-right-radius: 0.5rem !important;
                font-family: monospace;
            }
        </style>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                <h2 class="font-bold text-gray-800 text-sm flex items-center gap-2">
                    <i class="fas fa-align-left text-[#002752]"></i>
                    Conteúdo da Página (Editor Visual)
                </h2>
                <span class="text-xs text-gray-400 bg-gray-100 px-2.5 py-1 rounded-full font-medium">Formatador Rich Text</span>
            </div>
            <div class="p-6">
                <textarea name="content" id="content" rows="16"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200 font-mono resize-y"
                    placeholder="## Sobre este serviço&#10;&#10;Descreva aqui o serviço em detalhes...&#10;&#10;## Por que escolher?&#10;&#10;- Razão 1&#10;- Razão 2&#10;- Razão 3">{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
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

        {{-- SEO --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50">
                <h2 class="font-bold text-gray-800 text-sm flex items-center gap-2">
                    <i class="fas fa-search text-[#002752]"></i>
                    SEO e Meta Dados
                </h2>
                <p class="text-xs text-gray-400 mt-1">Otimize como este serviço aparece nos mecanismos de busca</p>
            </div>
            <div class="p-6 space-y-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="meta_title" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" maxlength="255"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                            placeholder="Título para SEO (deixe vazio para usar o título do serviço)">
                    </div>
                    <div>
                        <label for="meta_keywords" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                            placeholder="intercâmbio, estudar no exterior, viagem">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="meta_description" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="2" maxlength="500"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200 resize-none"
                            placeholder="Descrição que aparece no Google (recomendado: 150-160 caracteres)">{{ old('meta_description') }}</textarea>
                    </div>
                </div>

                <hr class="border-gray-100">

                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Open Graph (Redes Sociais)</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="og_title" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">OG Title</label>
                        <input type="text" name="og_title" id="og_title" value="{{ old('og_title') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                            placeholder="Título para compartilhamento">
                    </div>
                    <div>
                        <label for="og_image" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">OG Image</label>
                        <input type="file" name="og_image" id="og_image" accept="image/*"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-black file:uppercase file:bg-gray-100 file:text-[#002752] hover:file:bg-gray-200 file:cursor-pointer cursor-pointer border border-gray-300 rounded-lg p-1">
                        <p class="text-[10px] text-gray-400 mt-1">Recomendado: 1200x630px</p>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="og_description" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">OG Description</label>
                        <textarea name="og_description" id="og_description" rows="2" maxlength="500"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200 resize-none"
                            placeholder="Descrição para compartilhamento nas redes sociais">{{ old('og_description') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- BOTÕES --}}
        <div class="flex items-center gap-3">
            <button type="submit" class="bg-[#109e4a] hover:bg-[#0d9648] text-white px-8 py-3 rounded-lg font-bold text-xs uppercase tracking-wider transition duration-200 shadow-sm">
                <i class="fas fa-save mr-2"></i> Salvar Serviço
            </button>
            <a href="{{ route('admin.services.index') }}" class="border border-gray-300 hover:bg-gray-50 text-gray-600 px-6 py-3 rounded-lg font-bold text-xs uppercase tracking-wider transition duration-200">
                Cancelar
            </a>
        </div>
    </form>

    <script>
        function generateSlug(title) {
            const slugField = document.getElementById('slug');
            if (!slugField.dataset.edited) {
                slugField.value = title
                    .toLowerCase()
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '')
                    .replace(/[^a-z0-9\s-]/g, '')
                    .trim()
                    .replace(/[\s_]+/g, '-')
                    .replace(/-+/g, '-');
            }
        }

        document.getElementById('slug').addEventListener('input', function () {
            this.dataset.edited = 'true';
        });
    </script>
@endsection
