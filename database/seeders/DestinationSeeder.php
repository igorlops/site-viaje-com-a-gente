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
    'title' => 'Rio de Janeiro + Arraial do Cabo',
    'subtitle' => 'Pacote completo com roteiro exclusivo, hospedagem e os principais passeios para você aproveitar o melhor de cada destino.',
    'image_path' => 'destinations/rio.png',
    'duration' => '6',
    'category' => 'AÉREO + HOTEL + PASSEIOS',
    'price' => 289.00, // ASSUMIDO: valor da entrada informado na imagem (R$ 289,00). Ajuste se "price" representar outra coisa no seu front.
    'tag' => NULL, // ASSUMIDO: nenhuma tag foi mostrada na imagem (ex: "MAIS VENDIDO")
    'is_featured' => 1,
    'whatsapp_link' => NULL,
    'created_at' => '2026-07-04 12:00:00',
    'updated_at' => '2026-07-04 12:00:00',
    'slug' => 'rio-de-janeiro-arraial-do-cabo',
    'banner_image_path' => 'destinations/rio.png',
    'full_price' => 'R$ 4.950',
    'date_range' => '05 a 10 de Junho 2027',
    'nights' => '6',
    'departure_date' => '05 de Junho 2027',
    'return_date' => '10 de Junho 2027',
    'departure_city' => 'Fortaleza - CE',
    'trip_type' => 'Pacote Individual / Família', // ASSUMIDO: não informado na imagem
    'highlights_icons' =>
    [
      0 => 'hotel',
      1 => 'plane',
    ],
    'type' => 'pacote-principal', // ASSUMIDO: não informado na imagem
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