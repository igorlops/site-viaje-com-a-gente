@extends('layouts.admin')

@section('page_title', 'Gerenciar Banner Principal')

@section('admin_content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h2 class="font-bold text-gray-800">Lista de Banners</h2>
            <a href="{{ route('admin.banners.create') }}" class="inline-flex items-center gap-2 bg-[#109e4a] hover:bg-[#0d9648] text-white px-5 py-2.5 rounded-lg font-bold text-xs uppercase tracking-wider transition duration-200 shadow-sm">
                <i class="fas fa-plus"></i>
                <span>Nova Banner</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs font-bold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-4">Imagem</th>
                        <th class="px-6 py-4">Título</th> 
                        <th class="px-6 py-4">Página</th>
                        <th class="px-6 py-4">Subtítulo</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    @forelse($banners as $banner)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4">
                                <img src="{{ asset('storage/' . $banner->image_path) }}" alt="Banner" class="w-24 h-14 object-cover rounded-lg shadow-sm border border-gray-200">
                            </td>
                            <td class="px-6 py-4 font-semibold text-[#002752] max-w-xs truncate">
                                {{ $banner->title ?: '(Sem título)' }}
                            </td>
                            <td class="px-6 py-4 text-gray-500 max-w-sm truncate">
                                {{ $banner?->page?->name ?: '(Sem página)' }}
                            </td>
                            <td class="px-6 py-4 text-gray-500 max-w-sm truncate">
                                {{ $banner->subtitle ?: '(Sem subtítulo)' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($banner->active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-50 text-[#109e4a]">
                                        Ativo
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 text-gray-400">
                                        Inativo
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.banners.edit', $banner->id) }}" class="inline-flex items-center gap-1 bg-[#002752] hover:bg-[#f2bd11] hover:text-[#00152b] text-white px-3.5 py-2 rounded-lg font-bold text-xs transition duration-200">
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
