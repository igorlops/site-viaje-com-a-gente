<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('banners')->truncate();

        $data = [
  0 => 
  [
    'id' => 1,
    'title' => 'Sua próxima viagem está',
    'subtitle' => 'Viaje com segurança, parcele no boleto e conte com a gente do planejamento ao retorno.',
    'image_path' => 'banners/page-home.jpeg',
    'active' => 1,
    'created_at' => '2026-06-12 18:48:30',
    'updated_at' => '2026-06-15 01:02:23',
    'page_id' => 1,
    'titulo_destaque' => 'mais perto do que você imagina!',
  ],
  1 => 
  [
    'id' => 2,
    'title' => 'Passeios',
    'subtitle' => 'Viaje no final de semana ou feriado e retorne no mesmo dia. Conheça as melhores praias e serras pertinho de Fortaleza com segurança e conforto.',
    'image_path' => 'banners/FexT0MWrtxRlNeSMb5REg5OHQVHO5OWCyYOO2Q6h.jpg',
    'active' => 1,
    'created_at' => '2026-06-14 23:44:17',
    'updated_at' => '2026-06-14 23:48:44',
    'page_id' => 3,
    'titulo_destaque' => 'Bate e Volta',
  ],
  2 => 
  [
    'id' => 3,
    'title' => 'Viagens',
    'subtitle' => 'Viaje acompanhado por guias dedicados desde o embarque e viva experiências compartilhadas fantásticas com novos amigos e segurança total.',
    'image_path' => 'banners/h88KiY0GRtMQiLJAOpJH2gqvT1LonLEapp2XPBtY.jpg',
    'active' => 1,
    'created_at' => '2026-06-14 23:52:35',
    'updated_at' => '2026-06-14 23:52:35',
    'page_id' => 4,
    'titulo_destaque' => 'em Grupo',
  ],
  3 => 
  [
    'id' => 4,
    'title' => 'Pacotes 2026/2027 com',
    'subtitle' => 'Garanta seu destino com preço fixo, parcelamento no boleto e todo o suporte da Viaje com a Gente, do planejamento até a volta pra casa.',
    'image_path' => 'banners/e4w6He7FZedBmwiqV92gURZn1FGNbhN9JLBFfNWf.jpg',
    'active' => 1,
    'created_at' => '2026-06-21 02:58:17',
    'updated_at' => '2026-06-21 02:58:17',
    'page_id' => 7,
    'titulo_destaque' => 'as melhores condições do ano',
  ],
  4 => 
  [
    'id' => 5,
    'title' => 'Fale',
    'subtitle' => 'Dúvidas, sugestões ou orçamentos personalizados? Envie uma mensagem no formulário abaixo ou fale diretamente pelos canais de atendimento.',
    'image_path' => 'banners/HZB6Tn47Q92BbzVaZjHv1jaQhLeqJK8Tul60Y2Mz.jpg',
    'active' => 1,
    'created_at' => '2026-06-21 04:56:20',
    'updated_at' => '2026-06-21 04:56:20',
    'page_id' => 6,
    'titulo_destaque' => 'Conosco',
  ],
  5 => 
  [
    'id' => 6,
    'title' => 'Nossos',
    'subtitle' => 'Oferecemos soluções completas de logística de viagem e suporte especializado para garantir que sua única preocupação seja aproveitar a experiência ao máximo.',
    'image_path' => 'banners/x8PTnTplykCLmb5uSML3fDq7cWApwU5Je3T9atLq.jpg',
    'active' => 1,
    'created_at' => '2026-06-21 04:58:02',
    'updated_at' => '2026-06-21 04:58:02',
    'page_id' => 2,
    'titulo_destaque' => 'Serviços',
  ],
  6 => 
  [
    'id' => 7,
    'title' => 'Dúvidas',
    'subtitle' => 'Tem alguma dúvida sobre sua próxima viagem? Reunimos aqui as respostas para as perguntas mais comuns dos nossos clientes.',
    'image_path' => 'banners/44e2fDGx5NWkwqDiXalugpFgT65nIqR2gzUyXWHV.jpg',
    'active' => 1,
    'created_at' => '2026-06-21 04:59:34',
    'updated_at' => '2026-06-21 04:59:34',
    'page_id' => 5,
    'titulo_destaque' => 'Frequentes',
  ],
];

        DB::table('banners')->insert($data);
        Schema::enableForeignKeyConstraints();
    }
}
