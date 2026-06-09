<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 50; $i++) {
            User::create([
                'nombre' => "Usuario $i",
                'email' => "usuario$i@gmail.com",
                'password' => bcrypt("password$i"), // Encripta la contraseña de prueba
            ]);
        }
    }
}