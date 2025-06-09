
$(document).ready(function() {
    // Enviar formulario crear categoría con AJAX
    $('#formCrearCategoria').submit(function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: storeCategoriaURL,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#alerta-error-nombre').hide();
                $('#crearCategoriaModal').modal('hide');

                // Mostrar mensaje de éxito en div estático

                sessionStorage.setItem('mensaje_exito', response.success);
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
    // Enviar formulario editar categoría con AJAX    

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
                sessionStorage.setItem('mensaje_exito', response.success);
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


