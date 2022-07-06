<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            // Vaciar la tabla.
            Product::truncate();

            $faker = \Faker\Factory::create();
            // Crear artículos en la tabla
            Product::create([
                'name' => 'Papa',
                'value' => '1500',
                'stock' => '35',
             ]);

             Product::create([
                'name' => 'Agua',
                'value' => '500',
                'stock' => '50',
             ]);

             Product::create([
                'name' => 'Empanada',
                'value' => '700',
                'stock' => '20',
             ]);

             Product::create([
                'name' => 'Arroz',
                'value' => '2500',
                'stock' => '25',
             ]);

             Product::create([
                'name' => 'Arepa',
                'value' => '2000',
                'stock' => '1200',
             ]);
    }
}
