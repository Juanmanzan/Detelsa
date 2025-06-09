@extends('adminlte::page')

@section('title', 'Perfil')

@section('css')
<link rel="stylesheet" href="/css/admincolores.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .tarjeta-prioridad-1 {
        width: 50%;
        margin-left: 10%;
        margin-bottom: 2rem;
        border: 1px solid #ccc;
        padding: 20px;
        background-color: transparent;
        border-radius: 10px;
    }

    .titulo-prioridad-1 {
        font-weight: bold;
    }

    .contenido-prioridad-1 {
        display: flex;
        align-items: flex-start;
        margin-top: 10px;
    }

    .contenido-prioridad-1 img {
        width: 300px;
        height: 200px;
        object-fit: cover;
        margin-right: 15px;
    }

    .contenido-prioridad-1 p {
        font-size: 1.5rem;
        flex: 1;
    }

    .botones {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .contenedor-prioridad-2 {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: space-between;
        margin: 30px 10%;
    }

    .tarjeta-prioridad-2 {
        width: 30%;
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 15px;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .tarjeta-prioridad-2 img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 4px;
        margin-bottom: 10px;
    }

    .tarjeta-prioridad-2 h5 {
        font-weight: bold;
        text-align: center;
        margin-bottom: 10px;
    }

    .tarjeta-prioridad-2 p {
        font-size: 1.3rem;
        text-align: justify;
    }

    .tarjeta-prioridad-1:hover,
    .tarjeta-prioridad-2:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }
    
  

</style>
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
    <div class="tarjeta-prioridad-1">
        <h3 class="titulo-prioridad-1">{{ $item->titulo }}</h3>
        <div class="contenido-prioridad-1">
            @if ($item->imagen)
            <img src="{{ asset($item->imagen) }}" alt="{{ $item->titulo }}">
            @endif
            <p>{{ $item->contenido }}</p>
        </div>
        <div class="botones">
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editarContenidoModal{{ $item->id }}">Editar</button>
            <form action="{{ route('perfil.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este contenido?')">Eliminar</button>
            </form>
        </div>
    </div>
    @endif
@endforeach

<!-- Tarjetas prioridad 2 -->
<div class="contenedor-prioridad-2">
    @foreach ($contenido as $item)
        @if($item->prioridad == 2)
        <div class="tarjeta-prioridad-2">
            <h5>{{ $item->titulo }}</h5>
            @if ($item->imagen)
            <img src="{{ asset($item->imagen) }}" alt="{{ $item->titulo }}">
            @endif
            <p>{{ $item->contenido }}</p>
            <div class="botones">
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editarContenidoModal{{ $item->id }}">Editar</button>
                <form action="{{ route('perfil.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este contenido?')">Eliminar</button>
                </form>
            </div>
        </div>
        @endif
    @endforeach
</div>

<!-- Modales de edición -->
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