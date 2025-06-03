@extends('adminlte::page')

@section('title', 'Categorías')

@section('content_header')
    <h1>Categorías</h1>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admincolores.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@stop

@section('content')

    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#crearCategoriaModal">
        Crear Categoría
    </button>

    <!-- Modal Crear Categoría -->
    <div class="modal fade" id="crearCategoriaModal" tabindex="-1" aria-labelledby="crearCategoriaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formCrearCategoria" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearCategoriaModalLabel">Crear Nueva Categoría</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre">Nombre de la categoría</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="imagen">Imagen de la categoría</label>
                            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
                        </div>

                        <div id="alerta-error-nombre" class="alert alert-danger mt-2" style="display:none;"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Crear Categoría</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Mostrar categorías -->
    <div class="row">
        @foreach ($categorias as $categoria)
            <div class="col-md-3 mb-3">
                <div class="card h-100" style="max-width: 250px; cursor: pointer;">
                    <img class="card-img-top" src="{{ asset($categoria->imagen) }}" alt="{{ $categoria->nombre }}">
                    <div class="card-body p-3">
                        <h5 class="fw-bolder mb-0">{{ $categoria->nombre }}</h5>
                    </div>
                    <div class="card-footer d-flex justify-content-between px-3 pb-3">
                        <a href="#" 
                            class="btn btn-outline-success btn-sm btn-editar-categoria" 
                            data-id="{{ $categoria->id }}" 
                            data-nombre="{{ $categoria->nombre }}" 
                            data-imagen="{{ asset($categoria->imagen) }}" 
                            onclick="event.stopPropagation();" 
                            data-toggle="modal" 
                            data-target="#editarCategoriaModal">
                            Editar
                        </a>
                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="event.stopPropagation();">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal Editar Categoría -->
    <div class="modal fade" id="editarCategoriaModal" tabindex="-1" aria-labelledby="editarCategoriaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formEditarCategoria" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarCategoriaModalLabel">Editar Categoría</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="editCategoriaId">
                        <div class="form-group">
                            <label for="editNombre">Nombre de la categoría</label>
                            <input type="text" class="form-control" id="editNombre" name="nombre" required>
                        </div>
                        <div class="form-group mt-3">
                            <label>Imagen actual:</label><br>
                            <img id="editImagenPreview" src="" alt="Imagen actual" width="100">
                        </div>
                        <div class="form-group mt-2">
                            <label for="editImagen">Cambiar imagen (opcional)</label>
                            <input type="file" class="form-control" id="editImagen" name="imagen" accept="image/*">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Actualizar Categoría</button>
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
                location.reload(); // Recargar página o actualizar la lista dinámicamente
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

    // Código para editar categorías (sin cambios)
    const botonesEditar = document.querySelectorAll('.btn-editar-categoria');
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

});
</script>
@stop
