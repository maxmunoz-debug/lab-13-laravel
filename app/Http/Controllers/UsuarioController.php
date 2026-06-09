<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActualizarPerfilRequest;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Protege todo este controlador
    }

    // Mostrar el formulario
    public function getActualizar()
    {
        return view('usuario.actualizar');
    }

    // Procesar la actualización
    public function postActualizar(ActualizarPerfilRequest $request)
    {
        $usuario = Auth::user();

        // Actualizar el nombre
        $usuario->nombre = $request->nombre;

        // Si se escribió una nueva contraseña, encriptarla y guardarla
        if ($request->filled('password')) {
            $usuario->password = bcrypt($request->password);
        }

        $usuario->save();

        // Redirigir al inicio enviando el mensaje flash 'correcto'
        return redirect()->route('home')->with('correcto', 'Su perfil ha sido actualizado correctamente');
    }
}