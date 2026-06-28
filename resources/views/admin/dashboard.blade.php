@extends('layouts.admin')

@section('page_title', 'Dashboard')

@section('admin_content')

    {{-- STAT CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-5 mb-8">
        <!-- Visitas (30d) -->
        <div class="lg:col-span-1 bg-gradient-to-br from-[#002752] to-[#004a9a] p-6 rounded-xl shadow-sm flex items-center justify-between text-white">
            <div>
                <span class="block text-xs font-bold uppercase tracking-wider text-white/60 mb-1">Visitas (30 dias)</span>
                <span class="block text-3xl font-black">{{ number_format($totalVisits30d) }}</span>
                <span class="block text-xs text-white/50 mt-2">páginas visitadas</span>
            </div>
            <div class="w-14 h-14 rounded-full bg-white/10 flex items-center justify-center text-2xl">
                <i class="fas fa-chart-line"></i>
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
            <div class="w-14 h-14 rounded-full bg-blue-50 text-[#002752] flex items-center justify-center text-2xl shadow-inner">
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
            <div class="w-14 h-14 rounded-full bg-green-50 text-[#109e4a] flex items-center justify-center text-2xl shadow-inner">
                <i class="fas fa-map-marked-alt"></i>
            </div>
        </div>

        <!-- Social Links -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex items-center justify-between">
            <div>
                <span class="block text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Redes Sociais</span>
                <span class="block text-3xl font-black text-[#002752]">{{ $socialLinksCount }}</span>
                <a href="{{ route('admin.social.index') }}" class="inline-flex items-center text-xs font-bold text-[#109e4a] hover:text-[#0b803a] mt-3 gap-1">
                    <span>Gerenciar</span>
                    <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
            <div class="w-14 h-14 rounded-full bg-yellow-50 text-[#f2bd11] flex items-center justify-center text-2xl shadow-inner">
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
            <div class="w-14 h-14 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center text-2xl shadow-inner">
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
                    <i class="fas fa-chart-area text-[#f2bd11]"></i>
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

    {{-- Quick Actions --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8">
        <h2 class="text-lg font-bold text-[#002752] mb-6 flex items-center gap-2">
            <i class="fas fa-bolt text-[#f2bd11]"></i>
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
                <i class="fas fa-link text-2xl text-[#f2bd11]"></i>
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
                    titleColor: '#f2bd11',
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
</script>
@endsection
