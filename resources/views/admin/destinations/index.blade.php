@extends('layouts.admin')

@section('page_title', 'Gerenciar Destinos')

@section('admin_content')
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <p class="text-sm text-gray-500">Cadastre e altere os pacotes de viagens exibidos no site.</p>
        <a href="{{ route('admin.destinations.create') }}" class="inline-flex items-center gap-2 bg-[#109e4a] hover:bg-[#0d9648] text-white px-5 py-3 rounded-lg font-bold text-xs uppercase tracking-wider transition duration-200 shadow-sm">
            <i class="fas fa-plus"></i>
            <span>Novo Destino</span>
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="font-bold text-gray-800">Lista de Pacotes / Destinos</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs font-bold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-4">Imagem</th>
                        <th class="px-6 py-4">Título</th>
                        <th class="px-6 py-4">Subtítulo / Roteiro</th>
                        <th class="px-6 py-4">Duração</th>
                        <th class="px-6 py-4">Tipo</th>
                        <th class="px-6 py-4">Preço</th>
                        <th class="px-6 py-4">Destaque</th>
                        <th class="px-6 py-4 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    @forelse($destinations as $dest)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4">
                                <img src="{{ asset('storage/' . $dest->image_path) }}" alt="{{ $dest->title }}" class="w-16 h-12 object-cover rounded-lg shadow-sm border border-gray-200">
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-[#002752]">{{ $dest->title }}</div>
                                @if($dest->tag)
                                    <span class="inline-block bg-[#f2bd11] text-[#002752] text-[9px] font-black uppercase px-1.5 py-0.5 rounded mt-1">
                                        {{ $dest->tag }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-500 max-w-xs truncate">
                                {{ $dest->subtitle ?: '-' }}
                            </td>
                            <td class="px-6 py-4 text-xs font-semibold text-gray-500">
                                {{ $dest->duration }}
                            </td>
                            <td class="px-6 py-4 text-xs font-bold text-gray-600 uppercase">
                                @if($dest->type == 'pacote-principal')
                                    Pacote Principal
                                @elseif($dest->type == 'bate-e-volta')
                                    Bate e Volta
                                @elseif($dest->type == 'viagem-grupo')
                                    Viagem em Grupo
                                @else
                                    -
                                @endif
                             </td>
                            <td class="px-6 py-4 font-bold text-[#109e4a]">
                                R$ {{ number_format($dest->price, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                @if($dest->is_featured)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded bg-green-50 text-[10px] font-bold text-[#109e4a]">
                                        Sim
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded bg-gray-100 text-[10px] font-bold text-gray-400">
                                        Não
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.destinations.edit', $dest->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition duration-200" title="Editar">
                                        <i class="fas fa-edit text-xs"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.destinations.destroy', $dest->id) }}" method="POST" onsubmit="return confirm('Deseja realmente excluir este destino?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition duration-200" title="Excluir">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                                Nenhum destino cadastrado no momento.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
