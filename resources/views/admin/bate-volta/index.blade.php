@extends('layouts.admin')

@section('page_title', 'Passeios – Bate e Volta')

@section('admin_content')
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <p class="text-sm text-gray-500">Gerencie os passeios de 1 dia da modalidade Bate e Volta.</p>
        </div>
        <a href="{{ route('admin.bate-volta.create') }}" class="inline-flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-5 py-3 rounded-lg font-bold text-xs uppercase tracking-wider transition duration-200 shadow-sm">
            <i class="fas fa-plus"></i>
            <span>Novo Passeio Bate e Volta</span>
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-center gap-3 text-sm font-medium">
            <i class="fas fa-check-circle text-emerald-500"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center">
                <i class="fas fa-sun text-orange-500 text-sm"></i>
            </div>
            <h2 class="font-bold text-gray-800">Lista de Passeios Bate e Volta</h2>
            <span class="ml-auto bg-orange-100 text-orange-700 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">
                {{ $destinations->count() }} passeio(s)
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs font-bold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-4">Imagem</th>
                        <th class="px-6 py-4">Título / Data</th>
                        <th class="px-6 py-4">Saída → Retorno</th>
                        <th class="px-6 py-4">Local Embarque</th>
                        <th class="px-6 py-4">Preço</th>
                        <th class="px-6 py-4">Destaque</th>
                        <th class="px-6 py-4 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    @forelse($destinations as $dest)
                        <tr class="hover:bg-orange-50/30 transition duration-150">
                            <td class="px-6 py-4">
                                @if($dest->image_path)
                                    <img src="{{ asset('storage/' . $dest->image_path) }}" alt="{{ $dest->title }}" class="w-16 h-12 object-cover rounded-lg shadow-sm border border-gray-200">
                                @else
                                    <div class="w-16 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-sun text-orange-400"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-[#002752]">{{ $dest->title }}</div>
                                @if($dest->subtitle)
                                    <div class="text-xs text-gray-400 mt-0.5 max-w-xs truncate">{{ $dest->subtitle }}</div>
                                @endif
                                @if($dest->date_range)
                                    <span class="inline-block bg-orange-100 text-orange-700 text-[9px] font-bold px-1.5 py-0.5 rounded mt-1">
                                        <i class="fas fa-calendar-alt mr-0.5"></i> {{ $dest->date_range }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($dest->departure_date || $dest->return_date)
                                    <div class="flex flex-col gap-1 text-xs font-semibold">
                                        @if($dest->departure_date)
                                            <span class="text-green-600">
                                                <i class="fas fa-arrow-right text-[10px] mr-1"></i>{{ $dest->departure_date }}
                                            </span>
                                        @endif
                                        @if($dest->return_date)
                                            <span class="text-blue-600">
                                                <i class="fas fa-arrow-left text-[10px] mr-1"></i>{{ $dest->return_date }}
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-gray-400 text-xs">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-500 max-w-[180px] truncate">
                                {{ $dest->departure_city ?: '—' }}
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
                                    {{-- Ver no site --}}
                                    @if($dest->slug)
                                        <a href="{{ route('destination.show', $dest->slug) }}" target="_blank"
                                           class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-orange-50 text-orange-600 hover:bg-orange-600 hover:text-white transition duration-200" title="Ver no site">
                                            <i class="fas fa-eye text-xs"></i>
                                        </a>
                                    @endif

                                    {{-- Duplicar --}}
                                    <form action="{{ route('admin.bate-volta.duplicate', $dest->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-green-50 text-green-600 hover:bg-green-600 hover:text-white transition duration-200" title="Duplicar">
                                            <i class="fas fa-copy text-xs"></i>
                                        </button>
                                    </form>

                                    {{-- Editar --}}
                                    <a href="{{ route('admin.bate-volta.edit', $dest->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition duration-200" title="Editar">
                                        <i class="fas fa-edit text-xs"></i>
                                    </a>

                                    {{-- Excluir --}}
                                    <form action="{{ route('admin.bate-volta.destroy', $dest->id) }}" method="POST" onsubmit="return confirm('Deseja realmente excluir este passeio?')">
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
                            <td colspan="7" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-gray-400">
                                    <div class="w-14 h-14 rounded-full bg-orange-50 flex items-center justify-center">
                                        <i class="fas fa-sun text-orange-300 text-2xl"></i>
                                    </div>
                                    <p class="text-sm font-semibold">Nenhum passeio Bate e Volta cadastrado.</p>
                                    <a href="{{ route('admin.bate-volta.create') }}" class="inline-flex items-center gap-1.5 text-orange-500 hover:text-orange-600 text-xs font-bold transition-colors">
                                        <i class="fas fa-plus text-[10px]"></i> Criar o primeiro passeio
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
