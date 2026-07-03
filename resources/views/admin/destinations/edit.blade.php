@extends('layouts.admin')

@section('page_title', 'Editar Destino')

@section('admin_content')
    <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 overflow-hidden transition-all duration-300">
        <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-slate-50 to-white flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-gray-900 text-lg tracking-tight">Editar Destino: {{ $destination->title }}</h2>
                <p class="text-xs text-gray-500 mt-1">Atualize as informações do pacote, fotos, itens inclusos e o cronograma.</p>
            </div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-bold tracking-widest uppercase bg-[#f3a908]/10 text-[#a37f00] border border-[#f3a908]/20">
                <i class="fas fa-edit"></i> Editando Registro
            </span>
        </div>

        {{-- Tabs Navigation --}}
        <div class="border-b border-gray-100 bg-slate-50 px-2 sm:px-4">
            <nav id="tabs" role="tablist" aria-label="Seções do formulário"
                 class="flex gap-1 overflow-x-auto pt-2 [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                <button type="button" role="tab" aria-selected="true" aria-controls="tab-basic" onclick="switchTab(event, 'basic')"
                    class="tab-btn active inline-flex shrink-0 items-center gap-2 rounded-t-xl border border-gray-100 border-b-white -mb-px px-4 sm:px-5 py-3 text-[11px] sm:text-xs font-bold uppercase tracking-wider whitespace-nowrap transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#001c3d]/30 bg-white text-[#001c3d] shadow-[0_-2px_10px_rgba(0,0,0,0.03)]">
                    <i class="fas fa-info-circle text-sm"></i>
                    <span>Básico</span>
                </button>
                <button type="button" role="tab" aria-selected="false" aria-controls="tab-details" onclick="switchTab(event, 'details')"
                    class="tab-btn inline-flex shrink-0 items-center gap-2 rounded-t-xl border border-transparent px-4 sm:px-5 py-3 text-[11px] sm:text-xs font-bold uppercase tracking-wider whitespace-nowrap transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#001c3d]/30 text-gray-400 hover:text-[#001c3d] hover:bg-white/60">
                    <i class="fas fa-sliders text-sm"></i>
                    <span>Detalhes do Pacote</span>
                </button>
                <button type="button" role="tab" aria-selected="false" aria-controls="tab-includes-tab" onclick="switchTab(event, 'includes-tab')"
                    class="tab-btn inline-flex shrink-0 items-center gap-2 rounded-t-xl border border-transparent px-4 sm:px-5 py-3 text-[11px] sm:text-xs font-bold uppercase tracking-wider whitespace-nowrap transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#001c3d]/30 text-gray-400 hover:text-[#001c3d] hover:bg-white/60">
                    <i class="fas fa-check-double text-sm"></i>
                    <span>Inclui / Não Inclui</span>
                </button>
                <button type="button" role="tab" aria-selected="false" aria-controls="tab-highlights-tab" onclick="switchTab(event, 'highlights-tab')"
                    class="tab-btn inline-flex shrink-0 items-center gap-2 rounded-t-xl border border-transparent px-4 sm:px-5 py-3 text-[11px] sm:text-xs font-bold uppercase tracking-wider whitespace-nowrap transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#001c3d]/30 text-gray-400 hover:text-[#001c3d] hover:bg-white/60">
                    <i class="fas fa-star text-sm"></i>
                    <span>Destaques</span>
                </button>
                <button type="button" role="tab" aria-selected="false" aria-controls="tab-itinerary-tab" onclick="switchTab(event, 'itinerary-tab')"
                    class="tab-btn inline-flex shrink-0 items-center gap-2 rounded-t-xl border border-transparent px-4 sm:px-5 py-3 text-[11px] sm:text-xs font-bold uppercase tracking-wider whitespace-nowrap transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#001c3d]/30 text-gray-400 hover:text-[#001c3d] hover:bg-white/60">
                    <i class="fas fa-route text-sm"></i>
                    <span>Roteiro</span>
                </button>
            </nav>
        </div>

        <form action="{{ route('admin.destinations.update', $destination->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')

            {{-- TAB BASIC --}}
            <div id="tab-basic" class="tab-content space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Título (Cidade / Local)</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $destination->title) }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: Gramado">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="subtitle" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Subtítulo (Atrações / Detalhes)</label>
                        <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle', $destination->subtitle) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: Canela + Bento Gonçalves">
                        @error('subtitle')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="title" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Título do Card</label>
                        <input type="text" name="title_card" id="title_card" value="{{ old('title_card', $destination->title_card) }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: Gramado">
                        @error('title_card')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="subtitle_card" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Subtítulo do Card</label>
                        <input type="text" name="subtitle_card" id="subtitle_card" value="{{ old('subtitle_card', $destination->subtitle_card) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: Canela + Bento Gonçalves">
                        @error('subtitle_card')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="text_label_banner" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Descrição do Destino</label>
                        <textarea name="text_label_banner" id="text_label_banner" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: Canela + Bento Gonçalves">{{ old('text_label_banner', $destination->text_label_banner) }}</textarea>
                        @error('text_label_banner')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>


                    <div>
                        <label for="slug" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Slug (URL amigável - opcional)</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug', $destination->slug) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: gramado-inverno">
                        @error('slug')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Categoria</label>
                        <input type="text" name="category" id="category" value="{{ old('category', $destination->category) }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: AÉREO + HOTEL + PASSEIOS">
                        @error('category')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="price" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Preço Mensal (Boleto)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 font-bold text-sm">R$</span>
                            <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $destination->price) }}" required
                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                                placeholder="Ex: 69.99">
                        </div>
                        @error('price')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tag" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Tag de Destaque (Opcional)</label>
                        <input type="text" name="tag" id="tag" value="{{ old('tag', $destination->tag) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: MAIS VENDIDO">
                        @error('tag')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="type" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Tipo de Destino</label>
                        <select name="type" id="type" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white select-custom">
                            <option value="">Selecione o tipo...</option>
                            <option value="pacotes-2026-2027" {{ old('type', $destination->type) == 'pacotes-2026-2027' ? 'selected' : '' }}>Pacotes 2026-2027</option>
                            <option value="bate-e-volta" {{ old('type', $destination->type) == 'bate-e-volta' ? 'selected' : '' }}>Bate e Volta</option>
                            <option value="viagem-em-grupo" {{ old('type', $destination->type) == 'viagem-em-grupo' ? 'selected' : '' }}>Viagem em Grupo</option>
                            <option value="pacote-principal" {{ old('type', $destination->type) == 'pacote-principal' ? 'selected' : '' }}>Pacote Principal</option>
                        </select>
                        @error('type')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-3">Imagem do Card (Home/Listagem)</label>
                    <div class="flex flex-col sm:flex-row gap-6 items-start">
                        @if($destination->image_path)
                            <div class="shrink-0">
                                <span class="block text-[10px] font-bold text-gray-400 mb-1">Imagem atual:</span>
                                <img src="{{ asset('storage/' . $destination->image_path) }}" alt="{{ $destination->title }}" class="w-32 h-24 object-cover rounded-xl shadow-sm border border-gray-200">
                            </div>
                        @endif
                        
                        <div class="flex-grow w-full">
                            <label class="flex flex-col items-center justify-center w-full h-24 border-2 border-gray-200 border-dashed rounded-xl cursor-pointer bg-white hover:bg-gray-50 transition-colors">
                                <div class="flex flex-col items-center justify-center pt-2">
                                    <i class="fas fa-cloud-upload-alt text-xl text-slate-400 mb-1"></i>
                                    <p class="text-xs text-slate-500 font-bold mb-0.5">Enviar nova imagem</p>
                                    <p class="text-[9px] text-slate-400">Deixe em branco para manter a atual</p>
                                </div>
                                <input type="file" name="image" id="image" accept="image/*" class="hidden" onchange="previewFile(this, 'card-preview')">
                            </label>
                            <div id="card-preview-container" class="mt-3 hidden">
                                <span class="text-[10px] font-bold text-gray-400 block mb-1">Nova pré-visualização:</span>
                                <img id="card-preview" src="#" alt="Preview" class="w-32 h-24 object-cover rounded-lg border border-gray-200 shadow-sm">
                            </div>
                            @error('image')
                                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div>
                    <label for="whatsapp_link" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Link WhatsApp Personalizado (Opcional)</label>
                    <input type="url" name="whatsapp_link" id="whatsapp_link" value="{{ old('whatsapp_link', $destination->whatsapp_link) }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                        placeholder="Ex: https://wa.me/5585999166421?text=Olá, tenho interesse...">
                    <p class="text-[10px] text-gray-400 mt-1.5 font-medium">Se deixado em branco, o site usará o link padrão do WhatsApp.</p>
                    @error('whatsapp_link')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col sm:flex-row gap-6">
                    <label class="flex items-center gap-3 bg-slate-50 p-4 rounded-xl border border-slate-100 cursor-pointer select-none hover:bg-slate-100 transition-colors w-fit">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $destination->is_featured) ? 'checked' : '' }}
                            class="w-4 h-4 rounded text-[#001c3d] focus:ring-[#001c3d] border-gray-300">
                        <span class="text-xs font-bold text-[#001c3d] uppercase tracking-wide">Exibir na Home</span>
                    </label>
                </div>
            </div>

            {{-- TAB DETAILS --}}
            <div id="tab-details" class="tab-content hidden space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="full_price" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Preço Total Inteiro (Ex: R$ 1.800)</label>
                        <input type="text" name="full_price" id="full_price" value="{{ old('full_price', $destination->full_price) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: R$ 2.450,00">
                    </div>

                    <div>
                        <label for="date_range" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Período da Viagem</label>
                        <input type="text" name="date_range" id="date_range" value="{{ old('date_range', $destination->date_range) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: 10 a 17 de Outubro">
                    </div>

                    <div>
                        <label for="nights" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Número de Noites</label>
                        <input type="number" name="nights" id="nights" value="{{ old('nights', $destination->nights) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: 6">
                    </div>
                    <div>
                        <label for="duration" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Número de dias</label>
                        <input type="number" name="duration" id="duration" value="{{ old('duration', $destination->duration) }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: 7">
                        @error('duration')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="departure_city" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Cidade de Saída</label>
                        <input type="text" name="departure_city" id="departure_city" value="{{ old('departure_city', $destination->departure_city) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: Fortaleza">
                    </div>

                    <div>
                        <label for="departure_date" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Data de Ida</label>
                        <input type="text" name="departure_date" id="departure_date" value="{{ old('departure_date', $destination->departure_date) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: 10/10/2026">
                    </div>

                    <div>
                        <label for="return_date" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Data de Volta</label>
                        <input type="text" name="return_date" id="return_date" value="{{ old('return_date', $destination->return_date) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: 17/10/2026">
                    </div>

                    <div>
                        <label for="trip_type" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Tipo de Pacote detalhado</label>
                        <input type="text" name="trip_type" id="trip_type" value="{{ old('trip_type', $destination->trip_type) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: Pacote Aéreo">
                    </div>
                </div>

                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-3">Imagem de Banner (Detalhes do Pacote)</label>
                    <div class="flex flex-col sm:flex-row gap-6 items-start">
                        @if($destination->banner_image_path)
                            <div class="shrink-0">
                                <span class="block text-[10px] font-bold text-gray-400 mb-1">Banner atual:</span>
                                <img src="{{ asset('storage/' . $destination->banner_image_path) }}" alt="Banner" class="w-48 h-20 object-cover rounded-xl shadow-sm border border-gray-200">
                            </div>
                        @endif
                        
                        <div class="flex-grow w-full">
                            <label class="flex flex-col items-center justify-center w-full h-24 border-2 border-gray-200 border-dashed rounded-xl cursor-pointer bg-white hover:bg-gray-50 transition-colors">
                                <div class="flex flex-col items-center justify-center pt-2">
                                    <i class="fas fa-image text-xl text-slate-400 mb-1"></i>
                                    <p class="text-xs text-slate-500 font-bold mb-0.5">Enviar nova imagem banner</p>
                                    <p class="text-[9px] text-slate-400">Deixe em branco para manter a atual</p>
                                </div>
                                <input type="file" name="banner_image" id="banner_image" accept="image/*" class="hidden" onchange="previewFile(this, 'banner-preview')">
                            </label>
                            <div id="banner-preview-container" class="mt-3 hidden">
                                <span class="text-[10px] font-bold text-gray-400 block mb-1">Nova pré-visualização:</span>
                                <img id="banner-preview" src="#" alt="Banner Preview" class="w-64 h-20 object-cover rounded-lg border border-gray-200 shadow-sm">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-50/50 p-6 rounded-2xl border border-slate-100">
                    <label class="block text-xs font-bold text-[#001c3d] uppercase tracking-wider mb-4"><i class="fas fa-star text-[#f3a908] mr-1"></i> Facilidades Inclusas (Marcação Rápida)</label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        @php
                            $currentIcons = $destination->highlights_icons ?? [];
                            $iconsOptions = [
                                'hotel' => 'Hotel/Hospedagem',
                                'plane' => 'Voo/Passagem Aérea',
                                'utensils' => 'Café da manhã/Refeições',
                                'bus' => 'Transporte/Passeio de Ônibus',
                                'ticket-alt' => 'Ingresso Incluso',
                                'camera' => 'Guia de Turismo',
                                'shield-alt' => 'Seguro Viagem',
                                'ship' => 'Passeio de Barco/Cruzeiro',
                            ];
                        @endphp
                        @foreach($iconsOptions as $key => $label)
                            <label class="flex items-center gap-3 bg-white p-3.5 rounded-xl border border-gray-100 cursor-pointer text-xs font-semibold text-gray-700 hover:border-[#001c3d] hover:bg-slate-50 transition-all select-none shadow-sm">
                                <input type="checkbox" name="highlights_icons[]" value="{{ $key }}" {{ in_array($key, $currentIcons) ? 'checked' : '' }}
                                    class="w-4 h-4 rounded text-[#001c3d] focus:ring-[#001c3d] border-gray-300">
                                <span>{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- TAB INCLUDES --}}
            <div id="tab-includes-tab" class="tab-content hidden space-y-6">
                <div class="bg-slate-50/60 p-6 rounded-2xl border border-slate-100 backdrop-blur-sm">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                        <div>
                            <h3 class="text-sm font-extrabold text-[#001c3d] uppercase tracking-wide flex items-center gap-2">
                                <i class="fas fa-check-double text-emerald-500"></i> Itens Inclusos e Não Inclusos
                            </h3>
                            <p class="text-xs text-gray-400 mt-0.5">Defina com clareza o que faz parte ou não do pacote de viagem.</p>
                        </div>
                        <button type="button" onclick="addIncludeRow()" class="bg-[#001c3d] hover:bg-[#001126] text-white px-4 py-2.5 rounded-xl text-xs font-bold transition-all duration-200 shadow-md hover:shadow-lg focus:ring-2 focus:ring-[#001c3d]/20 inline-flex items-center gap-2 self-start sm:self-auto">
                            <i class="fas fa-plus bg-white/20 p-1 rounded-lg text-[10px]"></i> Adicionar Item
                        </button>
                    </div>
                    
                    <div id="includes-container" class="space-y-4">
                        @foreach($destination->includes as $index => $include)
                            <div class="flex flex-col sm:flex-row gap-3 items-stretch sm:items-center include-row bg-white p-4 rounded-xl border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.01)] hover:border-gray-200 transition-all group">
                                <div class="relative shrink-0 sm:w-44">
                                    <select name="includes[{{ $index }}][type]" class="w-full bg-slate-50 border border-gray-200 rounded-xl px-3 py-2.5 text-xs font-bold text-gray-700 focus:outline-none focus:border-[#001c3d] focus:bg-white transition-colors cursor-pointer appearance-none">
                                        <option value="included" {{ $include->type === 'included' ? 'selected' : '' }}>🟢 Incluso</option>
                                        <option value="not_included" {{ $include->type === 'not_included' ? 'selected' : '' }}>🔴 Não Incluso</option>
                                    </select>
                                </div>
                                <div class="flex-1">
                                    <input type="text" name="includes[{{ $index }}][text]" value="{{ $include->text }}" placeholder="Ex: Passagem de ida e volta em classe econômica"
                                        class="w-full bg-slate-50/50 focus:bg-white border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 px-4 py-2.5 rounded-xl text-xs font-medium focus:outline-none transition-all shadow-inner" required>
                                </div>
                                <input type="hidden" name="includes[{{ $index }}][order]" value="{{ $include->order ?? ($index + 1) }}">
                                <button type="button" onclick="removeRow(this)" class="p-2.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-xl transition-all self-end sm:self-auto" title="Remover item">
                                    <i class="fas fa-trash-alt text-sm"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- TAB HIGHLIGHTS --}}
            <div id="tab-highlights-tab" class="tab-content hidden space-y-6">
                <div class="bg-slate-50/60 p-6 rounded-2xl border border-slate-100 backdrop-blur-sm">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                        <div>
                            <h3 class="text-sm font-extrabold text-[#001c3d] uppercase tracking-wide flex items-center gap-2">
                                <i class="fas fa-images text-amber-500"></i> Destaques e Galeria Rápida
                            </h3>
                            <p class="text-xs text-gray-400 mt-0.5">Pontos turísticos marcantes e experiências com chamadas atraentes.</p>
                        </div>
                        <button type="button" onclick="addHighlightRow()" class="bg-[#001c3d] hover:bg-[#001126] text-white px-4 py-2.5 rounded-xl text-xs font-bold transition-all duration-200 shadow-md hover:shadow-lg focus:ring-2 focus:ring-[#001c3d]/20 inline-flex items-center gap-2 self-start sm:self-auto">
                            <i class="fas fa-plus bg-white/20 p-1 rounded-lg text-[10px]"></i> Adicionar Destaque
                        </button>
                    </div>

                    <div id="highlights-container" class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                        @foreach($destination->highlights as $index => $highlight)
                            <div class="rounded-2xl border border-gray-100 bg-white shadow-[0_4px_20px_rgba(0,0,0,0.01)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.02)] overflow-hidden highlight-row transition-all duration-300 flex flex-col justify-between group hover:border-gray-200">
                                <input type="hidden" name="highlights[{{ $index }}][id]" value="{{ $highlight->id }}">
                                <input type="hidden" name="highlights[{{ $index }}][order]" value="{{ $highlight->order }}">

                                <div class="flex items-center justify-between gap-2 px-4 py-3 bg-gradient-to-r from-slate-50 to-white border-b border-slate-100">
                                    <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold text-[#001c3d] uppercase tracking-widest">
                                        <i class="fas fa-star text-[#f3a908]"></i> Bloco de Destaque
                                    </span>
                                    <button type="button" onclick="removeRow(this)" class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Remover destaque">
                                        <i class="fas fa-trash-alt text-xs"></i>
                                    </button>
                                </div>

                                <div class="p-5 space-y-4 flex-grow">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Título Principal</label>
                                            <input type="text" name="highlights[{{ $index }}][title]" value="{{ $highlight->title }}" placeholder="Ex: Lago Negro"
                                                class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 text-xs font-semibold focus:outline-none transition-all bg-slate-50/30 focus:bg-white" required>
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Chamada Curta / Subtítulo</label>
                                            <input type="text" name="highlights[{{ $index }}][subtitle]" value="{{ $highlight->subtitle }}" placeholder="Ex: Lindo passeio de pedalinho"
                                                class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 text-xs font-semibold focus:outline-none transition-all bg-slate-50/30 focus:bg-white">
                                        </div>
                                    </div>
                                    
                                    <div class="bg-slate-50/50 p-3 rounded-xl border border-gray-100 flex gap-4 items-center transition-colors group-hover:bg-slate-50">
                                        @if($highlight->image_path)
                                            <div class="relative shrink-0 shadow-sm rounded-lg overflow-hidden border border-gray-200 bg-white">
                                                <img src="{{ asset('storage/' . $highlight->image_path) }}" alt="" class="w-14 h-14 object-cover">
                                            </div>
                                        @endif
                                        <div class="flex-grow">
                                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">Mudar Foto do Card</label>
                                            <input type="file" name="highlights[{{ $index }}][image]" accept="image/*"
                                                class="w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[10px] file:font-bold file:uppercase file:tracking-wider file:bg-[#001c3d]/10 file:text-[#001c3d] hover:file:bg-[#001c3d]/20 file:transition-colors file:cursor-pointer bg-white rounded-lg border border-gray-200 p-1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- TAB ITINERARY --}}
            <div id="tab-itinerary-tab" class="tab-content hidden space-y-6">
                <div class="bg-slate-50/60 p-6 rounded-2xl border border-slate-100 backdrop-blur-sm">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                        <div>
                            <h3 class="text-sm font-extrabold text-[#001c3d] uppercase tracking-wide flex items-center gap-2">
                                <i class="fas fa-map-marked-alt text-indigo-500"></i> Roteiro Cronológico (Dia a Dia)
                            </h3>
                            <p class="text-xs text-gray-400 mt-0.5">Organize a experiência do usuário mapeando as atividades em blocos lógicos.</p>
                        </div>
                        <button type="button" onclick="addItineraryDayRow()" class="bg-[#001c3d] hover:bg-[#001126] text-white px-4 py-2.5 rounded-xl text-xs font-bold transition-all duration-200 shadow-md hover:shadow-lg focus:ring-2 focus:ring-[#001c3d]/20 inline-flex items-center gap-2 self-start sm:self-auto">
                            <i class="fas fa-plus bg-white/20 p-1 rounded-lg text-[10px]"></i> Adicionar Dia Novo
                        </button>
                    </div>

                    <div id="itinerary-container" class="space-y-6">
                        @foreach($destination->itineraryDays as $dayIndex => $day)
                            <div class="rounded-2xl border border-gray-100 bg-white shadow-[0_4px_20px_rgba(0,0,0,0.01)] overflow-hidden itinerary-day-row transition-all duration-300 hover:border-gray-200" data-day-index="{{ $dayIndex }}">
                                <input type="hidden" name="itinerary[{{ $dayIndex }}][id]" value="{{ $day->id }}">
                                <input type="hidden" name="itinerary[{{ $dayIndex }}][order]" value="{{ $day->order }}">

                                <div class="flex items-center justify-between gap-2 px-4 py-3 bg-gradient-to-r from-slate-50 to-white border-b border-slate-100">
                                    <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold text-[#001c3d] uppercase tracking-widest">
                                        <i class="fas fa-calendar-alt text-indigo-500"></i> Estrutura do Dia
                                    </span>
                                    <button type="button" onclick="removeRow(this)" class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Remover dia inteiro">
                                        <i class="fas fa-trash-alt text-xs"></i>
                                    </button>
                                </div>

                                <div class="p-5 space-y-5">
                                    <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                                        <div class="sm:col-span-2">
                                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Nº do Dia</label>
                                            <input type="number" name="itinerary[{{ $dayIndex }}][day_number]" value="{{ $day->day_number }}" placeholder="Ex: 1"
                                                class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 text-xs font-bold text-center focus:outline-none transition-all bg-slate-50/30 focus:bg-white shadow-inner" required>
                                        </div>
                                        <div class="sm:col-span-3">
                                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Data / Período</label>
                                            <input type="text" name="itinerary[{{ $dayIndex }}][date]" value="{{ $day->date }}" placeholder="Ex: Sab, 12 de Out"
                                                class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 text-xs font-semibold focus:outline-none transition-all bg-slate-50/30 focus:bg-white" hidden-placeholder>
                                        </div>
                                        <div class="sm:col-span-7">
                                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Título Descritivo do Dia</label>
                                            <input type="text" name="itinerary[{{ $dayIndex }}][label]" value="{{ $day->label }}" placeholder="Ex: Chegada a Gramado e Jantar de Boas-Vindas"
                                                class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 text-xs font-semibold focus:outline-none transition-all bg-slate-50/30 focus:bg-white" required>
                                        </div>
                                    </div>
                                    <div class="bg-slate-50/50 p-3 rounded-xl border border-gray-100 flex gap-4 items-center transition-colors hover:bg-slate-50">
                                        <div class="flex-grow">
                                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">Foto do Dia</label>
                                            <input type="file" name="itinerary[{{ $dayIndex }}][image]" accept="image/*"
                                                class="w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[10px] file:font-bold file:uppercase file:tracking-wider file:bg-[#001c3d]/10 file:text-[#001c3d] hover:file:bg-[#001c3d]/20 file:transition-colors file:cursor-pointer bg-white rounded-lg border border-gray-200 p-1">
                                        </div>
                                    </div>

                                    {{-- Atividades --}}
                                    <div class="bg-slate-50 p-5 rounded-xl border border-gray-200/60 shadow-inner">
                                        <label class="block text-[10px] font-extrabold text-gray-500 uppercase tracking-widest mb-3 flex items-center gap-1.5">
                                            <i class="fas fa-stream text-slate-400"></i> Cronograma de Atividades Deste Dia
                                        </label>
                                        
                                        <div class="activities-container space-y-3">
                                            @foreach($day->activities as $actIndex => $activity)
                                                <div class="flex gap-2 items-center activity-row bg-white p-2 pl-3 rounded-xl border border-gray-200 shadow-[0_2px_10px_rgba(0,0,0,0.01)] transition-all focus-within:border-[#001c3d] focus-within:ring-2 focus-within:ring-[#001c3d]/5">
                                                    <div class="flex items-center justify-center shrink-0 w-5 h-5 rounded-full bg-slate-100 text-[#001c3d] text-[9px] font-extrabold">
                                                        <i class="fas fa-circle text-[5px]"></i>
                                                    </div>
                                                    <input type="text" name="itinerary[{{ $dayIndex }}][activities][]" value="{{ $activity->activity }}" placeholder="Descreva a atividade do dia..."
                                                        class="flex-1 border-0 focus:ring-0 px-2 py-1.5 text-xs font-medium focus:outline-none text-gray-700 placeholder-gray-400" required>
                                                    <button type="button" onclick="removeRow(this)" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                                        <i class="fas fa-times text-xs"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                        
                                        <button type="button" onclick="addActivityRow(this, {{ $dayIndex }})" class="mt-4 inline-flex items-center gap-2 text-[#001c3d] hover:text-[#001126] text-[10px] font-extrabold uppercase tracking-wider bg-white px-3 py-2 rounded-lg border border-gray-200 shadow-sm hover:border-gray-300 transition-all">
                                            <i class="fas fa-plus text-[8px] bg-[#001c3d] text-white p-1 rounded-full"></i> Nova Linha de Atividade
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-6 mt-6 border-t border-gray-100">
                <a href="{{ route('admin.destinations.index') }}" class="border border-gray-200 hover:bg-gray-50 text-gray-500 px-6 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all duration-200">
                    Cancelar
                </a>
                <button type="submit" class="bg-[#109e4a] hover:bg-[#0d8c40] text-white px-8 py-3.5 rounded-xl font-extrabold text-xs uppercase tracking-wider transition-all duration-200 shadow-lg shadow-emerald-500/10">
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>

    {{-- Javascript para abas e blocos dinâmicos --}}
    <script>
        function switchTab(evt, tabName) {
            const contents = document.querySelectorAll('.tab-content');
            contents.forEach(content => content.classList.add('hidden'));

            const inactiveClasses = "tab-btn inline-flex shrink-0 items-center gap-2 rounded-t-xl border border-transparent px-4 sm:px-5 py-3 text-[11px] sm:text-xs font-bold uppercase tracking-wider whitespace-nowrap transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#001c3d]/30 text-gray-400 hover:text-[#001c3d] hover:bg-white/60";
            const activeClasses = "tab-btn active inline-flex shrink-0 items-center gap-2 rounded-t-xl border border-gray-100 border-b-white -mb-px px-4 sm:px-5 py-3 text-[11px] sm:text-xs font-bold uppercase tracking-wider whitespace-nowrap transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#001c3d]/30 bg-white text-[#001c3d] shadow-[0_-2px_10px_rgba(0,0,0,0.03)]";

            const tabBtns = document.querySelectorAll('.tab-btn');
            tabBtns.forEach(btn => {
                btn.className = inactiveClasses;
                btn.setAttribute('aria-selected', 'false');
            });

            document.getElementById('tab-' + tabName).classList.remove('hidden');
            evt.currentTarget.className = activeClasses;
            evt.currentTarget.setAttribute('aria-selected', 'true');
            evt.currentTarget.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
        }

        function removeRow(btn) {
            const row = btn.closest('.include-row, .highlight-row, .itinerary-day-row, .activity-row');
            if (row) row.remove();
        }

        function previewFile(input, previewId) {
            const preview = document.getElementById(previewId);
            const container = document.getElementById(previewId + '-container');
            const file = input.files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function () {
                preview.src = reader.result;
                container.classList.remove('hidden');
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function addIncludeRow() {
            const container = document.getElementById('includes-container');
            const index = container.querySelectorAll('.include-row').length;
            const html = `
                <div class="flex flex-col sm:flex-row gap-3 items-stretch sm:items-center include-row bg-white p-4 rounded-xl border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.01)] hover:border-gray-200 transition-all group">
                    <div class="relative shrink-0 sm:w-44">
                        <select name="includes[${index}][type]" class="w-full bg-slate-50 border border-gray-200 rounded-xl px-3 py-2.5 text-xs font-bold text-gray-700 focus:outline-none focus:border-[#001c3d] focus:bg-white transition-colors cursor-pointer appearance-none">
                            <option value="included">🟢 Incluso</option>
                            <option value="not_included">🔴 Não Incluso</option>
                        </select>
                    </div>
                    <div class="flex-1">
                        <input type="text" name="includes[${index}][text]" placeholder="Ex: Passagem de ida e volta em classe econômica" required
                            class="w-full bg-slate-50/50 focus:bg-white border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 px-4 py-2.5 rounded-xl text-xs font-medium focus:outline-none transition-all shadow-inner">
                    </div>
                    <input type="hidden" name="includes[${index}][order]" value="${index + 1}">
                    <button type="button" onclick="removeRow(this)" class="p-2.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-xl transition-all self-end sm:self-auto" title="Remover item">
                        <i class="fas fa-trash-alt text-sm"></i>
                    </button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        }

        function addHighlightRow() {
            const container = document.getElementById('highlights-container');
            const index = container.querySelectorAll('.highlight-row').length;
            const html = `
                <div class="rounded-2xl border border-gray-100 bg-white shadow-[0_4px_20px_rgba(0,0,0,0.01)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.02)] overflow-hidden highlight-row transition-all duration-300 flex flex-col justify-between group hover:border-gray-200">
                    <input type="hidden" name="highlights[${index}][order]" value="${index + 1}">
                    <div class="flex items-center justify-between gap-2 px-4 py-3 bg-gradient-to-r from-slate-50 to-white border-b border-slate-100">
                        <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold text-[#001c3d] uppercase tracking-widest">
                            <i class="fas fa-star text-[#f3a908]"></i> Bloco de Destaque
                        </span>
                        <button type="button" onclick="removeRow(this)" class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Remover destaque">
                            <i class="fas fa-trash-alt text-xs"></i>
                        </button>
                    </div>
                    <div class="p-5 space-y-4 flex-grow">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Título Principal</label>
                                <input type="text" name="highlights[${index}][title]" placeholder="Ex: Lago Negro"
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 text-xs font-semibold focus:outline-none transition-all bg-slate-50/30 focus:bg-white" required>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Chamada Curta / Subtítulo</label>
                                <input type="text" name="highlights[${index}][subtitle]" placeholder="Ex: Lindo passeio de pedalinho"
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 text-xs font-semibold focus:outline-none transition-all bg-slate-50/30 focus:bg-white">
                            </div>
                        </div>
                        <div class="bg-slate-50/50 p-3 rounded-xl border border-gray-100 flex gap-4 items-center transition-colors group-hover:bg-slate-50">
                            <div class="flex-grow">
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">Foto do Destaque</label>
                                <input type="file" name="highlights[${index}][image]" accept="image/*" required
                                    class="w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[10px] file:font-bold file:uppercase file:tracking-wider file:bg-[#001c3d]/10 file:text-[#001c3d] hover:file:bg-[#001c3d]/20 file:transition-colors file:cursor-pointer bg-white rounded-lg border border-gray-200 p-1">
                            </div>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        }

        function addItineraryDayRow() {
            const container = document.getElementById('itinerary-container');
            const index = container.querySelectorAll('.itinerary-day-row').length;
            const html = `
                <div class="rounded-2xl border border-gray-100 bg-white shadow-[0_4px_20px_rgba(0,0,0,0.01)] overflow-hidden itinerary-day-row transition-all duration-300 hover:border-gray-200" data-day-index="${index}">
                    <input type="hidden" name="itinerary[${index}][order]" value="${index + 1}">
                    <div class="flex items-center justify-between gap-2 px-4 py-3 bg-gradient-to-r from-slate-50 to-white border-b border-slate-100">
                        <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold text-[#001c3d] uppercase tracking-widest">
                            <i class="fas fa-calendar-alt text-indigo-500"></i> Estrutura do Dia
                        </span>
                        <button type="button" onclick="removeRow(this)" class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Remover dia inteiro">
                            <i class="fas fa-trash-alt text-xs"></i>
                        </button>
                    </div>
                    <div class="p-5 space-y-5">
                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                            <div class="sm:col-span-2">
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Nº do Dia</label>
                                <input type="number" name="itinerary[${index}][day_number]" value="${index + 1}" placeholder="Ex: 1"
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 text-xs font-bold text-center focus:outline-none transition-all bg-slate-50/30 focus:bg-white shadow-inner" required>
                            </div>
                            <div class="sm:col-span-3">
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Data / Período</label>
                                <input type="text" name="itinerary[${index}][date]" placeholder="Ex: Sab, 12 de Out"
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 text-xs font-semibold focus:outline-none transition-all bg-slate-50/30 focus:bg-white">
                            </div>
                            <div class="sm:col-span-7">
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Título Descritivo do Dia</label>
                                <input type="text" name="itinerary[${index}][label]" placeholder="Ex: Chegada a Gramado e Jantar de Boas-Vindas"
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 text-xs font-semibold focus:outline-none transition-all bg-slate-50/30 focus:bg-white" required>
                            </div>
                        </div>
                        <div class="bg-slate-50/50 p-3 rounded-xl border border-gray-100 flex gap-4 items-center transition-colors hover:bg-slate-50">
                            <div class="flex-grow">
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">Foto do Dia</label>
                                <input type="file" name="itinerary[${index}][image]" accept="image/*"
                                    class="w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[10px] file:font-bold file:uppercase file:tracking-wider file:bg-[#001c3d]/10 file:text-[#001c3d] hover:file:bg-[#001c3d]/20 file:transition-colors file:cursor-pointer bg-white rounded-lg border border-gray-200 p-1">
                            </div>
                        </div>
                        <div class="bg-slate-50 p-5 rounded-xl border border-gray-200/60 shadow-inner">
                            <label class="block text-[10px] font-extrabold text-gray-500 uppercase tracking-widest mb-3 flex items-center gap-1.5">
                                <i class="fas fa-stream text-slate-400"></i> Cronograma de Atividades Deste Dia
                            </label>
                            <div class="activities-container space-y-3">
                                <div class="flex gap-2 items-center activity-row bg-white p-2 pl-3 rounded-xl border border-gray-200 shadow-[0_2px_10px_rgba(0,0,0,0.01)] transition-all focus-within:border-[#001c3d] focus-within:ring-2 focus-within:ring-[#001c3d]/5">
                                    <div class="flex items-center justify-center shrink-0 w-5 h-5 rounded-full bg-slate-100 text-[#001c3d] text-[9px] font-extrabold">
                                        <i class="fas fa-circle text-[5px]"></i>
                                    </div>
                                    <input type="text" name="itinerary[${index}][activities][]" placeholder="Descreva a atividade do dia..."
                                        class="flex-1 border-0 focus:ring-0 px-2 py-1.5 text-xs font-medium focus:outline-none text-gray-700 placeholder-gray-400" required>
                                    <button type="button" onclick="removeRow(this)" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                        <i class="fas fa-times text-xs"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button" onclick="addActivityRow(this, ${index})" class="mt-4 inline-flex items-center gap-2 text-[#001c3d] hover:text-[#001126] text-[10px] font-extrabold uppercase tracking-wider bg-white px-3 py-2 rounded-lg border border-gray-200 shadow-sm hover:border-gray-300 transition-all">
                                <i class="fas fa-plus text-[8px] bg-[#001c3d] text-white p-1 rounded-full"></i> Nova Linha de Atividade
                            </button>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        }

        function addActivityRow(btn, dayIndex) {
            const container = btn.closest('.itinerary-day-row').querySelector('.activities-container');
            const html = `
                <div class="flex gap-2 items-center activity-row bg-white p-2 pl-3 rounded-xl border border-gray-200 shadow-[0_2px_10px_rgba(0,0,0,0.01)] transition-all focus-within:border-[#001c3d] focus-within:ring-2 focus-within:ring-[#001c3d]/5">
                    <div class="flex items-center justify-center shrink-0 w-5 h-5 rounded-full bg-slate-100 text-[#001c3d] text-[9px] font-extrabold">
                        <i class="fas fa-circle text-[5px]"></i>
                    </div>
                    <input type="text" name="itinerary[${dayIndex}][activities][]" placeholder="Descreva a atividade do dia..."
                        class="flex-1 border-0 focus:ring-0 px-2 py-1.5 text-xs font-medium focus:outline-none text-gray-700 placeholder-gray-400" required>
                    <button type="button" onclick="removeRow(this)" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        }
    </script>
@endsection