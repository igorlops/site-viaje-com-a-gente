<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SocialLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('social_links')->truncate();

        $data = [
  0 => 
  [
    'id' => 1,
    'name' => 'Instagram',
    'url' => 'https://instagram.com/viajecomagente',
    'icon' => 'fab fa-instagram',
    'active' => 1,
    'created_at' => '2026-06-12 18:48:36',
    'updated_at' => '2026-06-12 18:48:36',
  ],
  1 => 
  [
    'id' => 2,
    'name' => 'Facebook',
    'url' => 'https://facebook.com/viajecomagente',
    'icon' => 'fab fa-facebook-f',
    'active' => 1,
    'created_at' => '2026-06-12 18:48:36',
    'updated_at' => '2026-06-12 18:48:36',
  ],
  2 => 
  [
    'id' => 3,
    'name' => 'TikTok',
    'url' => 'https://tiktok.com/@viajecomagente',
    'icon' => 'fab fa-tiktok',
    'active' => 1,
    'created_at' => '2026-06-12 18:48:36',
    'updated_at' => '2026-06-12 18:48:36',
  ],
  3 => 
  [
    'id' => 4,
    'name' => 'WhatsApp',
    'url' => 'https://wa.me/5585999166421',
    'icon' => 'fab fa-whatsapp',
    'active' => 1,
    'created_at' => '2026-06-12 18:48:36',
    'updated_at' => '2026-06-12 18:48:36',
  ],
];

        DB::table('social_links')->insert($data);
        Schema::enableForeignKeyConstraints();
    }
}
