<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DestinationHighlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('destination_highlights')->truncate();

        $data = [
  0 => 
  [
    'id' => 9,
    'destination_id' => 1,
    'title' => 'Piscinas Naturais',
    'subtitle' => 'Passeio de jangada incrível',
    'image_path' => 'destinations/porto.png',
    'order' => 1,
    'created_at' => '2026-06-12 18:48:32',
    'updated_at' => '2026-06-12 18:48:32',
  ],
  1 => 
  [
    'id' => 10,
    'destination_id' => 1,
    'title' => 'Praia dos Carneiros',
    'subtitle' => 'Igrejinha de São Benedito famosa',
    'image_path' => 'destinations/porto.png',
    'order' => 2,
    'created_at' => '2026-06-12 18:48:32',
    'updated_at' => '2026-06-12 18:48:32',
  ],
  2 => 
  [
    'id' => 11,
    'destination_id' => 2,
    'title' => 'Lago Negro',
    'subtitle' => 'Caminhada romântica e pedalinho',
    'image_path' => 'destinations/gramado.png',
    'order' => 1,
    'created_at' => '2026-06-12 18:48:33',
    'updated_at' => '2026-06-12 18:48:33',
  ],
  3 => 
  [
    'id' => 12,
    'destination_id' => 2,
    'title' => 'Cascata do Caracol',
    'subtitle' => 'Vista espetacular em Canela',
    'image_path' => 'destinations/gramado.png',
    'order' => 2,
    'created_at' => '2026-06-12 18:48:33',
    'updated_at' => '2026-06-12 18:48:33',
  ],
  4 => 
  [
    'id' => 13,
    'destination_id' => 3,
    'title' => 'Cristo Redentor',
    'subtitle' => 'Uma das maravilhas do mundo',
    'image_path' => 'destinations/rio.png',
    'order' => 1,
    'created_at' => '2026-06-12 18:48:34',
    'updated_at' => '2026-06-12 18:48:34',
  ],
  5 => 
  [
    'id' => 14,
    'destination_id' => 3,
    'title' => 'Praias de Arraial',
    'subtitle' => 'O caribe brasileiro',
    'image_path' => 'destinations/rio.png',
    'order' => 2,
    'created_at' => '2026-06-12 18:48:34',
    'updated_at' => '2026-06-12 18:48:34',
  ],
  6 => 
  [
    'id' => 15,
    'destination_id' => 4,
    'title' => 'Garganta do Diabo',
    'subtitle' => 'A maior queda das Cataratas',
    'image_path' => 'destinations/foz.png',
    'order' => 1,
    'created_at' => '2026-06-12 18:48:35',
    'updated_at' => '2026-06-12 18:48:35',
  ],
  7 => 
  [
    'id' => 16,
    'destination_id' => 4,
    'title' => 'Parque das Aves',
    'subtitle' => 'Contato direto com a natureza',
    'image_path' => 'destinations/foz.png',
    'order' => 2,
    'created_at' => '2026-06-12 18:48:36',
    'updated_at' => '2026-06-12 18:48:36',
  ],
];

        DB::table('destination_highlights')->insert($data);
        Schema::enableForeignKeyConstraints();
    }
}
