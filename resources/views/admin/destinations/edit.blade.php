@extends('layouts.admin')

@section('page_title', 'Editar Destino')

@section('admin_content')
    @include('admin.destinations._form', ['destination' => $destination, 'edit' => true])
    {{-- Javascript para abas e blocos dinâmicos --}}
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        // Se houver algum campo inválido (required em branco, email mal formatado, etc)
        if (!form.checkValidity()) {
            // IMPEDE O ENVIO IMEDIATAMENTE
            e.preventDefault();
            e.stopPropagation();

            // Pega o PRIMEIRO campo com erro
            const invalidField = form.querySelector(':invalid');

            if (invalidField) {
                // Descobre o container da aba que guarda esse campo
                const tabContent = invalidField.closest('.tab-content');

                if (tabContent) {
                    const tabId = tabContent.id; // Exemplo: "tab-basic", "tab-details", etc.

                    // Procura o botão da aba correspondente usando o atributo aria-controls ou onclick
                    const tabButton = document.querySelector(`[aria-controls="${tabId}-tab"]`) 
                                   || document.querySelector(`[aria-controls="${tabId}"]`)
                                   || document.querySelector(`button[onclick*="'${tabId.replace('tab-', '')}'"]`);

                    // 1. Se encontrou o botão da aba, simula o clique nele para abrir a aba
                    if (tabButton) {
                        tabButton.click();
                    } else if (typeof switchTab === 'function') {
                        // Alternativa: chama a função switchTab diretamente
                        switchTab(null, tabId.replace('tab-', ''));
                    }

                    // 2. Espera a animação/troca de aba acontecer e dispara o alerta e foco
                    setTimeout(() => {
                        invalidField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        invalidField.focus();
                        invalidField.reportValidity(); // Mostra a mensagem nativa "Preencha este campo"
                    }, 200);
                } else {
                    // Se o campo não estiver dentro de abas, apenas foca nele
                    invalidField.focus();
                    invalidField.reportValidity();
                }
            }
        }
    });
});
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

        function addObservationRow() {
            const container = document.getElementById('observations-container');
            const emptyState = document.getElementById('observations-empty');
            if (emptyState) emptyState.remove();

            const index = container.querySelectorAll('.observation-row').length;
            const html = `
                <div class="observation-row flex gap-3 items-start bg-amber-50/40 border border-amber-100 rounded-xl p-3">
                    <input type="hidden" name="observations[${index}][order]" value="${index + 1}">
                    <div class="flex items-center justify-center shrink-0 w-7 h-7 rounded-full bg-amber-100 text-amber-600 mt-1">
                        <i class="fas fa-triangle-exclamation text-xs"></i>
                    </div>
                    <textarea name="observations[${index}][text]"
                              placeholder="Ex: O passeio pode ser cancelado em caso de mau tempo."
                              rows="2" required
                              class="flex-1 border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none rounded-xl px-3 py-2.5 text-sm text-gray-700 placeholder-gray-400 resize-none transition duration-200 bg-white"></textarea>
                    <button type="button" onclick="removeRow(this)"
                            class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors mt-1">
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
                                class="w-full text-xs text-gray-500 border border-slate-200 rounded-lg p-1.5 focus:outline-none bg-white">
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