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
            @foreach($faqs as $index => $faq)
                <!-- Accordion Item -->
                <div class="border border-gray-150 rounded-xl bg-white overflow-hidden shadow-sm transition duration-200 faq-item">
                    <!-- Header Button -->
                    <button type="button" class="w-full text-left py-5 px-6 font-bold text-[#002752] flex justify-between items-center bg-white hover:bg-gray-50 focus:outline-none transition duration-200 cursor-pointer select-none faq-trigger">
                        <span>{{ $faq->question }}</span>
                        <!-- SVG Chevron Icon -->
                        <svg class="w-5 h-5 text-[#109e4a] transition-transform duration-300 transform faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <!-- Content Panel -->
                    <div class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out opacity-0 faq-panel">
                        <div class="px-6 pb-5 text-gray-500 text-sm leading-relaxed border-t border-gray-50 pt-4 bg-gray-50/50">
                            {{ $faq->answer }}
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
