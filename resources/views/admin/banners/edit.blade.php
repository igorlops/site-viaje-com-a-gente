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
            <div>
                <label for="titulo_destaque" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Trecho em Destaque</label>
                <input type="text" name="titulo_destaque" id="titulo_destaque" value="{{ old('titulo_destaque', $banner->titulo_destaque) }}"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                    placeholder="Sua próxima viagem está mais perto do que você imagina!">
                @error('titulo_destaque')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>
            <!-- Page -->
            <div>
                <label for="page_id" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Página do Banner</label>
                <select name="page_id" id="page_id" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200">
                    <option value="">Selecione a página</option>
                    @foreach($pages as $page)
                        <option value="{{ $page->id }}" {{ old('page_id',$banner->page_id) == $page->id ? 'selected' : '' }} >{{ $page->name }}</option>
                    @endforeach
                </select>
                @error('page_id')
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

            <!-- Features -->
            <div class="border-t border-gray-100 pt-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-gray-800 text-sm uppercase">Features</h3>

                    <button
                        type="button"
                        id="add-feature"
                        class="bg-[#109e4a] hover:bg-[#0d9648] text-white px-6 py-3 rounded-lg font-bold text-xs uppercase tracking-wider transition duration-200 shadow-sm cursor-pointer">
                        Adicionar Feature
                    </button>
                </div>

                <div id="features-container">
                    @if(isset($banner->featureBanners))
                        @foreach($banner->featureBanners as $featureIndex => $feature)
                    <div class="feature-item border rounded-lg p-4 mb-4 bg-gray-50 relative">

                        <form action="{{ route('admin.feature-banner.delete', $feature->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="remove-feature absolute top-2 right-2 text-red-500 font-bold">
                                X
                            </button>
                        </form>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">
                                        Nome
                                    </label>

                                    <input
                                        type="text"
                                        name="features[${featureIndex}][name]"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300"
                                        value="{{ old('features.{$featureIndex}.name', $feature->name) }}">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">
                                        Ícone
                                    </label>

                                    <input
                                        type="text"
                                        name="features[${featureIndex}][icon]"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300"
                                        placeholder="fa-solid fa-plane"
                                        value="{{ old('features.{$featureIndex}.icon', $feature->icon) }}">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">
                                        Ordem
                                    </label>

                                    <input
                                        type="number"
                                        name="features[${featureIndex}][order]"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300"
                                        value="{{ old('features.{$featureIndex}.order', $feature->order) }}">
                                </div>

                            </div>
                        </div>
                        @endforeach
                    @endif

                </div>
            </div>

            <!-- Botões -->
            <div class="border-t border-gray-100 pt-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-gray-800 text-sm uppercase">Botões</h3>

                    <button
                        type="button"
                        id="add-button"
                        class="bg-[#109e4a] hover:bg-[#0d9648] text-white px-6 py-3 rounded-lg font-bold text-xs uppercase tracking-wider transition duration-200 shadow-sm cursor-pointer">
                        Adicionar Botão
                    </button>
                </div>

                <div id="buttons-container">
                    @if(isset($banner->buttons))
                        @foreach($banner->buttons as $buttonIndex => $button)

                        <div class="button-item border rounded-lg p-4 mb-4 bg-gray-50 relative">

                            <form action="{{ route('admin.button-banner.delete', $button->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="remove-button absolute top-2 right-2 text-red-500 font-bold">
                                    X
                                </button>
                            </form>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">
                                        Texto
                                    </label>

                                    <input
                                        type="text"
                                        name="buttons[${buttonIndex}][text]"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300"
                                        value="{{ old('buttons.{$buttonIndex}.text', $button->text) }}">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">
                                        Cor
                                    </label>

                                    <input
                                        type="text"
                                        name="buttons[${buttonIndex}][color]"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300"
                                        placeholder="#109e4a"
                                        value="{{ old('buttons.{$buttonIndex}.color', $button->color) }}">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">
                                        URL
                                    </label>

                                    <input
                                        type="text"
                                        name="buttons[${buttonIndex}][url]"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300"
                                        value="{{ old('buttons.{$buttonIndex}.url', $button->url) }}">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">
                                        Target
                                    </label>

                                    <select
                                        name="buttons[${buttonIndex}][target]"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300">
                                        <option
                                            value="_self"
                                            {{ old('buttons.{$buttonIndex}.target', $button->target) == '_self' ? 'selected' : '' }}>
                                            Mesma Aba
                                        </option>
                                        <option
                                            value="_blank"
                                            {{ old('buttons.{$buttonIndex}.target', $button->target) == '_blank' ? 'selected' : '' }}>
                                            Nova Aba
                                        </option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">
                                        Ordem
                                    </label>

                                    <input
                                        type="number"
                                        name="buttons[${buttonIndex}][order]"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300"
                                        value="{{ old('buttons.{$buttonIndex}.order', $button->order) }}">
                                </div>

                            </div>
                        </div>

                        @endforeach
                    @endif

                </div>
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

