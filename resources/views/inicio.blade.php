@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <!-- Alerta de éxito al actualizar perfil (estilo minimalista) -->
            @if (session('correcto'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4 p-3" role="alert" style="background-color: #f0fdf4; color: #166534; border-radius: 8px;">
                    <div class="d-flex align-items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        <span>{{ session('correcto') }}</span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Encabezado Minimalista (Estilo Apple / Airbnb) -->
            <div class="d-flex flex-column border-bottom pb-4 mb-5">
                <h1 class="h2 mb-1" style="color: #18181b; font-weight: 600; letter-spacing: -0.025em; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
                    Hola, {{ Auth::user()->nombre }}
                </h1>
                <p class="text-secondary mb-0" style="font-size: 0.9rem;">
                    Resumen de tu galería y álbumes de fotos.
                </p>
            </div>

            <!-- Grid de Tarjetas -->
            <div class="row g-4">
                
                <!-- Tarjeta: Álbumes -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm transition-all hover-shadow" style="border: 1px solid #e4e4e7; border-radius: 12px; background: #ffffff;">
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center justify-content-between text-secondary mb-4" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 500;">
                                    <span>Colección</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-muted"><path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2z"></path></svg>
                                </div>
                                <h3 class="display-6 font-weight-bold mb-1" style="color: #18181b; font-weight: 600; letter-spacing: -0.025em; font-family: -apple-system, sans-serif;">
                                    {{ $totalAlbumes }}
                                </h3>
                                <p class="text-secondary small mb-0">Álbumes creados por tu cuenta</p>
                            </div>
                            <div class="mt-4 pt-3 border-top" style="border-top: 1px solid #f4f4f5 !important;">
                                <a href="{{ route('albumes.index') }}" class="text-dark font-weight-bold text-decoration-none d-flex align-items-center gap-1 btn-link-arrow" style="font-size: 0.8rem; font-weight: 600;">
                                    Ver mis álbumes
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="arrow-icon"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta: Fotos -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm transition-all hover-shadow" style="border: 1px solid #e4e4e7; border-radius: 12px; background: #ffffff;">
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center justify-content-between text-secondary mb-4" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 500;">
                                    <span>Fotografías</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-muted"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                </div>
                                <h3 class="display-6 font-weight-bold mb-1" style="color: #18181b; font-weight: 600; letter-spacing: -0.025em; font-family: -apple-system, sans-serif;">
                                    {{ $totalFotos }}
                                </h3>
                                <p class="text-secondary small mb-0">Total de fotos subidas</p>
                            </div>
                            <div class="mt-4 pt-3 border-top" style="border-top: 1px solid #f4f4f5 !important;">
                                <a href="{{ route('albumes.index') }}" class="text-dark font-weight-bold text-decoration-none d-flex align-items-center gap-1 btn-link-arrow" style="font-size: 0.8rem; font-weight: 600;">
                                    Ver todas las fotos
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="arrow-icon"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta: Seguridad / Cuenta -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm transition-all hover-shadow" style="border: 1px solid #e4e4e7; border-radius: 12px; background: #ffffff;">
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center justify-content-between text-secondary mb-4" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 500;">
                                    <span>Cuenta</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-muted"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                </div>
                                <h3 class="h6 font-weight-bold mb-1 truncate-text" style="color: #18181b; font-weight: 600; letter-spacing: -0.01em; margin-top: 15px; margin-bottom: 5px; font-family: -apple-system, sans-serif;">
                                    {{ Auth::user()->email }}
                                </h3>
                                <p class="text-secondary small mb-0">Correo registrado</p>
                            </div>
                            <div class="mt-4 pt-3 border-top" style="border-top: 1px solid #f4f4f5 !important;">
                                <a href="{{ route('usuario.actualizar') }}" class="text-dark font-weight-bold text-decoration-none d-flex align-items-center gap-1 btn-link-arrow" style="font-size: 0.8rem; font-weight: 600;">
                                    Configurar perfil
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="arrow-icon"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    /* Estilos sutiles y transiciones premium */
    .hover-shadow {
        transition: all 0.25s ease-in-out;
    }
    .hover-shadow:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 20px -8px rgba(24, 24, 27, 0.08) !important;
        border-color: #d4d4d8 !important;
    }
    .btn-link-arrow {
        color: #18181b !important;
        transition: opacity 0.2s ease;
    }
    .btn-link-arrow:hover {
        opacity: 0.7;
    }
    .arrow-icon {
        transition: transform 0.2s ease-in-out;
    }
    .btn-link-arrow:hover .arrow-icon {
        transform: translate(2px, -2px);
    }
    .truncate-text {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@endsection