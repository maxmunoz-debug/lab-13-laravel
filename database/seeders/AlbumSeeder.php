<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 50; $i++) {
            for ($j = 1; $j <= 2; $j++) {
                Album::create([
                    'nombre' => "Album $j de Usuario $i",
                    'descripcion' => "Este es el album $j creado para el usuario $i.",
                    'user_id' => $i,
                ]);
            }
        }
    }
}