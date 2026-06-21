<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('services')->truncate();

        $data = [
  0 => 
  [
    'id' => 1,
    'title' => 'Intercambio Estudantil',
    'slug' => 'intercambio-estudantil',
    'subtitle' => 'Aprenda novos idiomas e costumes através do nosso intercambio',
    'summary' => 'Intercambio alskdançsldkDFÇKLAJSHDFLAKSDJFNASDKLFJNASDKLFJNASDKFJASNDFKLASJDNFAKLSDJF NAKLSDJ NFASDKJFNASKDLFJNASDKFJAN KSD NK JNSADKFJNASDKFJ NAS',
    'content' => 'Viaje com **total tranquilidade** e aproveite cada momento da sua jornada. Nossa equipe garante *atendimento personalizado* do início ao fim, com parcelamento facilitado e suporte 24h. Saiba mais em nosso [site oficial](https://viajecomagente.com.br] ou fale direto pelo WhatsApp.',
    'banner_path' => 'services/banners/IgSwkfIfhizmQTNvcXBFz0gxGyIqAQAyHYQomuDt.jpg',
    'image_path' => 'services/images/xHutPaJ9mGUyAwzd3w8XrRShjYtTXXK3gi6Nkgrk.jpg',
    'status' => 'published',
    'show_in_menu' => 1,
    'meta_title' => 'Viaje com a gente',
    'meta_description' => 'asdas\\dsdfasdfasdfasdfasdfasdfasdfasdf',
    'meta_keywords' => 'arquiteto fortaleza, arquitetura alto padrão, projetos residenciais fortaleza, escritório de arquitetura ceará',
    'og_title' => 'afasdfsdfasdfasdf',
    'og_description' => 'sdfasdfasdfasdfasdfasdfasdfasdfasddsghsghfghdfgh',
    'og_image' => NULL,
    'deleted_at' => NULL,
    'created_at' => '2026-06-20 00:10:05',
    'updated_at' => '2026-06-21 04:52:13',
  ],
];

        DB::table('services')->insert($data);
        Schema::enableForeignKeyConstraints();
    }
}
