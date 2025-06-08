    $(document).ready(function() {
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

    // Función para buscar productos en la tabla
    function searchProducts() {
        const searchTerm = $('#search-input').val().toLowerCase().trim();
        
        $('table tbody tr').each(function() {
            const $row = $(this);
            let found = false;
            
            // Buscar en las columnas relevantes
            const nombre = $row.find('.nombre-producto').text().toLowerCase();
            const precio = $row.find('.precio-producto').text().toLowerCase();
            const categoria = $row.find('.categoria-producto').text().toLowerCase();
            const descripcion = $row.find('.descripcion-producto').text().toLowerCase();
            
            if (nombre.includes(searchTerm) || 
                precio.includes(searchTerm) || 
                categoria.includes(searchTerm) || 
                descripcion.includes(searchTerm)) {
                found = true;
            }
            
            found ? $row.show() : $row.hide();
        });
    }

    $(document).ready(function() {
        // Evento para el botón de búsqueda
        $('#search-button').click(searchProducts);
        
        // Evento para búsqueda al presionar Enter
        $('#search-input').keyup(function(e) {
            if (e.key === 'Enter') searchProducts();
        });
        
        // Evento para limpiar búsqueda
        $('#search-input').on('input', function() {
            if (!$(this).val()) {
                $('table tbody tr').show();
            }
        });
    });
