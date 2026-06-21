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
    'id' => 45,
    'destination_id' => 4,
    'text' => 'Passagem aérea de ida e volta saindo de Fortaleza',
    'type' => 'included',
    'order' => 1,
    'created_at' => '2026-06-14 23:17:01',
    'updated_at' => '2026-06-14 23:17:01',
  ],
  1 => 
  [
    'id' => 46,
    'destination_id' => 4,
    'text' => 'Almoço e bebidas não inclusos nos passeios',
    'type' => 'not_included',
    'order' => 2,
    'created_at' => '2026-06-14 23:17:01',
    'updated_at' => '2026-06-14 23:17:01',
  ],
  2 => 
  [
    'id' => 47,
    'destination_id' => 3,
    'text' => 'Aéreo ida e volta Fortaleza / Rio / Fortaleza',
    'type' => 'included',
    'order' => 1,
    'created_at' => '2026-06-14 23:17:26',
    'updated_at' => '2026-06-14 23:17:26',
  ],
  3 => 
  [
    'id' => 48,
    'destination_id' => 3,
    'text' => 'Despesas pessoais e passeios extras',
    'type' => 'not_included',
    'order' => 1,
    'created_at' => '2026-06-14 23:17:26',
    'updated_at' => '2026-06-14 23:17:26',
  ],
  4 => 
  [
    'id' => 49,
    'destination_id' => 3,
    'text' => 'Hospedagem em Copacabana com café',
    'type' => 'included',
    'order' => 2,
    'created_at' => '2026-06-14 23:17:26',
    'updated_at' => '2026-06-14 23:17:26',
  ],
  5 => 
  [
    'id' => 50,
    'destination_id' => 3,
    'text' => 'Passeio de barco em Arraial do Cabo',
    'type' => 'included',
    'order' => 3,
    'created_at' => '2026-06-14 23:17:26',
    'updated_at' => '2026-06-14 23:17:26',
  ],
  6 => 
  [
    'id' => 51,
    'destination_id' => 2,
    'text' => 'Passagem aérea de ida e volta saindo de Fortaleza',
    'type' => 'included',
    'order' => 1,
    'created_at' => '2026-06-14 23:17:34',
    'updated_at' => '2026-06-14 23:17:34',
  ],
  7 => 
  [
    'id' => 52,
    'destination_id' => 2,
    'text' => 'Almoços, jantares e consumo extra',
    'type' => 'not_included',
    'order' => 1,
    'created_at' => '2026-06-14 23:17:34',
    'updated_at' => '2026-06-14 23:17:34',
  ],
  8 => 
  [
    'id' => 53,
    'destination_id' => 2,
    'text' => 'Hospedagem em hotel selecionado com café da manhã',
    'type' => 'included',
    'order' => 2,
    'created_at' => '2026-06-14 23:17:34',
    'updated_at' => '2026-06-14 23:17:34',
  ],
  9 => 
  [
    'id' => 54,
    'destination_id' => 2,
    'text' => 'City tour guiado em Gramado e Canela',
    'type' => 'included',
    'order' => 3,
    'created_at' => '2026-06-14 23:17:35',
    'updated_at' => '2026-06-14 23:17:35',
  ],
  10 => 
  [
    'id' => 55,
    'destination_id' => 2,
    'text' => 'Ingresso para espetáculo especial do Natal Luz',
    'type' => 'included',
    'order' => 4,
    'created_at' => '2026-06-14 23:17:35',
    'updated_at' => '2026-06-14 23:17:35',
  ],
];

        DB::table('destination_includes')->insert($data);
        Schema::enableForeignKeyConstraints();
    }
}
