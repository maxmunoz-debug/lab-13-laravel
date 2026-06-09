<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Desactiva la comprobación de claves foráneas
        Schema::disableForeignKeyConstraints();

        // Vacía los registros existentes de las tablas
        DB::table('users')->truncate();
        DB::table('albums')->truncate();
        DB::table('fotos')->truncate();

        // Reactiva la comprobación
        Schema::enableForeignKeyConstraints();

        // Ejecuta las semillas en orden
        $this->call([
            UserSeeder::class,
            AlbumSeeder::class,
            FotoSeeder::class,
        ]);
    }
}