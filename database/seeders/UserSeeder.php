<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();

        $data = [
  0 => 
  [
    'id' => 1,
    'name' => 'Administrador',
    'email' => 'admin@viajecomagente.com.br',
    'email_verified_at' => NULL,
    'password' => '$2y$12$rQAXZA5AwJn/lNT4ohqCe.ceprcZNDVcFzYOgk9eqSQx9bipblqeG',
    'remember_token' => '4jL8ZMKwKPL8dbf3hBgFBhrLKaDJ9LH623PXoGb3O25U7JJ02gu32QWtz0GN',
    'created_at' => '2026-06-09 01:55:42',
    'updated_at' => '2026-06-12 18:48:30',
  ],
];

        DB::table('users')->insert($data);
        Schema::enableForeignKeyConstraints();
    }
}
