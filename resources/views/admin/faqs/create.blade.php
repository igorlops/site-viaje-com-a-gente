@extends('layouts.admin')

@section('page_title', 'Nova Dúvida Frequente')

@section('admin_content')
    <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-slate-50 to-white flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-gray-900 text-lg tracking-tight">Cadastrar Nova Dúvida Frequente</h2>
                <p class="text-xs text-gray-500 mt-1">Adicione uma pergunta e a resposta que serão exibidas na página de FAQ.</p>
            </div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-bold tracking-widest uppercase bg-[#001c3d]/5 text-[#001c3d] border border-[#001c3d]/10">
                <i class="fas fa-plus-circle"></i> Novo Registro
            </span>
        </div>

        <form action="{{ route('admin.faqs.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            {{-- Question --}}
            <div>
                <label for="question" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                    Pergunta <span class="text-red-500">*</span>
                </label>
                <input type="text" name="question" id="question" value="{{ old('question') }}" required
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
                    placeholder="Digite aqui a resposta completa para a pergunta acima...">{{ old('answer') }}</textarea>
                @error('answer')
                    <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- Order --}}
            <div class="max-w-xs">
                <label for="order" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                    Ordem de Exibição
                </label>
                <input type="number" name="order" id="order" value="{{ old('order', 0) }}" min="0"
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
                    class="bg-[#109e4a] hover:bg-[#0d8c40] text-white px-8 py-3.5 rounded-xl font-extrabold text-xs uppercase tracking-wider transition-all duration-200 shadow-lg shadow-emerald-500/10 flex items-center gap-2">
                    <i class="fas fa-save"></i>
                    Cadastrar Dúvida
                </button>
            </div>
        </form>
    </div>
@endsection