@section('scripts')
<script>
    let featureIndex = 0;
    let buttonIndex = 0;

    // Adicionar Linha de Feature
    document.getElementById('add-feature').addEventListener('click', function () {
        const html = `
            <div class="feature-item rounded-xl border border-slate-100 bg-white shadow-sm overflow-hidden transition-all">
                <div class="flex items-center justify-between gap-2 px-4 py-2.5 bg-slate-50 border-b border-slate-100">
                    <span class="inline-flex items-center gap-2 text-[10px] font-bold text-[#001c3d] uppercase tracking-wider">
                        <i class="fas fa-star text-[#f2bd11]"></i> Nova Feature
                    </span>
                    <button type="button" class="remove-feature p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Remover Feature">
                        <i class="fas fa-trash-alt text-sm pointer-events-none"></i>
                    </button>
                </div>

                <div class="p-5 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Nome</label>
                        <input type="text" name="features[${featureIndex}][name]" placeholder="Ex: Wi-Fi Grátis" required
                            class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none transition-colors bg-slate-50/30">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Ícone (Font Awesome)</label>
                        <input type="text" name="features[${featureIndex}][icon]" placeholder="fa-solid fa-plane" required
                            class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none transition-colors bg-slate-50/30">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Ordem Exibição</label>
                        <input type="number" name="features[${featureIndex}][order]" placeholder="Ex: 1" required
                            class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none transition-colors bg-slate-50/30">
                    </div>
                </div>
            </div>
        `;

        document.getElementById('features-container').insertAdjacentHTML('beforeend', html);
        featureIndex++;
    });

    // Adicionar Linha de Botão
    document.getElementById('add-button').addEventListener('click', function () {
        const html = `
            <div class="button-item rounded-xl border border-slate-100 bg-white shadow-sm overflow-hidden transition-all">
                <div class="flex items-center justify-between gap-2 px-4 py-2.5 bg-slate-50 border-b border-slate-100">
                    <span class="inline-flex items-center gap-2 text-[10px] font-bold text-[#001c3d] uppercase tracking-wider">
                        <i class="fas fa-link text-blue-500"></i> Configuração do Botão
                    </span>
                    <button type="button" class="remove-button p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Remover Botão">
                        <i class="fas fa-trash-alt text-sm pointer-events-none"></i>
                    </button>
                </div>

                <div class="p-5 grid grid-cols-1 md:grid-cols-12 gap-4">
                    <div class="md:col-span-4">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Texto do Botão</label>
                        <input type="text" name="buttons[${buttonIndex}][text]" placeholder="Ex: Saiba Mais" required
                            class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none transition-colors bg-slate-50/30">
                    </div>
                    <div class="md:col-span-3">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Cor Hexadecimal</label>
                        <input type="text" name="buttons[${buttonIndex}][color]" placeholder="#109e4a" required
                            class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none transition-colors bg-slate-50/30">
                    </div>
                    <div class="md:col-span-5">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">URL / Link do Botão</label>
                        <input type="text" name="buttons[${buttonIndex}][url]" placeholder="Ex: https://..." required
                            class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none transition-colors bg-slate-50/30">
                    </div>
                    <div class="md:col-span-6">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Target (Abertura)</label>
                        <select name="buttons[${buttonIndex}][target]" required
                            class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none transition-colors bg-slate-50/30">
                            <option value="_self">Mesma Aba</option>
                            <option value="_blank">Nova Aba (Guia externa)</option>
                        </select>
                    </div>
                    <div class="md:col-span-6">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Ordem</label>
                        <input type="number" name="buttons[${buttonIndex}][order]" placeholder="Ex: 1" required
                            class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none transition-colors bg-slate-50/30">
                    </div>
                </div>
            </div>
        `;

        document.getElementById('buttons-container').insertAdjacentHTML('beforeend', html);
        buttonIndex++;
    });

    // Event Delegation Seguro para Remoção de Itens
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-feature')) {
            e.target.closest('.feature-item').remove();
        }
        if (e.target.classList.contains('remove-button')) {
            e.target.closest('.button-item').remove();
        }
    });
</script>
@endsection