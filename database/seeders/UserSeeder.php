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
            0 => [
                'id' => 1,
                'name' => env('APP_NAME', 'Administrador'),
                'email' => env('APP_EMAIL', 'admin@viajecomagente.com.br'),
                'login' => env('APP_LOGIN', 'Viajecomagente'),
                'email_verified_at' => NULL,
                'password' => bcrypt(env('APP_PASSWORD', 'Admin1234#')),
                'remember_token' => '',
                'created_at' => '2026-06-09 01:55:42',
                'updated_at' => '2026-06-12 18:48:30',
  ],
];

        DB::table('users')->insert($data);
        Schema::enableForeignKeyConstraints();
    }
}
