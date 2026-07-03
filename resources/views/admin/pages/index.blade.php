@extends('layouts.admin')

@section('page_title', 'Gerenciar Páginas')

@section('admin_content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h2 class="font-bold text-gray-800">Lista de Páginas</h2>
            <a href="{{ route('admin.pages.create') }}" class="inline-flex items-center gap-2 bg-[#109e4a] hover:bg-[#0d9648] text-white px-5 py-2.5 rounded-lg font-bold text-xs uppercase tracking-wider transition duration-200 shadow-sm">
                <i class="fas fa-plus"></i>
                <span>Nova Página</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs font-bold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-4">Nome</th>
                        <th class="px-6 py-4">Slug</th> 
                        <th class="px-6 py-4 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    @forelse($pages as $page)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 font-semibold text-[#002752] max-w-xs truncate">
                                {{ $page->name ?: '(Sem título)' }}
                            </td>
                            <td class="px-6 py-4 text-gray-500 max-w-sm truncate">
                                {{ $page->slug ?: '(Sem slug)' }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.pages.edit', $page->id) }}" class="inline-flex items-center gap-1 bg-[#002752] hover:bg-[#f3a908] hover:text-[#00152b] text-white px-3.5 py-2 rounded-lg font-bold text-xs transition duration-200">
                                    <i class="fas fa-edit"></i>
                                    <span>Editar</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                Nenhum banner cadastrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
