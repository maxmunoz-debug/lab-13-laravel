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

    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'album_id' => 'required|exists:albums,id',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096', // Máximo 4MB
        ]);

        $albumId = $request->album_id;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Crear el directorio si no existe en la carpeta pública
            $destinationPath = public_path('img/fotos');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }
            
            // Mover la imagen al directorio público
            $file->move($destinationPath, $filename);
            $ruta = 'img/fotos/' . $filename;

            // Registrar en la base de datos
            Foto::create([
                'titulo' => $request->titulo,
                'ruta' => $ruta,
                'album_id' => $albumId,
            ]);

            return redirect()->route('album.fotos', $albumId)->with('correcto', 'Foto subida correctamente');
        }

        return redirect()->route('album.fotos', $albumId)->with('error', 'No se pudo subir la foto');
    }
}