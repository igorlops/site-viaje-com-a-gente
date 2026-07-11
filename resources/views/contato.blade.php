@extends('layouts.site')

@section('title', 'Fale Conosco - Viaje com a Gente')

@section('content')

    @if($ctaSession = $cta_session->firstWhere('order_position', 1))
        <x-cta-session :cta="$ctaSession" />
    @endif

    <!-- CONTACT CONTAINER SECTION -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
                
                <!-- LEFT COLUMN: CONTACT INFRASTRUCTURE -->
                <div class="lg:col-span-5 flex flex-col justify-between">
                    <div>
                        <div class="inline-flex items-center justify-center gap-2 mb-2 text-[#002752] uppercase font-black tracking-widest text-xs">
                            <span>Canais de Atendimento</span>
                            <span class="w-2 h-2 rounded-full bg-[#109e4a]"></span>
                        </div>
                        <h2 class="text-3xl font-extrabold text-[#002752] mb-6 leading-tight">
                            Estamos prontos para ouvir você
                        </h2>
                        <p class="text-gray-500 text-sm leading-relaxed mb-8">
                            Nossos consultores prestam atendimento humanizado e detalhado. Escolha a melhor forma de se comunicar conosco ou envie uma mensagem ao lado.
                        </p>

                        <!-- Contact Channels List -->
                        <div class="space-y-6">
                            <!-- WhatsApp Channel -->
                            @php
                                $whatsappUrl = isset($socialLinks['whatsapp']) ? $socialLinks['whatsapp']->url : 'https://wa.me/5585999166421';
                            @endphp
                            <a href="{{ $whatsappUrl }}" target="_blank" class="flex items-start gap-4 p-4 rounded-xl border border-gray-100 hover:border-[#109e4a]/30 hover:bg-[#109e4a]/5 transition duration-300 group">
                                <div class="w-10 h-10 rounded-lg bg-[#109e4a]/10 text-[#109e4a] flex items-center justify-center shrink-0 group-hover:bg-[#109e4a] group-hover:text-white transition duration-300">
                                    <i class="fab fa-whatsapp text-xl"></i>
                                </div>
                                <div>
                                    <span class="block text-xs font-bold uppercase tracking-wider text-gray-400">WhatsApp Comercial</span>
                                    <span class="block text-base font-bold text-[#002752]">(85) 9 9916-6421</span>
                                    <span class="block text-xs text-gray-400 mt-0.5">Clique para iniciar uma conversa imediata</span>
                                </div>
                            </a>

                            <!-- Email Channel -->
                            <div class="flex items-start gap-4 p-4 rounded-xl border border-gray-100">
                                <div class="w-10 h-10 rounded-lg bg-[#002752]/5 text-[#002752] flex items-center justify-center shrink-0">
                                    <i class="far fa-envelope text-lg"></i>
                                </div>
                                <div>
                                    <span class="block text-xs font-bold uppercase tracking-wider text-gray-400">E-mail de Suporte</span>
                                    <span class="block text-base font-bold text-[#002752] break-all">atendimento@viajecomagente.com.br</span>
                                    <span class="block text-xs text-gray-400 mt-0.5">Respondemos suas solicitações em até 24h</span>
                                </div>
                            </div>

                            <!-- Operating Hours -->
                            <div class="flex items-start gap-4 p-4 rounded-xl border border-gray-100">
                                <div class="w-10 h-10 rounded-lg bg-[#002752]/5 text-[#002752] flex items-center justify-center shrink-0">
                                    <i class="far fa-clock text-lg"></i>
                                </div>
                                <div>
                                    <span class="block text-xs font-bold uppercase tracking-wider text-gray-400">Horário de Atendimento</span>
                                    <span class="block text-sm font-semibold text-[#002752]">Segunda a Sexta: 08h às 18h</span>
                                    <span class="block text-sm font-semibold text-[#002752]">Sábado: 09h às 13h</span>
                                    <span class="block text-xs text-gray-400 mt-0.5">Exceto feriados nacionais e estaduais</span>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="flex items-start gap-4 p-4 rounded-xl border border-gray-100">
                                <div class="w-10 h-10 rounded-lg bg-[#002752]/5 text-[#002752] flex items-center justify-center shrink-0">
                                    <i class="fas fa-map-marker-alt text-lg"></i>
                                </div>
                                <div>
                                    <span class="block text-xs font-bold uppercase tracking-wider text-gray-400">Escritório de Atendimento</span>
                                    <span class="block text-sm font-semibold text-[#002752]">Fortaleza - Ceará</span>
                                    <span class="block text-xs text-gray-400 mt-0.5">Atendimento presencial mediante agendamento</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- RIGHT COLUMN: CONTACT FORM -->
                <div class="lg:col-span-7 bg-gray-50 rounded-2xl p-6 sm:p-10 border border-gray-100 shadow-sm">
                    <h3 class="text-xl font-bold text-[#002752] mb-6">Envie uma Mensagem</h3>

                    <!-- Success Alert -->
                    @if(session('success'))
                        <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 rounded-lg mb-6 shadow-sm flex items-start gap-3">
                            <i class="fas fa-check-circle text-green-500 text-lg mt-0.5 shrink-0"></i>
                            <div>
                                <span class="font-bold block text-sm">Mensagem Enviada!</span>
                                <span class="text-xs">{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    <!-- Validation Errors Alert -->
                    @if($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 rounded-lg mb-6 shadow-sm">
                            <div class="flex items-start gap-3 mb-2">
                                <i class="fas fa-exclamation-triangle text-red-500 text-lg mt-0.5 shrink-0"></i>
                                <span class="font-bold text-sm">Ops! Verifique os erros abaixo:</span>
                            </div>
                            <ul class="list-disc pl-5 text-xs space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Contact Form -->
                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                        @csrf

                        <!-- Name field -->
                        <div>
                            <label for="name" class="block text-xs font-bold uppercase tracking-wider text-[#002752] mb-1.5">Nome Completo</label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                value="{{ old('name') }}" 
                                placeholder="Seu nome"
                                required
                                class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-white text-gray-800 text-sm focus:border-[#002752] focus:ring-2 focus:ring-[#002752]/10 transition duration-200 placeholder-gray-400 outline-none"
                            >
                        </div>

                        <!-- Email & Phone fields Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-[#002752] mb-1.5">E-mail</label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    id="email" 
                                    value="{{ old('email') }}" 
                                    placeholder="seuemail@exemplo.com"
                                    required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-white text-gray-800 text-sm focus:border-[#002752] focus:ring-2 focus:ring-[#002752]/10 transition duration-200 placeholder-gray-400 outline-none"
                                >
                            </div>
                            <div>
                                <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-[#002752] mb-1.5">Telefone / WhatsApp</label>
                                <input 
                                    type="text" 
                                    name="phone" 
                                    id="phone" 
                                    value="{{ old('phone') }}" 
                                    placeholder="(85) 99999-9999"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-white text-gray-800 text-sm focus:border-[#002752] focus:ring-2 focus:ring-[#002752]/10 transition duration-200 placeholder-gray-400 outline-none"
                                >
                            </div>
                        </div>

                        <!-- Message field -->
                        <div>
                            <label for="message" class="block text-xs font-bold uppercase tracking-wider text-[#002752] mb-1.5">Mensagem</label>
                            <textarea 
                                name="message" 
                                id="message" 
                                rows="5" 
                                placeholder="Conte-nos sobre o destino desejado, número de passageiros ou qualquer dúvida..."
                                required
                                class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-white text-gray-800 text-sm focus:border-[#002752] focus:ring-2 focus:ring-[#002752]/10 transition duration-200 placeholder-gray-400 outline-none resize-none"
                            >{{ old('message') }}</textarea>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button 
                                type="submit" 
                                class="w-full bg-[#002752] hover:bg-[#f3a908] hover:text-[#002752] text-white py-4 px-6 rounded-lg font-black text-sm tracking-wide uppercase transition duration-300 shadow-md cursor-pointer hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-[#002752]/25"
                            >
                                Enviar Mensagem
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @if($ctaSession = $cta_session->firstWhere('order_position', 2))
        <x-cta-session :cta="$ctaSession" />
    @endif

    @if($ctaSession = $cta_session->firstWhere('order_position', 3))
        <x-cta-session :cta="$ctaSession" />
    @endif

@endsection
