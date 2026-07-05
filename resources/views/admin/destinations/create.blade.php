@extends('layouts.admin')

@section('page_title', 'Criar Novo Destino')

@section('admin_content')
    <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 overflow-hidden transition-all duration-300">
        <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-slate-50 to-white flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-gray-900 text-lg tracking-tight">Cadastrar Novo Destino</h2>
                <p class="text-xs text-gray-500 mt-1">Insira os dados do pacote, imagens, itens inclusos, destaques e cronograma do roteiro.</p>
            </div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-bold tracking-widest uppercase bg-[#001c3d]/5 text-[#001c3d] border border-[#001c3d]/10">
                <i class="fas fa-plus-circle"></i> Novo Registro
            </span>
        </div>

        {{-- Tabs Navigation --}}
        <div class="border-b border-gray-100 bg-slate-50/50 flex flex-wrap gap-1 p-2" id="tabs">
            <button type="button" onclick="switchTab(event, 'basic')" class="tab-btn active px-5 py-3 rounded-lg font-bold text-xs uppercase tracking-wider transition-all duration-200 focus:outline-none bg-[#001c3d] text-white shadow-sm">
                <i class="fas fa-info-circle mr-1.5 text-sm"></i> Básico
            </button>
            <button type="button" onclick="switchTab(event, 'details')" class="tab-btn px-5 py-3 rounded-lg font-bold text-xs uppercase tracking-wider transition-all duration-200 focus:outline-none text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                <i class="fas fa-sliders mr-1.5 text-sm"></i> Detalhes do Pacote
            </button>
            <button type="button" onclick="switchTab(event, 'includes-tab')" class="tab-btn px-5 py-3 rounded-lg font-bold text-xs uppercase tracking-wider transition-all duration-200 focus:outline-none text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                <i class="fas fa-check-double mr-1.5 text-sm"></i> Inclui / Não Inclui
            </button>
            <button type="button" onclick="switchTab(event, 'highlights-tab')" class="tab-btn px-5 py-3 rounded-lg font-bold text-xs uppercase tracking-wider transition-all duration-200 focus:outline-none text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                <i class="fas fa-star mr-1.5 text-sm"></i> Destaques
            </button>
            <button type="button" onclick="switchTab(event, 'itinerary-tab')" class="tab-btn px-5 py-3 rounded-lg font-bold text-xs uppercase tracking-wider transition-all duration-200 focus:outline-none text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                <i class="fas fa-route mr-1.5 text-sm"></i> Roteiro
            </button>
            <button type="button" onclick="switchTab(event, 'payment-methods-tab')" class="tab-btn px-5 py-3 rounded-lg font-bold text-xs uppercase tracking-wider transition-all duration-200 focus:outline-none text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                <i class="fas fa-credit-card mr-1.5 text-sm"></i> Formas de Pagamento
            </button>
        </div>

        <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf

            {{-- TAB BASIC --}}
            <div id="tab-basic" class="tab-content space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Título (Cidade / Local)</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: Gramado">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subtitle -->
                    <div>
                        <label for="subtitle" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Subtítulo (Atrações / Detalhes)</label>
                        <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: Canela + Bento Gonçalves">
                        @error('subtitle')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="title" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Título do Card</label>
                        <input type="text" name="title_card" id="title_card" value="{{ old('title_card') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: Gramado">
                        @error('title_card')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="subtitle_card" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Subtítulo do Card</label>
                        <input type="text" name="subtitle_card" id="subtitle_card" value="{{ old('subtitle_card') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: Canela + Bento Gonçalves">
                        @error('subtitle_card')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="text_label_banner" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Descrição do Destino</label>
                        <textarea name="text_label_banner" id="text_label_banner" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: Canela + Bento Gonçalves">{{ old('text_label_banner') }}</textarea>
                        @error('text_label_banner')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div>
                        <label for="slug" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Slug (URL amigável - opcional)</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: gramado-inverno">
                        @error('slug')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Categoria</label>
                        <input type="text" name="category" id="category" value="{{ old('category') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: AÉREO + HOTEL + PASSEIOS">
                        @error('category')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Preço Mensal (Boleto)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 font-bold text-sm">R$</span>
                            <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" required
                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                                placeholder="Ex: 69.99">
                        </div>
                        @error('price')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tag -->
                    <div>
                        <label for="tag" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Tag de Destaque (Opcional)</label>
                        <input type="text" name="tag" id="tag" value="{{ old('tag') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: MAIS VENDIDO">
                        @error('tag')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Type -->
                    <div>
                        <label for="type" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Tipo de Destino</label>
                        <select name="type" id="type" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white select-custom">
                            <option value="">Selecione o tipo...</option>
                            <option value="pacotes-2026-2027" {{ old('type') == 'pacotes-2026-2027' ? 'selected' : '' }}>Pacotes 2026-2027</option>
                            <option value="bate-e-volta" {{ old('type') == 'bate-e-volta' ? 'selected' : '' }}>Bate e Volta</option>
                            <option value="viagem-em-grupo" {{ old('type') == 'viagem-em-grupo' ? 'selected' : '' }}>Viagem em Grupo</option>
                            <option value="pacote-principal" {{ old('type') == 'pacote-principal' ? 'selected' : '' }}>Pacote Principal</option>
                        </select>
                        @error('type')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="bg-slate-50 p-5 rounded-2xl border border-dashed border-slate-200 hover:border-slate-300 transition-colors">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-3">Imagem do Card (Home/Listagem)</label>
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-200 border-dashed rounded-xl cursor-pointer bg-white hover:bg-gray-50 transition-colors">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <i class="fas fa-cloud-upload-alt text-2xl text-slate-400 mb-2"></i>
                                <p class="text-xs text-slate-500 font-bold mb-1">Clique para fazer upload da imagem</p>
                                <p class="text-[10px] text-slate-400">PNG, JPG ou WEBP (Max 5MB)</p>
                            </div>
                            <input type="file" name="image" id="image" accept="image/*" required class="hidden" onchange="previewFile(this, 'card-preview')">
                        </label>
                    </div>
                    <div id="card-preview-container" class="mt-3 hidden">
                        <span class="text-[10px] font-bold text-gray-400 block mb-1">Pré-visualização:</span>
                        <img id="card-preview" src="#" alt="Preview" class="w-32 h-24 object-cover rounded-lg border border-gray-200 shadow-sm">
                    </div>
                    @error('image')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- WhatsApp Link -->
                <div>
                    <label for="whatsapp_link" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Link WhatsApp Personalizado (Opcional)</label>
                    <input type="url" name="whatsapp_link" id="whatsapp_link" value="{{ old('whatsapp_link') }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                        placeholder="Ex: https://wa.me/5585999166421?text=Olá, tenho interesse...">
                    <p class="text-[10px] text-gray-400 mt-1.5 font-medium">Se deixado em branco, o site usará o link padrão do WhatsApp.</p>
                    @error('whatsapp_link')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Checkboxes -->
                <div class="flex flex-col sm:flex-row gap-6">
                    <label class="flex items-center gap-3 bg-slate-50 p-4 rounded-xl border border-slate-100 cursor-pointer select-none hover:bg-slate-100 transition-colors w-fit">
                        <input type="checkbox" name="is_featured" value="1" checked
                            class="w-4 h-4 rounded text-[#001c3d] focus:ring-[#001c3d] border-gray-300">
                        <span class="text-xs font-bold text-slate-700 uppercase tracking-wide">Exibir na Home</span>
                    </label>
                </div>
            </div>

            {{-- TAB DETAILS --}}
            <div id="tab-details" class="tab-content hidden space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Full Price -->
                    <div>
                        <label for="full_price" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Preço Total Inteiro (Ex: R$ 1.800)</label>
                        <input type="text" name="full_price" id="full_price" value="{{ old('full_price') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: R$ 2.450,00">
                    </div>

                    <!-- Date Range -->
                    <div>
                        <label for="date_range" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Período da Viagem</label>
                        <input type="text" name="date_range" id="date_range" value="{{ old('date_range') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: 10 a 17 de Outubro">
                    </div>

                    <!-- Nights -->
                    <div>
                        <label for="nights" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Número de Noites</label>
                        <input type="number" name="nights" id="nights" value="{{ old('nights') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: 6">
                    </div>
                    <div>
                        <label for="duration" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Número de Dias</label>
                        <input type="number" name="duration" id="duration" value="{{ old('duration') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: 7">
                        @error('duration')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Departure City -->
                    <div>
                        <label for="departure_city" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Cidade de Saída</label>
                        <input type="text" name="departure_city" id="departure_city" value="{{ old('departure_city') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: Fortaleza">
                    </div>

                    <!-- Departure Date -->
                    <div>
                        <label for="departure_date" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Data de Ida</label>
                        <input type="text" name="departure_date" id="departure_date" value="{{ old('departure_date') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: 10/10/2026">
                    </div>

                    <!-- Return Date -->
                    <div>
                        <label for="return_date" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Data de Volta</label>
                        <input type="text" name="return_date" id="return_date" value="{{ old('return_date') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: 17/10/2026">
                    </div>

                    <!-- Trip Type -->
                    <div>
                        <label for="trip_type" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Tipo de Pacote detalhado</label>
                        <input type="text" name="trip_type" id="trip_type" value="{{ old('trip_type') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: Pacote Aéreo">
                    </div>
                </div>

                <!-- Banner Image -->
                <div class="bg-slate-50 p-5 rounded-2xl border border-dashed border-slate-200 hover:border-slate-300 transition-colors">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-3">Imagem de Banner (Detalhes do Pacote)</label>
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-200 border-dashed rounded-xl cursor-pointer bg-white hover:bg-gray-50 transition-colors">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <i class="fas fa-image text-2xl text-slate-400 mb-2"></i>
                                <p class="text-xs text-slate-500 font-bold mb-1">Fazer upload do banner panorâmico</p>
                                <p class="text-[10px] text-slate-400">Dimensões ideais recomendadas: 1920x600px</p>
                            </div>
                            <input type="file" name="banner_image" id="banner_image" accept="image/*" class="hidden" onchange="previewFile(this, 'banner-preview')">
                        </label>
                    </div>
                    <div id="banner-preview-container" class="mt-3 hidden">
                        <span class="text-[10px] font-bold text-gray-400 block mb-1">Pré-visualização:</span>
                        <img id="banner-preview" src="#" alt="Banner Preview" class="w-64 h-20 object-cover rounded-lg border border-gray-200 shadow-sm">
                    </div>
                </div>

                <!-- Highlights Icons -->
                <div class="bg-slate-50/50 p-6 rounded-2xl border border-slate-100">
                    <label class="block text-xs font-bold text-[#001c3d] uppercase tracking-wider mb-4"><i class="fas fa-star text-[#f3a908] mr-1"></i> Facilidades Inclusas (Marcação Rápida)</label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        @php
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
                                <input type="checkbox" name="highlights_icons[]" value="{{ $key }}"
                                    class="w-4 h-4 rounded text-[#001c3d] focus:ring-[#001c3d] border-gray-300">
                                <span>{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- TAB INCLUDES --}}
            <div id="tab-includes-tab" class="tab-content hidden space-y-6">
                <div class="bg-slate-50/50 p-6 rounded-2xl border border-slate-100">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-sm font-bold text-gray-800">Itens Inclusos e Não Inclusos no Pacote</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Defina a lista de itens inclusos e não inclusos da viagem.</p>
                        </div>
                        <button type="button" onclick="addIncludeRow()" class="bg-[#001c3d] text-white hover:bg-[#001126] px-4 py-2.5 rounded-lg text-xs font-bold transition-colors shadow-sm inline-flex items-center gap-1.5">
                            <i class="fas fa-plus"></i> Adicionar Item
                        </button>
                    </div>
                    
                    <div id="includes-container" class="space-y-3">
                        <div class="flex gap-3 items-center include-row bg-white p-3 rounded-xl border border-slate-100 shadow-sm">
                            <select name="includes[0][type]" class="bg-slate-50 border border-slate-200 rounded-lg px-3 py-2.5 text-xs font-bold text-gray-700 focus:outline-none focus:border-[#001c3d]">
                                <option value="included">Incluso</option>
                                <option value="not_included">Não Incluso</option>
                            </select>
                            <input type="text" name="includes[0][text]" placeholder="Ex: Passagem de ida e volta inclusa"
                                class="flex-1 bg-slate-50/50 focus:bg-white border border-slate-200 focus:border-[#001c3d] focus:ring-1 focus:ring-[#001c3d] px-4 py-2.5 rounded-lg text-xs focus:outline-none transition-colors" required>
                            <input type="hidden" name="includes[0][order]" value="1">
                            <button type="button" onclick="removeRow(this)" class="p-2.5 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                <i class="fas fa-trash-alt text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TAB HIGHLIGHTS --}}
            <div id="tab-highlights-tab" class="tab-content hidden space-y-6">
                <div class="bg-slate-50/50 p-6 rounded-2xl border border-slate-100">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-sm font-bold text-gray-800">Destaques e Fotos da Viagem</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Destaque os principais locais e experiências incríveis com fotos.</p>
                        </div>
                        <button type="button" onclick="addHighlightRow()" class="bg-[#001c3d] text-white hover:bg-[#001126] px-4 py-2.5 rounded-lg text-xs font-bold transition-colors shadow-sm inline-flex items-center gap-1.5">
                            <i class="fas fa-plus"></i> Adicionar Destaque
                        </button>
                    </div>

                    <div id="highlights-container" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-5 border border-slate-100 rounded-xl bg-white highlight-row space-y-4 shadow-sm relative">
                            <input type="hidden" name="highlights[0][order]" value="1">
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Título do Destaque</label>
                                    <input type="text" name="highlights[0][title]" placeholder="Ex: Lago Negro"
                                        class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none transition-colors bg-slate-50/30" required>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Descrição Curta</label>
                                    <input type="text" name="highlights[0][subtitle]" placeholder="Ex: Passeio romântico de pedalinho"
                                        class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none transition-colors bg-slate-50/30">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Foto do Destaque</label>
                                    <input type="file" name="highlights[0][image]" accept="image/*" required
                                        class="w-full text-xs text-gray-500 border border-slate-200 rounded-lg p-1.5 focus:outline-none">
                                </div>
                            </div>
                            <button type="button" onclick="removeRow(this)" class="absolute top-2 right-2 p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                <i class="fas fa-trash-alt text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TAB ITINERARY --}}
            <div id="tab-itinerary-tab" class="tab-content hidden space-y-6">
                <div class="bg-slate-50/50 p-6 rounded-2xl border border-slate-100">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-sm font-bold text-gray-800">Roteiro Diário (Dia a Dia)</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Descreva a programação completa da viagem dividida por dias.</p>
                        </div>
                        <button type="button" onclick="addItineraryDayRow()" class="bg-[#001c3d] text-white hover:bg-[#001126] px-4 py-2.5 rounded-lg text-xs font-bold transition-colors shadow-sm inline-flex items-center gap-1.5">
                            <i class="fas fa-plus"></i> Adicionar Dia
                        </button>
                    </div>

                    <div id="itinerary-container" class="space-y-6">
                        <div class="p-5 border border-slate-100 rounded-xl bg-white space-y-4 itinerary-day-row relative shadow-sm" data-day-index="0">
                            <input type="hidden" name="itinerary[0][order]" value="1">
                            
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Número do Dia</label>
                                    <input type="number" name="itinerary[0][day_number]" value="1" placeholder="Ex: 1"
                                        class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none transition-colors" required>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Data ou Período (Opcional)</label>
                                    <input type="text" name="itinerary[0][date]" placeholder="Ex: Dia 10 de Outubro"
                                        class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none transition-colors">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Título do Dia</label>
                                    <input type="text" name="itinerary[0][label]" placeholder="Ex: Chegada e Check-in"
                                        class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none transition-colors" required>
                                </div>
                            </div>

                            <div class="mt-4 bg-slate-50/50 p-3 rounded-xl border border-gray-100 flex gap-4 items-center">
                                <div class="flex-grow">
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Foto do Dia</label>
                                    <input type="file" name="itinerary[0][image]" accept="image/*"
                                        class="w-full text-xs text-gray-500 border border-slate-200 rounded-lg p-1.5 focus:outline-none">
                                </div>
                            </div>

                            {{-- Atividades --}}
                            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                                <label class="block text-[10px] font-bold text-slate-500 uppercase mb-3"><i class="fas fa-tasks mr-1"></i> Atividades Programadas</label>
                                <div class="activities-container space-y-2.5">
                                    <div class="flex gap-2 items-center activity-row bg-white p-2 rounded-lg border border-slate-100 shadow-sm">
                                        <span class="text-xs text-[#001c3d] font-bold pl-2">•</span>
                                        <input type="text" name="itinerary[0][activities][]" placeholder="Atividade realizada..."
                                            class="flex-1 border-0 focus:ring-0 px-2 py-1.5 text-xs focus:outline-none" required>
                                        <button type="button" onclick="removeRow(this)" class="p-1.5 text-red-500 hover:bg-red-50 rounded transition-colors">
                                            <i class="fas fa-times text-xs"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="button" onclick="addActivityRow(this, 0)" class="mt-3 inline-flex items-center gap-1.5 text-[#001c3d] hover:text-[#001126] text-[10px] font-bold">
                                    <i class="fas fa-plus text-[8px] bg-[#001c3d]/10 p-1.5 rounded-full"></i> Adicionar Atividade
                                </button>
                            </div>
                            <button type="button" onclick="removeRow(this)" class="absolute top-2 right-2 p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                <i class="fas fa-trash-alt text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TAB PAYMENT METHODS --}}
            <div id="tab-payment-methods-tab" class="tab-content space-y-6 hidden">
                <div>
                    <h3 class="text-sm font-extrabold text-gray-800">Formas de Pagamento do Destino</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Ative e configure as formas de pagamento disponíveis para este pacote de viagem.</p>
                </div>

                <div class="space-y-4">
                    @foreach($paymentMethods as $index => $method)
                        <div class="p-5 rounded-2xl border border-gray-150 bg-white hover:border-gray-300 transition duration-150 space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center">
                                        <i class="{{ $method->icon }} text-slate-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-bold text-gray-800">{{ $method->name }}</h4>
                                        <span class="text-[10px] text-gray-400 font-semibold">{{ $method->icon }} | {{ $method->icon_color }}</span>
                                    </div>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="hidden" name="payment_methods[{{ $index }}][payment_method_id]" value="{{ $method->id }}">
                                    <input type="checkbox" name="payment_methods[{{ $index }}][active]" value="1" checked class="sr-only peer">
                                    <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-emerald-600"></div>
                                    <span class="ml-2 text-xs font-bold text-gray-600">Ativo</span>
                                </label>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                                <div class="sm:col-span-8">
                                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Descrição Principal (HTML permitido)</label>
                                    @php
                                        $defaultText = '';
                                        $defaultSubtext = '';
                                        if ($method->name == 'Entrada + Parcelas') {
                                            $defaultText = 'Entrada de <strong>R$ 289,00</strong> + saldo devedor dividido em parcelas mensais até <strong>Março 2027</strong>.';
                                            $defaultSubtext = 'Pacote de Viagem tem que estar devidamente quitado até <strong>5 de Março 2027</strong>';
                                        } elseif ($method->name == 'À vista/parcelado') {
                                            $defaultText = 'À vista/parcelado (Depósito, Transferência, Promissória ou Pix)';
                                        } elseif ($method->name == 'Boleto') {
                                            $defaultText = 'Boleto em até 9x com início de pagamento de Julho 2027';
                                        } elseif ($method->name == 'Cartão de Crédito') {
                                            $defaultText = 'Cartão de crédito parcelado em até 10x';
                                            $defaultSubtext = '(Valor ajustado)';
                                        }
                                    @endphp
                                    <input type="text" name="payment_methods[{{ $index }}][text]" value="{{ $defaultText }}" placeholder="Ex: Boleto em até 9x..."
                                        class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 text-xs font-semibold focus:outline-none transition-all">
                                </div>
                                <div class="sm:col-span-3">
                                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Subtexto / Observação adicional</label>
                                    <input type="text" name="payment_methods[{{ $index }}][subtext]" value="{{ $defaultSubtext }}" placeholder="Ex: (Valor com desconto)"
                                        class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 text-xs font-semibold focus:outline-none transition-all">
                                </div>
                                <div class="sm:col-span-1">
                                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Ordem</label>
                                    <input type="number" name="payment_methods[{{ $index }}][order]" value="{{ $index + 1 }}"
                                        class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 text-xs font-bold text-center focus:outline-none transition-all">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Buttons Form Actions -->
            <div class="flex items-center justify-end gap-3 pt-6 mt-6 border-t border-gray-100">
                <a href="{{ route('admin.destinations.index') }}" class="border border-gray-200 hover:bg-gray-50 text-gray-500 px-6 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all duration-200">
                    Cancelar
                </a>
                <button type="submit" class="bg-[#109e4a] hover:bg-[#0d8c40] text-white px-8 py-3.5 rounded-xl font-extrabold text-xs uppercase tracking-wider transition-all duration-200 shadow-lg shadow-emerald-500/10">
                    Cadastrar Destino
                </button>
            </div>
        </form>
    </div>

    {{-- Javascript para abas e blocos dinâmicos --}}
    <script>
        function switchTab(evt, tabName) {
            const contents = document.querySelectorAll('.tab-content');
            contents.forEach(content => content.classList.add('hidden'));

            const tabBtns = document.querySelectorAll('.tab-btn');
            tabBtns.forEach(btn => {
                btn.className = "tab-btn px-5 py-3 rounded-lg font-bold text-xs uppercase tracking-wider transition-all duration-200 focus:outline-none text-gray-600 hover:bg-gray-100 hover:text-gray-900";
            });

            document.getElementById('tab-' + tabName).classList.remove('hidden');
            evt.currentTarget.className = "tab-btn active px-5 py-3 rounded-lg font-bold text-xs uppercase tracking-wider transition-all duration-200 focus:outline-none bg-[#001c3d] text-white shadow-sm";
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
                <div class="flex gap-3 items-center include-row bg-white p-3 rounded-xl border border-slate-100 shadow-sm">
                    <select name="includes[${index}][type]" class="bg-slate-50 border border-slate-200 rounded-lg px-3 py-2.5 text-xs font-bold text-gray-700 focus:outline-none focus:border-[#001c3d]">
                        <option value="included">Incluso</option>
                        <option value="not_included">Não Incluso</option>
                    </select>
                    <input type="text" name="includes[${index}][text]" placeholder="Ex: Passagem de ida e volta inclusa" required
                        class="flex-1 bg-slate-50/50 focus:bg-white border border-slate-200 focus:border-[#001c3d] focus:ring-1 focus:ring-[#001c3d] px-4 py-2.5 rounded-lg text-xs focus:outline-none transition-colors">
                    <input type="hidden" name="includes[${index}][order]" value="${index + 1}">
                    <button type="button" onclick="removeRow(this)" class="p-2.5 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
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
                <div class="p-5 border border-slate-100 rounded-xl bg-white highlight-row space-y-4 shadow-sm relative animate-fade-in">
                    <input type="hidden" name="highlights[${index}][order]" value="${index + 1}">
                    <div class="space-y-3">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Título do Destaque</label>
                            <input type="text" name="highlights[${index}][title]" placeholder="Ex: Lago Negro"
                                class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none transition-colors bg-slate-50/30" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Descrição Curta</label>
                            <input type="text" name="highlights[${index}][subtitle]" placeholder="Ex: Passeio romântico de pedalinho"
                                class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none transition-colors bg-slate-50/30">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Foto do Destaque</label>
                            <input type="file" name="highlights[${index}][image]" accept="image/*" required
                                class="w-full text-xs text-gray-500 border border-slate-200 rounded-lg p-1.5 focus:outline-none">
                        </div>
                    </div>
                    <button type="button" onclick="removeRow(this)" class="absolute top-2 right-2 p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                        <i class="fas fa-trash-alt text-sm"></i>
                    </button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        }

        function addItineraryDayRow() {
            const container = document.getElementById('itinerary-container');
            const index = container.querySelectorAll('.itinerary-day-row').length;
            const html = `
                <div class="p-5 border border-slate-100 rounded-xl bg-white space-y-4 itinerary-day-row relative shadow-sm" data-day-index="${index}">
                    <input type="hidden" name="itinerary[${index}][order]" value="${index + 1}">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Número do Dia</label>
                            <input type="number" name="itinerary[${index}][day_number]" value="${index + 1}" placeholder="Ex: 1"
                                class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none transition-colors" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Data ou Período (Opcional)</label>
                            <input type="text" name="itinerary[${index}][date]" placeholder="Ex: Dia 10 de Outubro"
                                class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Título do Dia</label>
                            <input type="text" name="itinerary[${index}][label]" placeholder="Ex: Chegada e Check-in"
                                class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none transition-colors" required>
                        </div>
                    </div>
                    <div class="mt-4 bg-slate-50/50 p-3 rounded-xl border border-gray-100 flex gap-4 items-center">
                        <div class="flex-grow">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Foto do Dia</label>
                            <input type="file" name="itinerary[${index}][image]" accept="image/*"
                                class="w-full text-xs text-gray-500 border border-slate-200 rounded-lg p-1.5 focus:outline-none">
                        </div>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                        <label class="block text-[10px] font-bold text-slate-500 uppercase mb-3"><i class="fas fa-tasks mr-1"></i> Atividades Programadas</label>
                        <div class="activities-container space-y-2.5">
                            <div class="flex gap-2 items-center activity-row bg-white p-2 rounded-lg border border-slate-100 shadow-sm">
                                <span class="text-xs text-[#001c3d] font-bold pl-2">•</span>
                                <input type="text" name="itinerary[${index}][activities][]" placeholder="Atividade realizada..."
                                    class="flex-1 border-0 focus:ring-0 px-2 py-1.5 text-xs focus:outline-none" required>
                                <button type="button" onclick="removeRow(this)" class="p-1.5 text-red-500 hover:bg-red-50 rounded transition-colors">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" onclick="addActivityRow(this, ${index})" class="mt-3 inline-flex items-center gap-1.5 text-[#001c3d] hover:text-[#001126] text-[10px] font-bold">
                            <i class="fas fa-plus text-[8px] bg-[#001c3d]/10 p-1.5 rounded-full"></i> Adicionar Atividade
                        </button>
                    </div>
                    <button type="button" onclick="removeRow(this)" class="absolute top-2 right-2 p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                        <i class="fas fa-trash-alt text-sm"></i>
                    </button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        }

        function addActivityRow(btn, dayIndex) {
            const container = btn.closest('.itinerary-day-row').querySelector('.activities-container');
            const html = `
                <div class="flex gap-2 items-center activity-row bg-white p-2 rounded-lg border border-slate-100 shadow-sm">
                    <span class="text-xs text-[#001c3d] font-bold pl-2">•</span>
                    <input type="text" name="itinerary[${dayIndex}][activities][]" placeholder="Atividade realizada..."
                        class="flex-1 border-0 focus:ring-0 px-2 py-1.5 text-xs focus:outline-none" required>
                    <button type="button" onclick="removeRow(this)" class="p-1.5 text-red-500 hover:bg-red-50 rounded transition-colors">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        }
    </script>
@endsection
