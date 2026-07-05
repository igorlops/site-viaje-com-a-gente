@extends('layouts.admin')

@section('page_title', 'Editar Dúvida Frequente')

@section('admin_content')
    <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-slate-50 to-white flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-gray-900 text-lg tracking-tight">Editar Dúvida Frequente</h2>
                <p class="text-xs text-gray-500 mt-1">Atualize a pergunta e resposta exibidas no site.</p>
            </div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-bold tracking-widest uppercase bg-[#f3a908]/10 text-[#a37f00] border border-[#f3a908]/20">
                <i class="fas fa-edit"></i> Editando Registro
            </span>
        </div>

        <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            {{-- Question --}}
            <div>
                <label for="question" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                    Pergunta <span class="text-red-500">*</span>
                </label>
                <input type="text" name="question" id="question" value="{{ old('question', $faq->question) }}" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                    placeholder="Ex: Como funciona o parcelamento no boleto?">
                @error('question')
                    <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- Answer --}}
            <div>
                <label for="answer" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                    Resposta <span class="text-red-500">*</span>
                </label>
                <textarea name="answer" id="answer" rows="6" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white resize-none"
                    placeholder="Digite aqui a resposta completa para a pergunta acima...">{{ old('answer', $faq->answer) }}</textarea>
                @error('answer')
                    <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- Order --}}
            <div class="max-w-xs">
                <label for="order" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                    Ordem de Exibição
                </label>
                <input type="number" name="order" id="order" value="{{ old('order', $faq->order) }}" min="0"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#001c3d] focus:ring-2 focus:ring-[#001c3d]/10 focus:outline-none text-sm transition duration-200 bg-gray-50/50 hover:bg-gray-50 focus:bg-white"
                    placeholder="0">
                <p class="text-[10px] text-gray-400 mt-1.5 font-medium">Número menor aparece primeiro na listagem.</p>
                @error('order')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>



            {{-- Form Actions --}}
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.faqs.index') }}"
                   class="border border-gray-200 hover:bg-gray-50 text-gray-500 px-6 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all duration-200">
                    Cancelar
                </a>
                <button type="submit"
                    class="bg-[#109e4a] cursor-pointer hover:bg-[#0d8c40] text-white px-8 py-3.5 rounded-xl font-extrabold text-xs uppercase tracking-wider transition-all duration-200 shadow-lg shadow-emerald-500/10 flex items-center gap-2">
                    <i class="fas fa-save"></i>
                    Salvar Alterações
                </button>
            </div>
        </form>
                    {{-- Danger Zone --}}
        <div class="bg-red-50 border border-red-100 rounded-xl p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <p class="text-sm font-bold text-red-700">Excluir esta dúvida</p>
                <p class="text-xs text-red-500/80 mt-0.5">Esta ação é irreversível e removerá permanentemente a pergunta do site.</p>
            </div>
            <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST"
                    onsubmit="return confirm('Tem certeza que deseja excluir esta dúvida permanentemente?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="shrink-0 inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2.5 rounded-lg font-bold text-xs uppercase tracking-wider transition-all duration-200">
                    <i class="fas fa-trash-alt"></i>
                    Excluir Dúvida
                </button>
            </form>
        </div>
    </div>
@endsection
