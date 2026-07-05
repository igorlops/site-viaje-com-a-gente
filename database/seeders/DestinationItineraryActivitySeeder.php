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
  // Dia 1 (itinerary_day_id = 1)
  0 => ['id' => 1, 'itinerary_day_id' => 1, 'activity' => 'Embarque no Aeroporto de Fortaleza/CE', 'order' => 1, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],
  1 => ['id' => 2, 'itinerary_day_id' => 1, 'activity' => 'Desembarque no Aeroporto do Rio de Janeiro/RJ', 'order' => 2, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],
  2 => ['id' => 3, 'itinerary_day_id' => 1, 'activity' => 'Transfer para o hotel', 'order' => 3, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],
  3 => ['id' => 4, 'itinerary_day_id' => 1, 'activity' => 'Check-in no hotel', 'order' => 4, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],

  // Dia 2 (itinerary_day_id = 2)
  4 => ['id' => 5, 'itinerary_day_id' => 2, 'activity' => 'Pão de Açúcar', 'order' => 1, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],
  5 => ['id' => 6, 'itinerary_day_id' => 2, 'activity' => 'Mirante Dona Marta', 'order' => 2, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],
  6 => ['id' => 7, 'itinerary_day_id' => 2, 'activity' => 'Bondinho de Santa Teresa', 'order' => 3, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],
  7 => ['id' => 8, 'itinerary_day_id' => 2, 'activity' => 'Arcos da Lapa', 'order' => 4, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],
  8 => ['id' => 9, 'itinerary_day_id' => 2, 'activity' => 'Escadaria Selarón', 'order' => 5, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],
  9 => ['id' => 10, 'itinerary_day_id' => 2, 'activity' => 'Catedral Metropolitana', 'order' => 6, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],
  10 => ['id' => 11, 'itinerary_day_id' => 2, 'activity' => 'Sambódromo', 'order' => 7, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],
  11 => ['id' => 12, 'itinerary_day_id' => 2, 'activity' => 'Maracanã', 'order' => 8, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],

  // Dia 3 (itinerary_day_id = 3)
  12 => ['id' => 13, 'itinerary_day_id' => 3, 'activity' => 'Day use em Arraial do Cabo com transporte, passeio de barco e almoço incluso', 'order' => 1, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],

  // Dia 4 (itinerary_day_id = 4)
  13 => ['id' => 14, 'itinerary_day_id' => 4, 'activity' => 'RodaStar', 'order' => 1, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],
  14 => ['id' => 15, 'itinerary_day_id' => 4, 'activity' => 'AquaRio', 'order' => 2, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],
  15 => ['id' => 16, 'itinerary_day_id' => 4, 'activity' => 'Mural das Etnias', 'order' => 3, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],
  16 => ['id' => 17, 'itinerary_day_id' => 4, 'activity' => 'Museu do Amanhã', 'order' => 4, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],
  17 => ['id' => 18, 'itinerary_day_id' => 4, 'activity' => 'Museu Náutico', 'order' => 5, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],
  18 => ['id' => 19, 'itinerary_day_id' => 4, 'activity' => 'Confeitaria Colombo', 'order' => 6, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],
  19 => ['id' => 20, 'itinerary_day_id' => 4, 'activity' => 'Cristo Redentor', 'order' => 7, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],

  // Dia 5 (itinerary_day_id = 5)
  20 => ['id' => 21, 'itinerary_day_id' => 5, 'activity' => 'Praia de Copacabana', 'order' => 1, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],
  21 => ['id' => 22, 'itinerary_day_id' => 5, 'activity' => 'Forte de Copacabana', 'order' => 2, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],
  22 => ['id' => 23, 'itinerary_day_id' => 5, 'activity' => 'Arpoador', 'order' => 3, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],
  23 => ['id' => 24, 'itinerary_day_id' => 5, 'activity' => 'Ipanema e Leblon', 'order' => 4, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],
  24 => ['id' => 25, 'itinerary_day_id' => 5, 'activity' => 'Check-out no hotel', 'order' => 5, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],
  25 => ['id' => 26, 'itinerary_day_id' => 5, 'activity' => 'Transfer para o aeroporto', 'order' => 6, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],
  26 => ['id' => 27, 'itinerary_day_id' => 5, 'activity' => 'Embarque no Aeroporto do Rio de Janeiro/RJ', 'order' => 7, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],
  27 => ['id' => 28, 'itinerary_day_id' => 5, 'activity' => 'Desembarque no Aeroporto de Fortaleza/CE', 'order' => 8, 'created_at' => '2026-07-04 12:00:00', 'updated_at' => '2026-07-04 12:00:00'],
];

        DB::table('destination_itinerary_activities')->insert($data);
        Schema::enableForeignKeyConstraints();
    }
}