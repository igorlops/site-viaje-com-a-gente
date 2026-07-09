@extends('layouts.site')

@section('title', 'Bate e Volta - Viaje com a Gente')

@section('content')

    <!-- SEÇÃO INTRODUTÓRIA + LISTAGEM DE PACOTES IMEDIATA -->
    <section class="py-16 bg-white copyright-watermark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Descrição Conceitual do Bate e Volta (Copy Inteligente) -->
            <div class="max-w-3xl mx-auto text-center mb-16">
                <span class="text-[#109e4a] text-xs font-black uppercase tracking-widest bg-[#109e4a]/10 px-4 py-1.5 rounded-full inline-block mb-4">
                    Conceito Bate e Volta
                </span>
                <h1 class="text-3xl sm:text-4xl font-black text-[#002752] tracking-tight mb-4">
                    Menos rotina. Mais destinos. Tudo em 24 horas.
                </h1>
                <p class="text-base text-gray-600 leading-relaxed">
                    O **Bate e Volta** é a pílula de escape para quem tem a rotina corrida, mas se recusa a passar o final de semana olhando para a parede. Uma viagem rápida, inteligente e revigorante: você embarca pela manhã em Fortaleza, vive um dia espetacular no litoral ou serra com tudo planejado, e volta a tempo de dormir no conforto da sua própria cama. **Sem precisar gastar com diárias de hotel ou pedir férias.**
                </p>
                <div class="w-24 h-1 bg-[#f3a908] mx-auto mt-6 rounded"></div>
            </div>

            <!-- Grid de Pacotes (Abaixo do texto, direto e dinâmico) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-4">
                @php
                    $whatsappUrl = isset($socialLinks['whatsapp']) ? $socialLinks['whatsapp']->url : 'https://wa.me/5585999166421';
                @endphp

                @foreach($destinations as $pkg)
                    <x-card-pacotes :pkg="$pkg" :whatsappUrl="$whatsappUrl" />
                @endforeach
            </div>
            
        </div>
    </section>

    <!-- INFRAESTRUTURA & SEGURANÇA -->
    <section class="py-20 bg-gray-50 border-t border-gray-100 copyright-watermark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-[#002752] uppercase tracking-tight">
                    Infraestrutura de Quem Sabe Fazer
                </h2>
                <p class="text-sm text-gray-500 mt-2">Segurança e conforto do início ao fim da sua jornada</p>
                <div class="w-16 h-1 bg-[#109e4a] mx-auto mt-4 rounded"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Info 1 -->
                <div class="bg-white rounded-xl p-6 border border-gray-100 text-center shadow-sm">
                    <div class="w-12 h-12 rounded-full bg-[#002752]/5 text-[#002752] flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-bus-alt text-xl"></i>
                    </div>
                    <h4 class="font-bold text-[#002752] mb-2 text-sm uppercase">Transporte de Turismo</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Veículos modernos (ônibus, micro-ônibus ou vans), higienizados, equipados com ar-condicionado e motoristas profissionais credenciados.
                    </p>
                </div>

                <!-- Info 2 -->
                <div class="bg-white rounded-xl p-6 border border-gray-100 text-center shadow-sm">
                    <div class="w-12 h-12 rounded-full bg-[#002752]/5 text-[#002752] flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-map-marked-alt text-xl"></i>
                    </div>
                    <h4 class="font-bold text-[#002752] mb-2 text-sm uppercase">Guia Credenciado</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Acompanhamento integral de guia de turismo bilíngue credenciado pelo Ministério do Turismo (CADASTUR) durante todo o passeio.
                    </p>
                </div>

                <!-- Info 3 -->
                <div class="bg-white rounded-xl p-6 border border-gray-100 text-center shadow-sm">
                    <div class="w-12 h-12 rounded-full bg-[#002752]/5 text-[#002752] flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-umbrella-beach text-xl"></i>
                    </div>
                    <h4 class="font-bold text-[#002752] mb-2 text-sm uppercase">Ponto de Apoio</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Paramos sempre em barracas de praia ou restaurantes parceiros estruturados com banheiros, chuveiros, armários e excelente gastronomia.
                    </p>
                </div>

                <!-- Info 4 -->
                <div class="bg-white rounded-xl p-6 border border-gray-100 text-center shadow-sm">
                    <div class="w-12 h-12 rounded-full bg-[#002752]/5 text-[#002752] flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <h4 class="font-bold text-[#002752] mb-2 text-sm uppercase">Embarque Facilitado</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Pontos de acesso inteligentes em Fortaleza (Avenida Beira Mar, aeroporto e hotéis) facilitando o seu acesso ao transporte.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SESSÃO: O CHECKLIST DO VIAJANTE INTELIGENTE (Quebra de Objeção) -->
    <section class="py-20 bg-white border-t border-gray-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-12">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#002752] uppercase tracking-tight">
                    Seu único trabalho é arrumar a mochila
                </h2>
                <p class="text-sm text-gray-500 mt-2">Veja como dividimos as tarefas para o seu dia ser perfeito</p>
                <div class="w-16 h-1 bg-[#109e4a] mx-auto mt-4 rounded"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Lado do Cliente -->
                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                    <h4 class="font-black text-sm text-gray-700 uppercase tracking-wide mb-4 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#f3a908]"></span> O que você traz:
                    </h4>
                    <ul class="space-y-3 text-xs text-gray-600 font-medium">
                        <li class="flex items-center gap-2"><i class="fas fa-check text-[#109e4a]"></i> Protetor solar e óculos de sol</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check text-[#109e4a]"></i> Roupa de banho e uma troca leve</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check text-[#109e4a]"></i> Celular carregado para as fotos</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check text-[#109e4a]"></i> Sorriso no rosto e mente aberta</li>
                    </ul>
                </div>

                <!-- Lado da Agência -->
                <div class="bg-[#109e4a]/5 rounded-2xl p-6 border border-[#109e4a]/20">
                    <h4 class="font-black text-sm text-[#002752] uppercase tracking-wide mb-4 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#109e4a]"></span> O que nós garantimos:
                    </h4>
                    <ul class="space-y-3 text-xs text-[#002752] font-semibold">
                        <li class="flex items-center gap-2"><i class="fas fa-shield-alt text-[#109e4a]"></i> Transporte com seguro viagem incluso</li>
                        <li class="flex items-center gap-2"><i class="fas fa-map-signs text-[#109e4a]"></i> Roteiro cronometrado para evitar filas</li>
                        <li class="flex items-center gap-2"><i class="fas fa-chair text-[#109e4a]"></i> Mesas reservadas na melhor barraca de apoio</li>
                        <li class="flex items-center gap-2"><i class="fas fa-user-check text-[#109e4a]"></i> Guia credenciado resolvendo toda a logística</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA FOOTER -->
    <section class="bg-[#f3a908] py-8 text-[#002752]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-6">
                <!-- Text -->
                <div class="text-center lg:text-left flex items-center gap-4 flex-col sm:flex-row">
                    <div class="w-14 h-14 rounded-full bg-white flex items-center justify-center text-[#109e4a] shrink-0 shadow-sm">
                        <i class="fab fa-whatsapp text-3xl"></i>
                    </div>
                    <div>
                        <span class="block text-lg font-black uppercase tracking-wide">Quer fugir da rotina no próximo fim de semana?</span>
                        <span class="block text-sm font-medium">Escolha seu destino e chame nossa equipe agora mesmo!</span>
                    </div>
                </div>
                
                <!-- Button -->
                <a href="{{ $whatsappUrl }}" target="_blank" class="bg-[#109e4a] hover:bg-[#0d9648] text-white px-8 py-3.5 rounded-lg font-black text-sm tracking-wider uppercase transition duration-300 shadow-md flex items-center gap-3 shrink-0">
                    <i class="fab fa-whatsapp text-2xl"></i>
                    <span>Escolher Destino</span>
                </a>
            </div>
        </div>
    </section>

@endsection