@extends('layouts.admin')

@section('page_title', 'Gerenciar CTA Sessions')

@section('admin_content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <div>
                <h2 class="font-bold text-gray-800 text-base">Lista de CTA Sessions</h2>
                <p class="text-xs text-gray-500 mt-0.5">Gerencie as seções de chamada para ação de cada página do site.</p>
            </div>
            <a href="{{ route('admin.cta_session.create') }}" class="inline-flex items-center gap-2 bg-[#109e4a] hover:bg-[#0d9648] text-white px-5 py-2.5 rounded-lg font-bold text-xs uppercase tracking-wider transition duration-200 shadow-sm">
                <i class="fas fa-plus"></i>
                <span>Nova CTA Session</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs font-bold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-4">#</th>
                        <th class="px-6 py-4">Título</th>
                        <th class="px-6 py-4">Página</th>
                        <th class="px-6 py-4">Botão Principal</th>
                        <th class="px-6 py-4">Alinhamento</th>
                        <th class="px-6 py-4">Ordem</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    @forelse($cta_sessions as $cta)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 text-gray-400 text-xs font-mono">{{ $cta->id }}</td>
                            <td class="px-6 py-4 max-w-xs">
                                <p class="font-semibold text-[#002752] truncate">{{ $cta->title ?: '(Sem título)' }}</p>
                                @if($cta->subtitle)
                                    <p class="text-gray-400 text-xs truncate mt-0.5">{{ Str::limit($cta->subtitle, 60) }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-500">
                                @if($cta->page)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700">
                                        <i class="fas fa-file-lines text-[9px]"></i>
                                        {{ $cta->page->name }}
                                    </span>
                                @else
                                    <span class="text-gray-300">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-xs">
                                @if($cta->button_label)
                                    <span class="font-medium text-gray-700">{{ $cta->button_label }}</span>
                                    @if($cta->button_url)
                                        <br><span class="text-gray-400 truncate max-w-[120px] inline-block">{{ $cta->button_url }}</span>
                                    @endif
                                @else
                                    <span class="text-gray-300">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-xs capitalize">
                                {{ $cta->alignment ?? 'center' }}
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-xs text-center">
                                {{ $cta->order_position ?? 0 }}
                            </td>
                            <td class="px-6 py-4">
                                @if($cta->active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-50 text-[#109e4a]">
                                        <i class="fas fa-circle text-[7px] mr-1"></i> Ativo
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 text-gray-400">
                                        <i class="fas fa-circle text-[7px] mr-1"></i> Inativo
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.cta_session.edit', $cta->id) }}" 
                                       class="inline-flex items-center gap-1.5 bg-[#002752] hover:bg-[#f3a908] hover:text-[#00152b] text-white px-3.5 py-2 rounded-lg font-bold text-xs transition duration-200">
                                        <i class="fas fa-edit"></i>
                                        <span>Editar</span>
                                    </a>
                                    <form action="{{ route('admin.cta_session.duplicate', $cta->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center gap-1.5 bg-gray-100 hover:bg-[#f3a908] hover:text-[#00152b] text-gray-600 px-3.5 py-2 rounded-lg font-bold text-xs transition duration-200" title="Duplicar CTA">
                                            <i class="fas fa-copy"></i>
                                            <span>Copiar</span>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.cta_session.destroy', $cta->id) }}" method="POST" 
                                          onsubmit="return confirm('Tem certeza que deseja excluir esta CTA Session?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1.5 bg-red-50 hover:bg-red-600 text-red-600 hover:text-white px-3.5 py-2 rounded-lg font-bold text-xs transition duration-200" title="Deletar CTA">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-gray-400">
                                    <i class="fas fa-bullhorn text-4xl opacity-30"></i>
                                    <p class="font-semibold text-sm">Nenhuma CTA Session cadastrada.</p>
                                    <a href="{{ route('admin.cta_session.create') }}" class="mt-1 inline-flex items-center gap-1.5 text-[#109e4a] hover:underline text-xs font-bold">
                                        <i class="fas fa-plus"></i> Criar a primeira CTA Session
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
