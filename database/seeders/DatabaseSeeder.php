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
        
        // Porto de Galinhas (2026)
        $porto = Destination::create([
            'title' => 'Porto de Galinhas',
            'subtitle' => 'Maragogi + Carneiros',
            'slug' => 'porto-de-galinhas',
            'duration' => '7 DIAS',
            'category' => 'AÉREO + HOTEL + PASSEIOS',
            'price' => 69.99,
            'tag' => 'MAIS VENDIDO',
            'image_path' => 'destinations/porto.png',
            'banner_image_path' => 'destinations/porto.png',
            'full_price' => 'R$ 4.890',
            'date_range' => '12 a 18 de Outubro 2026',
            'nights' => '7 dias / 6 noites',
            'departure_date' => '12 de Outubro 2026',
            'return_date' => '18 de Outubro 2026',
            'departure_city' => 'Fortaleza - CE',
            'trip_type' => 'Pacote Individual / Família',
            'highlights_icons' => ['plane', 'hotel', 'coffee'],
            'type' => 'pacote-principal',
            'is_featured' => true,
        ]);

        $porto->includes()->createMany([
            ['text' => 'Passagem aérea de ida e volta saindo de Fortaleza', 'type' => 'included', 'order' => 1],
            ['text' => 'Hospedagem de 6 noites com café da manhã', 'type' => 'included', 'order' => 2],
            ['text' => 'Translado aeroporto / hotel / aeroporto', 'type' => 'included', 'order' => 3],
            ['text' => 'Passeio completo a Maragogi e Praia dos Carneiros', 'type' => 'included', 'order' => 4],
            ['text' => 'Almoço e bebidas não inclusos nos passeios', 'type' => 'not_included', 'order' => 1],
            ['text' => 'Taxas ambientais de turismo locais', 'type' => 'not_included', 'order' => 2],
        ]);

        $porto->highlights()->createMany([
            ['title' => 'Piscinas Naturais', 'subtitle' => 'Passeio de jangada incrível', 'image_path' => 'destinations/porto.png', 'order' => 1],
            ['title' => 'Praia dos Carneiros', 'subtitle' => 'Igrejinha de São Benedito famosa', 'image_path' => 'destinations/porto.png', 'order' => 2],
        ]);

        $day1 = $porto->itineraryDays()->create(['day_number' => 1, 'date' => '12 de Outubro 2026', 'label' => 'Dia 1: Chegada e Check-in', 'order' => 1]);
        $day1->activities()->createMany([
            ['activity' => 'Embarque no aeroporto de Fortaleza rumo a Recife', 'order' => 1],
            ['activity' => 'Translado privativo até o hotel em Porto de Galinhas', 'order' => 2],
        ]);
        $day2 = $porto->itineraryDays()->create(['day_number' => 2, 'date' => '13 de Outubro 2026', 'label' => 'Dia 2: Piscinas Naturais', 'order' => 2]);
        $day2->activities()->createMany([
            ['activity' => 'Passeio de jangada na maré baixa para ver peixinhos', 'order' => 1],
            ['activity' => 'Tarde livre para aproveitar a praia da vila', 'order' => 2],
        ]);

        // Gramado (2026)
        $gramado = Destination::create([
            'title' => 'Gramado',
            'subtitle' => 'Canela + Bento Gonçalves',
            'slug' => 'gramado',
            'duration' => '7 DIAS',
            'category' => 'AÉREO + HOTEL + PASSEIOS',
            'price' => 159.00,
            'tag' => null,
            'image_path' => 'destinations/gramado.png',
            'banner_image_path' => 'destinations/gramado.png',
            'full_price' => 'R$ 6.350',
            'date_range' => '10 a 16 de Novembro 2026',
            'nights' => '7 dias / 6 noites',
            'departure_date' => '10 de Novembro 2026',
            'return_date' => '16 de Novembro 2026',
            'departure_city' => 'Fortaleza - CE',
            'trip_type' => 'Grupo com Guia',
            'highlights_icons' => ['plane', 'hotel', 'utensils'],
            'type' => 'pacote-principal',
            'is_featured' => true,
        ]);

        $gramado->includes()->createMany([
            ['text' => 'Passagem aérea de ida e volta saindo de Fortaleza', 'type' => 'included', 'order' => 1],
            ['text' => 'Hospedagem em hotel selecionado com café da manhã', 'type' => 'included', 'order' => 2],
            ['text' => 'City tour guiado em Gramado e Canela', 'type' => 'included', 'order' => 3],
            ['text' => 'Ingresso para espetáculo especial do Natal Luz', 'type' => 'included', 'order' => 4],
            ['text' => 'Almoços, jantares e consumo extra', 'type' => 'not_included', 'order' => 1],
        ]);

        $gramado->highlights()->createMany([
            ['title' => 'Lago Negro', 'subtitle' => 'Caminhada romântica e pedalinho', 'image_path' => 'destinations/gramado.png', 'order' => 1],
            ['title' => 'Cascata do Caracol', 'subtitle' => 'Vista espetacular em Canela', 'image_path' => 'destinations/gramado.png', 'order' => 2],
        ]);

        $gday1 = $gramado->itineraryDays()->create(['day_number' => 1, 'date' => '10 de Novembro 2026', 'label' => 'Dia 1: Chegada à Serra Gaúcha', 'order' => 1]);
        $gday1->activities()->createMany([
            ['activity' => 'Voo de Fortaleza para Porto Alegre e translado para Gramado', 'order' => 1],
            ['activity' => 'Check-in e noite livre para caminhar pela Rua Coberta', 'order' => 2],
        ]);

        // Rio de Janeiro (2027)
        $rio = Destination::create([
            'title' => 'Rio de Janeiro',
            'subtitle' => 'Arraial do Cabo',
            'slug' => 'rio-de-janeiro',
            'duration' => '6 DIAS',
            'category' => 'AÉREO + HOTEL + PASSEIOS',
            'price' => 249.00,
            'tag' => null,
            'image_path' => 'destinations/rio.png',
            'banner_image_path' => 'destinations/rio.png',
            'full_price' => 'R$ 5.120',
            'date_range' => '15 a 20 de Março 2027',
            'nights' => '6 dias / 5 noites',
            'departure_date' => '15 de Março 2027',
            'return_date' => '20 de Março 2027',
            'departure_city' => 'Fortaleza - CE',
            'trip_type' => 'Pacote Individual / Casal',
            'highlights_icons' => ['plane', 'hotel', 'route'],
            'type' => 'pacote-principal',
            'is_featured' => true,
        ]);

        $rio->includes()->createMany([
            ['text' => 'Aéreo ida e volta Fortaleza / Rio / Fortaleza', 'type' => 'included', 'order' => 1],
            ['text' => 'Hospedagem em Copacabana com café', 'type' => 'included', 'order' => 2],
            ['text' => 'Passeio de barco em Arraial do Cabo', 'type' => 'included', 'order' => 3],
            ['text' => 'Despesas pessoais e passeios extras', 'type' => 'not_included', 'order' => 1],
        ]);

        $rio->highlights()->createMany([
            ['title' => 'Cristo Redentor', 'subtitle' => 'Uma das maravilhas do mundo', 'image_path' => 'destinations/rio.png', 'order' => 1],
            ['title' => 'Praias de Arraial', 'subtitle' => 'O caribe brasileiro', 'image_path' => 'destinations/rio.png', 'order' => 2],
        ]);

        $rday1 = $rio->itineraryDays()->create(['day_number' => 1, 'date' => '15 de Março 2027', 'label' => 'Dia 1: Chegada à Cidade Maravilhosa', 'order' => 1]);
        $rday1->activities()->createMany([
            ['activity' => 'Voo Fortaleza/Rio, recepção no aeroporto e translado', 'order' => 1],
        ]);

        // Foz do Iguaçu (2027)
        $foz = Destination::create([
            'title' => 'Foz do Iguaçu',
            'subtitle' => 'Argentina + Paraguai',
            'slug' => 'foz-do-iguacu',
            'duration' => '6 DIAS',
            'category' => 'HOTEL + PASSEIOS',
            'price' => 159.00,
            'tag' => null,
            'image_path' => 'destinations/foz.png',
            'banner_image_path' => 'destinations/foz.png',
            'full_price' => 'R$ 4.950',
            'date_range' => '05 a 10 de Junho 2027',
            'nights' => '6 dias / 5 noites',
            'departure_date' => '05 de Junho 2027',
            'return_date' => '10 de Junho 2027',
            'departure_city' => 'Fortaleza - CE',
            'trip_type' => 'Grupo com Guia',
            'highlights_icons' => ['hotel', 'route'],
            'type' => 'pacote-principal',
            'is_featured' => true,
        ]);

        $foz->includes()->createMany([
            ['text' => 'Hospedagem com café da manhã em Foz do Iguaçu', 'type' => 'included', 'order' => 1],
            ['text' => 'Translado para Cataratas Brasileiras e Parque das Aves', 'type' => 'included', 'order' => 2],
            ['text' => 'Translado de compras no Paraguai', 'type' => 'included', 'order' => 3],
            ['text' => 'Passagem aérea até Foz', 'type' => 'not_included', 'order' => 1],
        ]);

        $foz->highlights()->createMany([
            ['title' => 'Garganta do Diabo', 'subtitle' => 'A maior queda das Cataratas', 'image_path' => 'destinations/foz.png', 'order' => 1],
            ['title' => 'Parque das Aves', 'subtitle' => 'Contato direto com a natureza', 'image_path' => 'destinations/foz.png', 'order' => 2],
        ]);

        $fday1 = $foz->itineraryDays()->create(['day_number' => 1, 'date' => '05 de Junho 2027', 'label' => 'Dia 1: Chegada em Foz', 'order' => 1]);
        $fday1->activities()->createMany([
            ['activity' => 'Check-in no hotel e briefing com o guia do grupo', 'order' => 1],
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
