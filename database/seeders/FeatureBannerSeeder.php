<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FeatureBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('features_banner')->truncate();
        $features = [
            [
                "id" => 1,
                "name" => "Parcelamento Facilitado no Boleto",
                "icon" => "fas fa-barcode",
                "order" => 1,
                "banner_id" => 1,
                "created_at" => "2026-08-01 02:33:05",
                "updated_at" => "2026-08-01 02:33:05",
            ], 
            [
                "id" => 2,
                "name" => "Atendimento Humanizado",
                "icon" => "fas fa-headset",
                "order" => 2,
                "banner_id" => 1,
                "created_at" => "2026-08-01 02:33:05",
                "updated_at" => "2026-08-01 02:33:05",
            ], 
            [
                "id" => 3,
                "name" => "Suporte Antes, Durante e Após A Viagem",
                "icon" => "fas fa-shield",
                "order" => 3,
                "banner_id" => 1,
                "created_at" => "2026-08-01 02:33:05",
                "updated_at" => "2026-08-01 02:33:05",
            ], 
        ] ;
        DB::table('features_banner')->insert($features);
        // No records found in the database.
        Schema::enableForeignKeyConstraints();
    }
}
