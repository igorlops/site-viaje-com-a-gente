@extends('layouts.admin')

@section('page_title', 'Mensagens de Contato (Leads)')

@section('admin_content')

    {{-- FILTROS E PESQUISA --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <form action="{{ route('admin.contacts.index') }}" method="GET" class="flex flex-col md:flex-row items-end gap-4">
            
            {{-- Busca --}}
            <div class="w-full md:flex-1">
                <label for="search" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                    Buscar Mensagem
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                           class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                           placeholder="Buscar por nome, e-mail, telefone ou conteúdo da mensagem...">
                </div>
            </div>

            {{-- Tipo --}}
            <div class="w-full md:w-64">
                <label for="type" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                    Origem / Canal
                </label>
                <select name="type" id="type"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200 bg-white">
                    <option value="">🌍 Todas as origens</option>
                    <option value="general" {{ request('type') === 'general' ? 'selected' : '' }}>✉️ Contato Geral</option>
                    <option value="service" {{ request('type') === 'service' ? 'selected' : '' }}>🛎️ Solicitações de Serviços</option>
                </select>
            </div>

            {{-- Botões --}}
            <div class="flex gap-2 w-full md:w-auto">
                <button type="submit" class="w-full md:w-auto bg-[#002752] hover:bg-[#001c3d] text-white font-bold text-xs uppercase tracking-wider py-3 px-6 rounded-lg transition duration-200 flex items-center justify-center gap-2">
                    <i class="fas fa-filter"></i> Filtrar
                </button>
                @if(request()->anyFilled(['search', 'type']))
                    <a href="{{ route('admin.contacts.index') }}" class="w-full md:w-auto border border-gray-300 hover:bg-gray-50 text-gray-600 font-bold text-xs uppercase tracking-wider py-3 px-6 rounded-lg transition duration-200 text-center flex items-center justify-center">
                        Limpar
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- FEEDBACK MESSAGE --}}
    @if(session('success'))
        <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl shadow-sm mb-6 flex gap-3 animate-fade-in">
            <i class="fas fa-check-circle text-emerald-500 text-lg mt-0.5"></i>
            <span class="text-sm font-semibold text-emerald-900">{{ session('success') }}</span>
        </div>
    @endif

    {{-- LISTA DE CONTATOS --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        @if($contacts->isEmpty())
            <div class="flex flex-col items-center justify-center py-20 text-gray-400 text-center">
                <i class="fas fa-inbox text-5xl mb-4 opacity-35"></i>
                <p class="text-base font-bold">Nenhuma mensagem encontrada</p>
                <p class="text-xs mt-1">Experimente alterar os filtros de busca acima.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-150 text-xs font-bold text-gray-450 bg-gray-50 uppercase tracking-wider">
                            <th class="py-4 px-6">Nome</th>
                            <th class="py-4 px-6">Informações de Contato</th>
                            <th class="py-4 px-6">Origem / Canal</th>
                            <th class="py-4 px-6">Data de Envio</th>
                            <th class="py-4 px-6 text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @foreach($contacts as $contact)
                            <tr class="hover:bg-gray-50/50 transition duration-150">
                                <td class="py-4 px-6 font-bold text-gray-800">
                                    {{ $contact->name }}
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex flex-col gap-1">
                                        <span class="flex items-center gap-1.5 text-gray-700">
                                            <i class="far fa-envelope text-gray-400"></i> {{ $contact->email }}
                                        </span>
                                        @if($contact->phone)
                                            <span class="flex items-center gap-1.5 font-mono text-xs text-gray-500">
                                                <i class="fab fa-whatsapp text-green-500"></i> {{ $contact->phone }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    @if(str_contains(strtolower($contact->type), 'serviço'))
                                        <span class="inline-flex items-center bg-[#002752]/10 text-[#002752] font-bold text-[10px] px-2.5 py-0.5 rounded-full border border-[#002752]/20">
                                            <i class="fas fa-concierge-bell mr-1"></i> {{ $contact->type }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center bg-gray-100 text-gray-700 font-medium text-[10px] px-2.5 py-0.5 rounded-full border border-gray-250">
                                            <i class="fas fa-paper-plane mr-1"></i> Geral / Contato
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-xs text-gray-500">
                                    {{ $contact->created_at->timezone('America/Fortaleza')->format('d/m/Y H:i') }}
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button onclick="openLeadModal('{{ addslashes($contact->name) }}', '{{ addslashes($contact->email) }}', '{{ addslashes($contact->phone ?? 'Não informado') }}', '{{ addslashes($contact->type) }}', '{{ addslashes($contact->created_at->format('d/m/Y H:i')) }}', '{{ addslashes(str_replace(["\r", "\n"], ["", " "], $contact->message)) }}')" 
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 transition duration-200" title="Ler Mensagem">
                                            <i class="far fa-eye"></i>
                                        </button>
                                        
                                        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Deseja realmente excluir permanentemente este lead do banco de dados?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 transition duration-200" title="Excluir Lead">
                                                <i class="far fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{-- Paginação --}}
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $contacts->links() }}
            </div>
        @endif
    </div>

    {{-- MODAL PARA DETALHES DO LEAD --}}
    <div id="leadModal" class="fixed inset-0 z-50 hidden bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full shadow-2xl overflow-hidden border border-gray-200">
            <div class="bg-[#002752] p-5 text-white flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fas fa-envelope-open text-amber-400 text-lg"></i>
                    <h3 class="font-bold text-base">Detalhes da Mensagem</h3>
                </div>
                <button onclick="closeLeadModal()" class="text-white/80 hover:text-white transition duration-200">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            <div class="p-6 space-y-4 text-sm">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <span class="block text-[10px] uppercase font-bold text-gray-400">Cliente</span>
                        <span id="modalName" class="font-bold text-gray-800"></span>
                    </div>
                    <div>
                        <span class="block text-[10px] uppercase font-bold text-gray-400">Data de Envio</span>
                        <span id="modalDate" class="text-gray-600"></span>
                    </div>
                    <div>
                        <span class="block text-[10px] uppercase font-bold text-gray-400">E-mail</span>
                        <a id="modalEmailLink" href="" class="font-bold text-[#109e4a] underline"></a>
                    </div>
                    <div>
                        <span class="block text-[10px] uppercase font-bold text-gray-400">WhatsApp / Telefone</span>
                        <span id="modalPhone" class="font-bold text-gray-700 font-mono"></span>
                    </div>
                    <div class="col-span-2">
                        <span class="block text-[10px] uppercase font-bold text-gray-400">Origem / Canal</span>
                        <span id="modalType" class="inline-block bg-gray-150 px-2.5 py-0.5 rounded text-gray-700 font-bold text-[10px] mt-1 border"></span>
                    </div>
                </div>

                <hr class="border-gray-100">

                <div>
                    <span class="block text-[10px] uppercase font-bold text-gray-400 mb-2">Mensagem</span>
                    <div id="modalMessage" class="bg-gray-50 border border-gray-200 rounded-xl p-4 text-gray-700 whitespace-pre-wrap leading-relaxed max-h-48 overflow-y-auto font-sans"></div>
                </div>
            </div>
            <div class="bg-gray-50 p-4 border-t border-gray-150 flex justify-end gap-2">
                <a id="modalReplyBtn" href="" target="_blank" class="inline-flex items-center gap-1.5 bg-[#109e4a] hover:bg-[#0d9648] text-white font-bold text-xs py-2.5 px-4 rounded-lg transition duration-200 shadow-sm">
                    <i class="fab fa-whatsapp"></i> Responder no WhatsApp
                </a>
                <button onclick="closeLeadModal()" class="border border-gray-300 hover:bg-gray-100 text-gray-650 font-bold text-xs py-2.5 px-4 rounded-lg transition duration-200">
                    Fechar
                </button>
            </div>
        </div>
    </div>

    <script>
    // FUNÇÕES DO MODAL DE LEADS
    function openLeadModal(name, email, phone, type, date, message) {
        document.getElementById('modalName').innerText = name;
        document.getElementById('modalDate').innerText = date;
        
        const emailLink = document.getElementById('modalEmailLink');
        emailLink.href = "mailto:" + email;
        emailLink.innerText = email;
        
        document.getElementById('modalPhone').innerText = phone;
        document.getElementById('modalType').innerText = type;
        document.getElementById('modalMessage').innerText = message;
        
        const cleanPhone = phone.replace(/[^0-9]/g, '');
        const replyBtn = document.getElementById('modalReplyBtn');
        
        if (cleanPhone && cleanPhone.length >= 10) {
            replyBtn.href = "https://wa.me/" + (cleanPhone.startsWith('55') ? cleanPhone : '55' + cleanPhone) + "?text=" + encodeURIComponent("Olá " + name + ", recebemos sua mensagem através do nosso site a respeito de " + type + ".");
            replyBtn.classList.remove('hidden');
        } else {
            replyBtn.classList.add('hidden');
        }
        
        document.getElementById('leadModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeLeadModal() {
        document.getElementById('leadModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Fechar modal ao clicar fora
    window.onclick = function(event) {
        const modal = document.getElementById('leadModal');
        if (event.target == modal) {
            closeLeadModal();
        }
    }
    </script>

@endsection
