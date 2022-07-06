<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla.
        Role::truncate();

        $faker = \Faker\Factory::create();
        // Crear artículos en la tabla
        Role::create([
            'name' => 'ROLE_ADMIN',
         ]);

        Role::create([
            'name' => 'ROLE_VENDEDOR',
        ]);

        Role::create([
            'name' => 'ROLE_CLIENT',
        ]);
    }
}
