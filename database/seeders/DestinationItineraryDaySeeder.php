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
    'id' => 6,
    'destination_id' => 1,
    'day_number' => 1,
    'date' => '12 de Outubro 2026',
    'label' => 'Dia 1: Chegada e Check-in',
    'order' => 1,
    'created_at' => '2026-06-12 18:48:32',
    'updated_at' => '2026-06-12 18:48:32',
  ],
  1 => 
  [
    'id' => 7,
    'destination_id' => 1,
    'day_number' => 2,
    'date' => '13 de Outubro 2026',
    'label' => 'Dia 2: Piscinas Naturais',
    'order' => 2,
    'created_at' => '2026-06-12 18:48:32',
    'updated_at' => '2026-06-12 18:48:32',
  ],
  2 => 
  [
    'id' => 8,
    'destination_id' => 2,
    'day_number' => 1,
    'date' => '10 de Novembro 2026',
    'label' => 'Dia 1: Chegada à Serra Gaúcha',
    'order' => 1,
    'created_at' => '2026-06-12 18:48:33',
    'updated_at' => '2026-06-12 18:48:33',
  ],
  3 => 
  [
    'id' => 9,
    'destination_id' => 3,
    'day_number' => 1,
    'date' => '15 de Março 2027',
    'label' => 'Dia 1: Chegada à Cidade Maravilhosa',
    'order' => 1,
    'created_at' => '2026-06-12 18:48:35',
    'updated_at' => '2026-06-12 18:48:35',
  ],
  4 => 
  [
    'id' => 10,
    'destination_id' => 4,
    'day_number' => 1,
    'date' => '05 de Junho 2027',
    'label' => 'Dia 1: Chegada em Foz',
    'order' => 1,
    'created_at' => '2026-06-12 18:48:36',
    'updated_at' => '2026-06-12 18:48:36',
  ],
  5 => 
  [
    'id' => 11,
    'destination_id' => 4,
    'day_number' => 2,
    'date' => '06 de Junho 2027',
    'label' => 'Dia 2: Teste',
    'order' => 2,
    'created_at' => '2026-06-14 20:55:19',
    'updated_at' => '2026-06-14 20:55:19',
  ],
];

        DB::table('destination_itinerary_days')->insert($data);
        Schema::enableForeignKeyConstraints();
    }
}
