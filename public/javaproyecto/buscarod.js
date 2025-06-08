
document.addEventListener('DOMContentLoaded', function () {
    const searchButton = document.getElementById('search-button');
    const searchInput = document.getElementById('search-input');
    const tbody = document.querySelector('tbody');

    function normalize(text) {
        return text.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").trim();
    }

    function searchOrders() {
        const query = normalize(searchInput.value);
        const allRows = Array.from(document.querySelectorAll('tbody tr')).map(row => row.cloneNode(true));
        const ordenes = {};

        // Agrupar filas por ID de orden
        allRows.forEach(row => {
            const ordenId = row.getAttribute('data-orden');
            if (!ordenId) return;
            if (!ordenes[ordenId]) ordenes[ordenId] = [];
            ordenes[ordenId].push(row);
        });

        tbody.innerHTML = '';

        let currentOrderId = null;
        let currentOrderFecha = '';
        let totalOrden = '';
        let productosFiltrados = [];

        Object.entries(ordenes).forEach(([ordenId, filas]) => {
            const productosCoincidentes = [];
            let totalFiltrado = 0;

            filas.forEach(fila => {
                const nombreProducto = normalize(
                    fila.querySelector('.nombre-producto')?.textContent || ''
                );

                if (query === '' || nombreProducto.includes(query)) {
                    productosCoincidentes.push(fila);

                    // Sumar subtotal para total filtrado
                    const subtotalText = fila.children[5]?.textContent?.replace('$', '').replace(',', '').trim();
                    const subtotal = parseFloat(subtotalText) || 0;
                    totalFiltrado += subtotal;
                }
            });

            if (productosCoincidentes.length > 0) {
                const filaOriginal = filas[0];
                const fecha = filaOriginal.querySelectorAll('td')[1]?.textContent;

                // Crear primera fila de la orden
                const primeraFila = productosCoincidentes[0];
                const row = document.createElement('tr');

                row.innerHTML = `
                    <td><strong>${ordenId}</strong></td>
                    <td>${fecha}</td>
                    <td>${primeraFila.querySelector('.nombre-producto')?.textContent}</td>
                    <td>${primeraFila.querySelector('.precio-producto')?.textContent}</td>
                    <td>${primeraFila.querySelector('.cantidad-producto')?.textContent}</td>
                    <td>${primeraFila.querySelector('.sub-precio')?.textContent}</td>
                    <td>${primeraFila.querySelector('.total-orden')?.textContent}</td>
                `;
                tbody.appendChild(row);

                // Resto de filas
                for (let i = 1; i < productosCoincidentes.length; i++) {
                    const fila = productosCoincidentes[i];
                    const nuevaFila = document.createElement('tr');

                    nuevaFila.innerHTML = `
                        <td></td>
                        <td></td>
                        <td>${fila.querySelector('.nombre-producto')?.textContent}</td>
                        <td>${fila.querySelector('.precio-producto')?.textContent}</td>
                        <td>${primeraFila.querySelector('.cantidad-producto')?.textContent}</td>
                        <td>${primeraFila.querySelector('.sub-precio')?.textContent}</td>
                    `;
                    tbody.appendChild(nuevaFila);
                }
            }
        });

        if (tbody.children.length === 0) {
            const row = document.createElement('tr');
            row.innerHTML = `<td colspan="7" class="no-orders">
                <i class="fas fa-info-circle mr-2"></i> No hay órdenes registradas.
            </td>`;
            tbody.appendChild(row);
        }
    }

    searchButton.addEventListener('click', searchOrders);
    searchInput.addEventListener('keyup', function (e) {
        if (e.key === 'Enter' || searchInput.value === '') {
            searchOrders();
        }
    });
});

