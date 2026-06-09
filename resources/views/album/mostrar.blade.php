@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Mostrar alertas de éxito -->
            @if (session('correcto'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('correcto') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Formulario para Crear un Nuevo Álbum -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header font-weight-bold">{{ __('Crear Nuevo Álbum') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('album.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Álbum</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="2"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm">Crear Álbum</button>
                    </form>
                </div>
            </div>

            <!-- Listado de Álbumes -->
            <div class="card shadow-sm">
                <div class="card-header font-weight-bold">{{ __('Mis Álbumes') }}</div>

                <div class="card-body">
                    @if (sizeof($albumes) > 0)
                        <div class="list-group">
                            @foreach ($albumes as $album)
                                <div class="list-group-item flex-column align-items-start mb-3 border rounded shadow-sm p-4">
                                    <div class="d-flex w-100 justify-content-between mb-2">
                                        <h5 class="mb-1 font-weight-bold">{{ $album->nombre }}</h5>
                                    </div>
                                    <p class="mb-3 text-secondary">{{ $album->descripcion }}</p>
                                    
                                    <a href="{{ route('album.fotos', $album->id) }}" class="btn btn-sm btn-primary">
                                        Ver Fotos
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <p class="text-muted mb-0">No tienes álbumes registrados aún.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection