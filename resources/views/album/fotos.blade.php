@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Botón para regresar al listado de álbumes -->
            <a href="{{ route('albumes.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
                &larr; Volver a mis álbumes
            </a>

            <div class="card shadow-sm">
                <div class="card-header font-weight-bold">
                    {{ __('Fotos de: ') }} {{ $album->nombre }}
                </div>

                <div class="card-body">
                    <!-- Comprobamos si el álbum contiene fotos usando sizeof() -->
                    @if (sizeof($album->fotos) > 0)
                        <div class="row row-cols-1 row-cols-md-2 g-4">
                            @foreach ($album->fotos as $foto)
                                <div class="col">
                                    <div class="card h-100 border rounded shadow-sm">
                                        <div class="card-body">
                                            <h6 class="card-title font-weight-bold mb-1">{{ $foto->titulo }}</h6>
                                            <p class="card-text text-secondary small mb-0">Ruta: {{ $foto->ruta }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Mensaje si no contiene fotos -->
                        <div class="text-center py-5">
                            <p class="text-muted mb-0">Este álbum no tiene fotos cargadas aún.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection