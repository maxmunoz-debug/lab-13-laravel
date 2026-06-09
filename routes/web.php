<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\UsuarioController;

// Ruta pública de bienvenida
Route::get('/', function () {
    return view('bienvenida');
});

// Rutas de inicio de sesión, registro y recuperar contraseña (generadas por Laravel UI)
Auth::routes();

// Rutas protegidas (solo accesibles si el usuario inició sesión)
Route::middleware(['auth'])->group(function () {
    
    // Pantalla de Inicio / Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Actualización de Perfil 
    Route::get('/usuario/actualizar', [UsuarioController::class, 'getActualizar'])->name('usuario.actualizar');
    Route::post('/usuario/actualizar', [UsuarioController::class, 'postActualizar']);
    
    // Mostrar Álbumes 
    Route::get('/mis-albumes', [AlbumController::class, 'index'])->name('albumes.index');
    
    // Mostrar Fotos del Álbum 
    Route::get('/album/{id}/fotos', [FotoController::class, 'index'])->name('album.fotos');
        // Guardar nuevo álbum
    Route::post('/album/crear', [AlbumController::class, 'store'])->name('album.store');

    // Guardar nueva foto (Carga de imágenes)
    Route::post('/foto/subir', [FotoController::class, 'store'])->name('foto.store');
    
});