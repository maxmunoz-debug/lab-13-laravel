<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;

class FotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Protege todo este controlador
    }

    public function index($albumId)
    {
        // Buscar el álbum con sus fotos o dar error 404 si no existe
        $album = Album::with('fotos')->findOrFail($albumId);

        // Retorna la vista 'album.fotos' pasándole el álbum (que ya incluye sus fotos)
        return view('album.fotos', compact('album'));
    }
}