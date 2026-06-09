<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Protege todo este controlador
    }

    public function index()
    {
        // Obtener los álbumes que pertenecen al usuario autenticado
        $albumes = Album::where('user_id', Auth::id())->get();

        // Carga la vista 'album.mostrar' pasándole la variable $albumes
        return view('album.mostrar', compact('albumes'));
    }
    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        Album::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('albumes.index')->with('correcto', 'Álbum creado correctamente');
    }
}
