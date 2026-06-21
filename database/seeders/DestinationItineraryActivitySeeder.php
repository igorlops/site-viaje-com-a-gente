<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DestinationItineraryActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('destination_itinerary_activities')->truncate();

        $data = [
  0 => 
  [
    'id' => 9,
    'itinerary_day_id' => 6,
    'activity' => 'Embarque no aeroporto de Fortaleza rumo a Recife',
    'order' => 1,
    'created_at' => '2026-06-12 18:48:32',
    'updated_at' => '2026-06-12 18:48:32',
  ],
  1 => 
  [
    'id' => 10,
    'itinerary_day_id' => 6,
    'activity' => 'Translado privativo até o hotel em Porto de Galinhas',
    'order' => 2,
    'created_at' => '2026-06-12 18:48:32',
    'updated_at' => '2026-06-12 18:48:32',
  ],
  2 => 
  [
    'id' => 11,
    'itinerary_day_id' => 7,
    'activity' => 'Passeio de jangada na maré baixa para ver peixinhos',
    'order' => 1,
    'created_at' => '2026-06-12 18:48:32',
    'updated_at' => '2026-06-12 18:48:32',
  ],
  3 => 
  [
    'id' => 12,
    'itinerary_day_id' => 7,
    'activity' => 'Tarde livre para aproveitar a praia da vila',
    'order' => 2,
    'created_at' => '2026-06-12 18:48:32',
    'updated_at' => '2026-06-12 18:48:32',
  ],
  4 => 
  [
    'id' => 34,
    'itinerary_day_id' => 10,
    'activity' => 'Check-in no hotel e briefing com o guia do grupo',
    'order' => 1,
    'created_at' => '2026-06-14 23:17:01',
    'updated_at' => '2026-06-14 23:17:01',
  ],
  5 => 
  [
    'id' => 35,
    'itinerary_day_id' => 10,
    'activity' => 'TEste 1',
    'order' => 2,
    'created_at' => '2026-06-14 23:17:01',
    'updated_at' => '2026-06-14 23:17:01',
  ],
  6 => 
  [
    'id' => 36,
    'itinerary_day_id' => 11,
    'activity' => 'Passeio de bondinho',
    'order' => 1,
    'created_at' => '2026-06-14 23:17:02',
    'updated_at' => '2026-06-14 23:17:02',
  ],
  7 => 
  [
    'id' => 37,
    'itinerary_day_id' => 11,
    'activity' => 'Teste 2',
    'order' => 2,
    'created_at' => '2026-06-14 23:17:02',
    'updated_at' => '2026-06-14 23:17:02',
  ],
  8 => 
  [
    'id' => 38,
    'itinerary_day_id' => 11,
    'activity' => 'Teste 3',
    'order' => 3,
    'created_at' => '2026-06-14 23:17:02',
    'updated_at' => '2026-06-14 23:17:02',
  ],
  9 => 
  [
    'id' => 39,
    'itinerary_day_id' => 9,
    'activity' => 'Voo Fortaleza/Rio, recepção no aeroporto e translado',
    'order' => 1,
    'created_at' => '2026-06-14 23:17:27',
    'updated_at' => '2026-06-14 23:17:27',
  ],
  10 => 
  [
    'id' => 40,
    'itinerary_day_id' => 8,
    'activity' => 'Voo de Fortaleza para Porto Alegre e translado para Gramado',
    'order' => 1,
    'created_at' => '2026-06-14 23:17:35',
    'updated_at' => '2026-06-14 23:17:35',
  ],
  11 => 
  [
    'id' => 41,
    'itinerary_day_id' => 8,
    'activity' => 'Check-in e noite livre para caminhar pela Rua Coberta',
    'order' => 2,
    'created_at' => '2026-06-14 23:17:35',
    'updated_at' => '2026-06-14 23:17:35',
  ],
];

        DB::table('destination_itinerary_activities')->insert($data);
        Schema::enableForeignKeyConstraints();
    }
}
