@extends('layouts.admin')

@section('page_title', 'Dúvidas Frequentes')

@section('admin_content')
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <p class="text-sm text-gray-500">Gerencie as perguntas e respostas exibidas na página de Dúvidas Frequentes do site.</p>
        <a href="{{ route('admin.faqs.create') }}" class="inline-flex items-center gap-2 bg-[#109e4a] hover:bg-[#0d9648] text-white px-5 py-3 rounded-lg font-bold text-xs uppercase tracking-wider transition duration-200 shadow-sm">
            <i class="fas fa-plus"></i>
            <span>Nova Dúvida</span>
        </a>
    </div>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="mb-4 flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 text-sm font-medium px-4 py-3 rounded-xl">
            <i class="fas fa-check-circle text-green-500"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-[#002752]/10 flex items-center justify-center shrink-0">
                <i class="fas fa-question-circle text-[#002752] text-sm"></i>
            </div>
            <div>
                <h2 class="font-bold text-gray-800">Lista de Perguntas Frequentes</h2>
                <p class="text-xs text-gray-400 mt-0.5">{{ $faqs->count() }} {{ $faqs->count() === 1 ? 'pergunta cadastrada' : 'perguntas cadastradas' }}</p>
            </div>
        </div>

        @if($faqs->isEmpty())
            <div class="flex flex-col items-center justify-center py-16 text-center">
                <div class="w-14 h-14 rounded-full bg-slate-100 flex items-center justify-center mb-4">
                    <i class="fas fa-question-circle text-slate-400 text-xl"></i>
                </div>
                <p class="text-sm font-semibold text-gray-500">Nenhuma dúvida cadastrada ainda.</p>
                <p class="text-xs text-gray-400 mt-1">Clique em "Nova Dúvida" para adicionar a primeira.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-xs font-bold text-gray-500 uppercase tracking-wider">
                            <th class="px-6 py-4 w-16">Ordem</th>
                            <th class="px-6 py-4">Pergunta</th>
                            <th class="px-6 py-4">Resposta (prévia)</th>
                            <th class="px-6 py-4 text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @foreach($faqs as $faq)
                            <tr class="hover:bg-slate-50 transition duration-150">
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#002752]/10 text-[#002752] text-xs font-extrabold">
                                        {{ $faq->order }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 max-w-xs">
                                    <p class="font-semibold text-gray-800 leading-snug">{{ $faq->question }}</p>
                                </td>
                                <td class="px-6 py-4 text-gray-400 max-w-sm">
                                    <p class="text-xs leading-relaxed line-clamp-2">{{ $faq->answer }}</p>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.faqs.edit', $faq->id) }}"
                                           class="inline-flex items-center gap-1.5 border border-gray-200 hover:border-[#002752] hover:text-[#002752] text-gray-500 px-3 py-2 rounded-lg text-[11px] font-bold uppercase tracking-wider transition-all duration-200 bg-white">
                                            <i class="fas fa-pencil text-xs"></i>
                                            Editar
                                        </a>

                                        <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST"
                                              onsubmit="return confirm('Tem certeza que deseja excluir a pergunta: \'{{ addslashes($faq->question) }}\'?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center gap-1.5 border border-red-200 hover:bg-red-500 hover:border-red-500 text-red-500 hover:text-white px-3 py-2 rounded-lg text-[11px] font-bold uppercase tracking-wider transition-all duration-200 bg-white">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                                Excluir
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
