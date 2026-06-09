@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Botón para regresar al listado de álbumes -->
            <a href="{{ route('albumes.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
                &larr; Volver a mis álbumes
            </a>

            <!-- Mostrar alertas de éxito o error -->
            @if (session('correcto'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                    {{ session('correcto') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Formulario para Subir Nueva Foto -->
            <div class="card mb-4 shadow-sm border-0" style="border: 1px solid #e4e4e7; border-radius: 12px;">
                <div class="card-header font-weight-bold bg-white" style="border-bottom: 1px solid #e4e4e7;">{{ __('Subir Nueva Foto') }}</div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('foto.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="album_id" value="{{ $album->id }}">

                        <div class="mb-3">
                            <label for="titulo" class="form-label font-weight-bold" style="font-size: 0.9rem;">Título de la Foto</label>
                            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" required style="border-radius: 8px;">
                            @error('titulo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label font-weight-bold" style="font-size: 0.9rem;">Seleccionar Imagen</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/*" required style="border-radius: 8px;">
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success btn-sm font-weight-bold px-3 py-2" style="border-radius: 6px;">
                            Subir Foto
                        </button>
                    </form>
                </div>
            </div>

            <!-- Listado de Fotos -->
            <div class="card shadow-sm border-0" style="border: 1px solid #e4e4e7; border-radius: 12px;">
                <div class="card-header font-weight-bold bg-white" style="border-bottom: 1px solid #e4e4e7;">
                    {{ __('Fotos de: ') }} {{ $album->nombre }}
                </div>

                <div class="card-body p-4">
                    <!-- Comprobamos si el álbum contiene fotos usando sizeof() -->
                    @if (sizeof($album->fotos) > 0)
                        <div class="row row-cols-1 row-cols-md-2 g-4">
                            @foreach ($album->fotos as $foto)
                                <div class="col">
                                    <div class="card h-100 border rounded shadow-sm overflow-hidden" style="border: 1px solid #e4e4e7 !important; border-radius: 10px;">
                                        <!-- Renderizado real de la imagen -->
                                        @if($foto->ruta)
                                            <img src="{{ asset($foto->ruta) }}" class="card-img-top" alt="{{ $foto->titulo }}" style="height: 180px; object-fit: cover; background-color: #f4f4f5;">
                                        @endif
                                        <div class="card-body p-3">
                                            <h6 class="card-title font-weight-bold mb-1 text-dark">{{ $foto->titulo }}</h6>
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