document.addEventListener('DOMContentLoaded', function () {
    const boton = document.getElementById('btn-vermas');
    const detailsContent = document.getElementById('product-details-content');

    if (boton && detailsContent) {
        boton.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const icon = this.querySelector('i');

            if (detailsContent.classList.contains('expanded')) {
                detailsContent.classList.remove('expanded');
                icon.className = 'fas fa-chevron-down';
                this.innerHTML = '<i class="fas fa-chevron-down"></i> Ver detalles del producto';
            } else {
                detailsContent.classList.add('expanded');
                icon.className = 'fas fa-chevron-up';
                this.innerHTML = '<i class="fas fa-chevron-up"></i> Ocultar detalles';
            }
        });
    }
});
