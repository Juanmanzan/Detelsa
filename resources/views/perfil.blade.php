@extends('adminlte::page')

@section('title', 'Perfil')

@section('css')
    <link rel="stylesheet" href="/css/admincolores.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <style>
        .card-body h5,
        .card-body h6 {
            font-weight: bold;
        }

        .card-body img {
            max-width: 30%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        @media (max-width: 767px) {
            .card-body img {
                max-width: 70%;
            }
        }
       
        .tarjeta-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .tarjeta-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stop

@section('content_header')
    <h1>Perfil</h1>
@stop

@section('content')

<!-- Botón para abrir el modal de creación -->
<div class="mb-4 text-end">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearContenidoModal">
        Crear contenido
    </button>
</div>

<!-- Modal Crear Contenido -->
<div class="modal fade" id="crearContenidoModal" tabindex="-1" aria-labelledby="crearContenidoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('perfil.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="crearContenidoModalLabel">Crear nuevo contenido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <!-- Campos del formulario -->
                    <div class="mb-3">
                        <label class="form-label small">Prioridad</label>
                        <select name="prioridad" class="form-control form-control-sm" required>
                            <option value="" disabled selected>Seleccione una prioridad</option>
                            <option value="1">Alta</option>
                            <option value="2">Media</option>
                            <option value="3">Baja</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small">Título</label>
                        <input type="text" name="titulo" class="form-control form-control-sm" maxlength="40" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small">Contenido</label>
                        <textarea name="contenido" class="form-control form-control-sm" maxlength="1000" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small">Imagen (opcional)</label>
                        <input type="file" name="imagen" class="form-control form-control-sm">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small">Posición de la imagen</label>
                        <select name="posicionimg" class="form-control form-control-sm" required>
                            <option value="" disabled selected>Seleccione la posición</option>
                            <option value="0">Arriba del contenido</option>
                            <option value="1">Al lado del contenido</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- LISTADO DE CONTENIDO -->
<div class="row">
@foreach ($contenido->sortBy('prioridad') as $item)
    @php
        $tituloTag = $item->prioridad == 1 ? 'h5' : ($item->prioridad == 2 ? 'h6' : 'p');
        $claseTexto = 'text-wrap small';
    @endphp

    <div class="col-md-6 mb-4">
        <div class="card border shadow-sm tarjeta-hover h-100">
            <div class="card-body">
                <div class="row">
                    @if ($item->imagen && $item->posicionimg == 1)
                        <div class="col-md-4 text-center mb-2 mb-md-0">
                            <img src="{{ asset($item->imagen) }}" class="img-fluid rounded" style="max-width: 40%;" alt="Imagen">
                        </div>
                    @endif

                    <div class="{{ $item->imagen && $item->posicionimg == 1 ? 'col-md-8' : 'col-12' }}">
                        <<?php echo $tituloTag; ?> class="fw-bold">{{ $item->titulo }}</<?php echo $tituloTag; ?>>
                        <p class="{{ $claseTexto }}">{{ $item->contenido }}</p>
                    </div>

                    @if ($item->imagen && $item->posicionimg == 0)
                        <div class="col-12 mt-2 text-center">
                            <img src="{{ asset($item->imagen) }}" class="img-fluid rounded" style="max-width: 40%;" alt="Imagen">
                        </div>
                    @endif
                </div>

                <!-- BOTONES -->
                <div class="mt-3 text-end">
                    <!-- Editar -->
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editarContenidoModal{{ $item->id }}">Editar</button>

                    <!-- Eliminar -->
                    <form action="{{ route('perfil.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este contenido?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Contenido -->
    <div class="modal fade" id="editarContenidoModal{{ $item->id }}" tabindex="-1" aria-labelledby="editarContenidoModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('perfil.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarContenidoModalLabel{{ $item->id }}">Editar contenido</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small">Prioridad</label>
                            <select name="prioridad" class="form-control form-control-sm" required>
                                <option value="1" {{ $item->prioridad == 1 ? 'selected' : '' }}>Alta</option>
                                <option value="2" {{ $item->prioridad == 2 ? 'selected' : '' }}>Media</option>
                                <option value="3" {{ $item->prioridad == 3 ? 'selected' : '' }}>Baja</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Título</label>
                            <input type="text" name="titulo" class="form-control form-control-sm" maxlength="40" value="{{ $item->titulo }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Contenido</label>
                            <textarea name="contenido" class="form-control form-control-sm" maxlength="1000" required>{{ $item->contenido }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Imagen (opcional)</label>
                            <input type="file" name="imagen" class="form-control form-control-sm">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Posición de la imagen</label>
                            <select name="posicionimg" class="form-control form-control-sm" required>
                                <option value="0" {{ $item->posicionimg == 0 ? 'selected' : '' }}>Arriba del contenido</option>
                                <option value="1" {{ $item->posicionimg == 1 ? 'selected' : '' }}>Al lado del contenido</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
</div>

@stop

