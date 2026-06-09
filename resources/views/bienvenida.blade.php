@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0" style="border-radius: 12px;">
                <div class="card-header bg-white border-0 pt-4 text-center">
                    <h3 class="font-weight-bold" style="color: #18181b;">Gestor de Imágenes</h3>
                </div>

                <div class="card-body text-center p-5">
                    <p class="text-secondary mb-5" style="font-size: 1.05rem;">
                        Bienvenido a tu aplicación de álbumes de fotos. Inicia sesión o crea una cuenta nueva para comenzar a organizar tus recuerdos.
                    </p>
                    
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('login') }}" class="btn btn-primary px-4 py-2 font-weight-bold" style="border-radius: 8px;">
                            Iniciar Sesión
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline-secondary px-4 py-2 font-weight-bold" style="border-radius: 8px;">
                            Registrarse
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection