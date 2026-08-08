<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PacoteDestinationSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $now = Carbon::now();

        $destinations = [
            [
                'id'                => 11,
                'title'             => 'NORDESTE COMPLETO',
                'subtitle'          => 'Conheça o melhor do litoral nordestino: Jericoacoara, Lençóis Maranhenses e São Luís.',
                'text_label_banner' => 'Um roteiro completo pelo Nordeste que combina dunas, lagoas e cultura em um só pacote.',
                'title_card'        => 'Nordeste Completo',
                'subtitle_card'     => 'Jericoacoara + Lençóis',
                'price'             => 299.90,
                'full_price'        => 'R$ 5.490',
                'duration'          => '7',
                'nights'            => '6',
                'date_range'        => '05 a 11 de Novembro 2026',
                'departure_date'    => '05 de Novembro 2026',
                'return_date'       => '11 de Novembro 2026',
                'departure_city'    => 'Fortaleza - CE',
                'trip_type'         => 'Pacote de Viagem',
                'category'          => 'AÉREO + HOTEL + PASSEIOS',
                'tag'               => 'DESTAQUE',
                'slug'              => 'nordeste-completo-jeri-lencois',
                'highlights_icons'  => ['hotel', 'plane', 'ship', 'camera'],
                'type'              => 'pacotes',
                'is_featured'       => 1,
                'whatsapp_link'     => null,
                'image_path'        => 'destinations/nordeste.png',
                'banner_image_path' => 'destinations/nordeste.png',
                'includes'          => [
                    'Passagem aérea Fortaleza x São Luís x Fortaleza',
                    '6 diárias em hotel 3 estrelas com café da manhã',
                    'Transfer aeroporto x hotel x aeroporto',
                    'Passeio a Jericoacoara com hospedagem em pousada',
                    'Passeio aos Lençóis Maranhenses (Barreirinhas)',
                    'Passeio de escuna pelo Delta do Parnaíba',
                    'City tour por São Luís (Patrimônio da Humanidade)',
                    'Jantar nordestino incluso',
                    'Guia local durante todo o roteiro',
                    'Seguro viagem básico',
                ],
                'highlights'        => [
                    ['title' => 'Jericoacoara', 'subtitle' => 'Vila de pescadores com dunas, lagoas e pôr do sol inesquecível.', 'image_path' => 'destinations/nordeste.png'],
                    ['title' => 'Lençóis Maranhenses', 'subtitle' => 'Deserto de areia branca com lagoas cristalinas no verão.', 'image_path' => 'destinations/nordeste.png'],
                ],
                'observations'      => [
                    ['text' => 'Crianças até 5 anos não pagam (indo no colo dos responsáveis). De 6 a 11 anos: desconto de 50%.'],
                    ['text' => 'Aceitamos PIX, cartão de crédito em até 12x sem juros e boleto bancário.'],
                    ['text' => 'Leve protetor solar, chapéu e roupa confortável para os passeios. Vagas limitadas!'],
                ],
                'itinerary_days'    => [
                    [
                        'day_number' => 1,
                        'date'       => '05 de Novembro 2026',
                        'label'      => 'Dia 1: Chegada em São Luís',
                        'activities' => [
                            'Embarque no Aeroporto de Fortaleza/CE',
                            'Chegada no Aeroporto de São Luís/MA',
                            'Transfer para o hotel',
                            'Check-in no hotel',
                            'City tour pelo Centro Histórico de São Luís',
                            'Jantar de boas-vindas incluso',
                        ],
                    ],
                    [
                        'day_number' => 2,
                        'date'       => '06 de Novembro 2026',
                        'label'      => 'Dia 2: Lençóis Maranhenses',
                        'activities' => [
                            'Café da manhã no hotel',
                            'Transfer para Barreirinhas (≈ 4h)',
                            'Passeio pelo Rio Preguiças até a lagoa de João Paulo',
                            'Almoço típico incluso',
                            'Passeio de buggy pelo Parque Nacional dos Lençóis',
                            'Noite em pousada em Barreirinhas',
                        ],
                    ],
                    [
                        'day_number' => 3,
                        'date'       => '07 de Novembro 2026',
                        'label'      => 'Dia 3: Delta do Parnaíba',
                        'activities' => [
                            'Café da manhã na pousada',
                            'Passeio de escuna pelo Delta do Parnaíba',
                            'Visita às ilhas e à foz do Rio Parnaíba',
                            'Almoço de frutos do mar incluso',
                            'Retorno a Barreirinhas',
                            'Noite livre',
                        ],
                    ],
                    [
                        'day_number' => 4,
                        'date'       => '08 de Novembro 2026',
                        'label'      => 'Dia 4: Transfer para Jericoacoara',
                        'activities' => [
                            'Café da manhã na pousada',
                            'Transfer para Jericoacoara (via Cruz)',
                            'Check-in na pousada',
                            'Praia de Jericoacoara',
                            'Pôr do sol na duna',
                            'Jantar na vila incluso',
                        ],
                    ],
                    [
                        'day_number' => 5,
                        'date'       => '09 de Novembro 2026',
                        'label'      => 'Dia 5: Lagoa Azul e Lagoa do Paraíso',
                        'activities' => [
                            'Café da manhã na pousada',
                            'Passeio de buggy à Lagoa Azul e Lagoa do Paraíso',
                            'Almoço na beira da lagoa',
                            'Tarde livre para prática de esportes ou descanso',
                            'Noite livre na vila de Jeri',
                        ],
                    ],
                    [
                        'day_number' => 6,
                        'date'       => '10 de Novembro 2026',
                        'label'      => 'Dia 6: Retorno para Fortaleza',
                        'activities' => [
                            'Café da manhã na pousada',
                            'Check-out na pousada',
                            'Transfer para o aeroporto de Fortaleza',
                            'Noite em Fortaleza',
                        ],
                    ],
                    [
                        'day_number' => 7,
                        'date'       => '11 de Novembro 2026',
                        'label'      => 'Dia 7: Desembarque em Fortaleza',
                        'activities' => [
                            'Café da manhã no hotel',
                            'Check-out no hotel',
                            'Transfer para o aeroporto',
                            'Desembarque no Aeroporto de Fortaleza/CE',
                        ],
                    ],
                ],
            ],
            [
                'id'                => 12,
                'title'             => 'PATAGÔNIA ARGENTINA',
                'subtitle'          => 'Roteiro inesquecível por El Calafate, Perito Moreno e Ushuaia — o fim do mundo.',
                'text_label_banner' => 'Viva a aventura da Patagônia Argentina com geleiras, montanhas e a cidade mais austral do planeta.',
                'title_card'        => 'Patagônia Argentina',
                'subtitle_card'     => 'El Calafate + Ushuaia',
                'price'             => 349.90,
                'full_price'        => 'R$ 6.790',
                'duration'          => '8',
                'nights'            => '7',
                'date_range'        => '20 a 27 de Setembro 2026',
                'departure_date'    => '20 de Setembro 2026',
                'return_date'       => '27 de Setembro 2026',
                'departure_city'    => 'Fortaleza - CE',
                'trip_type'         => 'Pacote de Viagem',
                'category'          => 'AÉREO + HOTEL + PASSEIOS',
                'tag'               => 'AVENTURA',
                'slug'              => 'patagonia-argentina-el-calafate-ushuaia',
                'highlights_icons'  => ['hotel', 'plane', 'camera', 'shield-alt'],
                'type'              => 'pacotes',
                'is_featured'       => 1,
                'whatsapp_link'     => null,
                'image_path'        => 'destinations/patagonia.png',
                'banner_image_path' => 'destinations/patagonia.png',
                'includes'          => [
                    'Passagem aérea Fortaleza x Buenos Aires x El Calafate x Ushuaia x Fortaleza',
                    '7 diárias em hotel 4 estrelas com café da manhã',
                    'Transfer aeroporto x hotel x aeroporto',
                    'Passeio ao Glaciar Perito Moreno',
                    'Passeio a Ushuaia (Canal de Beagle)',
                    'Passeio ao Parque Nacional da Terra do Fogo',
                    'Navegação pelo Lago Argentino',
                    'Jantar de despedida incluso',
                    'Guia local bilíngue',
                    'Seguro viagem internacional',
                ],
                'highlights'        => [
                    ['title' => 'Glaciar Perito Moreno', 'subtitle' => 'Um dos únicos glaciares do mundo em constante avanço, com 70m de altura.', 'image_path' => 'destinations/patagonia.png'],
                    ['title' => 'Ushuaia', 'subtitle' => 'A cidade mais austral do planeta, porta de entrada para a Antártica.', 'image_path' => 'destinations/patagonia.png'],
                ],
                'observations'      => [
                    ['text' => 'Crianças até 5 anos não pagam hospedagem (indo no colo dos responsáveis). De 6 a 11 anos: desconto de 50%.'],
                    ['text' => 'Aceitamos PIX, cartão de crédito em até 10x sem juros e boleto bancário.'],
                    ['text' => 'Passaporte obrigatório para entrada na Argentina. Leve roupas de frio e impermeáveis.'],
                ],
                'itinerary_days'    => [
                    [
                        'day_number' => 1,
                        'date'       => '20 de Setembro 2026',
                        'label'      => 'Dia 1: Chegada em Buenos Aires',
                        'activities' => [
                            'Embarque no Aeroporto de Fortaleza/CE',
                            'Chegada no Aeroporto de Buenos Aires/AR',
                            'Transfer para hotel em El Calafate',
                            'Check-in no hotel',
                            'Noite livre para passeio no centro',
                        ],
                    ],
                    [
                        'day_number' => 2,
                        'date'       => '21 de Setembro 2026',
                        'label'      => 'Dia 2: Glaciar Perito Moreno',
                        'activities' => [
                            'Café da manhã no hotel',
                            'Passeio ao Parque Nacional Los Glaciares',
                            'Caminhada pelas passarelas do Glaciar Perito Moreno',
                            'Navegação pelo Lago Argentino até a face do glaciar',
                            'Almoço típico incluso',
                            'Retorno ao hotel',
                            'Noite livre',
                        ],
                    ],
                    [
                        'day_number' => 3,
                        'date'       => '22 de Setembro 2026',
                        'label'      => 'Dia 3: Lago Argentino e Estância',
                        'activities' => [
                            'Café da manhã no hotel',
                            'Passeio a Estancia Cristina',
                            'Cavalgada e almoço na estância',
                            'Visita ao Museu dos Glaciares',
                            'Noite livre em El Calafate',
                        ],
                    ],
                    [
                        'day_number' => 4,
                        'date'       => '23 de Setembro 2026',
                        'label'      => 'Dia 4: Transfer para Ushuaia',
                        'activities' => [
                            'Café da manhã no hotel',
                            'Transfer para o aeroporto de El Calafate',
                            'Voo para Ushuaia',
                            'Chegada em Ushuaia',
                            'Transfer para o hotel',
                            'Check-in no hotel',
                            'Noite livre para passeio pelo porto',
                        ],
                    ],
                    [
                        'day_number' => 5,
                        'date'       => '24 de Setembro 2026',
                        'label'      => 'Dia 5: Canal de Beagle',
                        'activities' => [
                            'Café da manhã no hotel',
                            'Navegação pelo Canal de Beagle',
                            'Visita à Ilha dos Pássaros e à Colônia de Lobos Marinhos',
                            'Almoço a bordo incluso',
                            'Retorno a Ushuaia',
                            'City tour por Ushuaia',
                            'Noite livre',
                        ],
                    ],
                    [
                        'day_number' => 6,
                        'date'       => '25 de Setembro 2026',
                        'label'      => 'Dia 6: Parque Nacional Terra do Fogo',
                        'activities' => [
                            'Café da manhã no hotel',
                            'Passeio ao Parque Nacional da Terra do Fogo',
                            'Trilha e visita ao Trem do Fim do Mundo',
                            'Almoço típico incluso',
                            'Retorno a Ushuaia',
                            'Noite livre',
                        ],
                    ],
                    [
                        'day_number' => 7,
                        'date'       => '26 de Setembro 2026',
                        'label'      => 'Dia 7: Retorno para Buenos Aires',
                        'activities' => [
                            'Café da manhã no hotel',
                            'Check-out no hotel',
                            'Transfer para o aeroporto de Ushuaia',
                            'Voo para Buenos Aires',
                            'Noite livre em Buenos Aires',
                            'Jantar de despedida incluso',
                        ],
                    ],
                    [
                        'day_number' => 8,
                        'date'       => '27 de Setembro 2026',
                        'label'      => 'Dia 8: Desembarque em Fortaleza',
                        'activities' => [
                            'Café da manhã no hotel',
                            'Transfer para o aeroporto de Buenos Aires',
                            'Embarque no Aeroporto de Buenos Aires/AR',
                            'Desembarque no Aeroporto de Fortaleza/CE',
                        ],
                    ],
                ],
            ],
            [
                'id'                => 13,
                'title'             => 'CHILE ATACAMA',
                'subtitle'          => 'Explore o deserto mais árido do mundo: geysers, lagos andinos e o céu estrelado mais puro do planeta.',
                'text_label_banner' => 'Uma experiência única no Deserto do Atacama, entre gêiseres, lagoas andinas e o Vale da Lua.',
                'title_card'        => 'Chile Atacama',
                'subtitle_card'     => 'Deserto e Andino',
                'price'             => 279.90,
                'full_price'        => 'R$ 5.890',
                'duration'          => '6',
                'nights'            => '5',
                'date_range'        => '01 a 06 de Dezembro 2026',
                'departure_date'    => '01 de Dezembro 2026',
                'return_date'       => '06 de Dezembro 2026',
                'departure_city'    => 'Fortaleza - CE',
                'trip_type'         => 'Pacote de Viagem',
                'category'          => 'AÉREO + HOTEL + PASSEIOS',
                'tag'               => 'NATUREZA',
                'slug'              => 'chile-atacama-deserto',
                'highlights_icons'  => ['hotel', 'plane', 'camera', 'shield-alt'],
                'type'              => 'pacotes',
                'is_featured'       => 1,
                'whatsapp_link'     => null,
                'image_path'        => 'destinations/atacama.png',
                'banner_image_path' => 'destinations/atacama.png',
                'includes'          => [
                    'Passagem aérea Fortaleza x Santiago x Calama x Fortaleza',
                    '5 diárias em hotel 4 estrelas com café da manhã',
                    'Transfer aeroporto x hotel x aeroporto',
                    'Passeio aos Gêiseres del Tatio',
                    'Passeio à Laguna Cejar e Laguna Ojos del Salar',
                    'Passeio ao Vale da Lua e Vale da Morte',
                    'Passeio à Laguna Miscanti e Laguna Miñiques',
                    'Jantar andino incluso',
                    'Guia local bilíngue',
                    'Seguro viagem internacional',
                ],
                'highlights'        => [
                    ['title' => 'Gêiseres del Tatio', 'subtitle' => 'Campo de gêiseres a 4.300m de altitude, com fontes de água quente e fumaça no amanhecer.', 'image_path' => 'destinations/atacama.png'],
                    ['title' => 'Laguna Cejar', 'subtitle' => 'Lagoa de água salgada nas montanhas andinas, perfeita para flutuar.', 'image_path' => 'destinations/atacama.png'],
                ],
                'observations'      => [
                    ['text' => 'Crianças até 5 anos não pagam hospedagem (indo no colo dos responsáveis). De 6 a 11 anos: desconto de 50%.'],
                    ['text' => 'Aceitamos PIX, cartão de crédito em até 10x sem juros e boleto bancário.'],
                    ['text' => 'Altitude pode causar mal-estar. Leve roupas de frio, protetor solar e dinheiro em dólares.'],
                ],
                'itinerary_days'    => [
                    [
                        'day_number' => 1,
                        'date'       => '01 de Dezembro 2026',
                        'label'      => 'Dia 1: Chegada em Santiago',
                        'activities' => [
                            'Embarque no Aeroporto de Fortaleza/CE',
                            'Chegada no Aeroporto de Santiago/CL',
                            'Transfer para Calama (≈ 2h de voo interno)',
                            'Check-in no hotel em San Pedro de Atacama',
                            'Noite livre para aclimatação',
                        ],
                    ],
                    [
                        'day_number' => 2,
                        'date'       => '02 de Dezembro 2026',
                        'label'      => 'Dia 2: Gêiseres del Tatio e Laguna Cejar',
                        'activities' => [
                            'Saída às 05:00 para os Gêiseres del Tatio',
                            'Observação dos gêiseres ao amanhecer',
                            'Banho em fonte de água quente',
                            'Café da manhã no local',
                            'Retorno ao hotel para descanso',
                            'Passeio à Laguna Cejar no final da tarde',
                            'Jantar andino incluso',
                        ],
                    ],
                    [
                        'day_number' => 3,
                        'date'       => '03 de Dezembro 2026',
                        'label'      => 'Dia 3: Valle de la Luna e Valle de la Muerte',
                        'activities' => [
                            'Café da manhã no hotel',
                            'Passeio ao Vale da Lua e Vale da Morte',
                            'Visita à Pedra do Coyote e à Caverna das Mãos',
                            'Almoço típico incluso',
                            'Passeio ao Salar de Atacama',
                            'Pôr do sol no Deserto',
                            'Noite livre',
                        ],
                    ],
                    [
                        'day_number' => 4,
                        'date'       => '04 de Dezembro 2026',
                        'label'      => 'Dia 4: Lagunas Miscanti e Miñiques',
                        'activities' => [
                            'Café da manhã no hotel',
                            'Passeio às Lagunas Miscanti e Miñiques',
                            'Trilha pelas lagoas andinas',
                            'Almoço na comunidade de Socaire',
                            'Visita à vila de Toconao e sua igreja colonial',
                            'Retorno a San Pedro de Atacama',
                            'Noite livre',
                        ],
                    ],
                    [
                        'day_number' => 5,
                        'date'       => '05 de Dezembro 2026',
                        'label'      => 'Dia 5: Passeio opcional e tempo livre',
                        'activities' => [
                            'Café da manhã no hotel',
                            'Manhã livre para passeios opcionais ou compras',
                            'Almoço livre',
                            'Tarde livre para explorar San Pedro de Atacama',
                            'Jantar livre',
                        ],
                    ],
                    [
                        'day_number' => 6,
                        'date'       => '06 de Dezembro 2026',
                        'label'      => 'Dia 6: Retorno para Fortaleza',
                        'activities' => [
                            'Café da manhã no hotel',
                            'Check-out no hotel',
                            'Transfer para o aeroporto de Calama',
                            'Voo para Santiago',
                            'Embarque no Aeroporto de Santiago/CL',
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
