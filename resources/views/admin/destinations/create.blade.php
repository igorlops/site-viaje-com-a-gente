@extends('layouts.admin')

@section('page_title', 'Criar Novo Destino')

@section('admin_content')
    @include('admin.destinations._form',['destination' => null, 'edit' => false])

    {{-- Javascript para abas e blocos dinâmicos --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');

    if (!form) return;

    form.addEventListener('submit', function (e) {
        // Verifica se o formulário é válido segundo os atributos required/type HTML5
        if (!form.checkValidity()) {
            // Cancela o envio padrão para tratarmos a aba correta
            e.preventDefault();

            // Encontra o PRIMEIRO campo com erro de validação
            const invalidField = form.querySelector(':invalid');

            if (invalidField) {
                // Encontra a aba (tab-content) onde este campo está guardado
                const tabContent = invalidField.closest('.tab-content');

                if (tabContent) {
                    // Extrai o ID da aba (ex: "tab-basic", "tab-details", etc)
                    const tabId = tabContent.id;

                    // Converte o ID da div para a chave usada na função switchTab
                    // Ex: "tab-details" -> "details" | "tab-includes-tab" -> "includes-tab"
                    let targetTabKey = tabId.replace('tab-', '');

                    // Se a sua função switchTab já existe no sistema, executamos ela:
                    if (typeof switchTab === 'function') {
                        switchTab(null, targetTabKey);
                    }

                    // Aguarda a transição/abertura da aba e foca no campo com erro
                    setTimeout(() => {
                        invalidField.focus();
                        
                        // Opcional: Dispara o balão de erro nativo do navegador
                        invalidField.reportValidity();
                    }, 100);
                }
            }
        }
    });
});
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
            const row = btn.closest('.include-row, .highlight-row, .itinerary-day-row, .activity-row, .testimonial-row');
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

        function addTestimonialRow() {
            const container = document.getElementById('testimonials-container');
            const index = container.querySelectorAll('.testimonial-row').length;
            const html = `
                <div class="p-5 border border-slate-100 rounded-xl bg-white testimonial-row space-y-4 shadow-sm relative animate-fade-in">
                    <input type="hidden" name="testimonials[${index}][order]" value="${index + 1}">
                    <div class="space-y-3">
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Nome do Autor</label>
                                <input type="text" name="testimonials[${index}][author_name]" placeholder="Ex: Maria Silva"
                                    class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none transition-colors bg-slate-50/30" required>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Função/Cargo (Opcional)</label>
                                <input type="text" name="testimonials[${index}][author_role]" placeholder="Ex: Cliente"
                                    class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none transition-colors bg-slate-50/30">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Avaliação</label>
                                <select name="testimonials[${index}][rating]" class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none bg-slate-50/30" required>
                                    <option value="5">5 Estrelas</option>
                                    <option value="4">4 Estrelas</option>
                                    <option value="3">3 Estrelas</option>
                                    <option value="2">2 Estrelas</option>
                                    <option value="1">1 Estrela</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Status</label>
                                <select name="testimonials[${index}][is_active]" class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none bg-slate-50/30" required>
                                    <option value="1">Ativo</option>
                                    <option value="0">Inativo</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Foto do Autor</label>
                            <input type="file" name="testimonials[${index}][author_photo]" accept="image/*"
                                class="w-full text-xs text-gray-500 border border-slate-200 rounded-lg p-1.5 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Depoimento</label>
                            <textarea name="testimonials[${index}][content]" rows="3" placeholder="Escreva o depoimento..."
                                class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:border-[#001c3d] text-xs focus:outline-none transition-colors bg-slate-50/30" required></textarea>
                        </div>
                    </div>
                    <button type="button" onclick="removeRow(this)" class="absolute top-2 right-2 p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                        <i class="fas fa-trash-alt text-sm"></i>
                    </button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        }
    </script>
@endsection
