@extends('adminlte::page')

@section('title', 'Categorías')

@section('content_header')
    <h1 class="text-azul">Categorías</h1>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admincolores.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --azul-principal: #1a3a6c;
            --azul-secundario: #2c5282;
            --azul-claro: #4dabf7;
            --gris-claro: #f8f9fa;
            --gris-medio: #e9ecef;
        }
        
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            padding-bottom: 30px;
        }
        
        .text-azul {
            color: var(--azul-principal);
            font-weight: 700;
        }
        
        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(26, 58, 108, 0.12);
            overflow: hidden;
            margin-top: 20px;
            padding: 0;
            border: none;
        }
        
        .table {
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .thead-azul th {
            background: linear-gradient(135deg, var(--azul-principal), var(--azul-secundario));
            color: white !important;
            font-weight: 600;
            padding: 16px 15px;
            border: none;
            font-size: 1.1rem;
            position: relative;
        }
        
        .thead-azul th:first-child {
            border-top-left-radius: 12px;
        }
        
        .thead-azul th:last-child {
            border-top-right-radius: 12px;
        }
        
        .table-bordered th, 
        .table-bordered td {
            border: 1px solid var(--gris-medio);
            padding: 14px 15px;
            vertical-align: middle;
            text-align: center;
        }
        
        .table-bordered thead th {
            border-bottom: 2px solid var(--gris-medio);
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(26, 58, 108, 0.03);
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transform: translateY(-1px);
            transition: all 0.3s ease;
        }
        
        td img {
            width: 120px;
            height: 80px;
            display: block;
            margin: 0 auto;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border: 1px solid var(--gris-medio);
            transition: all 0.3s ease;
        }
        
        td img:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }
        
        .nombre-categoria {
            font-weight: 600;
            color: var(--azul-principal);
            font-size: 1.1rem;
        }
        
        .btn-group-custom {
            display: flex;
            gap: 10px;
            justify-content: center;
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
        
        .btn-accion i {
            margin-right: 6px;
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
        
        /* Estilos para los modales */
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 15px 35px rgba(26, 58, 108, 0.2);
            overflow: hidden;
        }
        
        .modal-header {
            border-bottom: 1px solid var(--gris-medio);
            background: linear-gradient(135deg, var(--azul-principal), var(--azul-secundario));
            color: white;
            padding: 18px 20px;
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
        
        .modal-body {
            padding: 25px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--azul-principal);
            margin-bottom: 8px;
            display: block;
        }
        
        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 10px 15px;
            height: 50px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--azul-claro);
            box-shadow: 0 0 0 0.2rem rgba(26, 58, 108, 0.2);
        }
        
        .alert-danger {
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 0.95rem;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
        
        .modal-footer {
            border-top: 1px solid var(--gris-medio);
            padding: 15px 20px;
            background-color: var(--gris-claro);
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
        
        .img-preview-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
            background-color: var(--gris-claro);
            padding: 15px;
            border-radius: 10px;
            border: 1px dashed var(--azul-claro);
        }
        
        .img-preview {
            max-width: 220px;
            max-height: 150px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            margin-bottom: 10px;
            border: 1px solid var(--gris-medio);
        }
        
        .img-preview-label {
            font-weight: 600;
            color: var(--azul-principal);
            margin-bottom: 10px;
        }
        
     
    </style>
@stop

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 text-muted">Gestión de categorías de productos</h2>
        <button type="button" class="btn btn-crear" data-toggle="modal" data-target="#crearCategoriaModal">
            <i class="fas fa-plus"></i> Crear Nueva Categoría
        </button>
    </div>

    <!-- Modal Crear Categoría -->
    <div class="modal fade" id="crearCategoriaModal" tabindex="-1" aria-labelledby="crearCategoriaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="formCrearCategoria" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearCategoriaModalLabel">
                            <i class="fas fa-folder-plus mr-2"></i>Crear Nueva Categoría
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre" class="form-label">Nombre de la categoría</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required 
                                   placeholder="Ingrese el nombre de la categoría">
                        </div>
                    
                        
                        <div class="form-group">
                            <label for="imagen" class="form-label">Imagen de la categoría</label>
                            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
                            <small class="form-text text-muted">Formatos aceptados: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
                        </div>

                        <div id="alerta-error-nombre" class="alert alert-danger mt-2" style="display:none;"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-guardar">Crear Categoría</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Mostrar categorías en tabla -->
    <div class="table-container">
        <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle" >
            <thead class="thead-azul">
                <tr>
                    <th width="25%">Imagen</th>
                    <th>Nombre</th>
                    <th width="25%">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr>
                        <td>
                            <img src="{{ asset($categoria->imagen) }}" alt="{{ $categoria->nombre }}">
                        </td>
                        <td class="nombre-categoria">{{ $categoria->nombre }}</td>
                        <td>
                            <div class="btn-group-custom">
                                <a href="#"
                                class="btn btn-accion btn-editar"
                                data-id="{{ $categoria->id }}"
                                data-nombre="{{ $categoria->nombre }}"
                                data-imagen="{{ asset($categoria->imagen) }}"
                                onclick="event.stopPropagation();"
                                data-toggle="modal"
                                data-target="#editarCategoriaModal">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-accion btn-eliminar" onclick="event.stopPropagation();">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>

    <!-- Modal Editar Categoría -->
    <div class="modal fade" id="editarCategoriaModal" tabindex="-1" aria-labelledby="editarCategoriaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="formEditarCategoria" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarCategoriaModalLabel">
                            <i class="fas fa-edit mr-2"></i>Editar Categoría
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="editCategoriaId">
                        <div class="form-group">
                            <label for="editNombre" class="form-label">Nombre de la categoría</label>
                            <input type="text" class="form-control" id="editNombre" name="nombre" required 
                                   placeholder="Ingrese el nuevo nombre">
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="img-preview-container">
                                <span class="img-preview-label">Imagen Actual</span>
                                <img id="editImagenPreview" src="" alt="Imagen actual" class="img-preview">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="editImagen" class="form-label">Cambiar imagen (opcional)</label>
                            <input type="file" class="form-control" id="editImagen" name="imagen" accept="image/*">
                            <small class="form-text text-muted">Deje en blanco para mantener la imagen actual</small>
                        </div>
                        
                        <div id="alerta-error-nombre-editar" class="alert alert-danger mt-2" style="display:none;"></div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-guardar">Actualizar Categoría</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop

@section('js')
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script>
$(document).ready(function() {
    // Enviar formulario crear categoría con AJAX
    $('#formCrearCategoria').submit(function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('categorias.store') }}",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#alerta-error-nombre').hide();
                $('#crearCategoriaModal').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    if (errors.nombre) {
                        $('#alerta-error-nombre').text(errors.nombre[0]).show();
                    }
                }
            }
        });
    });

    $('#formEditarCategoria').submit(function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        let actionUrl = $(this).attr('action');

        $.ajax({
            url: actionUrl,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#alerta-error-nombre-editar').hide();
                $('#editarCategoriaModal').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    if (errors.nombre) {
                        $('#alerta-error-nombre-editar').text(errors.nombre[0]).show();
                    }
                }
            }
        });
    });

    // Código para editar categorías
    const botonesEditar = document.querySelectorAll('.btn-editar');
    const formEditar = document.getElementById('formEditarCategoria');
    const nombreInput = document.getElementById('editNombre');
    const imagenPreview = document.getElementById('editImagenPreview');

    botonesEditar.forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const nombre = this.dataset.nombre;
            const imagen = this.dataset.imagen;

            nombreInput.value = nombre;
            imagenPreview.src = imagen;

            formEditar.action = `/categorias/${id}`;

            $('#editarCategoriaModal').modal('show');
        });
    });

    // Efecto hover en filas de la tabla
    $('.table-hover tbody tr').hover(
        function() {
            $(this).css('transform', 'translateY(-2px)');
        },
        function() {
            $(this).css('transform', 'translateY(0)');
        }
    );
});
</script>
@stop