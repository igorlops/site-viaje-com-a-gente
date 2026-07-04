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

        $services = [
            [
                'title' => 'Passagens Aéreas',
                'subtitle'  => 'Viaje com conforto e segurança. Escolha entre diversas companhias aéreas e voe com total segurança e qualidade.',
                'image_path' => 'services/images/passagens-aereas.png',
            ],
            [
                'title' => 'Hospedagens',
                'subtitle'  => 'Para todos os estilos. De resorts luxuosos a pousadas aconchegantes — encontre a opção ideal para sua viagem.',
                'image_path' => 'services/images/hospedagens.png',
            ],
            [
                'title' => 'Seguro Viagem',
                'subtitle'  => 'Proteção completa para sua viagem. Tenha cobertura para emergências médicas, atrasos de voo e extravio.',
                'image_path' => 'services/images/seguro-viagem.jpg',
            ],
            [
                'title' => 'Transfer Privativo',
                'subtitle'  => 'Escolha entre opções privativas ou compartilhadas e encontre o serviço ideal para sua viagem.',
                'image_path' => 'services/images/transfer-privativo.jpg',
            ],
            [
                'title' => 'Receptivos',
                'subtitle'  => 'Recepção personalizada no aeroporto. Seja recebido por nossa equipe e tenha um início de viagem tranquilo.',
                'image_path' => 'services/images/receptivos.jpg',
            ],
            [
                'title' => 'Locação de Veículos',
                'subtitle'  => 'Alugue seu carro com facilidade. Escolha entre uma ampla variedade de veículos e viaje com praticidade.',
                'image_path' => 'services/images/locacao-veiculos.jpg',
            ],
            [
                'title' => 'Pacotes Turísticos',
                'subtitle'  => 'Passagem, hospedagem, transfer e passeios em um só pacote! Viaje sem preocupações e aproveite ao máximo.',
                'image_path' => 'services/images/pacotes-turisticos.jpg',
            ],
            [
                'title' => 'Viagens em Grupos',
                'subtitle'  => 'Seja uma viagem com amigos, família ou empresa, criamos roteiros sob medida para sua necessidade.',
                'image_path' => 'services/images/viagens-grupos.jpg',
            ],
            [
                'title' => 'Passeios Diversos',
                'subtitle'  => 'Escolha entre experiências exclusivas ou compartilhe momentos inesquecíveis com outros viajantes.',
                'image_path' => 'services/images/passeios-diversos.jpg',
            ],
        ];

        DB::table('services')->insert($services);

        Schema::enableForeignKeyConstraints();
    }
}
