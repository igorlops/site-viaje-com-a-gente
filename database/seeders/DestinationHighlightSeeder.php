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

        // ATENÇÃO: as imagens enviadas não mostram uma seção de "highlights" para este destino.
        // Os 2 itens abaixo foram INFERIDOS a partir dos pontos mais fortes do roteiro
        // (Cristo Redentor e Arraial do Cabo), seguindo o padrão de 2 highlights por destino
        // usado nos outros seeders. Ajuste título/subtítulo/imagem conforme necessário.
        $data = [
  0 =>
  [
    'id' => 1,
    'destination_id' => 1,
    'title' => 'Cristo Redentor',
    'subtitle' => 'Uma das 7 Maravilhas do Mundo',
    'image_path' => 'destinations/rio.png',
    'order' => 1,
    'created_at' => '2026-07-04 12:00:00',
    'updated_at' => '2026-07-04 12:00:00',
  ],
  1 =>
  [
    'id' => 2,
    'destination_id' => 1,
    'title' => 'Arraial do Cabo',
    'subtitle' => 'Day use com passeio de barco e almoço incluso',
    'image_path' => 'destinations/rio.png',
    'order' => 2,
    'created_at' => '2026-07-04 12:00:00',
    'updated_at' => '2026-07-04 12:00:00',
  ],
];

        DB::table('destination_highlights')->insert($data);
        Schema::enableForeignKeyConstraints();
    }
}