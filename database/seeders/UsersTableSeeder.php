<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            // Vaciar la tabla
            User::truncate();
            $faker = \Faker\Factory::create();

            $password = Hash::make('123123');

            User::create([
            'name' => 'Administrador',
            'email' => 'admin@prueba.com',
            'password' => $password,
            'role' => 'ROLE_ADMIN'
            ]);

            User::create([
            'name' => 'Vendedor',
            'email' => 'vendedor@prueba.com',
            'password' => $password,
            'role' => 'ROLE_VENDEDOR'
            ]);

            User::create([
            'name' => 'Cliente',
            'email' => 'cliente@prueba.com',
            'password' => $password,
            'role' => 'ROLE_CLIENT'
            ]);

            User::create([
            'name' => 'Cliente2',
            'email' => 'cliente2@prueba.com',
            'password' => $password,
            'role' => 'ROLE_CLIENT'
            ]);

            User::create([
            'name' => 'Cliente3',
            'email' => 'cliente3@prueba.com',
            'password' => $password,
            'role' => 'ROLE_CLIENT'
            ]);
    }
}
