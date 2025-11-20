<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Products::create([
        //     'name' => 'Laptop',
        //     'short_description' => 'Laptop de 15 pulgadas',
        //     'description' => 'Laptop de 15 pulgadas con procesador de 64 bits',
        //     'price' => 2500.00
        // ]);
        // Products::create([
        //     'name' => 'Laptop',
        //     'short_description' => 'Laptop de 15 pulgadas',
        //     'description' => 'Laptop de 15 pulgadas con procesador de 64 bits',
        //     'price' => 2500.00
        // ]);
        // Products::create([
        //     'name' => 'Laptop',
        //     'short_description' => 'Laptop de 15 pulgadas',
        //     'description' => 'Laptop de 15 pulgadas con procesador de 64 bits',
        //     'price' => 2500.00
        // ]);
        Products::factory(10)->create();
    }
}
