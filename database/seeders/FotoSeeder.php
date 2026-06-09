<?php

namespace Database\Seeders;

use App\Models\Foto;
use Illuminate\Database\Seeder;

class FotoSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 100; $i++) { // 50 usuarios * 2 álbumes = 100 álbumes en total
            for ($j = 1; $j <= 3; $j++) {
                Foto::create([
                    'titulo' => "Foto $j de Album $i",
                    'ruta' => "img/fotos/foto$j.jpg",
                    'album_id' => $i,
                ]);
            }
        }
    }
}