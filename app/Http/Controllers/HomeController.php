<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Protege el dashboard
    }

    public function index()
    {
        $user = Auth::user();

        // Contar cuántos álbumes tiene creados el usuario logueado
        $totalAlbumes = Album::where('user_id', $user->id)->count();

        // Contar cuántas fotos tiene en total en todos sus álbumes
        $totalFotos = Foto::whereHas('album', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();

        // Retorna la vista 'inicio' pasándole ambos totales
        return view('inicio', compact('totalAlbumes', 'totalFotos'));
    }
}