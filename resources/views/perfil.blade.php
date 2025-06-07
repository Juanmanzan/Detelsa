@extends('adminlte::page')

@section('title', 'Perfil')

@section('css')
<link rel="stylesheet" href="/css/admincolores.css">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    :root {
        --azul-principal: #1a3a6c;
        --azul-secundario: #2c5282;
        --azul-claro: #4dabf7;
        --gris-medio: #e9ecef;
    }
    
    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .btn-crear {
        background: linear-gradient(135deg, var(--azul-principal), var(--azul-secundario));
        color: white;
        border: none;
        border-radius: 8px;
        padding: 12px 25px;
        font-weight: 600;
        font-size: 1rem;
        box-shadow: 0 5px 15px rgba(26, 58, 108, 0.25);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }
    
    .btn-crear i {
        margin-right: 8px;
    }
    
    .btn-crear:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(26, 58, 108, 0.35);
        background: linear-gradient(135deg, var(--azul-secundario), var(--azul-principal));
    }
    
    /* Estilos para los modales */
    .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 15px 35px rgba(26, 58, 108, 0.2);
        overflow: hidden;
    }
    
    .modal-header-azul {
        border-bottom: 1px solid #e9ecef;
        background: linear-gradient(135deg, var(--azul-principal), var(--azul-secundario));
        color: white;
        padding: 18px 20px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }
    
    .modal-title {
        font-weight: 700;
        font-size: 1.3rem;
    }
    
    .close {
        color: white;
        text-shadow: none;
        opacity: 0.8;
        font-size: 1.8rem;
    }
    
    .close:hover {
        color: white;
        opacity: 1;
    }
    
    .modal-footer {
        border-top: 1px solid #e9ecef;
        padding: 15px 20px;
        background-color: #f8f9fa;
    }
    
    .btn-modal {
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        border: none;
    }
    
    .btn-cancelar {
        background: linear-gradient(135deg, #6c757d, #5a6268);
        color: white;
    }
    
    .btn-cancelar:hover {
        background: linear-gradient(135deg, #5a6268, #495057);
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(108, 117, 125, 0.25);
    }
    
    .btn-guardar {
        background: linear-gradient(135deg, #28a745, #218838);
        color: white;
    }
    
    .btn-guardar:hover {
        background: linear-gradient(135deg, #218838, #1e7e34);
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(40, 167, 69, 0.3);
    }
    
    /* Mantener el resto de tus estilos existentes */
    .titulo-prioridad-1 {
        font-weight: bold;
        font-size: 1.8rem;
        margin-bottom: 15px;
        color: var(--azul-principal);
    }

    .titulo-prioridad-2 {
        font-weight: bold;
        font-size: 1.6rem;
        margin-bottom: 10px;
        color: var(--azul-principal);
    }

    .contenido-prioridad-1 {
        font-size: 1.25rem;
        text-align: justify;
        line-height: 1.6;
    }

    .contenido-prioridad-2 {
        font-size: 1.1rem;
        text-align: justify;
        line-height: 1.5;
    }

    .imagen-prioridad-1 {
        max-width: 280px;
        max-height: 280px;
        object-fit: cover;
        margin-right: 15px;
        border-radius: 5px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .imagen-prioridad-2 {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 5px;
        margin-bottom: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .botones-izquierda {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }
    
    .btn-accion {
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        box-shadow: 0 3px 8px rgba(0,0,0,0.12);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
    }
    
    .btn-editar {
        background: linear-gradient(135deg, #28a745, #218838);
        color: white !important;
    }
    
    .btn-editar:hover {
        background: linear-gradient(135deg, #218838, #1e7e34);
        transform: translateY(-2px);
        box-shadow: 0 5px 12px rgba(40, 167, 69, 0.25);
    }
    
    .btn-eliminar {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white !important;
    }
    
    .btn-eliminar:hover {
        background: linear-gradient(135deg, #c82333, #bd2130);
        transform: translateY(-2px);
        box-shadow: 0 5px 12px rgba(220, 53, 69, 0.25);
    }

    @media (max-width: 767.98px) {
        .imagen-prioridad-1 {
            width: 100%;
            height: auto;
            margin-right: 0;
            margin-bottom: 10px;
        }

        .contenido-prioridad-1 {
            font-size: 1.2rem;
        }
        
        .header-container {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #ced4da;
        padding: 10px 17px;
        height: 50px;
        font-size: 1rem;
        transition: all 0.3s ease;
   }
    
    .card {
        transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 12px;
        overflow: hidden;
        border: none;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    }
    
    .mensaje-exito {
        background-color: #d4edda;
        padding: 15px;
        border-radius: 8px;
        color: #155724;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        transition: opacity 0.5s ease;
        display: flex;
        align-items: center;
    }
    
    .mensaje-exito i {
        margin-right: 10px;
        font-size: 1.2rem;
    }
    
    .img-preview-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 15px 0;
        margin-bottom: 20px;
        background-color: var(--gris-claro);
        padding: 15px;
        border-radius: 10px;
        border: 1px dashed var(--azul-claro);
    }
    
    .img-preview-label {
        font-weight: 600;
        color: var(--azul-principal);
        margin-bottom: 10px;
    }
    
    .img-preview {
        max-width: 200px;
        max-height: 200px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        margin-bottom: 10px;
        border: 1px solid var(--gris-medio);

    }
    
    .img-actions {
        display: flex;
        gap: 10px;
        margin-top: 10px;
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