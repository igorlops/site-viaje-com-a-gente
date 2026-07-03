@extends('layouts.site')

@section('title', 'Dúvidas Frequentes - Viaje com a Gente')

@section('content')


<!-- FAQ SECTION -->
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center justify-center gap-2 mb-2 text-[#002752] uppercase font-black tracking-widest text-sm">
                <span>Central de Ajuda</span>
                <i class="fas fa-question-circle text-[#109e4a]"></i>
            </div>
            <h2 class="text-3xl font-extrabold text-[#002752] tracking-tight">
                Como podemos te ajudar hoje?
            </h2>
            <div class="w-16 h-1 bg-[#109e4a] mx-auto mt-4 rounded"></div>
        </div>

        <!-- Accordion Container -->
        <div class="space-y-4">
            @php
                $faqs = [
                    [
                        'question' => 'Como funciona o parcelamento no boleto bancário?',
                        'answer' => 'Nosso parcelamento no boleto não exige consulta ao SPC ou Serasa e não consome o limite do seu cartão de crédito. Você pode parcelar o valor total da viagem em boletos mensais fixos, sendo que a última parcela deve ser obrigatoriamente quitada em até 15 dias antes da data do embarque. É a forma ideal de planejar suas férias com antecedência e saúde financeira.'
                    ],
                    [
                        'question' => 'Quais documentos são obrigatórios para o embarque?',
                        'answer' => 'Para voos nacionais, é obrigatório apresentar um documento oficial de identidade com foto (RG, CNH, Passaporte ou Carteira de Trabalho física) em bom estado e dentro da validade. Para destinos internacionais no Mercosul, você pode embarcar portando apenas o RG original (emitido há menos de 10 anos) ou Passaporte válido. Para demais destinos no exterior, o Passaporte com validade mínima de 6 meses é obrigatório, além de eventuais vistos consulares exigidos pelo país de destino.'
                    ],
                    [
                        'question' => 'O que está incluso nos pacotes de viagem da agência?',
                        'answer' => 'A cobertura exata varia por pacote. Normalmente, nossos pacotes completos incluem passagens aéreas de ida e volta (com franquia de bagagem de mão inclusa), hospedagem em hotéis ou resorts selecionados com café da manhã, taxas de embarque inclusas e passeios locais guiados indicados no itinerário. Detalhes específicos de inclusões e exclusões de cada destino estão descritos na página do pacote ou no contrato de viagem.'
                    ],
                    [
                        'question' => 'Posso realizar alterações ou cancelar minha viagem?',
                        'answer' => 'Sim. Cancelamentos ou alterações de datas são possíveis e seguem as regras de multas contratuais e políticas das companhias aéreas e hotéis parceiros. Como trabalhamos com tarifas promocionais e de grupo, recomendamos planejar suas datas com atenção e ler as cláusulas de cancelamento no contrato de prestação de serviços.'
                    ],
                    [
                        'question' => 'As viagens em grupo contam com guia de turismo acompanhante?',
                        'answer' => 'Sim! Todas as nossas saídas classificadas como "Viagens em Grupo" contam com o acompanhamento de um guia de turismo credenciado da agência desde o embarque no aeroporto de Fortaleza até o encerramento do roteiro e retorno. O guia coordena os passeios, check-ins e dá todo o suporte necessário ao grupo.'
                    ],
                    [
                        'question' => 'Quais são as formas de pagamento disponíveis?',
                        'answer' => 'Aceitamos pagamentos de forma facilitada: PIX (com desconto à vista), cartão de crédito em até 12x (consulte taxas aplicáveis) ou o nosso boleto bancário parcelado sem burocracia.'
                    ],
                    [
                        'question' => 'Qual a antecedência ideal para reservar um pacote?',
                        'answer' => 'Recomendamos realizar a reserva de pacotes aéreos com antecedência mínima de 4 a 6 meses. Isso garante tarifas aéreas muito mais econômicas, maior disponibilidade de hotéis de alto padrão e permite um prazo de parcelamento no boleto muito mais suave e estendido.'
                    ]
                ];
            @endphp

            @foreach($faqs as $index => $faq)
                <!-- Accordion Item -->
                <div class="border border-gray-150 rounded-xl bg-white overflow-hidden shadow-sm transition duration-200 faq-item">
                    <!-- Header Button -->
                    <button type="button" class="w-full text-left py-5 px-6 font-bold text-[#002752] flex justify-between items-center bg-white hover:bg-gray-50 focus:outline-none transition duration-200 cursor-pointer select-none faq-trigger">
                        <span>{{ $faq['question'] }}</span>
                        <!-- SVG Chevron Icon -->
                        <svg class="w-5 h-5 text-[#109e4a] transition-transform duration-300 transform faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <!-- Content Panel -->
                    <div class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out opacity-0 faq-panel">
                        <div class="px-6 pb-5 text-gray-500 text-sm leading-relaxed border-t border-gray-50 pt-4 bg-gray-50/50">
                            {{ $faq['answer'] }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ACCORDION JAVASCRIPT -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const triggers = document.querySelectorAll('.faq-trigger');

        triggers.forEach(trigger => {
            trigger.addEventListener('click', function() {
                const item = this.closest('.faq-item');
                const panel = item.querySelector('.faq-panel');
                const icon = this.querySelector('.faq-icon');
                const isOpen = item.classList.contains('is-open');

                // Close other open panels first (Optional accordion behavior, very clean and premium)
                document.querySelectorAll('.faq-item').forEach(otherItem => {
                    if (otherItem !== item && otherItem.classList.contains('is-open')) {
                        otherItem.classList.remove('is-open');
                        otherItem.querySelector('.faq-panel').style.maxHeight = '0px';
                        otherItem.querySelector('.faq-panel').style.opacity = '0';
                        otherItem.querySelector('.faq-icon').classList.remove('rotate-180');
                    }
                });

                // Toggle current item
                if (isOpen) {
                    item.classList.remove('is-open');
                    panel.style.maxHeight = '0px';
                    panel.style.opacity = '0';
                    icon.classList.remove('rotate-180');
                } else {
                    item.classList.add('is-open');
                    panel.style.maxHeight = panel.scrollHeight + 'px';
                    panel.style.opacity = '1';
                    icon.classList.add('rotate-180');
                }
            });
        });
    });
</script>

<!-- CTA FOOTER -->
<section class="bg-[#f3a908] py-12 text-[#002752]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
            <!-- Text block -->
            <div class="text-center lg:text-left">
                <span class="block text-lg font-black uppercase tracking-wide">Ainda tem alguma dúvida específica?</span>
                <span class="block text-sm font-medium opacity-90">Fale agora mesmo com nossos consultores e tenha um atendimento 100% humano!</span>
            </div>
            
            <!-- Action Button -->
            @php
                $whatsappUrl = isset($socialLinks['whatsapp']) ? $socialLinks['whatsapp']->url : 'https://wa.me/5585999166421';
            @endphp
            <a href="{{ $whatsappUrl }}" target="_blank" class="bg-[#109e4a] hover:bg-[#0d9648] text-white px-8 py-4 rounded-lg font-black text-sm tracking-wider uppercase transition duration-300 shadow-md flex items-center gap-3 shrink-0">
                <i class="fab fa-whatsapp text-2xl"></i>
                <span>Chamar no WhatsApp</span>
            </a>
        </div>
    </div>
</section>

@endsection
