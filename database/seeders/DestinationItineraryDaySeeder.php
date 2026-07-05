<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DestinationItineraryDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('destination_itinerary_days')->truncate();

        $data = [
  0 =>
  [
    'id' => 1,
    'destination_id' => 1,
    'day_number' => 1,
    'date' => '05 de Junho 2027',
    'label' => 'Dia 1: Chegada ao Rio de Janeiro',
    'order' => 1,
    'created_at' => '2026-07-04 12:00:00',
    'updated_at' => '2026-07-04 12:00:00',
  ],
  1 =>
  [
    'id' => 2,
    'destination_id' => 1,
    'day_number' => 2,
    'date' => '06 de Junho 2027',
    'label' => 'Dia 2: Conheça o Pão de Açúcar',
    'order' => 2,
    'created_at' => '2026-07-04 12:00:00',
    'updated_at' => '2026-07-04 12:00:00',
  ],
  2 =>
  [
    'id' => 3,
    'destination_id' => 1,
    'day_number' => 3,
    'date' => '07 de Junho 2027',
    'label' => 'Dia 3: Um dia inesquecível em Arraial do Cabo',
    'order' => 3,
    'created_at' => '2026-07-04 12:00:00',
    'updated_at' => '2026-07-04 12:00:00',
  ],
  3 =>
  [
    'id' => 4,
    'destination_id' => 1,
    'day_number' => 4,
    'date' => '08 de Junho 2027',
    'label' => 'Dia 4: Cristo Redentor, uma das 7 Maravilhas do Mundo',
    'order' => 4,
    'created_at' => '2026-07-04 12:00:00',
    'updated_at' => '2026-07-04 12:00:00',
  ],
  4 =>
  [
    'id' => 5,
    'destination_id' => 1,
    'day_number' => 5,
    // ASSUMIDO: a imagem mostra "Dia 5" cobrindo o retorno, mas o pacote vai até dia 10 (6 dias/5 noites).
    // Ajustei a data para cobrir os dias 09 e 10 de Junho.
    'date' => '09 a 10 de Junho 2027',
    'label' => 'Dia 5: Retorno para Fortaleza',
    'order' => 5,
    'created_at' => '2026-07-04 12:00:00',
    'updated_at' => '2026-07-04 12:00:00',
  ],
];

        DB::table('destination_itinerary_days')->insert($data);
        Schema::enableForeignKeyConstraints();
    }
}