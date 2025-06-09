@extends('adminlte::page')

@section('title', 'Perfil')

@section('css')
<link rel="stylesheet" href="/css/admincolores.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="/css/perfil.css">
<link rel="icon" href="{{ asset('favicon_io/favicon.ico') }}" type="image/x-icon">
@stop

@section('content_header')
<h1>Perfil</h1>
@stop

@section('content')

@if(session('success'))
<div id="mensaje-exito" class="mensaje-exito">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
<script>
    setTimeout(() => {
        const mensaje = document.getElementById('mensaje-exito');
        if (mensaje) {
            mensaje.style.opacity = '0';
            setTimeout(() => mensaje.remove(), 500);
        }
    }, 3000);
</script>
@endif

<!-- Botón a la derecha con estilo azul corporativo -->
<div class="header-container">
    <div class="d-flex justify-content-between align-items-center w-100">
        <h2 class="h4 text-muted mb-0">Gestión del perfil</h2>
        <button type="button" class="btn btn-crear" data-toggle="modal" data-target="#crearContenidoModal">
            <i class="fas fa-plus mr-2"></i> Crear contenido
        </button>
    </div>
</div>

<!-- Modal Crear Contenido con diseño unificado -->
<div class="modal fade" id="crearContenidoModal" tabindex="-1" aria-labelledby="crearContenidoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formCrearContenido" action="{{ route('perfil.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header modal-header-azul">
                    <h5 class="modal-title">Crear Contenido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Prioridad</label>
                        <select name="prioridad" class="form-control" required>
                            <option value="" disabled selected>Seleccione una prioridad</option>
                            <option value="1">Alta</option>
                            <option value="2">Baja</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Título</label>
                        <input type="text" name="titulo" class="form-control" maxlength="40" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Contenido</label>
                        <textarea name="contenido" class="form-control" maxlength="1000" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Imagen</label>
                        <input type="file" name="imagen" class="form-control">
                        <small class="form-text text-muted">Formatos aceptados: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-cancelar btn-modal" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-guardar btn-modal">Crear Contenido</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container mt-4">

    <!-- Tarjetas prioridad 1 -->
    @foreach ($contenido as $item)
        @if($item->prioridad == 1)
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="titulo-prioridad-1">{{ $item->titulo }}</h3>
                    <div class="d-flex flex-wrap flex-md-nowrap align-items-center">
                        @if ($item->imagen)
                            <img src="{{ asset($item->imagen) }}" alt="{{ $item->titulo }}" class="imagen-prioridad-1">
                        @endif
                        <p class="contenido-prioridad-1">{{ $item->contenido }}</p>
                    </div>
                    <div class="botones-izquierda">
                        <button type="button" class="btn btn-accion btn-editar" data-toggle="modal" data-target="#editarContenidoModal{{ $item->id }}">
                            <i class="fas fa-edit mr-1"></i> Editar
                        </button>
                        <form action="{{ route('perfil.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este contenido?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-accion btn-eliminar">
                                <i class="fas fa-trash mr-1"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    <!-- Tarjetas prioridad 2 -->
    <div class="row">
        @foreach ($contenido as $item)
            @if($item->prioridad == 2)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="titulo-prioridad-2">{{ $item->titulo }}</h5>
                            @if ($item->imagen)
                                <img src="{{ asset($item->imagen) }}" alt="{{ $item->titulo }}" class="imagen-prioridad-2">
                            @endif
                            <p class="contenido-prioridad-2 flex-grow-1">{{ $item->contenido }}</p>
                            <div class="d-flex justify-content-center gap-2 mt-2">
                                <button type="button" class="btn btn-accion btn-editar" data-toggle="modal" data-target="#editarContenidoModal{{ $item->id }}">
                                    <i class="fas fa-edit mr-1"></i> Editar
                                </button>
                                <form action="{{ route('perfil.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este contenido?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-accion btn-eliminar mx-3">
                                        <i class="fas fa-trash mr-1"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

</div>

<!-- editar modal -->
@foreach ($contenido as $item)
<div class="modal fade" id="editarContenidoModal{{ $item->id }}" tabindex="-1" aria-labelledby="editarContenidoModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('perfil.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header modal-header-azul">
                    <h5 class="modal-title">Editar Contenido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Prioridad</label>
                        <select name="prioridad" class="form-control" required>
                            <option value="1" {{ $item->prioridad == 1 ? 'selected' : '' }}>Alta</option>
                            <option value="2" {{ $item->prioridad == 2 ? 'selected' : '' }}>Baja</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Título</label>
                        <input type="text" name="titulo" class="form-control" maxlength="40" value="{{ $item->titulo }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Contenido</label>
                        <textarea name="contenido" class="form-control" maxlength="1000" required>{{ $item->contenido }}</textarea>
                    </div>
                    
                    
                    <!-- Sección de imagen unificada -->
                    <div class="form-group">
                        <div class="img-preview-container">
                            @if ($item->imagen)
                                <span class="img-preview-label">Imagen Actual</span>
                                <img src="{{ asset($item->imagen) }}" alt="Imagen actual" class="img-preview">
                                <div class="img-actions">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="eliminar_imagen" value="1" id="eliminarImagen{{ $item->id }}">
                                        <label class="form-check-label" for="eliminarImagen{{ $item->id }}">Eliminar imagen</label>
                                    </div>
                                </div>
                            @else
                                <span class="img-preview-label">No hay imagen actual</span>
                            @endif
                        </div>
                        
                        <label class="form-label">Cambiar Imagen (opcional)</label>
                        <input type="file" name="imagen" class="form-control">
                        <small class="form-text text-muted">Deje en blanco para mantener la imagen actual</small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-cancelar btn-modal" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-guardar btn-modal">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@stop