<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {        
        // Creamos la instancia de nuestro modelo
        $user = new User();

        $user->name = 'Nestor';
        $user->email = "nestor@gmail.com";
        $user->password = bcrypt('123456');

        $user->save();

        $user = new User();

        $user->name = 'Iris';
        $user->email = "iris@gmail.com";
        $user->password = bcrypt('123456');

        $user->save();

        // Para usar el factory definido
        // Con esto nos crearia 10 datos de prueba aleatorios
        User::factory(10)->create();
    }
}
