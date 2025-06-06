@extends('adminlte::page')

@section('title', 'Perfil')

@section('css')
<link rel="stylesheet" href="/css/admincolores.css">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
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
<div class="mb-2" id="mensaje-exito" style="background-color: #d4edda; padding: 10px; border-radius: 5px; color: #155724;">
    {{ session('success') }}
</div>
<script>
    setTimeout(() => {
        const mensaje = document.getElementById('mensaje-exito');
        if (mensaje) {
            mensaje.style.transition = "opacity 0.5s ease";
            mensaje.style.opacity = '0';
            setTimeout(() => mensaje.remove(), 500);
        }
    }, 3000);
</script>
@endif

<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#crearContenidoModal">
    Crear contenido
</button>

<!-- Modal Crear Contenido -->
<div class="modal fade" id="crearContenidoModal" tabindex="-1" aria-labelledby="crearContenidoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formCrearContenido" action="{{ route('perfil.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Crear Contenido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Prioridad</label>
                        <select name="prioridad" class="form-control form-control-sm" required>
                            <option value="" disabled selected>Seleccione una prioridad</option>
                            <option value="1">Alta</option>
                            <option value="2">Baja</option>
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
                        <label class="form-label small">Imagen</label>
                        <input type="file" name="imagen" class="form-control form-control-sm">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Crear Contenido</button>
                </div>
            </form>
        </div>
    </div>
</div>

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

                <div class="modal-header">
                    <h5 class="modal-title">Editar Contenido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Prioridad</label>
                        <select name="prioridad" class="form-control form-control-sm" required>
                            <option value="1" {{ $item->prioridad == 1 ? 'selected' : '' }}>Alta</option>
                            <option value="2" {{ $item->prioridad == 2 ? 'selected' : '' }}>Baja</option>
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
                        <label class="form-label small">Imagen</label>
                        <input type="file" name="imagen" class="form-control form-control-sm">
                        @if ($item->imagen)
                        <div class="mt-2">
                            <img src="{{ asset($item->imagen) }}" style="width: 100px; border-radius: 5px;" alt="Imagen actual">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="eliminar_imagen" value="1" id="eliminarImagen{{ $item->id }}">
                                <label class="form-check-label" for="eliminarImagen{{ $item->id }}">Eliminar imagen actual</label>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@stop
