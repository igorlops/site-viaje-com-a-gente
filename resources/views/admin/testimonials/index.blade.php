@extends('layouts.admin')

@section('page_title', 'Depoimentos')

@section('admin_content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-lg font-extrabold text-gray-900">Depoimentos</h2>
            <p class="text-xs text-gray-500 mt-0.5">Gerencie os depoimentos exibidos no site.</p>
        </div>
        <a href="{{ route('admin.testimonials.create') }}"
           class="inline-flex items-center gap-2 bg-[#109e4a] hover:bg-[#0b803a] text-white font-bold text-xs uppercase px-5 py-2.5 rounded-xl transition duration-200 shadow-sm">
            <i class="fas fa-plus"></i>
            <span>Novo Depoimento</span>
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 overflow-hidden">
        @if($testimonials->isEmpty())
            <div class="flex flex-col items-center justify-center py-20 text-center px-6">
                <div class="w-16 h-16 rounded-full bg-amber-50 flex items-center justify-center mb-4">
                    <i class="fas fa-quote-left text-[#f3a908] text-2xl"></i>
                </div>
                <h3 class="text-sm font-bold text-gray-700 mb-1">Nenhum depoimento cadastrado</h3>
                <p class="text-xs text-gray-400 mb-5">Adicione depoimentos para aumentar a confiança dos visitantes.</p>
                <a href="{{ route('admin.testimonials.create') }}"
                   class="inline-flex items-center gap-2 bg-[#109e4a] hover:bg-[#0b803a] text-white font-bold text-xs uppercase px-5 py-2.5 rounded-xl transition duration-200">
                    <i class="fas fa-plus"></i> Adicionar Depoimento
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-gray-400">Autor</th>
                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-gray-400">Depoimento</th>
                            <th class="px-6 py-4 text-center text-[11px] font-bold uppercase tracking-wider text-gray-400">Avaliação</th>
                            <th class="px-6 py-4 text-center text-[11px] font-bold uppercase tracking-wider text-gray-400">Status</th>
                            <th class="px-6 py-4 text-center text-[11px] font-bold uppercase tracking-wider text-gray-400">Ordem</th>
                            <th class="px-6 py-4 text-right text-[11px] font-bold uppercase tracking-wider text-gray-400">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($testimonials as $testimonial)
                            <tr class="hover:bg-slate-50/50 transition duration-150">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($testimonial->author_photo)
                                            <img src="{{ asset('storage/' . $testimonial->author_photo) }}"
                                                 alt="{{ $testimonial->author_name }}"
                                                 class="w-10 h-10 rounded-full object-cover shrink-0 border border-gray-200">
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-[#002752]/10 flex items-center justify-center shrink-0">
                                                <i class="fas fa-user text-[#002752]/40 text-sm"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-bold text-gray-800 text-sm">{{ $testimonial->author_name }}</p>
                                            @if($testimonial->author_role)
                                                <p class="text-xs text-gray-400">{{ $testimonial->author_role }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-xs text-gray-600 line-clamp-2 max-w-xs">{{ $testimonial->content }}</p>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-0.5">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star text-xs {{ $i <= $testimonial->rating ? 'text-[#f3a908]' : 'text-gray-200' }}"></i>
                                        @endfor
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                        {{ $testimonial->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-gray-100 text-gray-400' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $testimonial->is_active ? 'bg-emerald-500' : 'bg-gray-300' }}"></span>
                                        {{ $testimonial->is_active ? 'Ativo' : 'Inativo' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-xs font-mono text-gray-500">{{ $testimonial->order }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <form action="{{ route('admin.testimonials.duplicate', $testimonial) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#002752]/5 hover:bg-[#002752] text-[#002752] hover:text-white text-xs font-bold transition duration-200">
                                                <i class="fas fa-copy text-[10px]"></i> Copiar
                                            </button>
                                        </form>
                                        <a href="{{ route('admin.testimonials.edit', $testimonial) }}"
                                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#002752]/5 hover:bg-[#002752] text-[#002752] hover:text-white text-xs font-bold transition duration-200">
                                            <i class="fas fa-edit text-[10px]"></i> Editar
                                        </a>
                                        <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST"
                                              onsubmit="return confirm('Tem certeza que deseja excluir este depoimento?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 hover:bg-red-600 text-red-600 hover:text-white text-xs font-bold transition duration-200">
                                                <i class="fas fa-trash text-[10px]"></i> Excluir
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
