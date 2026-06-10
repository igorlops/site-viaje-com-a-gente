@extends('layouts.admin')

@section('page_title', 'Gerenciar Redes Sociais')

@section('admin_content')
    @php
        $editing = request()->has('edit') ? \App\Models\SocialLink::find(request('edit')) : null;
    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Social Links List -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h2 class="font-bold text-gray-800">Redes Sociais Cadastradas</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-xs font-bold text-gray-500 uppercase tracking-wider">
                            <th class="px-6 py-4">Ícone / Rede</th>
                            <th class="px-6 py-4">URL</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm">
                        @forelse($socialLinks as $link)
                            <tr class="hover:bg-gray-50 transition duration-150 {{ $editing && $editing->id === $link->id ? 'bg-blue-50/50' : '' }}">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-[#002752] text-white flex items-center justify-center">
                                            <i class="{{ $link->icon }} text-base"></i>
                                        </div>
                                        <span class="font-bold text-[#002752]">{{ $link->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-500 max-w-xs truncate font-medium">
                                    <a href="{{ $link->url }}" target="_blank" class="hover:underline hover:text-[#002752]">
                                        {{ $link->url }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    @if($link->active)
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
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.social.index', ['edit' => $link->id]) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition duration-200" title="Editar">
                                            <i class="fas fa-edit text-xs"></i>
                                        </a>
                                        
                                        <form action="{{ route('admin.social.destroy', $link->id) }}" method="POST" onsubmit="return confirm('Deseja realmente excluir este link?')">
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
                                <td colspan="4" class="px-6 py-12 text-center text-gray-400 font-medium">
                                    Nenhuma rede social configurada.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add / Edit Form -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden h-fit">
            <div class="p-6 border-b border-gray-200 bg-gray-50/50">
                <h2 class="font-bold text-gray-800 text-base">
                    {{ $editing ? 'Editar Rede Social' : 'Adicionar Rede Social' }}
                </h2>
            </div>
            
            <form action="{{ $editing ? route('admin.social.update', $editing->id) : route('admin.social.store') }}" method="POST" class="p-6 space-y-5">
                @csrf
                @if($editing)
                    @method('PUT')
                @endif
                
                <!-- Name -->
                <div>
                    <label for="name" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nome da Rede</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $editing ? $editing->name : '') }}" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                        placeholder="Ex: Instagram, Facebook, TikTok">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- URL -->
                <div>
                    <label for="url" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Endereço (URL)</label>
                    <input type="url" name="url" id="url" value="{{ old('url', $editing ? $editing->url : '') }}" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                        placeholder="Ex: https://instagram.com/seuusuario">
                    @error('url')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Icon Class -->
                <div>
                    <label for="icon" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Ícone (Classe FontAwesome)</label>
                    <input type="text" name="icon" id="icon" value="{{ old('icon', $editing ? $editing->icon : '') }}" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                        placeholder="Ex: fab fa-instagram, fab fa-facebook-f, fab fa-tiktok">
                    <div class="mt-2 p-3 bg-blue-50/50 rounded-lg text-xs text-blue-800 space-y-1">
                        <p class="font-bold">Ícones comuns:</p>
                        <p>• Instagram: <code class="font-mono bg-blue-100/60 px-1 py-0.5 rounded">fab fa-instagram</code></p>
                        <p>• Facebook: <code class="font-mono bg-blue-100/60 px-1 py-0.5 rounded">fab fa-facebook-f</code></p>
                        <p>• TikTok: <code class="font-mono bg-blue-100/60 px-1 py-0.5 rounded">fab fa-tiktok</code></p>
                        <p>• WhatsApp: <code class="font-mono bg-blue-100/60 px-1 py-0.5 rounded">fab fa-whatsapp</code></p>
                    </div>
                    @error('icon')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Active -->
                <div>
                    <label class="flex items-center gap-2.5 cursor-pointer select-none">
                        <input type="checkbox" name="active" value="1" {{ old('active', $editing ? $editing->active : true) ? 'checked' : '' }}
                            class="w-4 h-4 rounded text-[#002752] focus:ring-[#002752] border-gray-300">
                        <span class="text-sm font-bold text-gray-700 uppercase tracking-wide">Link Ativo</span>
                    </label>
                </div>

                <!-- Buttons -->
                <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                    <button type="submit" class="bg-[#109e4a] hover:bg-[#0d9648] text-white px-6 py-3 rounded-lg font-bold text-xs uppercase tracking-wider transition duration-200 shadow-sm flex-grow">
                        {{ $editing ? 'Atualizar Link' : 'Adicionar Link' }}
                    </button>
                    @if($editing)
                        <a href="{{ route('admin.social.index') }}" class="border border-gray-300 hover:bg-gray-50 text-gray-600 px-4 py-3 rounded-lg font-bold text-xs uppercase tracking-wider transition duration-200">
                            Cancelar
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
