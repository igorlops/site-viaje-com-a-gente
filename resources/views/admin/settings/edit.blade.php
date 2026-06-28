@extends('layouts.admin')

@section('page_title', 'Editar — ' . $setting->label)

@section('admin_content')

<div class="max-w-2xl mx-auto">
    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-gray-400 mb-6">
        <a href="{{ route('admin.settings.index') }}" class="hover:text-[#002752] font-medium transition-colors">
            <i class="fas fa-sliders mr-1"></i>Configurações Gerais
        </a>
        <i class="fas fa-chevron-right text-[10px]"></i>
        <span class="text-gray-600 font-semibold">{{ $setting->label }}</span>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        {{-- Cabeçalho --}}
        <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-[#001c3d] to-[#002752]">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                    @if($setting->type === 'image')
                        <i class="fas fa-image text-white"></i>
                    @elseif($setting->type === 'email')
                        <i class="fas fa-envelope text-white"></i>
                    @elseif($setting->type === 'url')
                        <i class="fas fa-link text-white"></i>
                    @else
                        <i class="fas fa-pencil text-white"></i>
                    @endif
                </div>
                <div>
                    <h2 class="font-bold text-white text-lg">{{ $setting->label }}</h2>
                    <p class="text-xs text-white/60 font-mono">{{ $setting->key }}</p>
                </div>
            </div>
        </div>

        {{-- Formulário --}}
        <form action="{{ route('admin.settings.update', $setting) }}"
              method="POST"
              enctype="multipart/form-data"
              class="px-8 py-8 space-y-6">
            @csrf
            @method('PUT')

            @if($setting->type === 'image')
                {{-- Preview da imagem atual --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Imagem Atual</label>
                    <div id="preview-container" class="flex items-center gap-4">
                        @if($setting->value)
                            <img id="img-preview"
                                 src="{{ str_starts_with($setting->value, 'settings/') || str_starts_with($setting->value, 'banners/')
                                    ? asset('storage/' . $setting->value)
                                    : asset($setting->value) }}"
                                 alt="{{ $setting->label }}"
                                 class="h-20 w-auto max-w-[200px] rounded-xl border border-gray-200 object-contain bg-gray-50 p-2 shadow-sm">
                        @else
                            <img id="img-preview"
                                 src=""
                                 alt="Preview"
                                 class="h-20 w-auto max-w-[200px] rounded-xl border border-dashed border-gray-300 bg-gray-50 p-2 hidden">
                        @endif
                        <div class="text-xs text-gray-400">
                            <p class="font-mono">{{ $setting->value ?: 'Nenhuma imagem' }}</p>
                            <p class="mt-1">Formatos: JPEG, PNG, WebP, SVG — Máx. 2 MB</p>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="value" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nova Imagem <span class="text-gray-400 font-normal">(deixe em branco para manter a atual)</span>
                    </label>
                    <div class="relative border-2 border-dashed border-gray-200 hover:border-[#002752] rounded-xl p-6 text-center transition-colors duration-200 cursor-pointer"
                         onclick="document.getElementById('value').click()">
                        <i class="fas fa-cloud-arrow-up text-3xl text-gray-300 mb-2"></i>
                        <p class="text-sm text-gray-400">Clique para selecionar ou arraste a imagem aqui</p>
                        <input type="file"
                               id="value"
                               name="value"
                               accept="image/*"
                               class="absolute inset-0 opacity-0 cursor-pointer w-full h-full"
                               onchange="previewImage(this)">
                    </div>
                    @error('value')
                        <p class="mt-2 text-xs text-red-600 flex items-center gap-1">
                            <i class="fas fa-circle-exclamation"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

            @elseif($setting->type === 'textarea')
                <div>
                    <label for="value" class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ $setting->label }}
                    </label>
                    <textarea id="value"
                              name="value"
                              rows="4"
                              class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#002752]/30 focus:border-[#002752] transition-colors resize-none"
                              placeholder="Digite o conteúdo...">{{ old('value', $setting->value) }}</textarea>
                    @error('value')
                        <p class="mt-2 text-xs text-red-600 flex items-center gap-1">
                            <i class="fas fa-circle-exclamation"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

            @else
                <div>
                    <label for="value" class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ $setting->label }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            @if($setting->type === 'email')
                                <i class="fas fa-envelope text-sm"></i>
                            @elseif($setting->type === 'url')
                                <i class="fas fa-link text-sm"></i>
                            @else
                                <i class="fas fa-font text-sm"></i>
                            @endif
                        </div>
                        <input type="{{ $setting->type === 'email' ? 'email' : ($setting->type === 'url' ? 'url' : 'text') }}"
                               id="value"
                               name="value"
                               value="{{ old('value', $setting->value) }}"
                               class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-3 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#002752]/30 focus:border-[#002752] transition-colors"
                               placeholder="Digite o valor...">
                    </div>
                    @error('value')
                        <p class="mt-2 text-xs text-red-600 flex items-center gap-1">
                            <i class="fas fa-circle-exclamation"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            @endif

            {{-- Ações --}}
            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                <a href="{{ route('admin.settings.index') }}"
                   class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-700 font-semibold transition-colors">
                    <i class="fas fa-arrow-left text-xs"></i>
                    Voltar
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-2 bg-[#002752] hover:bg-[#001c3d] text-white font-bold text-sm px-6 py-3 rounded-xl shadow-sm transition-all duration-200 hover:shadow-md active:scale-95">
                    <i class="fas fa-floppy-disk"></i>
                    Salvar Configuração
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('img-preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
