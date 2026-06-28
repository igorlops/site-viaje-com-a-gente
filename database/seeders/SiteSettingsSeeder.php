<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Grupo: Identidade
            [
                'key'   => 'logo_navbar',
                'value' => 'assets/images/logo.jpeg',
                'type'  => 'image',
                'label' => 'Logo do Menu (Navbar)',
                'group' => 'identidade',
                'order' => 1,
            ],
            [
                'key'   => 'logo_head',
                'value' => 'assets/images/logo.jpeg',
                'type'  => 'image',
                'label' => 'Logo do Cabeçalho (Favicon / OG Image)',
                'group' => 'identidade',
                'order' => 2,
            ],
            [
                'key'   => 'site_name',
                'value' => 'Viaje com a Gente',
                'type'  => 'text',
                'label' => 'Nome do Site',
                'group' => 'identidade',
                'order' => 3,
            ],
            [
                'key'   => 'site_slogan',
                'value' => 'Sua agência de viagens de confiança',
                'type'  => 'text',
                'label' => 'Slogan / Descrição Curta',
                'group' => 'identidade',
                'order' => 4,
            ],

            // Grupo: Contato
            [
                'key'   => 'contact_email',
                'value' => 'contato@viajcomgente.com.br',
                'type'  => 'email',
                'label' => 'E-mail de Contato',
                'group' => 'contato',
                'order' => 1,
            ],
            [
                'key'   => 'contact_phone',
                'value' => '',
                'type'  => 'text',
                'label' => 'Telefone / WhatsApp',
                'group' => 'contato',
                'order' => 2,
            ],
            [
                'key'   => 'contact_address',
                'value' => '',
                'type'  => 'textarea',
                'label' => 'Endereço',
                'group' => 'contato',
                'order' => 3,
            ],

            // Grupo: SEO
            [
                'key'   => 'meta_title_default',
                'value' => 'Viaje com a Gente — Agência de Viagens',
                'type'  => 'text',
                'label' => 'Título Meta Padrão',
                'group' => 'seo',
                'order' => 1,
            ],
            [
                'key'   => 'meta_description_default',
                'value' => 'Encontre os melhores pacotes de viagem com a Viaje com a Gente. Destinos nacionais e internacionais com o melhor atendimento.',
                'type'  => 'textarea',
                'label' => 'Descrição Meta Padrão',
                'group' => 'seo',
                'order' => 2,
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
