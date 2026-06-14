@extends('layouts.admin')

@section('page_title', 'Editar Página')

@section('admin_content')
    <div class="max-w-3xl bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="font-bold text-gray-800 text-base">Formulário de Edição</h2>
        </div>

        <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label for="name" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nome da Página</label>
                <input type="text" name="name" id="name" value="{{ old('name', $page->name) }}"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                    placeholder="Sua próxima viagem está mais perto do que você imagina!">
                @error('name')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- slug -->
            <div>
                <label for="slug" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Slug da Página</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $page->slug) }}"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                    placeholder="Slug da página">
                @error('slug')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>
            <!-- Meta Title -->
            <div>
                <label for="meta_title" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Meta Title</label>
                <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $page->meta_title) }}"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                    placeholder="Meta title">
                @error('meta_title')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>
            <!-- Meta Description -->
            <div>
                <label for="meta_description" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Meta Description</label>
                <input type="text" name="meta_description" id="meta_description" value="{{ old('meta_description', $page->meta_description) }}"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                    placeholder="Meta description">
                @error('meta_description')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>
            <!-- Meta Keywords -->
            <div>
                <label for="meta_keywords" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Meta Keywords</label>
                <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $page->meta_keywords) }}"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                    placeholder="Meta keywords">
                @error('meta_keywords')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="bg-[#109e4a] hover:bg-[#0d9648] text-white px-6 py-3 rounded-lg font-bold text-xs uppercase tracking-wider transition duration-200 shadow-sm">
                    Salvar Alterações
                </button>
                <a href="{{ route('admin.pages.index') }}" class="border border-gray-300 hover:bg-gray-50 text-gray-600 px-6 py-3 rounded-lg font-bold text-xs uppercase tracking-wider transition duration-200">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection
