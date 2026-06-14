@extends('layouts.admin')

@section('page_title', 'Dashboard')

@section('admin_content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Stat Card 1: Banners -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex items-center justify-between">
            <div>
                <span class="block text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Banner Principal</span>
                <span class="block text-3xl font-black text-[#002752]">{{ $bannersCount }}</span>
                <a href="{{ route('admin.banners.index') }}" class="inline-flex items-center text-xs font-bold text-[#109e4a] hover:text-[#0b803a] mt-3 gap-1">
                    <span>Gerenciar banners</span>
                    <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
            <div class="w-14 h-14 rounded-full bg-blue-50 text-[#002752] flex items-center justify-center text-2xl shadow-inner">
                <i class="fas fa-images"></i>
            </div>
        </div>

        <!-- Stat Card 2: Destinations -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex items-center justify-between">
            <div>
                <span class="block text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Destinos Cadastrados</span>
                <span class="block text-3xl font-black text-[#002752]">{{ $destinationsCount }}</span>
                <a href="{{ route('admin.destinations.index') }}" class="inline-flex items-center text-xs font-bold text-[#109e4a] hover:text-[#0b803a] mt-3 gap-1">
                    <span>Gerenciar destinos</span>
                    <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
            <div class="w-14 h-14 rounded-full bg-green-50 text-[#109e4a] flex items-center justify-center text-2xl shadow-inner">
                <i class="fas fa-map-marked-alt"></i>
            </div>
        </div>

        <!-- Stat Card 3: Social Links -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex items-center justify-between">
            <div>
                <span class="block text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Redes Sociais</span>
                <span class="block text-3xl font-black text-[#002752]">{{ $socialLinksCount }}</span>
                <a href="{{ route('admin.social.index') }}" class="inline-flex items-center text-xs font-bold text-[#109e4a] hover:text-[#0b803a] mt-3 gap-1">
                    <span>Gerenciar links</span>
                    <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
            <div class="w-14 h-14 rounded-full bg-yellow-50 text-[#f2bd11] flex items-center justify-center text-2xl shadow-inner">
                <i class="fas fa-share-nodes"></i>
            </div>
        </div>

        <!-- Stat Card 4: Services -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex items-center justify-between">
            <div>
                <span class="block text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Serviços</span>
                <span class="block text-3xl font-black text-[#002752]">{{ $servicesCount }}</span>
                <a href="{{ route('admin.services.index') }}" class="inline-flex items-center text-xs font-bold text-[#109e4a] hover:text-[#0b803a] mt-3 gap-1">
                    <span>Gerenciar serviços</span>
                    <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
            <div class="w-14 h-14 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center text-2xl shadow-inner">
                <i class="fas fa-concierge-bell"></i>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8">
        <h2 class="text-lg font-bold text-[#002752] mb-6 flex items-center gap-2">
            <i class="fas fa-bolt text-[#f2bd11]"></i>
            <span>Ações Rápidas de Gerenciamento</span>
        </h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.banners.index') }}" class="flex flex-col items-center justify-center p-6 border border-gray-200 hover:border-[#002752] rounded-xl hover:bg-gray-50 transition duration-200 text-center gap-3">
                <i class="fas fa-image text-3xl text-blue-500"></i>
                <span class="font-bold text-sm text-gray-700">Trocar Banner Principal</span>
            </a>
            
            <a href="{{ route('admin.destinations.create') }}" class="flex flex-col items-center justify-center p-6 border border-gray-200 hover:border-[#002752] rounded-xl hover:bg-gray-50 transition duration-200 text-center gap-3">
                <i class="fas fa-plus text-3xl text-green-500"></i>
                <span class="font-bold text-sm text-gray-700">Cadastrar Novo Destino</span>
            </a>
            
            <a href="{{ route('admin.social.index') }}" class="flex flex-col items-center justify-center p-6 border border-gray-200 hover:border-[#002752] rounded-xl hover:bg-gray-50 transition duration-200 text-center gap-3">
                <i class="fas fa-link text-3xl text-[#f2bd11]"></i>
                <span class="font-bold text-sm text-gray-700">Configurar Redes Sociais</span>
            </a>
            
            <a href="{{ route('admin.services.create') }}" class="flex flex-col items-center justify-center p-6 border border-gray-200 hover:border-[#002752] rounded-xl hover:bg-gray-50 transition duration-200 text-center gap-3">
                <i class="fas fa-concierge-bell text-3xl text-purple-500"></i>
                <span class="font-bold text-sm text-gray-700">Cadastrar Novo Serviço</span>
            </a>
            
            <a href="{{ route('home') }}" target="_blank" class="flex flex-col items-center justify-center p-6 border border-gray-200 hover:border-[#002752] rounded-xl hover:bg-gray-50 transition duration-200 text-center gap-3">
                <i class="fas fa-external-link-alt text-3xl text-gray-400"></i>
                <span class="font-bold text-sm text-gray-700">Visualizar Site Público</span>
            </a>
        </div>
    </div>
@endsection
