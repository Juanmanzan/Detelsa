document.addEventListener('DOMContentLoaded', function () {
    const searchButton = document.getElementById('search-button');
    const searchInput = document.getElementById('search-input');
    const tbody = document.querySelector('tbody');


    const form = document.querySelector('.search-form');
    form.addEventListener('submit', function (e) {
        e.preventDefault();
    });

    // Evitar que se envíe el formulario si lo hay
    document.querySelector('form')?.addEventListener('submit', function (e) {
        e.preventDefault();
    });

    // Guardar las filas originales
    const originalRows = Array.from(tbody.querySelectorAll('tr')).map(row => row.cloneNode(true));

    function normalize(text) {
        return text.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").trim();
    }

    function searchOrders() {
        const query = normalize(searchInput.value);
        tbody.innerHTML = '';

        const ordenes = {};

        originalRows.forEach(row => {
            const ordenId = row.getAttribute('data-orden');
            if (!ordenId) return;
            if (!ordenes[ordenId]) ordenes[ordenId] = [];
            ordenes[ordenId].push(row.cloneNode(true));
        });

        let coincidencias = 0;

        Object.entries(ordenes).forEach(([ordenId, filas]) => {
            const productosCoincidentes = [];
            let coincidePorFechaOID = false;

            filas.forEach(fila => {
                const nombreProducto = normalize(fila.querySelector('.nombre-producto')?.textContent || '');
                const fechaOrden = normalize(fila.querySelectorAll('td')[1]?.textContent || '');
                const ordenIdNormalizado = normalize(ordenId);

                if (ordenIdNormalizado.includes(query) || fechaOrden.includes(query)) {
                    coincidePorFechaOID = true;
                }

                if (nombreProducto.includes(query)) {
                    productosCoincidentes.push(fila);
                }
            });

            if (coincidePorFechaOID) {
                coincidencias++;
                filas.forEach((fila, i) => {
                    const row = document.createElement('tr');
                    if (i === 0) {
                        const ordenId = fila.getAttribute('data-orden');
                        const fecha = fila.querySelectorAll('td')[1]?.textContent;
                        row.innerHTML = `
                            <td><strong>${ordenId}</strong></td>
                            <td>${fecha}</td>
                            <td>${fila.querySelector('.nombre-producto')?.textContent}</td>
                            <td>${fila.querySelector('.precio-producto')?.textContent}</td>
                            <td>${fila.querySelector('.cantidad-producto')?.textContent}</td>
                            <td>${fila.querySelector('.sub-precio')?.textContent}</td>
                            <td>${fila.querySelector('.total-orden')?.textContent}</td>
                        `;
                    } else {
                        row.innerHTML = `
                            <td></td><td></td>
                            <td>${fila.querySelector('.nombre-producto')?.textContent}</td>
                            <td>${fila.querySelector('.precio-producto')?.textContent}</td>
                            <td>${fila.querySelector('.cantidad-producto')?.textContent}</td>
                            <td>${fila.querySelector('.sub-precio')?.textContent}</td>
                            <td></td>
                        `;
                    }
                    tbody.appendChild(row);
                });
            } else if (productosCoincidentes.length > 0) {
                coincidencias++;
                productosCoincidentes.forEach((fila, i) => {
                    const row = document.createElement('tr');
                    if (i === 0) {
                        const ordenId = fila.getAttribute('data-orden');
                        const fecha = fila.querySelectorAll('td')[1]?.textContent;
                        row.innerHTML = `
                            <td><strong>${ordenId}</strong></td>
                            <td>${fecha}</td>
                            <td>${fila.querySelector('.nombre-producto')?.textContent}</td>
                            <td>${fila.querySelector('.precio-producto')?.textContent}</td>
                            <td>${fila.querySelector('.cantidad-producto')?.textContent}</td>
                            <td>${fila.querySelector('.sub-precio')?.textContent}</td>
                            <td>${fila.querySelector('.total-orden')?.textContent}</td>
                        `;
                    } else {
                        row.innerHTML = `
                            <td></td><td></td>
                            <td>${fila.querySelector('.nombre-producto')?.textContent}</td>
                            <td>${fila.querySelector('.precio-producto')?.textContent}</td>
                            <td>${fila.querySelector('.cantidad-producto')?.textContent}</td>
                            <td>${fila.querySelector('.sub-precio')?.textContent}</td>
                            <td></td>
                        `;
                    }
                    tbody.appendChild(row);
                });
            }
        });

        if (coincidencias === 0) {
            const row = document.createElement('tr');
            row.innerHTML = `<td colspan="7" class="no-orders">
                <i class="fas fa-info-circle mr-2"></i> No hay órdenes registradas.
            </td>`;
            tbody.appendChild(row);
        }
    }

    // Botón buscar
    searchButton.addEventListener('click', function (e) {
        e.preventDefault();
        searchOrders();
    });

    // Tecla Enter o campo vacío
    searchInput.addEventListener('keyup', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            searchOrders();
        } else if (searchInput.value === '') {
            searchOrders();
        }
    });
});
