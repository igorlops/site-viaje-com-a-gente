@extends('layouts.admin')

@section('page_title', 'Nova CTA Session')

@section('admin_content')
    <div class="flex flex-col lg:flex-row gap-6">
        
        {{-- Formulário Principal --}}
        <div class="flex-grow max-w-4xl bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-slate-50 to-white flex items-center justify-between">
                <div>
                    <h2 class="font-extrabold text-gray-900 text-lg tracking-tight">Nova CTA Session</h2>
                    <p class="text-xs text-gray-500 mt-1">Configure uma seção de chamada para ação para uma página do site.</p>
                </div>
                <a href="{{ route('admin.cta_session.index') }}" class="inline-flex items-center gap-2 border border-gray-200 hover:bg-gray-50 text-gray-500 px-4 py-2 rounded-lg font-bold text-xs uppercase tracking-wider transition duration-200">
                    <i class="fas fa-arrow-left text-[10px]"></i> Voltar
                </a>
            </div>

            <form action="{{ route('admin.cta_session.store') }}" method="POST" class="p-6 space-y-8">
                @csrf

                {{-- ===== SEÇÃO: CONTEÚDO PRINCIPAL ===== --}}
                <div>
                    <h3 class="text-xs font-bold text-[#002752] uppercase tracking-widest mb-4 flex items-center gap-2">
                        <i class="fas fa-align-left text-[#f3a908]"></i> Conteúdo Principal
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        {{-- Título --}}
                        <div class="sm:col-span-2">
                            <label for="title" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Título da CTA</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                                placeholder="Ex: Pronto para viajar? Fale com a gente!">
                            @error('title') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        {{-- Subtítulo --}}
                        <div class="sm:col-span-2">
                            <label for="subtitle" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Subtítulo / Descrição</label>
                            <textarea name="subtitle" id="subtitle" rows="3"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                                placeholder="Ex: Entre em contato e planeje sua próxima viagem com especialistas.">{{ old('subtitle') }}</textarea>
                            @error('subtitle') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        {{-- Página --}}
                        <div>
                            <label for="page_id" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Página Vinculada</label>
                            <select name="page_id" id="page_id"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white">
                                <option value="">Selecione a página...</option>
                                @foreach($pages as $page)
                                    <option value="{{ $page->id }}" {{ old('page_id') == $page->id ? 'selected' : '' }}>
                                        {{ $page->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('page_id') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        {{-- Ordem --}}
                        <div>
                            <label for="order_position" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Ordem de Exibição</label>
                            <input type="number" name="order_position" id="order_position" value="{{ old('order_position', 0) }}" min="0"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                                placeholder="0">
                            @error('order_position') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- ===== SEÇÃO: ITENS DE LISTA (NOVO) ===== --}}
                <div class="bg-slate-50/40 p-6 rounded-2xl border border-slate-100 space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xs font-bold text-[#002752] uppercase tracking-widest flex items-center gap-2">
                                <i class="fas fa-list-check text-[#f3a908]"></i> Lista de Características / Vantagens
                            </h3>
                            <p class="text-[11px] text-gray-400 mt-1">Adicione itens para listar nesta CTA (Ex: Suporte 24h, Parcelamento facilitado).</p>
                        </div>
                        <button type="button" id="add-list-item" class="bg-[#001c3d] text-white hover:bg-[#001126] px-4 py-2.5 rounded-lg text-xs font-bold transition-colors shadow-sm inline-flex items-center gap-1.5 cursor-pointer">
                            <i class="fas fa-plus"></i> Adicionar Item
                        </button>
                    </div>

                    <div id="list-items-container" class="space-y-3">
                        {{-- Inserido dinamicamente via JS --}}
                    </div>
                </div>

                {{-- ===== SEÇÃO: BOTÃO PRINCIPAL ===== --}}
                <div class="bg-slate-50/60 p-5 rounded-2xl border border-slate-100">
                    <h3 class="text-xs font-bold text-[#002752] uppercase tracking-widest mb-4 flex items-center gap-2">
                        <i class="fas fa-mouse-pointer text-[#f3a908]"></i> Botão Principal
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                        {{-- Label --}}
                        <div class="lg:col-span-1">
                            <label for="button_label" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Texto do Botão</label>
                            <input type="text" name="button_label" id="button_label" value="{{ old('button_label') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition bg-white"
                                placeholder="Ex: Solicitar Orçamento">
                            @error('button_label') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        {{-- URL --}}
                        <div class="lg:col-span-2">
                            <label for="button_url" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">URL / Link</label>
                            <input type="text" name="button_url" id="button_url" value="{{ old('button_url') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition bg-white"
                                placeholder="Ex: /contato ou https://...">
                            @error('button_url') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        {{-- Target --}}
                        <div>
                            <label for="button_target" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Abertura do Link</label>
                            <select name="button_target" id="button_target"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition bg-white">
                                <option value="_self" {{ old('button_target') == '_self' ? 'selected' : '' }}>Mesma aba</option>
                                <option value="_blank" {{ old('button_target') == '_blank' ? 'selected' : '' }}>Nova aba</option>
                            </select>
                            @error('button_target') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        {{-- Variante / Estilo --}}
                        <div>
                            <label for="button_variant" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Variante / Estilo</label>
                            <select name="button_variant" id="button_variant"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition bg-white">
                                <option value="primary" {{ old('button_variant', 'primary') == 'primary' ? 'selected' : '' }}>Primary (Principal)</option>
                                <option value="secondary" {{ old('button_variant') == 'secondary' ? 'selected' : '' }}>Secondary (Secundário)</option>
                                <option value="outline" {{ old('button_variant') == 'outline' ? 'selected' : '' }}>Outline (Contorno)</option>
                                <option value="ghost" {{ old('button_variant') == 'ghost' ? 'selected' : '' }}>Ghost (Transparente)</option>
                            </select>
                            @error('button_variant') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        {{-- Ícone --}}
                        <div>
                            <label for="button_icon" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Ícone (Font Awesome)</label>
                            <div class="flex gap-2 items-center">
                                <input type="text" name="button_icon" id="button_icon" value="{{ old('button_icon') }}"
                                    class="flex-1 px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm icon-input"
                                    placeholder="Ex: fa-solid fa-phone"
                                    onfocus="setLastFocusedInput(this)">
                                <span class="button-icon-preview text-gray-400 text-lg w-8 text-center">
                                    <i class="fas fa-icons opacity-30"></i>
                                </span>
                            </div>
                            @error('button_icon') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- ===== SEÇÃO: BOTÃO SECUNDÁRIO ===== --}}
                <div class="bg-slate-50/60 p-5 rounded-2xl border border-slate-100">
                    <h3 class="text-xs font-bold text-[#002752] uppercase tracking-widest mb-4 flex items-center gap-2">
                        <i class="fas fa-mouse-pointer text-gray-400"></i> Botão Secundário <span class="text-gray-300 font-normal normal-case tracking-normal">(opcional)</span>
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                        {{-- Label --}}
                        <div class="lg:col-span-1">
                            <label for="secondary_button_label" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Texto do Botão</label>
                            <input type="text" name="secondary_button_label" id="secondary_button_label" value="{{ old('secondary_button_label') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition bg-white"
                                placeholder="Ex: Ver Pacotes">
                            @error('secondary_button_label') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        {{-- URL --}}
                        <div class="lg:col-span-2">
                            <label for="secondary_button_url" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">URL / Link</label>
                            <input type="text" name="secondary_button_url" id="secondary_button_url" value="{{ old('secondary_button_url') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition bg-white"
                                placeholder="Ex: /pacotes ou https://...">
                            @error('secondary_button_url') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        {{-- Target --}}
                        <div>
                            <label for="secondary_button_target" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Abertura do Link</label>
                            <select name="secondary_button_target" id="secondary_button_target"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition bg-white">
                                <option value="_self" {{ old('secondary_button_target', '_self') == '_self' ? 'selected' : '' }}>Mesma aba</option>
                                <option value="_blank" {{ old('secondary_button_target') == '_blank' ? 'selected' : '' }}>Nova aba</option>
                            </select>
                            @error('secondary_button_target') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        {{-- Variante --}}
                        <div>
                            <label for="secondary_button_variant" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Variante / Estilo</label>
                            <select name="secondary_button_variant" id="secondary_button_variant"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition bg-white">
                                <option value="secondary" {{ old('secondary_button_variant', 'secondary') == 'secondary' ? 'selected' : '' }}>Secondary (Secundário)</option>
                                <option value="primary" {{ old('secondary_button_variant') == 'primary' ? 'selected' : '' }}>Primary (Principal)</option>
                                <option value="outline" {{ old('secondary_button_variant') == 'outline' ? 'selected' : '' }}>Outline (Contorno)</option>
                                <option value="ghost" {{ old('secondary_button_variant') == 'ghost' ? 'selected' : '' }}>Ghost (Transparente)</option>
                            </select>
                            @error('secondary_button_variant') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- ===== SEÇÃO: ESTILO VISUAL ===== --}}
                <div class="bg-slate-50/60 p-5 rounded-2xl border border-slate-100">
                    <h3 class="text-xs font-bold text-[#002752] uppercase tracking-widest mb-4 flex items-center gap-2">
                        <i class="fas fa-palette text-[#f3a908]"></i> Estilo Visual da Seção
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                        {{-- Cor de Fundo --}}
                        <div>
                            <label for="bg_color" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Cor de Fundo (Hex)</label>
                            <div class="flex gap-2">
                                <input type="color" name="bg_color_picker" id="bg_color_picker" value="{{ old('bg_color', '#ffffff') }}"
                                    class="h-11 w-14 rounded-lg border border-gray-200 cursor-pointer p-1"
                                    oninput="document.getElementById('bg_color').value = this.value">
                                <input type="text" name="bg_color" id="bg_color" value="{{ old('bg_color', '#ffffff') }}"
                                    class="flex-1 px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition bg-white"
                                    placeholder="#ffffff"
                                    oninput="document.getElementById('bg_color_picker').value = this.value">
                            </div>
                            @error('bg_color') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        {{-- Cor do Texto --}}
                        <div>
                            <label for="text_color" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Cor do Texto (Hex)</label>
                            <div class="flex gap-2">
                                <input type="color" name="text_color_picker" id="text_color_picker" value="{{ old('text_color', '#000000') }}"
                                    class="h-11 w-14 rounded-lg border border-gray-200 cursor-pointer p-1"
                                    oninput="document.getElementById('text_color').value = this.value">
                                <input type="text" name="text_color" id="text_color" value="{{ old('text_color', '#000000') }}"
                                    class="flex-1 px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition bg-white"
                                    placeholder="#000000"
                                    oninput="document.getElementById('text_color_picker').value = this.value">
                            </div>
                            @error('text_color') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        {{-- Alinhamento --}}
                        <div>
                            <label for="alignment" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Alinhamento do Conteúdo</label>
                            <select name="alignment" id="alignment"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition bg-white">
                                <option value="center" {{ old('alignment', 'center') == 'center' ? 'selected' : '' }}>Centralizado</option>
                                <option value="left" {{ old('alignment') == 'left' ? 'selected' : '' }}>Esquerda</option>
                                <option value="right" {{ old('alignment') == 'right' ? 'selected' : '' }}>Direita</option>
                            </select>
                            @error('alignment') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        {{-- Padding Vertical --}}
                        <div>
                            <label for="padding_vertical" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Espaçamento Vertical</label>
                            <input type="text" name="padding_vertical" id="padding_vertical" value="{{ old('padding_vertical', 'py-12') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition bg-white"
                                placeholder="Ex: py-12, py-16, py-20">
                            <p class="text-[10px] text-gray-400 mt-1">Classes de padding Tailwind CSS.</p>
                            @error('padding_vertical') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        {{-- Imagem de Fundo --}}
                        <div class="sm:col-span-2">
                            <label for="bg_image" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Imagem de Fundo (URL ou Path)</label>
                            <input type="text" name="bg_image" id="bg_image" value="{{ old('bg_image', 'none') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition bg-white"
                                placeholder="Ex: none, /storage/images/bg.jpg ou https://...">
                            <p class="text-[10px] text-gray-400 mt-1">Use <code class="bg-gray-100 px-1 rounded">none</code> para desativar ou informe a URL/path da imagem.</p>
                            @error('bg_image') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- ===== SEÇÃO: RASTREAMENTO ===== --}}
                <div>
                    <h3 class="text-xs font-bold text-[#002752] uppercase tracking-widest mb-4 flex items-center gap-2">
                        <i class="fas fa-chart-bar text-[#f3a908]"></i> Rastreamento & Marketing
                    </h3>
                    <div>
                        <label for="analytics_event_name" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nome do Evento Analytics</label>
                        <input type="text" name="analytics_event_name" id="analytics_event_name" value="{{ old('analytics_event_name') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: cta_click_home_contato">
                        <p class="text-[10px] text-gray-400 mt-1">Nome do evento para disparar no GA4 / Meta Pixel ao clicar no botão.</p>
                        @error('analytics_event_name') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- ===== STATUS ===== --}}
                <div class="flex items-center gap-3 bg-slate-50 p-4 rounded-xl border border-slate-100 cursor-pointer select-none hover:bg-slate-100 transition-colors w-fit">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="hidden" name="active" value="0">
                        <input type="checkbox" name="active" id="active" value="1" {{ old('active', true) ? 'checked' : '' }}
                            class="w-4 h-4 rounded text-[#001c3d] focus:ring-[#001c3d] border-gray-300">
                        <span class="text-xs font-bold text-[#001c3d] uppercase tracking-wide">CTA Session Ativa</span>
                    </label>
                </div>

                {{-- Botões de Ação do Form --}}
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.cta_session.index') }}" class="border border-gray-200 hover:bg-gray-50 text-gray-500 px-6 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all duration-200">
                        Cancelar
                    </a>
                    <button type="submit" class="bg-[#109e4a] hover:bg-[#0d8c40] text-white px-8 py-3.5 rounded-xl font-extrabold text-xs uppercase tracking-wider transition-all duration-200 shadow-lg shadow-emerald-500/10">
                        <i class="fas fa-save mr-1.5"></i> Criar CTA Session
                    </button>
                </div>
            </form>
        </div>

        {{-- Painel Lateral: Sugestão de Ícones Font Awesome --}}
        <div class="w-full lg:w-80 shrink-0">
            <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 p-5 sticky top-6">
                <h3 class="font-extrabold text-gray-900 text-sm tracking-tight border-b border-gray-100 pb-3 flex items-center gap-2">
                    <i class="fas fa-icons text-[#f3a908]"></i> Sugestões de Ícones
                </h3>
                <p class="text-[10px] text-gray-400 mt-2 mb-4">Clique em um campo de ícone no formulário e depois selecione um ícone abaixo para preenchê-lo automaticamente.</p>
                
                {{-- Busca Rápida de Ícones --}}
                <input type="text" id="search-icons" placeholder="Buscar ícone..." 
                       class="w-full px-3 py-2 text-xs rounded-lg border border-gray-200 focus:outline-none focus:border-[#001c3d] mb-4">

                <div class="grid grid-cols-4 gap-2 max-h-[400px] overflow-y-auto pr-1" id="icons-grid">
                    {{-- Ícones populares de turismo e gerais --}}
                    <button type="button" class="icon-selector-btn p-2 rounded hover:bg-gray-50 text-gray-700 text-sm border border-gray-100 flex flex-col items-center gap-1" data-icon="fa-solid fa-plane" title="Avião">
                        <i class="fa-solid fa-plane"></i>
                    </button>
                    <button type="button" class="icon-selector-btn p-2 rounded hover:bg-gray-50 text-gray-700 text-sm border border-gray-100 flex flex-col items-center gap-1" data-icon="fa-solid fa-hotel" title="Hotel">
                        <i class="fa-solid fa-hotel"></i>
                    </button>
                    <button type="button" class="icon-selector-btn p-2 rounded hover:bg-gray-50 text-gray-700 text-sm border border-gray-100 flex flex-col items-center gap-1" data-icon="fa-solid fa-route" title="Rota">
                        <i class="fa-solid fa-route"></i>
                    </button>
                    <button type="button" class="icon-selector-btn p-2 rounded hover:bg-gray-50 text-gray-700 text-sm border border-gray-100 flex flex-col items-center gap-1" data-icon="fa-solid fa-bus" title="Ônibus">
                        <i class="fa-solid fa-bus"></i>
                    </button>
                    <button type="button" class="icon-selector-btn p-2 rounded hover:bg-gray-50 text-gray-700 text-sm border border-gray-100 flex flex-col items-center gap-1" data-icon="fa-solid fa-umbrella-beach" title="Praia">
                        <i class="fa-solid fa-umbrella-beach"></i>
                    </button>
                    <button type="button" class="icon-selector-btn p-2 rounded hover:bg-gray-50 text-gray-700 text-sm border border-gray-100 flex flex-col items-center gap-1" data-icon="fa-solid fa-map-location-dot" title="Mapa">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </button>
                    <button type="button" class="icon-selector-btn p-2 rounded hover:bg-gray-50 text-gray-700 text-sm border border-gray-100 flex flex-col items-center gap-1" data-icon="fa-solid fa-earth-americas" title="Globo">
                        <i class="fa-solid fa-earth-americas"></i>
                    </button>
                    <button type="button" class="icon-selector-btn p-2 rounded hover:bg-gray-50 text-gray-700 text-sm border border-gray-100 flex flex-col items-center gap-1" data-icon="fa-solid fa-passport" title="Passaporte">
                        <i class="fa-solid fa-passport"></i>
                    </button>
                    <button type="button" class="icon-selector-btn p-2 rounded hover:bg-gray-50 text-gray-700 text-sm border border-gray-100 flex flex-col items-center gap-1" data-icon="fa-solid fa-ticket" title="Ingresso">
                        <i class="fa-solid fa-ticket"></i>
                    </button>
                    <button type="button" class="icon-selector-btn p-2 rounded hover:bg-gray-50 text-gray-700 text-sm border border-gray-100 flex flex-col items-center gap-1" data-icon="fa-solid fa-suitcase-rolling" title="Mala de Rodinha">
                        <i class="fa-solid fa-suitcase-rolling"></i>
                    </button>
                    <button type="button" class="icon-selector-btn p-2 rounded hover:bg-gray-50 text-gray-700 text-sm border border-gray-100 flex flex-col items-center gap-1" data-icon="fa-solid fa-wallet" title="Carteira">
                        <i class="fa-solid fa-wallet"></i>
                    </button>
                    <button type="button" class="icon-selector-btn p-2 rounded hover:bg-gray-50 text-gray-700 text-sm border border-gray-100 flex flex-col items-center gap-1" data-icon="fa-solid fa-shield-halved" title="Escudo/Segurança">
                        <i class="fa-solid fa-shield-halved"></i>
                    </button>
                    <button type="button" class="icon-selector-btn p-2 rounded hover:bg-gray-50 text-gray-700 text-sm border border-gray-100 flex flex-col items-center gap-1" data-icon="fa-solid fa-headset" title="Suporte">
                        <i class="fa-solid fa-headset"></i>
                    </button>
                    <button type="button" class="icon-selector-btn p-2 rounded hover:bg-gray-50 text-gray-700 text-sm border border-gray-100 flex flex-col items-center gap-1" data-icon="fa-solid fa-star" title="Estrela">
                        <i class="fa-solid fa-star"></i>
                    </button>
                    <button type="button" class="icon-selector-btn p-2 rounded hover:bg-gray-50 text-gray-700 text-sm border border-gray-100 flex flex-col items-center gap-1" data-icon="fa-solid fa-check-double" title="Check Duplo">
                        <i class="fa-solid fa-check-double"></i>
                    </button>
                    <button type="button" class="icon-selector-btn p-2 rounded hover:bg-gray-50 text-gray-700 text-sm border border-gray-100 flex flex-col items-center gap-1" data-icon="fa-solid fa-circle-check" title="Check Círculo">
                        <i class="fa-solid fa-circle-check"></i>
                    </button>
                    <button type="button" class="icon-selector-btn p-2 rounded hover:bg-gray-50 text-gray-700 text-sm border border-gray-100 flex flex-col items-center gap-1" data-icon="fa-solid fa-calendar-days" title="Calendário">
                        <i class="fa-solid fa-calendar-days"></i>
                    </button>
                    <button type="button" class="icon-selector-btn p-2 rounded hover:bg-gray-50 text-gray-700 text-sm border border-gray-100 flex flex-col items-center gap-1" data-icon="fa-solid fa-compass" title="Bússola">
                        <i class="fa-solid fa-compass"></i>
                    </button>
                    <button type="button" class="icon-selector-btn p-2 rounded hover:bg-gray-50 text-gray-700 text-sm border border-gray-100 flex flex-col items-center gap-1" data-icon="fa-solid fa-percent" title="Desconto">
                        <i class="fa-solid fa-percent"></i>
                    </button>
                    <button type="button" class="icon-selector-btn p-2 rounded hover:bg-gray-50 text-gray-700 text-sm border border-gray-100 flex flex-col items-center gap-1" data-icon="fa-solid fa-phone" title="Telefone">
                        <i class="fa-solid fa-phone"></i>
                    </button>
                    <button type="button" class="icon-selector-btn p-2 rounded hover:bg-gray-50 text-gray-700 text-sm border border-gray-100 flex flex-col items-center gap-1" data-icon="fa-brands fa-whatsapp" title="WhatsApp">
                        <i class="fa-brands fa-whatsapp"></i>
                    </button>
                    <button type="button" class="icon-selector-btn p-2 rounded hover:bg-gray-50 text-gray-700 text-sm border border-gray-100 flex flex-col items-center gap-1" data-icon="fa-solid fa-location-dot" title="Localização">
                        <i class="fa-solid fa-location-dot"></i>
                    </button>
                    <button type="button" class="icon-selector-btn p-2 rounded hover:bg-gray-50 text-gray-700 text-sm border border-gray-100 flex flex-col items-center gap-1" data-icon="fa-solid fa-clock" title="Relógio">
                        <i class="fa-solid fa-clock"></i>
                    </button>
                    <button type="button" class="icon-selector-btn p-2 rounded hover:bg-gray-50 text-gray-700 text-sm border border-gray-100 flex flex-col items-center gap-1" data-icon="fa-solid fa-credit-card" title="Cartão">
                        <i class="fa-solid fa-credit-card"></i>
                    </button>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
