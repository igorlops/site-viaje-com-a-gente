@extends('layouts.admin')

@section('page_title', 'Novo Depoimento')

@section('admin_content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-lg font-extrabold text-gray-900">Novo Depoimento</h2>
            <p class="text-xs text-gray-500 mt-0.5">Preencha as informações do depoimento.</p>
        </div>
        <a href="{{ route('admin.testimonials.index') }}"
           class="inline-flex items-center gap-2 border border-gray-300 hover:bg-gray-50 text-gray-600 font-bold text-xs uppercase px-4 py-2.5 rounded-xl transition duration-200">
            <i class="fas fa-arrow-left text-[10px]"></i>
            <span>Voltar</span>
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 p-6">
        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            @include('admin.testimonials._form')

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.testimonials.index') }}"
                   class="inline-flex items-center gap-2 border border-gray-300 hover:bg-gray-50 text-gray-600 font-bold text-xs uppercase px-5 py-2.5 rounded-xl transition duration-200">
                    Cancelar
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-2 bg-[#109e4a] hover:bg-[#0b803a] text-white font-bold text-xs uppercase px-6 py-2.5 rounded-xl transition duration-200 shadow-sm">
                    <i class="fas fa-save"></i>
                    Salvar Depoimento
                </button>
            </div>
        </form>
    </div>
@endsection
