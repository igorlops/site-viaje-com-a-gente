<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DestinationIncludeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('destination_includes')->truncate();

        $data = [
  0 =>
  [
    'id' => 1,
    'destination_id' => 1,
    'text' => 'Aéreo de Fortaleza x Rio de Janeiro x Fortaleza',
    'type' => 'included',
    'order' => 1,
    'created_at' => '2026-07-04 12:00:00',
    'updated_at' => '2026-07-04 12:00:00',
  ],
  1 =>
  [
    'id' => 2,
    'destination_id' => 1,
    'text' => 'Bagagem até 10kg',
    'type' => 'included',
    'order' => 2,
    'created_at' => '2026-07-04 12:00:00',
    'updated_at' => '2026-07-04 12:00:00',
  ],
  2 =>
  [
    'id' => 3,
    'destination_id' => 1,
    'text' => 'Translado privativo do aeroporto x hotel x aeroporto',
    'type' => 'included',
    'order' => 3,
    'created_at' => '2026-07-04 12:00:00',
    'updated_at' => '2026-07-04 12:00:00',
  ],
  3 =>
  [
    'id' => 4,
    'destination_id' => 1,
    'text' => '4 diárias no Hotel Rede Andrade Canadá ou similar em Copacabana',
    'type' => 'included',
    'order' => 4,
    'created_at' => '2026-07-04 12:00:00',
    'updated_at' => '2026-07-04 12:00:00',
  ],
  4 =>
  [
    'id' => 5,
    'destination_id' => 1,
    'text' => '4 cafés da manhã',
    'type' => 'included',
    'order' => 5,
    'created_at' => '2026-07-04 12:00:00',
    'updated_at' => '2026-07-04 12:00:00',
  ],
  5 =>
  [
    'id' => 6,
    'destination_id' => 1,
    'text' => 'Acomodações em quartos duplos ou triplos',
    'type' => 'included',
    'order' => 6,
    'created_at' => '2026-07-04 12:00:00',
    'updated_at' => '2026-07-04 12:00:00',
  ],
  6 =>
  [
    'id' => 7,
    'destination_id' => 1,
    'text' => '2 city tours completos no Rio de Janeiro',
    'type' => 'included',
    'order' => 7,
    'created_at' => '2026-07-04 12:00:00',
    'updated_at' => '2026-07-04 12:00:00',
  ],
  7 =>
  [
    'id' => 8,
    'destination_id' => 1,
    'text' => 'Day use em Arraial do Cabo',
    'type' => 'included',
    'order' => 8,
    'created_at' => '2026-07-04 12:00:00',
    'updated_at' => '2026-07-04 12:00:00',
  ],
  8 =>
  [
    'id' => 9,
    'destination_id' => 1,
    'text' => 'Passeio de barco com almoço incluso em Arraial do Cabo',
    'type' => 'included',
    'order' => 9,
    'created_at' => '2026-07-04 12:00:00',
    'updated_at' => '2026-07-04 12:00:00',
  ],
  9 =>
  [
    'id' => 10,
    'destination_id' => 1,
    'text' => 'Guia local',
    'type' => 'included',
    'order' => 10,
    'created_at' => '2026-07-04 12:00:00',
    'updated_at' => '2026-07-04 12:00:00',
  ],
  10 =>
  [
    'id' => 11,
    'destination_id' => 1,
    'text' => 'Suporte antes e durante toda a viagem',
    'type' => 'included',
    'order' => 11,
    'created_at' => '2026-07-04 12:00:00',
    'updated_at' => '2026-07-04 12:00:00',
  ],
  11 =>
  [
    'id' => 12,
    'destination_id' => 1,
    'text' => 'Brinde',
    'type' => 'included',
    'order' => 12,
    'created_at' => '2026-07-04 12:00:00',
    'updated_at' => '2026-07-04 12:00:00',
  ],
  12 =>
  [
    'id' => 13,
    'destination_id' => 1,
    'text' => 'Bagagem despachada',
    'type' => 'not_included',
    'order' => 1,
    'created_at' => '2026-07-04 12:00:00',
    'updated_at' => '2026-07-04 12:00:00',
  ],
  13 =>
  [
    'id' => 14,
    'destination_id' => 1,
    'text' => 'Ingressos',
    'type' => 'not_included',
    'order' => 2,
    'created_at' => '2026-07-04 12:00:00',
    'updated_at' => '2026-07-04 12:00:00',
  ],
  14 =>
  [
    'id' => 15,
    'destination_id' => 1,
    'text' => 'Taxas',
    'type' => 'not_included',
    'order' => 3,
    'created_at' => '2026-07-04 12:00:00',
    'updated_at' => '2026-07-04 12:00:00',
  ],
  15 =>
  [
    'id' => 16,
    'destination_id' => 1,
    'text' => 'Alimentação',
    'type' => 'not_included',
    'order' => 4,
    'created_at' => '2026-07-04 12:00:00',
    'updated_at' => '2026-07-04 12:00:00',
  ],
];

        DB::table('destination_includes')->insert($data);
        Schema::enableForeignKeyConstraints();
    }
}