<script>
    let listIndex = 0;
    let lastFocusedInput = null;

    function setLastFocusedInput(inputEl) {
        lastFocusedInput = inputEl;
    }

    // Gerenciar cliques nos ícones do painel de sugestões
    document.addEventListener('DOMContentLoaded', () => {
        const iconButtons = document.querySelectorAll('.icon-selector-btn');
        iconButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const iconClass = btn.getAttribute('data-icon');
                if (lastFocusedInput) {
                    lastFocusedInput.value = iconClass;
                    // Trigger input event to update preview
                    lastFocusedInput.dispatchEvent(new Event('input', { bubbles: true }));
                } else {
                    alert('Por favor, clique em um campo de ícone no formulário primeiro para poder preenchê-lo.');
                }
            });
        });

        // Filtro de ícones na barra de busca
        const searchInput = document.getElementById('search-icons');
        searchInput.addEventListener('input', function() {
            const term = this.value.toLowerCase();
            const btns = document.querySelectorAll('.icon-selector-btn');
            btns.forEach(btn => {
                const name = btn.getAttribute('data-icon').toLowerCase();
                const title = btn.getAttribute('title').toLowerCase();
                if (name.includes(term) || title.includes(term)) {
                    btn.classList.remove('hidden');
                } else {
                    btn.classList.add('hidden');
                }
            });
        });

        // Sincronizar os previews de ícone da página carregada
        document.querySelectorAll('.icon-input').forEach(input => {
            input.addEventListener('input', function() {
                const preview = this.closest('div').querySelector('.button-icon-preview, .list-icon-preview');
                if (preview) {
                    preview.innerHTML = this.value ? `<i class="${this.value}"></i>` : '<i class="fas fa-icons opacity-30"></i>';
                }
            });
        });
    });

    // Adicionar Linha de Item de Lista
    document.getElementById('add-list-item').addEventListener('click', function () {
        // Obter número atual de itens para definir a ordem sequencial automaticamente
        const currentItemsCount = document.querySelectorAll('.list-item-row').length;
        const defaultOrder = currentItemsCount + 1;

        const html = `
            <div class="list-item-row rounded-xl border border-slate-100 bg-white shadow-sm overflow-hidden transition-all">
                <div class="flex items-center justify-between gap-2 px-4 py-2 bg-slate-50 border-b border-slate-100">
                    <span class="inline-flex items-center gap-2 text-[10px] font-bold text-[#001c3d] uppercase tracking-wider">
                        <i class="fas fa-circle-check text-[#109e4a]"></i> Item de Lista #${defaultOrder}
                    </span>
                    <button type="button" class="remove-list-item p-1.5 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Remover Item">
                        <i class="fas fa-trash-alt text-xs pointer-events-none"></i>
                    </button>
                </div>

                <div class="p-4 grid grid-cols-1 md:grid-cols-12 gap-3">
                    <div class="md:col-span-6">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Título do Item</label>
                        <input type="text" name="list_items[${listIndex}][title]" placeholder="Ex: Suporte 24 horas por dia" required
                            class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none transition-colors">
                    </div>
                    <div class="md:col-span-3">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Ícone</label>
                        <div class="flex gap-2 items-center">
                            <input type="text" name="list_items[${listIndex}][icon]" placeholder="fa-solid fa-circle-check" value="fa-solid fa-circle-check" required
                                class="flex-grow px-3 py-2 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none transition-colors icon-input"
                                onfocus="setLastFocusedInput(this)">
                            <span class="list-icon-preview text-emerald-600 text-sm w-6 text-center">
                                <i class="fa-solid fa-circle-check"></i>
                            </span>
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Ordem</label>
                        <input type="number" name="list_items[${listIndex}][order]" value="${defaultOrder}" required
                            class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none transition-colors">
                    </div>
                    <div class="md:col-span-1 flex items-end justify-center pb-2">
                        <label class="flex items-center gap-1 cursor-pointer select-none">
                            <input type="hidden" name="list_items[${listIndex}][active]" value="0">
                            <input type="checkbox" name="list_items[${listIndex}][active]" value="1" checked
                                class="w-3.5 h-3.5 rounded text-[#001c3d] border-gray-300">
                            <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wide">Ativo</span>
                        </label>
                    </div>
                </div>
            </div>
        `;

        document.getElementById('list-items-container').insertAdjacentHTML('beforeend', html);

        // Bind input event to the new row
        const newRow = document.querySelector(`#list-items-container .list-item-row:last-child`);
        const newInput = newRow.querySelector('.icon-input');
        newInput.addEventListener('input', function() {
            const preview = this.closest('div').querySelector('.list-icon-preview');
            if (preview) {
                preview.innerHTML = this.value ? `<i class="${this.value}"></i>` : '<i class="fas fa-icons opacity-30"></i>';
            }
        });

        listIndex++;
    });

    // Event Delegation para Remoção
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-list-item')) {
            e.target.closest('.list-item-row').remove();
            // Reordenar os títulos visualmente se desejado, ou deixar a ordem original
        }
    });
</script>
@endsection