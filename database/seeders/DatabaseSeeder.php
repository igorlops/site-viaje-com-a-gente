<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Banner;
use App\Models\Destination;
use App\Models\SocialLink;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Admin User
        User::updateOrCreate(
            ['email' => 'admin@viajecomagente.com.br'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin123'),
            ]
        );

        // 2. Seed Banner
        Banner::truncate();
        Banner::create([
            'title' => 'Sua próxima viagem está mais perto do que você imagina!',
            'subtitle' => 'Viaje com segurança, parcele no boleto e conte com a gente do planejamento ao retorno.',
            'image_path' => 'banners/page-home.jpeg',
            'active' => true,
        ]);

        // 3. Seed Destinations
        Destination::truncate();
        
        Destination::create([
            'title' => 'Porto de Galinhas',
            'subtitle' => 'Maragogi + Carneiros',
            'duration' => '7 DIAS',
            'category' => 'AÉREO + HOTEL + PASSEIOS',
            'price' => 69.99,
            'tag' => 'MAIS VENDIDO',
            'image_path' => 'destinations/porto.png',
            'is_featured' => true,
        ]);

        Destination::create([
            'title' => 'Gramado',
            'subtitle' => 'Canela + Bento Gonçalves',
            'duration' => '7 DIAS',
            'category' => 'AÉREO + HOTEL + PASSEIOS',
            'price' => 159.00,
            'tag' => null,
            'image_path' => 'destinations/gramado.png',
            'is_featured' => true,
        ]);

        Destination::create([
            'title' => 'Rio de Janeiro',
            'subtitle' => 'Arraial do Cabo',
            'duration' => '6 DIAS',
            'category' => 'AÉREO + HOTEL + PASSEIOS',
            'price' => 249.00,
            'tag' => null,
            'image_path' => 'destinations/rio.png',
            'is_featured' => true,
        ]);

        Destination::create([
            'title' => 'Foz do Iguaçu',
            'subtitle' => 'Argentina + Paraguai',
            'duration' => '6 DIAS',
            'category' => 'HOTEL + PASSEIOS',
            'price' => 159.00,
            'tag' => null,
            'image_path' => 'destinations/foz.png',
            'is_featured' => true,
        ]);

        // 4. Seed Social Links
        SocialLink::truncate();
        
        SocialLink::create([
            'name' => 'Instagram',
            'url' => 'https://instagram.com/viajecomagente',
            'icon' => 'fab fa-instagram',
            'active' => true,
        ]);

        SocialLink::create([
            'name' => 'Facebook',
            'url' => 'https://facebook.com/viajecomagente',
            'icon' => 'fab fa-facebook-f',
            'active' => true,
        ]);

        SocialLink::create([
            'name' => 'TikTok',
            'url' => 'https://tiktok.com/@viajecomagente',
            'icon' => 'fab fa-tiktok',
            'active' => true,
        ]);

        SocialLink::create([
            'name' => 'WhatsApp',
            'url' => 'https://wa.me/5585999166421',
            'icon' => 'fab fa-whatsapp',
            'active' => true,
        ]);
    }
}
