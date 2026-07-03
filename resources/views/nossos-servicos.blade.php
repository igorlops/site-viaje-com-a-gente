@extends('layouts.site')

@section('title', 'Nossos Serviços - Viaje com a Gente')

@section('content')


    <!-- CORE SERVICES SECTION -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <div class="inline-flex items-center justify-center gap-2 mb-2 text-[#002752] uppercase font-black tracking-widest text-sm">
                    <span>O que fazemos por você</span>
                    <i class="fas fa-handshake text-[#109e4a]"></i>
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#002752] tracking-tight">
                    Logística integrada e planejamento sob medida
                </h2>
                <div class="w-16 h-1 bg-[#109e4a] mx-auto mt-4 rounded"></div>
            </div>

            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service 1: Consultoria de Viagens -->
                <div class="bg-white rounded-xl border border-gray-100 p-8 shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-300 group flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 rounded-lg bg-[#002752]/5 flex items-center justify-center mb-6 text-[#002752] group-hover:bg-[#002752] group-hover:text-white transition duration-300">
                            <!-- SVG Compass Icon -->
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                        </div>
                        <h3 class="text-[#002752] text-xl font-bold mb-3">Planejamento e Consultoria</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-6">
                            Nossos consultores desenham o roteiro ideal alinhado às suas preferências e orçamento. Cuidamos dos horários, conexões e documentações necessárias.
                        </p>
                    </div>
                    <span class="text-xs font-black uppercase text-[#109e4a] tracking-wider">Suporte Personalizado</span>
                </div>

                <!-- Service 2: Hospedagens de Qualidade -->
                <div class="bg-white rounded-xl border border-gray-100 p-8 shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-300 group flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 rounded-lg bg-[#002752]/5 flex items-center justify-center mb-6 text-[#002752] group-hover:bg-[#002752] group-hover:text-white transition duration-300">
                            <!-- SVG Bed Icon -->
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        <h3 class="text-[#002752] text-xl font-bold mb-3">Reservas de Hospedagem</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-6">
                            Parcerias com redes de hotéis, resorts e pousadas de alta qualidade. Garantimos estadias confortáveis, bem localizadas e com as melhores tarifas.
                        </p>
                    </div>
                    <span class="text-xs font-black uppercase text-[#109e4a] tracking-wider">Conforto Garantido</span>
                </div>

                <!-- Service 3: Emissão de Passagens -->
                <div class="bg-white rounded-xl border border-gray-100 p-8 shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-300 group flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 rounded-lg bg-[#002752]/5 flex items-center justify-center mb-6 text-[#002752] group-hover:bg-[#002752] group-hover:text-white transition duration-300">
                            <!-- SVG Ticket Icon -->
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-[#002752] text-xl font-bold mb-3">Passagens e Logística Aérea</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-6">
                            Emissão simplificada de passagens aéreas nacionais e internacionais. Cuidamos do acompanhamento de voos e suporte em caso de alterações ou cancelamentos.
                        </p>
                    </div>
                    <span class="text-xs font-black uppercase text-[#109e4a] tracking-wider">Tranquilidade no Voo</span>
                </div>

                <!-- Service 4: Seguro Viagem Completo -->
                <div class="bg-white rounded-xl border border-gray-100 p-8 shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-300 group flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 rounded-lg bg-[#002752]/5 flex items-center justify-center mb-6 text-[#002752] group-hover:bg-[#002752] group-hover:text-white transition duration-300">
                            <!-- SVG Shield Icon -->
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h3 class="text-[#002752] text-xl font-bold mb-3">Seguro e Proteção de Viagem</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-6">
                            Assistência médica de qualidade, cobertura de extravio de bagagem e assessoria jurídica em trânsito para qualquer eventualidade, nacional ou internacional.
                        </p>
                    </div>
                    <span class="text-xs font-black uppercase text-[#109e4a] tracking-wider">Segurança Absoluta</span>
                </div>

                <!-- Service 5: Roteiros e Passeios -->
                <div class="bg-white rounded-xl border border-gray-100 p-8 shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-300 group flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 rounded-lg bg-[#002752]/5 flex items-center justify-center mb-6 text-[#002752] group-hover:bg-[#002752] group-hover:text-white transition duration-300">
                            <!-- SVG Map Icon -->
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                            </svg>
                        </div>
                        <h3 class="text-[#002752] text-xl font-bold mb-3">Roteiros e Passeios Locais</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-6">
                            Ingressos para atrações turísticas, guias locais credenciados e transfers garantidos para que você conheça o melhor de cada cidade com comodidade.
                        </p>
                    </div>
                    <span class="text-xs font-black uppercase text-[#109e4a] tracking-wider">Experiências Únicas</span>
                </div>

                <!-- Service 6: Parcelamento no Boleto -->
                <div class="bg-white rounded-xl border border-gray-100 p-8 shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-300 group flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 rounded-lg bg-[#002752]/5 flex items-center justify-center mb-6 text-[#002752] group-hover:bg-[#002752] group-hover:text-white transition duration-300">
                            <!-- SVG Barcode Icon -->
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l2-2 4 2m0-6V4m0 0L9 7m6-3l3 3M4 19v-6a2 2 0 012-2h12a2 2 0 012 2v6M4 19h16"></path>
                            </svg>
                        </div>
                        <h3 class="text-[#002752] text-xl font-bold mb-3">Boleto Parcelado Facilitado</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-6">
                            Nossa modalidade de pagamento exclusiva permite parcelar pacotes sem burocracia e sem comprometer o limite do seu cartão de crédito.
                        </p>
                    </div>
                    <span class="text-xs font-black uppercase text-[#109e4a] tracking-wider">Facilidade Financeira</span>
                </div>
            </div>
        </div>
    </section>

    <!-- LOGISTICS DIFFERENTIALS SECTION -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Text / Checklist -->
                <div>
                    <div class="inline-flex items-center justify-center gap-2 mb-2 text-[#002752] uppercase font-black tracking-widest text-xs">
                        <span>Nosso Diferencial</span>
                        <span class="w-2 h-2 rounded-full bg-[#109e4a]"></span>
                    </div>
                    <h3 class="text-3xl font-extrabold text-[#002752] mb-6 leading-tight">
                        Do primeiro clique até o retorno para casa: estamos com você
                    </h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-8">
                        Diferente das agências 100% automatizadas e sem suporte humano, nós acreditamos que uma viagem perfeita exige um acompanhamento de perto. É por isso que desenhamos um ecossistema de atendimento completo.
                    </p>
                    
                    <!-- Checklist items -->
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-[#109e4a]/10 text-[#109e4a] flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <span class="block font-bold text-[#002752] text-sm">Suporte Emergencial 24 Horas</span>
                                <span class="block text-xs text-gray-500">Linha telefônica e de mensagens direta em caso de atrasos ou imprevistos em viagem.</span>
                            </div>
                        </li>
                        
                        <li class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-[#109e4a]/10 text-[#109e4a] flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <span class="block font-bold text-[#002752] text-sm">Assessoria de Embarque</span>
                                <span class="block text-xs text-gray-500">Realizamos seu check-in e enviamos lembretes úteis antes do dia da sua partida.</span>
                            </div>
                        </li>

                        <li class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-[#109e4a]/10 text-[#109e4a] flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <span class="block font-bold text-[#002752] text-sm">Transparência Tarifária</span>
                                <span class="block text-xs text-gray-500">Sem taxas ocultas ou surpresas na contratação. Valores detalhados na proposta.</span>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <!-- Graphic Display -->
                <div class="bg-gradient-to-br from-[#002752] to-[#001c3d] rounded-2xl p-8 text-white relative shadow-xl overflow-hidden">
                    <div class="absolute -right-8 -bottom-8 w-64 h-64 rounded-full bg-blue-900/40 blur-2xl"></div>
                    <div class="relative z-10">
                        <span class="block text-[#f3a908] text-xs font-black uppercase tracking-widest mb-2">Compromisso</span>
                        <h4 class="text-2xl font-extrabold mb-6">Nosso Padrão de Atendimento</h4>
                        
                        <!-- Timeline structure -->
                        <div class="space-y-6">
                            <div class="relative pl-8 border-l border-white/20">
                                <span class="absolute left-[-5px] top-1.5 w-2.5 h-2.5 rounded-full bg-[#f3a908]"></span>
                                <span class="block text-xs font-bold uppercase tracking-wider text-gray-400">1. Antes da Viagem</span>
                                <span class="block text-sm text-gray-200 mt-0.5">Planejamento, roteiros detalhados, emissão ágil e dicas exclusivas sobre o destino.</span>
                            </div>
                            
                            <div class="relative pl-8 border-l border-white/20">
                                <span class="absolute left-[-5px] top-1.5 w-2.5 h-2.5 rounded-full bg-[#109e4a]"></span>
                                <span class="block text-xs font-bold uppercase tracking-wider text-gray-400">2. Durante o Embarque</span>
                                <span class="block text-sm text-gray-200 mt-0.5">Check-in automático, acompanhamento de eventuais conexões e suporte ao passageiro.</span>
                            </div>
                            
                            <div class="relative pl-8">
                                <span class="absolute left-[-5px] top-1.5 w-2.5 h-2.5 rounded-full bg-[#f3a908]"></span>
                                <span class="block text-xs font-bold uppercase tracking-wider text-gray-400">3. No Destino</span>
                                <span class="block text-sm text-gray-200 mt-0.5">Suporte emergencial e acompanhamento opcional de guias locais nos passeios programados.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CALL TO ACTION (CTA) -->
    <section class="bg-[#f3a908] py-12 text-[#002752]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
                <!-- Text block -->
                <div class="text-center lg:text-left">
                    <span class="block text-lg font-black uppercase tracking-wide">Pronto para a sua próxima aventura?</span>
                    <span class="block text-sm font-medium opacity-90">Deixe o planejamento com quem entende e garanta o melhor preço e suporte do mercado.</span>
                </div>
                
                <!-- Action Button -->
                @php
                    $whatsappUrl = isset($socialLinks['whatsapp']) ? $socialLinks['whatsapp']->url : 'https://wa.me/5585999166421';
                @endphp
                <a href="{{ $whatsappUrl }}" target="_blank" class="bg-[#109e4a] hover:bg-[#0d9648] text-white px-8 py-4 rounded-lg font-black text-sm tracking-wider uppercase transition duration-300 shadow-md flex items-center gap-3 shrink-0">
                    <i class="fab fa-whatsapp text-2xl"></i>
                    <span>Conversar com um Consultor</span>
                </a>
            </div>
        </div>
    </section>

@endsection
