<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ViagemEmGrupoDestinationSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $now = Carbon::now();

        $destinations = [
            [
                'id'                => 8,
                'title'             => 'GRAMADO + CANELA',
                'subtitle'          => 'Roteiro completo pela Serra Gaúcha com hospedagem, passeios e jantares inclusos.',
                'text_label_banner' => 'Viva a magia da Serra Gaúcha com um pacote completo que une o charme de Gramado e a rusticidade de Canela.',
                'title_card'        => 'Gramado + Canela',
                'subtitle_card'     => 'Serra Gaúcha',
                'price'             => 189.90,
                'full_price'        => 'R$ 3.290',
                'duration'          => '5',
                'nights'            => '4',
                'date_range'        => '15 a 19 de Agosto 2026',
                'departure_date'    => '15 de Agosto 2026',
                'return_date'       => '19 de Agosto 2026',
                'departure_city'    => 'Fortaleza - CE',
                'trip_type'         => 'Viagem em grupo',
                'category'          => 'AÉREO + HOTEL + PASSEIOS',
                'tag'               => 'MAIS VENDIDO',
                'slug'              => 'gramado-canela-serra-gaucha',
                'highlights_icons'  => ['hotel', 'plane', 'utensils', 'camera'],
                'type'              => 'viagem-em-grupo',
                'is_featured'       => 1,
                'whatsapp_link'     => null,
                'image_path'        => 'destinations/gramado.png',
                'banner_image_path' => 'destinations/gramado.png',
                'includes'          => [
                    'Passagem aérea Fortaleza x Porto Alegre x Fortaleza',
                    '4 diárias no hotel com café da manhã',
                    'Transfer aeroporto x hotel x aeroporto',
                    'City tour por Gramado e Canela',
                    'Passeio a Nova Petrópolis',
                    'Jantar colonial incluso',
                    'Guia local durante todo o roteiro',
                    'Seguro viagem básico',
                ],
                'highlights'        => [
                    ['title' => 'Rua Coberta de Gramado', 'subtitle' => 'Coração da cidade com lojas, restaurantes e o famoso chocolate artesanal.', 'image_path' => 'destinations/gramado.png'],
                    ['title' => 'Canela e a Catedral', 'subtitle' => 'A belíssima Catedral de Pedra e a fábrica de chocolate mais famosa do Brasil.', 'image_path' => 'destinations/gramado.png'],
                ],
                'observations'      => [
                    ['text' => 'Crianças até 5 anos não pagam hospedagem (indo no colo dos responsáveis). De 6 a 11 anos: desconto de 50%.'],
                    ['text' => 'Aceitamos PIX, cartão de crédito em até 12x sem juros e boleto bancário.'],
                    ['text' => 'Vagas limitadas — garanta já a sua! As reservas encerram quando esgotadas.'],
                ],
                'itinerary_days'    => [
                    [
                        'day_number' => 1,
                        'date'       => '15 de Agosto 2026',
                        'label'      => 'Dia 1: Chegada em Porto Alegre e transfer para Gramado',
                        'activities' => [
                            'Embarque no Aeroporto de Fortaleza/CE',
                            'Chegada no Aeroporto de Porto Alegre/RS',
                            'Transfer para Gramado (≈ 2h de viagem)',
                            'Check-in no hotel',
                            'Noite livre para passeio na Rua Coberta',
                        ],
                    ],
                    [
                        'day_number' => 2,
                        'date'       => '16 de Agosto 2026',
                        'label'      => 'Dia 2: Passeios em Gramado',
                        'activities' => [
                            'Café da manhã no hotel',
                            'Passeio ao Lago Negro e Trilha do Lago',
                            'Visita à Rua Coberta e ao Mini Mundo',
                            'Almoço livre em Gramado',
                            'Passeio a Cascata do Caracol',
                            'Jantar colonial incluso à noite',
                        ],
                    ],
                    [
                        'day_number' => 3,
                        'date'       => '17 de Agosto 2026',
                        'label'      => 'Dia 3: Canela e Nova Petrópolis',
                        'activities' => [
                            'Café da manhã no hotel',
                            'Transfer para Canela',
                            'Visita à Catedral de Pedra',
                            'Passeio à fábrica de chocolate e à Casa do Pão de Queijo',
                            'Almoço típico gaúcho incluso',
                            'Retorno a Gramado com parada em Nova Petrópolis',
                            'Noite livre',
                        ],
                    ],
                    [
                        'day_number' => 4,
                        'date'       => '18 de Agosto 2026',
                        'label'      => 'Dia 4: Passeios opcionais e tempo livre',
                        'activities' => [
                            'Café da manhã no hotel',
                            'Manhã livre para compras ou passeios opcionais',
                            'Almoço livre',
                            'Passeio ao Parque do Caracol e ao Parque Estadual de Itiquira',
                            'Noite livre para curtir a noite de Gramado',
                        ],
                    ],
                    [
                        'day_number' => 5,
                        'date'       => '19 de Agosto 2026',
                        'label'      => 'Dia 5: Retorno para Fortaleza',
                        'activities' => [
                            'Café da manhã no hotel',
                            'Check-out no hotel',
                            'Transfer para Porto Alegre',
                            'Embarque no Aeroporto de Porto Alegre/RS',
                            'Desembarque no Aeroporto de Fortaleza/CE',
                        ],
                    ],
                ],
            ],
            [
                'id'                => 9,
                'title'             => 'FOZ DO IGUAÇU + ARGENTINA',
                'subtitle'          => 'Roteiro internacional com as Cataratas do Iguaçu, Puerto Iguazú e o famoso Comércio da República Argentina.',
                'text_label_banner' => 'Uma viagem inesquecível que une o espetáculo das Cataratas do Iguaçu à experiência cultural de Puerto Iguazú.',
                'title_card'        => 'Foz + Argentina',
                'subtitle_card'     => 'Cataratas e Cultura',
                'price'             => 249.90,
                'full_price'        => 'R$ 4.150',
                'duration'          => '6',
                'nights'            => '5',
                'date_range'        => '10 a 15 de Setembro 2026',
                'departure_date'    => '10 de Setembro 2026',
                'return_date'       => '15 de Setembro 2026',
                'departure_city'    => 'Fortaleza - CE',
                'trip_type'         => 'Viagem em grupo',
                'category'          => 'AÉREO + HOTEL + PASSEIOS',
                'tag'               => 'INTERNACIONAL',
                'slug'              => 'foz-do-iguacu-argentina',
                'highlights_icons'  => ['hotel', 'plane', 'ticket-alt', 'camera'],
                'type'              => 'viagem-em-grupo',
                'is_featured'       => 1,
                'whatsapp_link'     => null,
                'image_path'        => 'destinations/foz.png',
                'banner_image_path' => 'destinations/foz.png',
                'includes'          => [
                    'Passagem aérea Fortaleza x Foz do Iguaçu x Fortaleza',
                    '5 diárias em hotel 3 estrelas com café da manhã',
                    'Transfer aeroporto x hotel x aeroporto',
                    'Passeio às Cataratas do Iguaçu (lado brasileiro)',
                    'Passeio às Cataratas do Iguaçu (lado argentino)',
                    'Passeio à Garganta do Diabo',
                    'City tour por Puerto Iguazú',
                    'Jantar internacional incluso',
                    'Guia local bilíngue',
                    'Seguro viagem internacional',
                ],
                'highlights'        => [
                    ['title' => 'Cataratas do Iguaçu', 'subtitle' => 'Uma das 7 Maravilhas Naturais do Mundo, com 275 quedas d\'água impressionantes.', 'image_path' => 'destinations/foz.png'],
                    ['title' => 'Puerto Iguazú', 'subtitle' => 'Cidade fronteiriça com charme argentino, artesanato e gastronomia inesquecível.', 'image_path' => 'destinations/foz.png'],
                ],
                'observations'      => [
                    ['text' => 'Crianças até 5 anos não pagam (indo no colo dos responsáveis). De 6 a 11 anos: desconto de 50%.'],
                    ['text' => 'Aceitamos PIX, cartão de crédito em até 10x sem juros e boleto bancário.'],
                    ['text' => 'Passaporte e/ou RG válido obrigatório para entrada na Argentina. Vagas limitadas!'],
                ],
                'itinerary_days'    => [
                    [
                        'day_number' => 1,
                        'date'       => '10 de Setembro 2026',
                        'label'      => 'Dia 1: Chegada em Foz do Iguaçu',
                        'activities' => [
                            'Embarque no Aeroporto de Fortaleza/CE',
                            'Chegada no Aeroporto de Foz do Iguaçu/PR',
                            'Transfer para o hotel',
                            'Check-in no hotel',
                            'Noite livre para passeio na Avenida Brasil',
                        ],
                    ],
                    [
                        'day_number' => 2,
                        'date'       => '11 de Setembro 2026',
                        'label'      => 'Dia 2: Cataratas do Iguaçu (Lado Brasileiro)',
                        'activities' => [
                            'Café da manhã no hotel',
                            'Passeio ao Parque Nacional do Iguaçu (lado brasileiro)',
                            'Trilha pelas passarelas até a Garganta do Diabo',
                            'Almoço no parque',
                            'Retorno ao hotel',
                            'Noite livre',
                        ],
                    ],
                    [
                        'day_number' => 3,
                        'date'       => '12 de Setembro 2026',
                        'label'      => 'Dia 3: Cataratas do Iguaçu (Lado Argentino)',
                        'activities' => [
                            'Café da manhã no hotel',
                            'Transfer para a fronteira e entrada na Argentina',
                            'Passeio ao Parque Nacional Iguazú (lado argentino)',
                            'Passeio de barco até as Cataratas',
                            'Almoço em Puerto Iguazú',
                            'City tour por Puerto Iguazú',
                            'Retorno ao hotel',
                            'Jantar internacional incluso',
                        ],
                    ],
                    [
                        'day_number' => 4,
                        'date'       => '13 de Setembro 2026',
                        'label'      => 'Dia 4: Dia livre e passeios opcionais',
                        'activities' => [
                            'Café da manhã no hotel',
                            'Manhã livre para compras ou passeios opcionais',
                            'Passeio ao Parque das Aves (opcional)',
                            'Almoço livre',
                            'Noite livre para explorar a região',
                        ],
                    ],
                    [
                        'day_number' => 5,
                        'date'       => '14 de Setembro 2026',
                        'label'      => 'Dia 5: Passeio a Usina de Itaipu e retorno',
                        'activities' => [
                            'Café da manhã no hotel',
                            'Passeio à Usina Hidrelétrica de Itaipu',
                            'Almoço livre',
                            'Retorno ao hotel para check-out',
                            'Transfer para o aeroporto',
                            'Embarque no Aeroporto de Foz do Iguaçu/PR',
                        ],
                    ],
                    [
                        'day_number' => 6,
                        'date'       => '15 de Setembro 2026',
                        'label'      => 'Dia 6: Desembarque em Fortaleza',
                        'activities' => [
                            'Desembarque no Aeroporto de Fortaleza/CE',
                            'Fim dos serviços',
                        ],
                    ],
                ],
            ],
            [
                'id'                => 10,
                'title'             => 'SALVADOR + ILHÉUS',
                'subtitle'          => 'Roteiro completo pela Bahia com praias, cultura e gastronomia típica.',
                'text_label_banner' => 'Descubra a magia da Bahia com um pacote completo que une o calor de Salvador à tranquilidade de Ilhéus.',
                'title_card'        => 'Salvador + Ilhéus',
                'subtitle_card'     => 'Bahia Completa',
                'price'             => 179.90,
                'full_price'        => 'R$ 2.890',
                'duration'          => '5',
                'nights'            => '4',
                'date_range'        => '20 a 24 de Outubro 2026',
                'departure_date'    => '20 de Outubro 2026',
                'return_date'       => '24 de Outubro 2026',
                'departure_city'    => 'Fortaleza - CE',
                'trip_type'         => 'Viagem em grupo',
                'category'          => 'AÉREO + HOTEL + PASSEIOS',
                'tag'               => 'LANÇAMENTO',
                'slug'              => 'salvador-ilheus-bahia',
                'highlights_icons'  => ['hotel', 'plane', 'utensils', 'ship'],
                'type'              => 'viagem-em-grupo',
                'is_featured'       => 1,
                'whatsapp_link'     => null,
                'image_path'        => 'destinations/salvador.png',
                'banner_image_path' => 'destinations/salvador.png',
                'includes'          => [
                    'Passagem aérea Fortaleza x Salvador x Ilhéus x Fortaleza',
                    '4 diárias em hotel 3 estrelas com café da manhã',
                    'Transfer aeroporto x hotel x aeroporto',
                    'City tour por Salvador (Pelourinho e Mercado Modelo)',
                    'Passeio de escuna pela Baía de Todos os Santos',
                    'Passeio a Praia do Forte',
                    'Jantar baiano incluso',
                    'Guia local durante todo o roteiro',
                    'Seguro viagem básico',
                ],
                'highlights'        => [
                    ['title' => 'Pelourinho', 'subtitle' => 'Centro histórico de Salvador com igrejas coloniais, cores vibrantes e cultura afro-baiana.', 'image_path' => 'destinations/salvador.png'],
                    ['title' => 'Praia do Forte', 'subtitle' => 'Praia paradisíaca com piscinas naturais e o famoso Projeto Tamar.', 'image_path' => 'destinations/salvador.png'],
                ],
                'observations'      => [
                    ['text' => 'Crianças até 5 anos não pagam hospedagem (indo no colo dos responsáveis). De 6 a 11 anos: desconto de 50%.'],
                    ['text' => 'Aceitamos PIX, cartão de crédito em até 10x sem juros e boleto bancário.'],
                    ['text' => 'Vagas limitadas — garanta já a sua! As reservas encerram quando esgotadas.'],
                ],
                'itinerary_days'    => [
                    [
                        'day_number' => 1,
                        'date'       => '20 de Outubro 2026',
                        'label'      => 'Dia 1: Chegada em Salvador',
                        'activities' => [
                            'Embarque no Aeroporto de Fortaleza/CE',
                            'Chegada no Aeroporto de Salvador/BA',
                            'Transfer para o hotel',
                            'Check-in no hotel',
                            'Noite livre para passeio no Pelourinho',
                        ],
                    ],
                    [
                        'day_number' => 2,
                        'date'       => '21 de Outubro 2026',
                        'label'      => 'Dia 2: City tour por Salvador',
                        'activities' => [
                            'Café da manhã no hotel',
                            'City tour pelo Pelourinho e Igreja de São Francisco',
                            'Visita ao Mercado Modelo',
                            'Almoço típico baiano incluso',
                            'Passeio de escuna pela Baía de Todos os Santos',
                            'Noite livre',
                        ],
                    ],
                    [
                        'day_number' => 3,
                        'date'       => '22 de Outubro 2026',
                        'label'      => 'Dia 3: Praia do Forte',
                        'activities' => [
                            'Café da manhã no hotel',
                            'Passeio a Praia do Forte (≈ 1h de Salvador)',
                            'Visita ao Projeto Tamar',
                            'Almoço livre em Praia do Forte',
                            'Retorno a Salvador',
                            'Noite livre',
                        ],
                    ],
                    [
                        'day_number' => 4,
                        'date'       => '23 de Outubro 2026',
                        'label'      => 'Dia 4: Transfer para Ilhéus e praias',
                        'activities' => [
                            'Café da manhã no hotel',
                            'Transfer para Ilhéus',
                            'Check-in na pousada',
                            'Praia de Olivença',
                            'Almoço típico de frutos do mar incluso',
                            'Passeio pelo centro histórico de Ilhéus',
                            'Noite livre',
                        ],
                    ],
                    [
                        'day_number' => 5,
                        'date'       => '24 de Outubro 2026',
                        'label'      => 'Dia 5: Retorno para Fortaleza',
                        'activities' => [
                            'Café da manhã na pousada',
                            'Check-out na pousada',
                            'Transfer para o aeroporto de Ilhéus',
                            'Embarque no Aeroporto de Ilhéus/BA',
                            'Desembarque no Aeroporto de Fortaleza/CE',
                        ],
                    ],
                ],
            ],
        ];

        foreach ($destinations as $dest) {
            // 1. Inserir destino
            $destinationData = [
                'id'                 => $dest['id'],
                'title'              => $dest['title'],
                'subtitle'           => $dest['subtitle'],
                'description'        => $dest['text_label_banner'],
                'title_card'         => $dest['title_card'],
                'subtitle_card'      => $dest['subtitle_card'],
                'slug'               => $dest['slug'],
                'type'               => $dest['type'],
                'duration'           => $dest['duration'],
                'category'           => $dest['category'],
                'price'              => $dest['price'],
                'full_price'         => $dest['full_price'],
                'date_range'         => $dest['date_range'],
                'nights'             => $dest['nights'],
                'departure_date'     => $dest['departure_date'],
                'return_date'        => $dest['return_date'],
                'departure_city'     => $dest['departure_city'],
                'trip_type'          => $dest['trip_type'],
                'tag'                => $dest['tag'],
                'highlights_icons'   => isset($dest['highlights_icons']) ? json_encode($dest['highlights_icons']) : null,
                'image_path'         => $dest['image_path'],
                'banner_image_path'  => $dest['banner_image_path'],
                'whatsapp_link'      => $dest['whatsapp_link'],
                'is_featured'        => $dest['is_featured'],
                'created_at'         => $now,
                'updated_at'         => $now,
            ];

            DB::table('destinations')->updateOrInsert(['id' => $dest['id']], $destinationData);

            // 2. Incluir
            DB::table('destination_includes')->where('destination_id', $dest['id'])->delete();
            $includesToInsert = [];
            foreach ($dest['includes'] as $index => $includeText) {
                $includesToInsert[] = [
                    'destination_id' => $dest['id'],
                    'text'           => $includeText,
                    'type'           => 'included',
                    'order'          => $index + 1,
                    'created_at'     => $now,
                    'updated_at'     => $now,
                ];
            }
            DB::table('destination_includes')->insert($includesToInsert);

            // 3. Destaques
            DB::table('destination_highlights')->where('destination_id', $dest['id'])->delete();
            $highlightsToInsert = [];
            foreach ($dest['highlights'] as $index => $highlight) {
                $highlightsToInsert[] = [
                    'destination_id' => $dest['id'],
                    'title'          => $highlight['title'],
                    'subtitle'       => $highlight['subtitle'],
                    'image_path'     => $highlight['image_path'],
                    'order'          => $index + 1,
                    'created_at'     => $now,
                    'updated_at'     => $now,
                ];
            }
            DB::table('destination_highlights')->insert($highlightsToInsert);

            // 4. Observações
            DB::table('destination_observations')->where('destination_id', $dest['id'])->delete();
            $observationsToInsert = [];
            foreach ($dest['observations'] as $index => $obs) {
                $observationsToInsert[] = [
                    'destination_id' => $dest['id'],
                    'text'           => $obs['text'],
                    'order'          => $index + 1,
                    'created_at'     => $now,
                    'updated_at'     => $now,
                ];
            }
            DB::table('destination_observations')->insert($observationsToInsert);

            // 5. Itinerário (dias e atividades)
            DB::table('destination_itinerary_days')->where('destination_id', $dest['id'])->delete();
            foreach ($dest['itinerary_days'] as $dayIndex => $day) {
                $dayId = DB::table('destination_itinerary_days')->insertGetId([
                    'destination_id' => $dest['id'],
                    'day_number'     => $day['day_number'],
                    'date'           => $day['date'],
                    'label'          => $day['label'],
                    'order'          => $dayIndex + 1,
                    'created_at'     => $now,
                    'updated_at'     => $now,
                ]);

                $activitiesToInsert = [];
                foreach ($day['activities'] as $actIndex => $activityText) {
                    $activitiesToInsert[] = [
                        'itinerary_day_id' => $dayId,
                        'activity'         => $activityText,
                        'order'            => $actIndex + 1,
                        'created_at'       => $now,
                        'updated_at'       => $now,
                    ];
                }
                DB::table('destination_itinerary_activities')->insert($activitiesToInsert);
            }
        }

        Schema::enableForeignKeyConstraints();
    }
}
