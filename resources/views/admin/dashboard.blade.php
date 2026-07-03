@extends('layouts.admin')

@section('page_title', 'Dashboard')

@section('admin_content')

    {{-- STAT CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-5 mb-8">
        <!-- Visitas (30d) -->
        <div class="bg-gradient-to-br from-[#002752] to-[#004a9a] p-6 rounded-xl shadow-sm flex items-center justify-between text-white">
            <div>
                <span class="block text-xs font-bold uppercase tracking-wider text-white/60 mb-1">Visitas (30 dias)</span>
                <span class="block text-3xl font-black">{{ number_format($totalVisits30d) }}</span>
                <span class="block text-xs text-white/50 mt-2">páginas visitadas</span>
            </div>
            <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center text-xl shrink-0">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>

        <!-- Contatos / Leads -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex items-center justify-between">
            <div>
                <span class="block text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Contatos</span>
                <span class="block text-3xl font-black text-[#002752]">{{ $contactsCount }}</span>
                <span class="block text-xs text-gray-400 mt-2">mensagens recebidas</span>
            </div>
            <div class="w-12 h-12 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center text-xl shrink-0 shadow-inner">
                <i class="fas fa-envelope-open-text"></i>
            </div>
        </div>

        <!-- Banners -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex items-center justify-between">
            <div>
                <span class="block text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Banners</span>
                <span class="block text-3xl font-black text-[#002752]">{{ $bannersCount }}</span>
                <a href="{{ route('admin.banners.index') }}" class="inline-flex items-center text-xs font-bold text-[#109e4a] hover:text-[#0b803a] mt-3 gap-1">
                    <span>Gerenciar</span>
                    <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
            <div class="w-12 h-12 rounded-full bg-blue-50 text-[#002752] flex items-center justify-center text-xl shrink-0 shadow-inner">
                <i class="fas fa-images"></i>
            </div>
        </div>

        <!-- Destinations -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex items-center justify-between">
            <div>
                <span class="block text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Destinos</span>
                <span class="block text-3xl font-black text-[#002752]">{{ $destinationsCount }}</span>
                <a href="{{ route('admin.destinations.index') }}" class="inline-flex items-center text-xs font-bold text-[#109e4a] hover:text-[#0b803a] mt-3 gap-1">
                    <span>Gerenciar</span>
                    <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
            <div class="w-12 h-12 rounded-full bg-green-50 text-[#109e4a] flex items-center justify-center text-xl shrink-0 shadow-inner">
                <i class="fas fa-map-marked-alt"></i>
            </div>
        </div>

        <!-- Social Links -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex items-center justify-between">
            <div>
                <span class="block text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Redes</span>
                <span class="block text-3xl font-black text-[#002752]">{{ $socialLinksCount }}</span>
                <a href="{{ route('admin.social.index') }}" class="inline-flex items-center text-xs font-bold text-[#109e4a] hover:text-[#0b803a] mt-3 gap-1">
                    <span>Gerenciar</span>
                    <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
            <div class="w-12 h-12 rounded-full bg-yellow-50 text-[#f3a908] flex items-center justify-center text-xl shrink-0 shadow-inner">
                <i class="fas fa-share-nodes"></i>
            </div>
        </div>

        <!-- Services -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex items-center justify-between">
            <div>
                <span class="block text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Serviços</span>
                <span class="block text-3xl font-black text-[#002752]">{{ $servicesCount }}</span>
                <a href="{{ route('admin.services.index') }}" class="inline-flex items-center text-xs font-bold text-[#109e4a] hover:text-[#0b803a] mt-3 gap-1">
                    <span>Gerenciar</span>
                    <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
            <div class="w-12 h-12 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center text-xl shrink-0 shadow-inner">
                <i class="fas fa-concierge-bell"></i>
            </div>
        </div>
    </div>

    {{-- METRICS ROW --}}
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 mb-8">

        {{-- CHART: Visitas por dia --}}
        <div class="lg:col-span-3 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-base font-bold text-[#002752] flex items-center gap-2">
                    <i class="fas fa-chart-area text-[#f3a908]"></i>
                    Visitas por Dia
                </h2>
                <span class="text-xs text-gray-400 bg-gray-100 px-3 py-1 rounded-full font-medium">Últimos 14 dias</span>
            </div>
            <div class="relative" style="height: 220px;">
                <canvas id="visitsChart"></canvas>
            </div>
        </div>

        {{-- TOP PAGES --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-base font-bold text-[#002752] flex items-center gap-2">
                    <i class="fas fa-fire text-orange-400"></i>
                    Top Páginas
                </h2>
                <span class="text-xs text-gray-400 bg-gray-100 px-3 py-1 rounded-full font-medium">30 dias</span>
            </div>

            @if($topPages->isEmpty())
                <div class="flex flex-col items-center justify-center h-40 text-gray-400 text-center">
                    <i class="fas fa-chart-bar text-3xl mb-2 opacity-30"></i>
                    <p class="text-sm">Nenhuma visita registrada ainda</p>
                    <p class="text-xs mt-1">As visitas aparecerão após acessos ao site público</p>
                </div>
            @else
                @php $maxVisits = $topPages->max('total'); @endphp
                <div class="space-y-3">
                    @foreach($topPages as $index => $page)
                        @php
                            $pct = $maxVisits > 0 ? round(($page->total / $maxVisits) * 100) : 0;
                            $medals = ['🥇','🥈','🥉'];
                        @endphp
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-xs font-semibold text-gray-600 flex items-center gap-1.5 truncate max-w-[70%]">
                                    <span class="shrink-0">{{ $medals[$index] ?? ($index + 1) . '.' }}</span>
                                    {{ $page->page_name }}
                                </span>
                                <span class="text-xs font-black text-[#002752] shrink-0">{{ number_format($page->total) }}</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-1.5">
                                <div class="bg-gradient-to-r from-[#002752] to-[#109e4a] h-1.5 rounded-full transition-all duration-500"
                                     style="width: {{ $pct }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- TABELA DE LEADS / CONTATOS --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-100 pb-5 mb-5 gap-3">
            <div>
                <h2 class="text-base font-bold text-[#002752] flex items-center gap-2">
                    <i class="fas fa-envelope-open-text text-amber-500"></i>
                    Mensagens de Contato Recentes (Leads)
                </h2>
                <p class="text-xs text-gray-400 mt-1">Últimas solicitações preenchidas pelos clientes no site e nas páginas de serviços</p>
            </div>
            <span class="text-xs text-gray-500 font-medium bg-gray-50 px-3 py-1.5 rounded-lg border border-gray-200 self-start sm:self-center">
                Total Geral: {{ $contactsCount }} mensagens
            </span>
        </div>

        @if($latestContacts->isEmpty())
            <div class="flex flex-col items-center justify-center py-12 text-gray-400 text-center">
                <i class="fas fa-inbox text-4xl mb-3 opacity-30"></i>
                <p class="text-sm font-bold">Nenhuma mensagem recebida ainda</p>
                <p class="text-xs mt-1">Os contatos preenchidos no site serão exibidos aqui em tempo real.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-xs font-bold text-gray-400 uppercase tracking-wider">
                            <th class="py-3 px-4">Nome</th>
                            <th class="py-3 px-4">Contato</th>
                            <th class="py-3 px-4">Origem / Tipo</th>
                            <th class="py-3 px-4">Enviado em</th>
                            <th class="py-3 px-4 text-right">Ação</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-xs sm:text-sm">
                        @foreach($latestContacts as $contact)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="py-4 px-4 font-bold text-gray-800">
                                    {{ $contact->name }}
                                </td>
                                <td class="py-4 px-4 text-gray-600">
                                    <div class="flex flex-col gap-0.5">
                                        <span class="flex items-center gap-1"><i class="far fa-envelope text-gray-400"></i> {{ $contact->email }}</span>
                                        @if($contact->phone)
                                            <span class="flex items-center gap-1 font-mono text-xs text-gray-500">
                                                <i class="fab fa-whatsapp text-green-500"></i> {{ $contact->phone }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    @if(str_contains(strtolower($contact->type), 'serviço'))
                                        <span class="inline-flex items-center bg-[#002752]/10 text-[#002752] font-bold text-[10px] px-2 py-0.5 rounded-full border border-[#002752]/20">
                                            <i class="fas fa-concierge-bell mr-1"></i> {{ $contact->type }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center bg-gray-100 text-gray-700 font-medium text-[10px] px-2 py-0.5 rounded-full border border-gray-250">
                                            <i class="fas fa-paper-plane mr-1"></i> Geral / Contato
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 text-xs text-gray-450">
                                    {{ $contact->created_at->timezone('America/Fortaleza')->format('d/m/Y H:i') }}
                                </td>
                                <td class="py-4 px-4 text-right">
                                    <button onclick="openLeadModal('{{ addslashes($contact->name) }}', '{{ addslashes($contact->email) }}', '{{ addslashes($contact->phone ?? 'Não informado') }}', '{{ addslashes($contact->type) }}', '{{ addslashes($contact->created_at->format('d/m/Y H:i')) }}', '{{ addslashes(str_replace(["\r", "\n"], ["", " "], $contact->message)) }}')" 
                                            class="inline-flex items-center gap-1 bg-[#109e4a] hover:bg-[#0d9648] text-white font-bold text-xs py-1.5 px-3 rounded-lg transition duration-200">
                                        <i class="far fa-eye"></i> Ler Mensagem
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- MODAL PARA DETALHES DO LEAD --}}
    <div id="leadModal" class="fixed inset-0 z-50 hidden bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full shadow-2xl overflow-hidden animate-fade-in border border-gray-150">
            <div class="bg-[#002752] p-5 text-white flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fas fa-envelope-open text-amber-400 text-lg"></i>
                    <h3 class="font-bold text-base">Mensagem Recebida</h3>
                </div>
                <button onclick="closeLeadModal()" class="text-white/80 hover:text-white transition duration-200">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            <div class="p-6 space-y-4 text-xs sm:text-sm">
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
                        <span id="modalPhone" class="font-bold text-gray-700"></span>
                    </div>
                    <div class="col-span-2">
                        <span class="block text-[10px] uppercase font-bold text-gray-400">Origem / Canal</span>
                        <span id="modalType" class="inline-block bg-gray-100 px-2 py-0.5 rounded text-gray-700 font-semibold text-[10px] mt-1 border"></span>
                    </div>
                </div>

                <hr class="border-gray-150">

                <div>
                    <span class="block text-[10px] uppercase font-bold text-gray-400 mb-2">Mensagem</span>
                    <div id="modalMessage" class="bg-gray-50 border border-gray-150 rounded-xl p-4 text-gray-700 whitespace-pre-wrap leading-relaxed max-h-48 overflow-y-auto font-sans"></div>
                </div>
            </div>
            <div class="bg-gray-50 p-4 border-t border-gray-150 flex justify-end gap-2">
                <a id="modalReplyBtn" href="" class="inline-flex items-center gap-1.5 bg-[#109e4a] hover:bg-[#0d9648] text-white font-bold text-xs py-2 px-4 rounded-lg transition duration-200">
                    <i class="fab fa-whatsapp"></i> Responder no Whats
                </a>
                <button onclick="closeLeadModal()" class="border border-gray-300 hover:bg-gray-100 text-gray-600 font-bold text-xs py-2 px-4 rounded-lg transition duration-200">
                    Fechar
                </button>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8">
        <h2 class="text-lg font-bold text-[#002752] mb-6 flex items-center gap-2">
            <i class="fas fa-bolt text-[#f3a908]"></i>
            <span>Ações Rápidas de Gerenciamento</span>
        </h2>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            <a href="{{ route('admin.banners.index') }}" class="flex flex-col items-center justify-center p-5 border border-gray-200 hover:border-[#002752] rounded-xl hover:bg-gray-50 transition duration-200 text-center gap-3">
                <i class="fas fa-image text-2xl text-blue-500"></i>
                <span class="font-bold text-xs text-gray-700">Banners</span>
            </a>
            
            <a href="{{ route('admin.destinations.create') }}" class="flex flex-col items-center justify-center p-5 border border-gray-200 hover:border-[#002752] rounded-xl hover:bg-gray-50 transition duration-200 text-center gap-3">
                <i class="fas fa-plus text-2xl text-green-500"></i>
                <span class="font-bold text-xs text-gray-700">Novo Destino</span>
            </a>
            
            <a href="{{ route('admin.social.index') }}" class="flex flex-col items-center justify-center p-5 border border-gray-200 hover:border-[#002752] rounded-xl hover:bg-gray-50 transition duration-200 text-center gap-3">
                <i class="fas fa-link text-2xl text-[#f3a908]"></i>
                <span class="font-bold text-xs text-gray-700">Redes Sociais</span>
            </a>

            <a href="{{ route('admin.settings.index') }}" class="flex flex-col items-center justify-center p-5 border border-gray-200 hover:border-[#002752] rounded-xl hover:bg-gray-50 transition duration-200 text-center gap-3">
                <i class="fas fa-sliders text-2xl text-indigo-500"></i>
                <span class="font-bold text-xs text-gray-700">Configurações</span>
            </a>
            
            <a href="{{ route('home') }}" target="_blank" class="flex flex-col items-center justify-center p-5 border border-gray-200 hover:border-[#002752] rounded-xl hover:bg-gray-50 transition duration-200 text-center gap-3">
                <i class="fas fa-external-link-alt text-2xl text-gray-400"></i>
                <span class="font-bold text-xs text-gray-700">Ver Site</span>
            </a>
        </div>
    </div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
(function() {
    const ctx = document.getElementById('visitsChart');
    if (!ctx) return;

    const labels = @json($chartLabels);
    const data   = @json($chartData);

    const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 220);
    gradient.addColorStop(0, 'rgba(0, 39, 82, 0.15)');
    gradient.addColorStop(1, 'rgba(0, 39, 82, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels,
            datasets: [{
                label: 'Visitas',
                data,
                borderColor: '#002752',
                backgroundColor: gradient,
                borderWidth: 2.5,
                pointBackgroundColor: '#002752',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                fill: true,
                tension: 0.4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#002752',
                    titleColor: '#f3a908',
                    bodyColor: '#fff',
                    padding: 10,
                    cornerRadius: 8,
                    callbacks: {
                        label: ctx => ` ${ctx.parsed.y} visita${ctx.parsed.y !== 1 ? 's' : ''}`,
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 11 }, color: '#9ca3af' }
                },
                y: {
                    beginAtZero: true,
                    grid: { color: '#f3f4f6' },
                    ticks: {
                        font: { size: 11 },
                        color: '#9ca3af',
                        precision: 0,
                    }
                }
            }
        }
    });
})();

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
