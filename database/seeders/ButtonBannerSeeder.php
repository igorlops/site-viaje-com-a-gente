<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ButtonBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('buttons_banner')->truncate();
        $button = [[

            "id"=> 1,
            "text"=> "Solicite um orçamento",
            "color"=> "#000000",
            "url"=> "https://wa.me/" . env('PHONE_NUMBER'),
            "target"=> "_blank",
            "order"=> 1,
            "banner_id"=> 1,
            "created_at"=> "2026-08-01 00:54:40",
            "updated_at"=> "2026-08-01 02:04:27",
            "bg_color"=> "#FFC700",
            "bg_hover_color"=> "#E5A800",
        ],
        [            
            "id"=> 2,
            "text"=> "Nossos pacotes",
            "color"=> "#ffffff",
            "url"=> "https://wa.me/" .env('PHONE_NUMBER'),
            "target"=> "_blank",
            "order"=> 2,
            "banner_id"=> 1,
            "created_at"=> "2026-08-01 00:54:40",
            "updated_at"=> "2026-08-01 02:04:27",
            "bg_color"=> "#0052CC",
            "bg_hover_color"=> "#083C91",]
        ];

        DB::table('buttons_banner')->insert($button);
        // No records found in the database.
        Schema::enableForeignKeyConstraints();
    }
}
