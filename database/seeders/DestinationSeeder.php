<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('destinations')->truncate();

        $data = [
  0 => 
  [
    'id' => 1,
    'title' => 'Porto de Galinhas',
    'subtitle' => 'Maragogi + Carneiros',
    'image_path' => 'destinations/porto.png',
    'duration' => '7 DIAS',
    'category' => 'AÉREO + HOTEL + PASSEIOS',
    'price' => 69.99,
    'tag' => 'MAIS VENDIDO',
    'is_featured' => 1,
    'whatsapp_link' => NULL,
    'created_at' => '2026-06-12 18:48:31',
    'updated_at' => '2026-06-14 20:58:16',
    'slug' => 'porto-de-galinhas',
    'banner_image_path' => 'destinations/porto.png',
    'full_price' => 'R$ 4.890',
    'date_range' => '12 a 18 de Outubro 2026',
    'nights' => '7 dias / 6 noites',
    'departure_date' => '12 de Outubro 2026',
    'return_date' => '18 de Outubro 2026',
    'departure_city' => 'Fortaleza - CE',
    'trip_type' => 'Pacote Individual / Família',
    'highlights_icons' => 
    [
      0 => 'hotel',
      1 => 'plane',
    ],
    'type' => 'pacote-principal',
  ],
  1 => 
  [
    'id' => 2,
    'title' => 'Gramado',
    'subtitle' => 'Canela + Bento Gonçalves',
    'image_path' => 'destinations/gramado.png',
    'duration' => '7 DIAS',
    'category' => 'AÉREO + HOTEL + PASSEIOS',
    'price' => 159,
    'tag' => NULL,
    'is_featured' => 1,
    'whatsapp_link' => NULL,
    'created_at' => '2026-06-12 18:48:32',
    'updated_at' => '2026-06-14 23:17:34',
    'slug' => 'gramado',
    'banner_image_path' => 'destinations/gramado.png',
    'full_price' => 'R$ 6.350',
    'date_range' => '10 a 16 de Novembro 2026',
    'nights' => '7 dias / 6 noites',
    'departure_date' => '10 de Novembro 2026',
    'return_date' => '16 de Novembro 2026',
    'departure_city' => 'Fortaleza - CE',
    'trip_type' => 'Grupo com Guia',
    'highlights_icons' => 
    [
      0 => 'hotel',
      1 => 'plane',
      2 => 'utensils',
    ],
    'type' => 'viagem-em-grupo',
  ],
  2 => 
  [
    'id' => 3,
    'title' => 'Rio de Janeiro',
    'subtitle' => 'Arraial do Cabo',
    'image_path' => 'destinations/rio.png',
    'duration' => '6 DIAS',
    'category' => 'AÉREO + HOTEL + PASSEIOS',
    'price' => 249,
    'tag' => NULL,
    'is_featured' => 1,
    'whatsapp_link' => NULL,
    'created_at' => '2026-06-12 18:48:34',
    'updated_at' => '2026-06-14 23:17:26',
    'slug' => 'rio-de-janeiro',
    'banner_image_path' => 'destinations/rio.png',
    'full_price' => 'R$ 5.120',
    'date_range' => '15 a 20 de Março 2027',
    'nights' => '6 dias / 5 noites',
    'departure_date' => '15 de Março 2027',
    'return_date' => '20 de Março 2027',
    'departure_city' => 'Fortaleza - CE',
    'trip_type' => 'Pacote Individual / Casal',
    'highlights_icons' => 
    [
      0 => 'hotel',
      1 => 'plane',
    ],
    'type' => 'bate-e-volta',
  ],
  3 => 
  [
    'id' => 4,
    'title' => 'Foz do Iguaçu',
    'subtitle' => 'Argentina + Paraguai',
    'image_path' => 'destinations/foz.png',
    'duration' => '6 DIAS',
    'category' => 'HOTEL + PASSEIOS',
    'price' => 159,
    'tag' => NULL,
    'is_featured' => 1,
    'whatsapp_link' => NULL,
    'created_at' => '2026-06-12 18:48:35',
    'updated_at' => '2026-06-14 23:17:00',
    'slug' => 'foz-do-iguacu',
    'banner_image_path' => 'destinations/foz.png',
    'full_price' => 'R$ 4.950',
    'date_range' => '05 a 10 de Junho 2027',
    'nights' => '6 dias / 5 noites',
    'departure_date' => '05 de Junho 2027',
    'return_date' => '10 de Junho 2027',
    'departure_city' => 'Fortaleza - CE',
    'trip_type' => 'Grupo com Guia',
    'highlights_icons' => 
    [
      0 => 'hotel',
    ],
    'type' => 'pacotes-2026-2027',
  ],
];

        foreach ($data as &$item) {
            if (isset($item['highlights_icons']) && is_array($item['highlights_icons'])) {
                $item['highlights_icons'] = json_encode($item['highlights_icons']);
            }
        }

        DB::table('destinations')->insert($data);
        Schema::enableForeignKeyConstraints();
    }
}
