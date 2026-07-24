<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BateVoltaDestinationSeeder extends Seeder
{
    /**
     * Executa os seeds para a modalidade Bate e Volta.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $now = Carbon::now();

        // Array com todos os novos destinos extraídos das imagens
        $destinations = [
            [
                'id'                => 2,
                'title'             => 'SÁBADÃO EM CANOA QUEBRADA',
                'subtitle'          => 'Bate e Volta para Canoa Quebrada – Dia 11 de Julho/2026!',
                'text_label_banner' => 'Aproveite essa oportunidade no mês das Férias e venha  curtir um domingo incrível em uma das praias mais desejadas do nosso Ceará.  ',
                'price'             => 49.90,
                'departure_city'    => 'Shopping RioMar Kennedy',
                'departure_date'    => '06:30h da manhã',
                'return_date'       => '17:00 da tarde',
                'date_range'        => '07 de Junho de 2026',
                'includes'          => ['Transporte climatizado', 'Guia de turismo', 'Serviço de bordo', 'Barraca de apoio', 'Suporte durante a viagem']
            ],
            [
                'id'                => 3,
                'title'             => 'ICAPUÍ',
                'subtitle'          => 'Bate e Volta para Icapuí – Dia 07 de Junho/2026!',
                'text_label_banner' => 'Um dia para relaxar, aproveitar o mar e esquecer a rotina!',
                'price'             => 49.90,
                'departure_city'    => 'Shopping RioMar Kennedy',
                'departure_date'    => '06:30h da manhã',
                'return_date'       => '17:00 da tarde',
                'date_range'        => '07 de Junho de 2026',
                'includes'          => ['Transporte climatizado', 'Guia de turismo', 'Serviço de bordo', 'Barraca de apoio', 'Suporte durante a viagem']
            ],
            [
                'id'                => 4,
                'title'             => 'ICARAÍ DE AMONTADA',
                'subtitle'          => 'Bate e Volta para Icaraí de Amontada– Dia 14 de Junho/2026!',
                'text_label_banner' => 'E que tal levar sua mãe para curtir o dias das MÃES nesses paraiso chamado Icaraí de Amontada ? Na compra de 2 bate e volta sua mamãe é por nossa conta.',
                'price'             => 49.90,
                'departure_city'    => 'Shopping RioMar Kennedy',
                'departure_date'    => '06:45 da manhã',
                'return_date'       => '17:00 da tarde',
                'date_range'        => '14 de Junho de 2026',
                'includes'          => ['Transporte climatizado', 'Guia de turismo', 'Serviço de bordo', 'Barraca de apoio', 'Suporte durante a viagem']
            ],
            [
                'id'                => 5,
                'title'             => 'FLECHEIRAS + MUNDAÚ',
                'subtitle'          => 'Bate e Volta para Flecheiras + Mundaú – Dia 14 de Junho/2026!',
                'text_label_banner' => 'Descubra o paraíso no litoral oeste do Ceará: um roteiro inesquecível unindo a rústica Praia de Mundaú, com seu encontro de rio e mar (passeio de catamarã), e a charmosa Praia de Flecheiras , famosa pelas piscinas naturais na maré baixa',
                'price'             => 49.90,
                'departure_city'    => 'Shopping RioMar Kennedy',
                'departure_date'    => '06:45 da manhã',
                'return_date'       => '17:00 da tarde',
                'date_range'        => '14 de Junho de 2026',
                'includes'          => ['Transporte climatizado', 'Guia de turismo', 'Serviço de bordo', 'Barraca de apoio', 'Suporte durante a viagem']
            ],
            [
                'id'                => 6,
                'title'             => 'ÁGUAS BELAS',
                'subtitle'          => 'Bate e Volta para Águas Belas – Dia 07 de Junho/2026!',
                'text_label_banner' => 'Um dia para relaxar, renovar as energias e aproveitar o paraíso de Águas Belas!',
                'price'             => 49.90,
                'departure_city'    => 'Shopping RioMar Kennedy',
                'departure_date'    => '06:45 da manhã',
                'return_date'       => '17:00 da tarde',
                'date_range'        => '07 de Junho de 2026',
                'includes'          => ['Transporte climatizado', 'Guia de turismo', 'Serviço de bordo', 'Barraca de apoio', 'Suporte durante a viagem']
            ],
            [
                'id'                => 7,
                'title'             => 'GUARAMIRANGA',
                'subtitle'          => 'Bate e Volta para Guaramiranga – Dia 28 de Junho/2026!',
                'text_label_banner' => 'Um dia para respirar ar puro, curtir o clima da serra e se encantar com a beleza de Guaramiranga!',
                'price'             => 49.90,
                'departure_city'    => 'Shopping RioMar Kennedy',
                'departure_date'    => '06:45 da manhã',
                'return_date'       => '17:00 da tarde',
                'date_range'        => '28 de Junho de 2026',
                'includes'          => ['Transporte climatizado', 'Guia de turismo', 'Serviço de bordo', 'Ponto de apoio', 'Suporte durante a viagem'] // Nota: Guaramiranga usa "Ponto de apoio" em vez de Barraca
            ],
        ];

        // Loop principal para inserir cada um dos destinos
        foreach ($destinations as $dest) {
            
            // 1. Inserir na tabela 'destinations'
            $destinationData = [
                'id'                 => $dest['id'],
                'title'              => $dest['title'],
                'subtitle'           => $dest['subtitle'],
                'description'  =>   $dest['text_label_banner'],
                'slug'               => Str::slug($dest['title'] . '-' . $dest['date_range']), // Gera slug dinâmico
                
                // Campos fixos e ocultos da modalidade
                'type'               => 'bate-e-volta',
                'duration'           => '1',
                'category'           => 'BATE E VOLTA',
                'trip_type'          => 'Bate e Volta',
                
                'price'              => $dest['price'],
                'image_path'         => '', // Adicione os caminhos reais depois se houver upload
                'whatsapp_link'      => null,
                'is_featured'        => 1,
                
                // Logística
                'departure_city'     => $dest['departure_city'],
                'departure_date'     => $dest['departure_date'],
                'return_date'        => $dest['return_date'],
                'date_range'         => $dest['date_range'],
                
                'created_at'         => $now,
                'updated_at'         => $now,
            ];

            DB::table('destinations')->updateOrInsert(
                ['id' => $dest['id']],
                $destinationData
            );

            // 2. Inserir os Itens Inclusos na tabela 'destination_includes'
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

            // 3. Inserir Regras e Alertas na tabela 'destination_observations'
            // As imagens compartilham exatamente as mesmas 3 regras
            DB::table('destination_observations')->where('destination_id', $dest['id'])->delete();
            $observationsData = [
                [
                    'destination_id' => $dest['id'],
                    'text'           => 'Crianças até 5 anos não pagam (indo no colo dos responsáveis).',
                    'order'          => 1,
                    'created_at'     => $now,
                    'updated_at'     => $now,
                ],
                [
                    'destination_id' => $dest['id'],
                    'text'           => 'Aceitamos todas as formas de pagamento.',
                    'order'          => 2,
                    'created_at'     => $now,
                    'updated_at'     => $now,
                ],
                [
                    'destination_id' => $dest['id'],
                    'text'           => 'Vagas limitadas — garanta já a sua!',
                    'order'          => 3,
                    'created_at'     => $now,
                    'updated_at'     => $now,
                ],
            ];
            DB::table('destination_observations')->insert($observationsData);
        }

        Schema::enableForeignKeyConstraints();
    }
}