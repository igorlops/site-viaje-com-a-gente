<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('pages')->truncate();

        $data = [
  0 => 
  [
    'id' => 1,
    'name' => 'HOME',
    'slug' => 'home',
    'created_at' => '2026-06-11 22:34:12',
    'updated_at' => '2026-06-12 00:28:20',
    'meta_title' => 'Pacotes de Viagem em Fortaleza | Viaje com a Gente',
    'meta_description' => 'Pacotes de viagem nacionais e internacionais saindo de Fortaleza. Parcelamos no boleto, sem juros. Fale agora no WhatsApp e monte seu roteiro!',
    'meta_keywords' => 'pacotes de viagem Fortaleza, agência de viagens Fortaleza, viagens parceladas Ceará, pacotes de turismo Fortaleza, viagens baratas saindo de Fortaleza, agência de turismo Ceará',
  ],
  1 => 
  [
    'id' => 2,
    'name' => 'NOSSOS SERVIÇOS',
    'slug' => 'nossos-servicos',
    'created_at' => '2026-06-12 00:27:20',
    'updated_at' => '2026-06-12 00:27:20',
    'meta_title' => 'Nossos Serviços de Viagem | Viaje com a Gente',
    'meta_description' => 'Conheça todos os serviços da Viaje com a Gente: pacotes nacionais, internacionais, viagens em grupo, bate-e-volta e muito mais. Tudo parcelado no boleto!',
    'meta_keywords' => 'serviços de agência de viagens, pacotes nacionais Fortaleza, pacotes internacionais Ceará, assessoria de viagens Fortaleza, planejamento de viagem, roteiros personalizados Fortaleza',
  ],
  2 => 
  [
    'id' => 3,
    'name' => 'BATE E VOLTA',
    'slug' => 'bate-e-volta',
    'created_at' => '2026-06-12 00:27:43',
    'updated_at' => '2026-06-12 00:27:43',
    'meta_title' => 'Bate e Volta saindo de Fortaleza | Viaje com a Gente',
    'meta_description' => 'Passeios bate e volta saindo de Fortaleza: Canoa Quebrada, Jericoacoara, Cumbuco e mais. Roteiros de 1 dia com transporte incluso. Reserve pelo WhatsApp!',
    'meta_keywords' => 'bate e volta Fortaleza, passeio de um dia Fortaleza, excursão bate e volta Ceará, passeio Canoa Quebrada, passeio Jericoacoara saindo Fortaleza, turismo de um dia Ceará, bate volta praias Ceará',
  ],
  3 => 
  [
    'id' => 4,
    'name' => 'VIAGENS EM GRUPO',
    'slug' => 'viagens-em-grupo',
    'created_at' => '2026-06-12 00:28:07',
    'updated_at' => '2026-06-12 00:28:07',
    'meta_title' => 'Viagens em Grupo saindo de Fortaleza | Viaje com a Gente',
    'meta_description' => 'Organize sua viagem em grupo com a Viaje com a Gente! Excursões escolares, corporativas e familiares saindo de Fortaleza. Ônibus fretado, guia e roteiro incluso.',
    'meta_keywords' => 'viagens em grupo Fortaleza, excursão em grupo Ceará, viagem corporativa Fortaleza, turismo escolar Fortaleza, fretamento ônibus viagem Ceará, pacote grupo família Fortaleza, excursão organizada Ceará',
  ],
  4 => 
  [
    'id' => 5,
    'name' => 'PERGUNTAS FREQUENTES',
    'slug' => 'perguntas-frequentes',
    'created_at' => '2026-06-12 00:30:04',
    'updated_at' => '2026-06-12 00:30:04',
    'meta_title' => 'Perguntas Frequentes sobre Viagens | Viaje com a Gente',
    'meta_description' => 'Tire suas dúvidas sobre pacotes, formas de pagamento, cancelamentos e mais. Atendemos pelo WhatsApp e queremos tornar sua viagem mais fácil e segura!',
    'meta_keywords' => 'perguntas frequentes agência de viagens, como comprar pacote de viagem, parcelamento viagem boleto, cancelamento pacote viagem, dúvidas viagem Fortaleza, como funciona pacote de viagem',
  ],
  5 => 
  [
    'id' => 6,
    'name' => 'CONTATO',
    'slug' => 'contato',
    'created_at' => '2026-06-12 00:30:35',
    'updated_at' => '2026-06-12 00:30:35',
    'meta_title' => 'Fale Conosco — Agência de Viagens em Fortaleza | Viaje com a Gente',
    'meta_description' => 'Entre em contato com a Viaje com a Gente! Atendemos pelo WhatsApp, telefone e e-mail. Solicite seu orçamento e planeje a viagem dos seus sonhos agora.',
    'meta_keywords' => 'contato agência de viagens Fortaleza, WhatsApp agência de viagens Ceará, solicitar orçamento viagem Fortaleza, falar com agência de viagens, atendimento viagem Ceará',
  ],
  6 => 
  [
    'id' => 7,
    'name' => 'Pacotes 2026/2027',
    'slug' => 'pacotes-2026-2027',
    'created_at' => '2026-06-14 23:31:44',
    'updated_at' => '2026-06-14 23:31:44',
    'meta_title' => 'Pacotes de Viagem em Fortaleza | Viaje com a Gente',
    'meta_description' => 'Pacotes de viagem nacionais e internacionais saindo de Fortaleza. Parcelamos no boleto, sem juros. Fale agora no WhatsApp e monte seu roteiro!',
    'meta_keywords' => 'pacotes de viagem Fortaleza, agência de viagens Fortaleza, viagens parceladas Ceará, pacotes de turismo Fortaleza, viagens baratas saindo de Fortaleza, agência de turismo Ceará',
  ],
  7 => 
  [
    'id' => 8,
    'name' => 'DESTINOS',
    'slug' => 'pacotes',
    'created_at' => '2026-06-20 00:24:11',
    'updated_at' => '2026-06-20 00:24:11',
    'meta_title' => 'Pacotes de Viagem em Fortaleza | Viaje com a Gente',
    'meta_description' => 'Pacotes de viagem nacionais e internacionais saindo de Fortaleza. Parcelamos no boleto, sem juros. Fale agora no WhatsApp e monte seu roteiro!',
    'meta_keywords' => 'pacotes de viagem Fortaleza, agência de viagens Fortaleza, viagens parceladas Ceará, pacotes de turismo Fortaleza, viagens baratas saindo de Fortaleza, agência de turismo Ceará',
  ],
];

        DB::table('pages')->insert($data);
        Schema::enableForeignKeyConstraints();
    }
}
