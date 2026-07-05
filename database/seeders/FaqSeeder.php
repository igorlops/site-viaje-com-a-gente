<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Como funciona o parcelamento no boleto bancário?',
                'answer' => 'Nosso parcelamento no boleto não exige consulta ao SPC ou Serasa e não consome o limite do seu cartão de crédito. Você pode parcelar o valor total da viagem em boletos mensais fixos, sendo que a última parcela deve ser obrigatoriamente quitada em até 15 dias antes da data do embarque. É a forma ideal de planejar suas férias com antecedência e saúde financeira.',
                'order' => 1,
            ],
            [
                'question' => 'Quais documentos são obrigatórios para o embarque?',
                'answer' => 'Para voos nacionais, é obrigatório apresentar um documento oficial de identidade com foto (RG, CNH, Passaporte ou Carteira de Trabalho física) em bom estado e dentro da validade. Para destinos internacionais no Mercosul, você pode embarcar portando apenas o RG original (emitido há menos de 10 anos) ou Passaporte válido. Para demais destinos no exterior, o Passaporte com validade mínima de 6 meses é obrigatório, além de eventuais vistos consulares exigidos pelo país de destino.',
                'order' => 2,
            ],
            [
                'question' => 'O que está incluso nos pacotes de viagem da agência?',
                'answer' => 'A cobertura exata varia por pacote. Normalmente, nossos pacotes completos incluem passagens aéreas de ida e volta (com franquia de bagagem de mão inclusa), hospedagem em hotéis ou resorts selecionados com café da manhã, taxas de embarque inclusas e passeios locais guiados indicados no itinerário. Detalhes específicos de inclusões e exclusões de cada destino estão descritos na página do pacote ou no contrato de viagem.',
                'order' => 3,
            ],
            [
                'question' => 'Posso realizar alterações ou cancelar minha viagem?',
                'answer' => 'Sim. Cancelamentos ou alterações de datas são possíveis e seguem as regras de multas contratuais e políticas das companhias aéreas e hotéis parceiros. Como trabalhamos com tarifas promocionais e de grupo, recomendamos planejar suas datas com atenção e ler as cláusulas de cancelamento no contrato de prestação de serviços.',
                'order' => 4,
            ],
            [
                'question' => 'As viagens em grupo contam com guia de turismo acompanhante?',
                'answer' => 'Sim! Todas as nossas saídas classificadas como "Viagens em Grupo" contam com o acompanhamento de um guia de turismo credenciado da agência desde o embarque no aeroporto de Fortaleza até o encerramento do roteiro e retorno. O guia coordena os passeios, check-ins e dá todo o suporte necessário ao grupo.',
                'order' => 5,
            ],
            [
                'question' => 'Quais são as formas de pagamento disponíveis?',
                'answer' => 'Aceitamos pagamentos de forma facilitada: PIX (com desconto à vista), cartão de crédito em até 12x (consulte taxas aplicáveis) ou o nosso boleto bancário parcelado sem burocracia.',
                'order' => 6,
            ],
            [
                'question' => 'Qual a antecedência ideal para reservar um pacote?',
                'answer' => 'Recomendamos realizar a reserva de pacotes aéreos com antecedência mínima de 4 a 6 meses. Isso garante tarifas aéreas muito mais econômicas, maior disponibilidade de hotéis de alto padrão e permite um prazo de parcelamento no boleto muito mais suave e estendido.',
                'order' => 7,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(
                ['question' => $faq['question']],
                $faq
            );
        }
    }
}
