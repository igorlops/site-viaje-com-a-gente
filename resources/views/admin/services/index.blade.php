@extends('layouts.admin')

@section('page_title', 'Gerenciar Serviços')

@section('admin_content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-lg font-bold text-[#002752]">Serviços Dinâmicos</h2>
            <p class="text-xs text-gray-500 mt-0.5">Gerencie os serviços exibidos no site</p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="inline-flex items-center gap-2 bg-[#109e4a] hover:bg-[#0d9648] text-white px-5 py-2.5 rounded-lg font-bold text-xs uppercase tracking-wider transition duration-200 shadow-sm">
            <i class="fas fa-plus"></i>
            <span>Novo Serviço</span>
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        @if($services->isEmpty())
            <div class="text-center py-20">
                <i class="fas fa-concierge-bell text-5xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 font-semibold text-sm">Nenhum serviço cadastrado ainda.</p>
                <p class="text-gray-400 text-xs mt-1">Clique em "Novo Serviço" para começar.</p>
                <a href="{{ route('admin.services.create') }}" class="mt-5 inline-flex items-center gap-2 bg-[#002752] hover:bg-[#003a66] text-white px-6 py-2.5 rounded-lg font-bold text-xs uppercase tracking-wider transition duration-200">
                    <i class="fas fa-plus"></i> Cadastrar Primeiro Serviço
                </a>
            </div>
        @else
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Serviço</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider hidden md:table-cell">Slug</th>
                        <th class="text-center px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider hidden lg:table-cell">Menu</th>
                        <th class="text-center px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="text-right px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($services as $service)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($service->image_path)
                                        <img src="{{ asset('storage/' . $service->image_path) }}" alt="{{ $service->title }}"
                                             class="w-10 h-10 rounded-lg object-cover border border-gray-200 flex-shrink-0">
                                    @else
                                        <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-concierge-bell text-gray-400"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-bold text-gray-800 text-sm">{{ $service->title }}</p>
                                        @if($service->subtitle)
                                            <p class="text-xs text-gray-500 truncate max-w-xs">{{ $service->subtitle }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 hidden md:table-cell">
                                <code class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">/servicos/{{ $service->slug }}</code>
                            </td>
                            <td class="px-6 py-4 text-center hidden lg:table-cell">
                                @if($service->show_in_menu)
                                    <span class="inline-flex items-center gap-1 text-xs font-bold text-[#109e4a]">
                                        <i class="fas fa-check-circle"></i> Sim
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-xs text-gray-400">
                                        <i class="fas fa-minus-circle"></i> Não
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($service->status === 'published')
                                    <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-full">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Publicado
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-700 text-xs font-bold px-3 py-1.5 rounded-full">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        Rascunho
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    @if($service->status === 'published')
                                        <a href="{{ route('service.show', $service->slug) }}" target="_blank"
                                           class="p-2 text-gray-400 hover:text-[#002752] hover:bg-gray-100 rounded-lg transition duration-200" title="Ver no site">
                                             <i class="fas fa-external-link-alt text-xs"></i>
                                         </a>
                                    @endif
                                    
                                    <form action="{{ route('admin.services.duplicate', $service) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center justify-center p-2 rounded-lg bg-green-50 text-green-600 hover:bg-green-600 hover:text-white transition duration-200" title="Duplicar">
                                            <i class="fas fa-copy text-xs"></i>
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.services.edit', $service) }}"
                                       class="inline-flex items-center gap-1.5 bg-[#002752] hover:bg-[#003a66] text-white px-3 py-2 rounded-lg font-bold text-xs transition duration-200">
                                         <i class="fas fa-pen text-xs"></i>
                                         <span class="hidden sm:inline">Editar</span>
                                     </a>
                                     <form action="{{ route('admin.services.destroy', $service) }}" method="POST"
                                           onsubmit="return confirm('Tem certeza que deseja excluir o serviço \'{{ $service->title }}\'?')">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit"
                                                 class="inline-flex items-center gap-1.5 bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 px-3 py-2 rounded-lg font-bold text-xs transition duration-200">
                                             <i class="fas fa-trash text-xs"></i>
                                             <span class="hidden sm:inline">Excluir</span>
                                         </button>
                                     </form>
                                 </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
