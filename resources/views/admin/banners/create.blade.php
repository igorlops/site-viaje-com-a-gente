@extends('layouts.admin')

@section('page_title', 'Editar Banner Principal')

@section('admin_content')
    <div class="max-w-4xl bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 overflow-hidden transition-all duration-300">
        <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-slate-50 to-white flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-gray-900 text-lg tracking-tight">Editar Banner Principal</h2>
                <p class="text-xs text-gray-500 mt-1">Atualize os textos, imagens de fundo, características e botões de ação do banner.</p>
            </div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-bold tracking-widest uppercase bg-[#f3a908]/10 text-[#a37f00] border border-[#f3a908]/20">
                <i class="fas fa-edit"></i> Editando Registro
            </span>
        </div>

        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Título do Banner</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                        placeholder="Sua próxima viagem está mais perto do que você imagina!">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="titulo_destaque" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Trecho em Destaque</label>
                    <input type="text" name="titulo_destaque" id="titulo_destaque" value="{{ old('titulo_destaque') }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                        placeholder="Ex: mais perto de você">
                    @error('titulo_destaque')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="page_id" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Página do Banner</label>
                    <select name="page_id" id="page_id" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white">
                        <option value="">Selecione a página...</option>
                        @foreach($pages as $page)
                            <option value="{{ $page->id }}" {{ old('page_id') == $page->id ? 'selected' : '' }} >{{ $page->name }}</option>
                        @endforeach
                    </select>
                    @error('page_id')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="subtitle" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Subtítulo do Banner</label>
                    <textarea name="subtitle" id="subtitle" rows="3"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                        placeholder="Viaje com segurança, parcele no boleto...">{{ old('subtitle') }}</textarea>
                    @error('subtitle')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200">
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-3">Imagem de Fundo</label>
                <div class="flex flex-col sm:flex-row gap-6 items-start">
                    <div class="flex-grow w-full">
                        <label class="flex flex-col items-center justify-center w-full h-24 border-2 border-gray-200 border-dashed rounded-xl cursor-pointer bg-white hover:bg-gray-50 transition-colors">
                            <div class="flex flex-col items-center justify-center pt-2">
                                <i class="fas fa-cloud-upload-alt text-xl text-slate-400 mb-1"></i>
                                <p class="text-xs text-slate-500 font-bold mb-0.5">Enviar nova imagem de fundo</p>
                                <p class="text-[9px] text-slate-400">Formatos suportados: JPG, JPEG, PNG, GIF (Máx: 5MB)</p>
                            </div>
                            <input type="file" name="image" id="image" accept="image/*" class="hidden">
                        </label>
                        @error('image')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3 bg-slate-50 p-4 rounded-xl border border-slate-100 cursor-pointer select-none hover:bg-slate-100 transition-colors w-fit">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="active" value="1" {{ old('active') ? 'checked' : '' }}
                        class="w-4 h-4 rounded text-[#001c3d] focus:ring-[#001c3d] border-gray-300">
                    <span class="text-xs font-bold text-[#001c3d] uppercase tracking-wide">Banner Ativo</span>
                </label>
            </div>

            <div class="bg-slate-50/50 p-6 rounded-2xl border border-slate-100 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Features (Características)</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Adicione pequenas vantagens ou ícones informativos no banner.</p>
                    </div>
                    <button type="button" id="add-feature" class="bg-[#001c3d] text-white hover:bg-[#001126] px-4 py-2.5 rounded-lg text-xs font-bold transition-colors shadow-sm inline-flex items-center gap-1.5 cursor-pointer">
                        <i class="fas fa-plus"></i> Adicionar Feature
                    </button>
                </div>

                <div id="features-container" class="space-y-4">
                    </div>
            </div>

            <div class="bg-slate-50/50 p-6 rounded-2xl border border-slate-100 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Botões de Ação</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Configure os botões de Call To Action que aparecerão no banner.</p>
                    </div>
                    <button type="button" id="add-button" class="bg-[#001c3d] text-white hover:bg-[#001126] px-4 py-2.5 rounded-lg text-xs font-bold transition-colors shadow-sm inline-flex items-center gap-1.5 cursor-pointer">
                        <i class="fas fa-plus"></i> Adicionar Botão
                    </button>
                </div>

                <div id="buttons-container" class="space-y-4">
                    </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.banners.index') }}" class="border border-gray-200 hover:bg-gray-50 text-gray-500 px-6 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all duration-200">
                    Cancelar
                </a>
                <button type="submit" class="bg-[#109e4a] hover:bg-[#0d8c40] text-white px-8 py-3.5 rounded-xl font-extrabold text-xs uppercase tracking-wider transition-all duration-200 shadow-lg shadow-emerald-500/10">
                    Salvar Alterações
                </button>
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
                        <i class="fas fa-star text-[#f3a908]"></i> Nova Feature
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