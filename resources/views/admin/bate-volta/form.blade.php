    <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 overflow-hidden transition-all duration-300">
        <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-orange-50 to-white flex items-center justify-between">
            <div>
                @if(isset($edit) && $edit)
                    <h2 class="font-extrabold text-gray-900 text-lg tracking-tight">Editar Passeio: {{ $destination->title }}</h2>
                    <p class="text-xs text-gray-500 mt-1">Atualize as informações do passeio Bate e Volta.</p>
                @else
                    <h2 class="font-extrabold text-gray-900 text-lg tracking-tight">Criar Novo Passeio — Bate e Volta</h2>
                    <p class="text-xs text-gray-500 mt-1">Preencha as informações do novo passeio de 1 dia.</p>
                @endif
            </div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-bold tracking-widest uppercase bg-orange-100 text-orange-700 border border-orange-200">
                <i class="fas fa-sun"></i>
                @if(isset($edit) && $edit) Editando Registro @else Bate e Volta @endif
            </span>
        </div>

        {{-- Tabs Navigation --}}
        <div class="border-b border-gray-100 bg-slate-50 px-2 sm:px-4">
            <nav id="tabs-bv" role="tablist" aria-label="Seções do formulário"
                 class="flex gap-1 overflow-x-auto pt-2 [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                <button type="button" role="tab" aria-selected="true" aria-controls="bv-tab-basic" onclick="switchTabBV(event, 'basic')"
                    class="bv-tab-btn bv-active inline-flex shrink-0 items-center gap-2 rounded-t-xl border border-gray-100 border-b-white -mb-px px-4 sm:px-5 py-3 text-[11px] sm:text-xs font-bold uppercase tracking-wider whitespace-nowrap transition-all duration-200 focus:outline-none bg-white text-[#001c3d] shadow-[0_-2px_10px_rgba(0,0,0,0.03)]">
                    <i class="fas fa-info-circle text-sm"></i>
                    <span>Dados Básicos</span>
                </button>
                <button type="button" role="tab" aria-selected="false" aria-controls="bv-tab-logistics" onclick="switchTabBV(event, 'logistics')"
                    class="bv-tab-btn inline-flex shrink-0 items-center gap-2 rounded-t-xl border border-transparent px-4 sm:px-5 py-3 text-[11px] sm:text-xs font-bold uppercase tracking-wider whitespace-nowrap transition-all duration-200 focus:outline-none text-gray-400 hover:text-[#001c3d] hover:bg-white/60">
                    <i class="fas fa-clock text-sm"></i>
                    <span>Logística e Horários</span>
                </button>
                <button type="button" role="tab" aria-selected="false" aria-controls="bv-tab-includes" onclick="switchTabBV(event, 'includes')"
                    class="bv-tab-btn inline-flex shrink-0 items-center gap-2 rounded-t-xl border border-transparent px-4 sm:px-5 py-3 text-[11px] sm:text-xs font-bold uppercase tracking-wider whitespace-nowrap transition-all duration-200 focus:outline-none text-gray-400 hover:text-[#001c3d] hover:bg-white/60">
                    <i class="fas fa-check-double text-sm"></i>
                    <span>Itens Inclusos</span>
                </button>
                <button type="button" role="tab" aria-selected="false" aria-controls="bv-tab-rules" onclick="switchTabBV(event, 'rules')"
                    class="bv-tab-btn inline-flex shrink-0 items-center gap-2 rounded-t-xl border border-transparent px-4 sm:px-5 py-3 text-[11px] sm:text-xs font-bold uppercase tracking-wider whitespace-nowrap transition-all duration-200 focus:outline-none text-gray-400 hover:text-[#001c3d] hover:bg-white/60">
                    <i class="fas fa-triangle-exclamation text-sm"></i>
                    <span>Regras e Alertas</span>
                </button>
            </nav>
        </div>

        @if(isset($edit) && $edit)
            <form action="{{ route('admin.bate-volta.update', $destination->id) }}" method="POST" novalidate enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')
        @else
            <form action="{{ route('admin.bate-volta.store') }}" method="POST" novalidate enctype="multipart/form-data" class="p-6">
                @csrf
        @endif

            {{-- Campo type oculto fixo para esta modalidade --}}
            <input type="hidden" name="type" value="bate-e-volta">
            <input type="hidden" name="duration" value="1">
            <input type="hidden" name="category" value="BATE E VOLTA">
            <input type="hidden" name="trip_type" value="Bate e Volta">

            {{-- ===================== TAB: DADOS BÁSICOS ===================== --}}
            <div id="bv-tab-basic" class="bv-tab-content space-y-6">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    {{-- Título --}}
                    <div>
                        <label for="bv_title" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Título do Destino <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="bv_title"
                            value="{{ old('title', isset($destination) ? $destination->title : '') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: SÁBADÃO EM CANOA QUEBRADA">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Subtítulo / Headline da Data --}}
                    <div>
                        <label for="bv_subtitle" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Subtítulo / Headline da Data
                        </label>
                        <input type="text" name="subtitle" id="bv_subtitle"
                            value="{{ old('subtitle', isset($destination) ? $destination->subtitle : '') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: Bate e Volta para Canoa Quebrada – Dia 11 de Julho/2026!">
                        @error('subtitle')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    <div>
                        <label for="bv_slug" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Slug (URL amigável — opcional)
                        </label>
                        <input type="text" name="slug" id="bv_slug"
                            value="{{ old('slug', isset($destination) ? $destination->slug : '') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: sabadao-canoa-quebrada-julho-2026">
                        @error('slug')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Preço Único --}}
                    <div>
                        <label for="bv_price" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Preço Único por Pessoa <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 font-bold text-sm">R$</span>
                            <input type="number" step="0.01" name="price" id="bv_price"
                                value="{{ old('price', isset($destination) ? $destination->price : '') }}" required
                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                                placeholder="Ex: 129.90">
                        </div>
                        @error('price')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Descrição Curta / Chamada --}}
                <div>
                    <label for="bv_description" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                        Descrição Curta / Chamada
                    </label>
                    <textarea name="description" id="bv_description" rows="3"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white resize-none"
                        placeholder="Ex: Uma aventura de um dia pelo litoral cearense com tudo incluso e muito conforto!">{{ old('description', isset($destination) ? $destination->description : '') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Imagem Principal --}}
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-3">Imagem Principal do Passeio</label>
                    <div class="flex flex-col sm:flex-row gap-6 items-start">
                        @if(isset($destination) && $destination->image_path)
                            <div class="shrink-0">
                                <span class="block text-[10px] font-bold text-gray-400 mb-1">Imagem atual:</span>
                                <img src="{{ asset('storage/' . $destination->image_path) }}" alt="{{ $destination->title }}" class="w-32 h-24 object-cover rounded-xl shadow-sm border border-gray-200">
                            </div>
                        @endif
                        <div class="flex-grow w-full">
                            <label class="flex flex-col items-center justify-center w-full h-24 border-2 border-gray-200 border-dashed rounded-xl cursor-pointer bg-white hover:bg-gray-50 transition-colors">
                                <div class="flex flex-col items-center justify-center pt-2">
                                    <i class="fas fa-cloud-upload-alt text-xl text-slate-400 mb-1"></i>
                                    <p class="text-xs text-slate-500 font-bold mb-0.5">Enviar imagem do passeio</p>
                                    <p class="text-[9px] text-slate-400">Deixe em branco para manter a atual</p>
                                </div>
                                <input type="file" name="image" id="bv_image" accept="image/*" class="hidden" onchange="bvPreviewFile(this, 'bv-card-preview')">
                            </label>
                            <div id="bv-card-preview-container" class="mt-3 hidden">
                                <span class="text-[10px] font-bold text-gray-400 block mb-1">Pré-visualização:</span>
                                <img id="bv-card-preview" src="#" alt="Preview" class="w-32 h-24 object-cover rounded-lg border border-gray-200 shadow-sm">
                            </div>
                            @error('image')
                                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Link WhatsApp e Destaque --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="bv_whatsapp_link" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Link WhatsApp Personalizado (Opcional)
                        </label>
                        <input type="url" name="whatsapp_link" id="bv_whatsapp_link"
                            value="{{ old('whatsapp_link', isset($destination) ? $destination->whatsapp_link : '') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: https://wa.me/5585999166421?text=Olá, quero o Bate e Volta...">
                        <p class="text-[10px] text-gray-400 mt-1.5 font-medium">Se vazio, usa o link padrão do sistema.</p>
                    </div>
                    <div class="flex flex-col justify-center">
                        <label class="flex items-center gap-3 bg-slate-50 p-4 rounded-xl border border-slate-100 cursor-pointer select-none hover:bg-slate-100 transition-colors w-fit">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', isset($destination) ? $destination->is_featured : '') ? 'checked' : '' }}
                                class="w-4 h-4 rounded text-[#001c3d] focus:ring-[#001c3d] border-gray-300">
                            <span class="text-xs font-bold text-[#001c3d] uppercase tracking-wide">Exibir na Home</span>
                        </label>
                    </div>
                </div>

            </div>{{-- END TAB BASIC --}}

            {{-- ===================== TAB: LOGÍSTICA E HORÁRIOS ===================== --}}
            <div id="bv-tab-logistics" class="bv-tab-content space-y-6 hidden">

                <div class="bg-orange-50/60 border border-orange-100 rounded-2xl p-5 mb-2">
                    <div class="flex items-center gap-2 mb-1">
                        <i class="fas fa-info-circle text-orange-500"></i>
                        <span class="text-xs font-bold text-orange-700 uppercase tracking-wider">Informações exclusivas do Bate e Volta</span>
                    </div>
                    <p class="text-xs text-orange-600/80 font-medium">Informe o local, horário de saída e retorno do passeio de 1 dia.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    {{-- Local de Embarque e Desembarque --}}
                    <div class="sm:col-span-3">
                        <label for="bv_departure_city" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            <i class="fas fa-map-marker-alt text-orange-500 mr-1"></i>
                            Local de Embarque e Desembarque <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="departure_city" id="bv_departure_city"
                            value="{{ old('departure_city', isset($destination) ? $destination->departure_city : '') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: Fortaleza – Av. Beira Mar (em frente ao Náutico), Shopping Benfica e Aeroporto">
                        @error('departure_city')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Horário de Saída --}}
                    <div>
                        <label for="bv_departure_date" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            <i class="fas fa-arrow-right text-green-500 mr-1"></i>
                            Horário de Saída <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="departure_date" id="bv_departure_date"
                            value="{{ old('departure_date', isset($destination) ? $destination->departure_date : '') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: 06:30h">
                        @error('departure_date')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Horário de Retorno --}}
                    <div>
                        <label for="bv_return_date" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            <i class="fas fa-arrow-left text-blue-500 mr-1"></i>
                            Horário de Retorno (Previsão) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="return_date" id="bv_return_date"
                            value="{{ old('return_date', isset($destination) ? $destination->return_date : '') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: 18:00h da tarde">
                        @error('return_date')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Data do Passeio (Período) --}}
                    <div>
                        <label for="bv_date_range" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            <i class="fas fa-calendar-alt text-purple-500 mr-1"></i>
                            Data do Passeio
                        </label>
                        <input type="text" name="date_range" id="bv_date_range"
                            value="{{ old('date_range', isset($destination) ? $destination->date_range : '') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                            placeholder="Ex: Sábado, 11 de Julho de 2026">
                        @error('date_range')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

            </div>{{-- END TAB LOGISTICS --}}

            {{-- ===================== TAB: ITENS INCLUSOS ===================== --}}
            <div id="bv-tab-includes" class="bv-tab-content space-y-6 hidden">

                <div class="bg-slate-50/60 p-6 rounded-2xl border border-slate-100">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                        <div>
                            <h3 class="text-sm font-extrabold text-[#001c3d] uppercase tracking-wide flex items-center gap-2">
                                <i class="fas fa-check-double text-emerald-500"></i> Itens Inclusos no Passeio
                            </h3>
                            <p class="text-xs text-gray-400 mt-0.5">Liste tudo que está incluso no preço do passeio Bate e Volta.</p>
                        </div>
                        <button type="button" onclick="bvAddIncludeRow()" class="bg-[#001c3d] hover:bg-[#001126] text-white px-4 py-2.5 rounded-xl text-xs font-bold transition-all duration-200 shadow-md inline-flex items-center gap-2 self-start sm:self-auto">
                            <i class="fas fa-plus bg-white/20 p-1 rounded-lg text-[10px]"></i> Adicionar Item
                        </button>
                    </div>

                    <div id="bv-includes-container" class="space-y-3">
                        @if(isset($destination) && $destination->includes->where('type', 'included')->count() > 0)
                            @foreach($destination->includes->where('type', 'included') as $index => $include)
                                <div class="flex gap-3 items-center include-row bg-white p-3 rounded-xl border border-slate-100 shadow-sm">
                                    <div class="flex items-center justify-center w-7 h-7 rounded-full bg-emerald-50 shrink-0">
                                        <i class="fas fa-check text-emerald-500 text-xs"></i>
                                    </div>
                                    <input type="hidden" name="includes[{{ $index }}][type]" value="included">
                                    <input type="hidden" name="includes[{{ $index }}][order]" value="{{ $include->order ?? ($index + 1) }}">
                                    <input type="text" name="includes[{{ $index }}][text]" value="{{ $include->text }}"
                                        placeholder="Ex: Transporte climatizado"
                                        class="flex-1 bg-slate-50/50 focus:bg-white border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 px-4 py-2.5 rounded-xl text-xs font-medium focus:outline-none transition-all" required>
                                    <button type="button" onclick="bvRemoveRow(this)" class="p-2.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-xl transition-all">
                                        <i class="fas fa-trash-alt text-sm"></i>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div id="bv-includes-empty" class="flex flex-col items-center justify-center py-10 text-center bg-emerald-50/30 rounded-2xl border border-dashed border-emerald-200">
                                <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center mb-3">
                                    <i class="fas fa-check-double text-emerald-500 text-sm"></i>
                                </div>
                                <p class="text-xs text-gray-500 font-semibold">Nenhum item incluso cadastrado.</p>
                                <p class="text-[10px] text-gray-400 mt-0.5">Clique em "Adicionar Item" para incluir.</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>{{-- END TAB INCLUDES --}}

            {{-- ===================== TAB: REGRAS E ALERTAS ===================== --}}
            <div id="bv-tab-rules" class="bv-tab-content space-y-6 hidden">

                <div class="grid grid-cols-1 gap-6">

                    {{-- Política para Crianças --}}
                    <div class="bg-blue-50/60 border border-blue-100 rounded-2xl p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                                <i class="fas fa-child text-blue-600 text-sm"></i>
                            </div>
                            <label for="bv_obs_children" class="text-xs font-bold text-blue-800 uppercase tracking-wider">
                                Política para Crianças
                            </label>
                        </div>
                        <textarea name="observations[0][text]" id="bv_obs_children" rows="2"
                            class="w-full px-4 py-3 rounded-xl border border-blue-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 focus:outline-none text-sm transition duration-200 bg-white resize-none"
                            placeholder="Ex: Crianças até 5 anos não pagam (indo no colo dos responsáveis). De 6 a 11 anos: meia entrada.">{{ old('observations.0.text', isset($destination) && $destination->observations->count() > 0 ? $destination->observations->get(0)?->text : '') }}</textarea>
                        <input type="hidden" name="observations[0][order]" value="1">
                        @if(isset($destination) && $destination->observations->count() > 0)
                            <input type="hidden" name="observations[0][id]" value="{{ $destination->observations->get(0)?->id }}">
                        @endif
                    </div>

                    {{-- Informações de Pagamento --}}
                    <div class="bg-yellow-50/60 border border-yellow-100 rounded-2xl p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center shrink-0">
                                <i class="fas fa-credit-card text-yellow-600 text-sm"></i>
                            </div>
                            <label for="bv_obs_payment" class="text-xs font-bold text-yellow-800 uppercase tracking-wider">
                                Informações de Pagamento
                            </label>
                        </div>
                        <textarea name="observations[1][text]" id="bv_obs_payment" rows="2"
                            class="w-full px-4 py-3 rounded-xl border border-yellow-200 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/10 focus:outline-none text-sm transition duration-200 bg-white resize-none"
                            placeholder="Ex: Aceitamos todas as formas de pagamento: PIX, cartão de crédito/débito e dinheiro.">{{ old('observations.1.text', isset($destination) && $destination->observations->count() > 1 ? $destination->observations->get(1)?->text : '') }}</textarea>
                        <input type="hidden" name="observations[1][order]" value="2">
                        @if(isset($destination) && $destination->observations->count() > 1)
                            <input type="hidden" name="observations[1][id]" value="{{ $destination->observations->get(1)?->id }}">
                        @endif
                    </div>

                    {{-- Texto de Urgência / Escassez --}}
                    <div class="bg-red-50/60 border border-red-100 rounded-2xl p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center shrink-0">
                                <i class="fas fa-fire text-red-600 text-sm"></i>
                            </div>
                            <label for="bv_obs_urgency" class="text-xs font-bold text-red-800 uppercase tracking-wider">
                                Texto de Urgência / Escassez
                            </label>
                        </div>
                        <textarea name="observations[2][text]" id="bv_obs_urgency" rows="2"
                            class="w-full px-4 py-3 rounded-xl border border-red-200 focus:border-red-500 focus:ring-2 focus:ring-red-500/10 focus:outline-none text-sm transition duration-200 bg-white resize-none"
                            placeholder="Ex: ⚠️ Vagas limitadas — garanta já a sua! As reservas encerram quando esgotadas.">{{ old('observations.2.text', isset($destination) && $destination->observations->count() > 2 ? $destination->observations->get(2)?->text : '') }}</textarea>
                        <input type="hidden" name="observations[2][order]" value="3">
                        @if(isset($destination) && $destination->observations->count() > 2)
                            <input type="hidden" name="observations[2][id]" value="{{ $destination->observations->get(2)?->id }}">
                        @endif
                    </div>

                </div>

            </div>{{-- END TAB RULES --}}

            {{-- Botões de Ação --}}
            <div class="flex items-center justify-end gap-3 pt-6 mt-6 border-t border-gray-100">
                <a href="{{ route('admin.bate-volta.index') }}" class="border border-gray-200 hover:bg-gray-50 text-gray-500 px-6 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all duration-200">
                    Cancelar
                </a>
                <button type="submit" class="bg-[#109e4a] hover:bg-[#0d8c40] text-white px-8 py-3.5 rounded-xl font-extrabold text-xs uppercase tracking-wider transition-all duration-200 shadow-lg shadow-emerald-500/10">
                    <i class="fas fa-save mr-2"></i>
                    @if(isset($edit) && $edit) Salvar Alterações @else Criar Passeio @endif
                </button>
            </div>

        </form>
    </div>

    <script>
        // ========== SISTEMA DE ABAS (BV - Bate e Volta) ==========
        function switchTabBV(evt, tabName) {
            document.querySelectorAll('.bv-tab-content').forEach(content => content.classList.add('hidden'));
            document.querySelectorAll('.bv-tab-btn').forEach(btn => {
                btn.classList.remove('bv-active', 'bg-white', 'text-[#001c3d]', 'shadow-[0_-2px_10px_rgba(0,0,0,0.03)]', 'border-gray-100', 'border-b-white');
                btn.classList.add('text-gray-400', 'border-transparent');
            });

            document.getElementById('bv-tab-' + tabName).classList.remove('hidden');
            if (evt && evt.currentTarget) {
                evt.currentTarget.classList.add('bv-active', 'bg-white', 'text-[#001c3d]', 'shadow-[0_-2px_10px_rgba(0,0,0,0.03)]', 'border-gray-100', 'border-b-white');
                evt.currentTarget.classList.remove('text-gray-400', 'border-transparent');
            }
        }

        function bvRemoveRow(btn) {
            const row = btn.closest('.include-row, .observation-row');
            if (row) row.remove();
            const empty = document.getElementById('bv-includes-empty');
            if (empty && document.querySelectorAll('#bv-includes-container .include-row').length === 0) {
                empty.classList.remove('hidden');
            }
        }

        function bvPreviewFile(input, previewId) {
            const preview = document.getElementById(previewId);
            const container = document.getElementById(previewId + '-container');
            const file = input.files[0];
            const reader = new FileReader();
            reader.addEventListener('load', function () {
                preview.src = reader.result;
                container.classList.remove('hidden');
            }, false);
            if (file) reader.readAsDataURL(file);
        }

        function bvAddIncludeRow() {
            const container = document.getElementById('bv-includes-container');
            const empty = document.getElementById('bv-includes-empty');
            if (empty) empty.classList.add('hidden');

            const index = container.querySelectorAll('.include-row').length;
            const html = `
                <div class="flex gap-3 items-center include-row bg-white p-3 rounded-xl border border-slate-100 shadow-sm">
                    <div class="flex items-center justify-center w-7 h-7 rounded-full bg-emerald-50 shrink-0">
                        <i class="fas fa-check text-emerald-500 text-xs"></i>
                    </div>
                    <input type="hidden" name="includes[${index}][type]" value="included">
                    <input type="hidden" name="includes[${index}][order]" value="${index + 1}">
                    <input type="text" name="includes[${index}][text]" placeholder="Ex: Transporte climatizado com ar-condicionado" required
                        class="flex-1 bg-slate-50/50 focus:bg-white border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 px-4 py-2.5 rounded-xl text-xs font-medium focus:outline-none transition-all">
                    <button type="button" onclick="bvRemoveRow(this)" class="p-2.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-xl transition-all">
                        <i class="fas fa-trash-alt text-sm"></i>
                    </button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        }

        // Validação: ao submeter, verificar aba com erro
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            if (!form) return;

            form.addEventListener('submit', function (e) {
                if (!form.checkValidity()) {
                    e.preventDefault();
                    const invalidField = form.querySelector(':invalid');
                    if (invalidField) {
                        const tabContent = invalidField.closest('.bv-tab-content');
                        if (tabContent) {
                            const tabId = tabContent.id.replace('bv-tab-', '');
                            const tabBtn = document.querySelector(`[onclick="switchTabBV(event, '${tabId}')"]`);
                            if (tabBtn) tabBtn.click();
                            setTimeout(() => { invalidField.focus(); invalidField.reportValidity(); }, 100);
                        }
                    }
                }
            });
        });
    </script>
