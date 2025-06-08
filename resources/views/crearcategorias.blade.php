@extends('adminlte::page')

@section('title', 'Categorías')

@section('content_header')
    <h1 class="text-azul">Categorías</h1>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admincolores.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/tablas.css') }}">
@stop

@section('content_header')
    <h1 class="text-azul">Categorías</h1>
@stop


@section('content')


    <form class="search-form">
        <input type="text" id="search-input" placeholder="Buscar..." class="search-input">
        <button type="button" id="search-button" class="search-button">
            🔍 Buscar
        </button>
    </form>


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

    // Función para buscar categorías en la tabla
function searchCategories() {
    const searchTerm = $('#search-input').val().toLowerCase().trim();
    
    $('table tbody tr').each(function() {
        const $row = $(this);
        const nombre = $row.find('.nombre-categoria').text().toLowerCase();
        
        if (nombre.includes(searchTerm)) {
            $row.show();
        } else {
            $row.hide();
        }
    });
}

$(document).ready(function() {
    // ... (código existente para AJAX y modales) ...
    
    // Evento para el botón de búsqueda
    $('#search-button').click(searchCategories);
    
    // Evento para búsqueda al presionar Enter
    $('#search-input').keyup(function(e) {
        if (e.key === 'Enter') {
            searchCategories();
        }
    });
    
    // Evento para limpiar búsqueda
    $('#search-input').on('input', function() {
        if (!$(this).val()) {
            $('table tbody tr').show();
        }
    });
    
    // ... (resto del código existente) ...
});


});
</script>
@stop