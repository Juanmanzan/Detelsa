document.addEventListener('DOMContentLoaded', function () {
  const cantidadInput = document.getElementById('cantidad');
  const btnMas = document.getElementById('btn-mas');
  const btnMenos = document.getElementById('btn-menos');

  btnMas.addEventListener('click', () => {
    let cantidad = parseInt(cantidadInput.value) || 1;
    cantidadInput.value = cantidad + 1;
  });

  btnMenos.addEventListener('click', () => {
    let cantidad = parseInt(cantidadInput.value) || 1;
    if (cantidad > 1) {
      cantidadInput.value = cantidad - 1;
    }
  });

  cantidadInput.addEventListener('input', () => {
    if (cantidadInput.value === "" || parseInt(cantidadInput.value) < 1) {
      cantidadInput.value = 1;
    }
  });

  // Elementos para el botón "Ver más"
  const btnVerMas = document.getElementById('btn-vermas');
  const tablaCarrito = document.getElementById('tabla-carrito');
  const contenedorMovil = document.getElementById('contenedor-tabla-movil');
  const contenedorOriginal = tablaCarrito.parentNode;
  const ingredientesModoUso = document.getElementById('ingredientes-modouso');
  const descripcion = document.getElementById('descripcion-producto');

  btnVerMas.addEventListener('click', () => {
    if (contenedorMovil.contains(tablaCarrito)) {
      // Volver tabla a su lugar original
      contenedorOriginal.appendChild(tablaCarrito);

      // Ocultar ingredientes y modo de uso
      ingredientesModoUso.style.display = 'none';

      // Cambiar texto botón a "Ver más"
      btnVerMas.innerHTML = 'Ver más <img src="/imagenes/Vermas.png" alt="Más">';

      // Ocultar descripción completa
      descripcion.classList.remove('descripcion-completa');

    } else {
      // Mover tabla carrito junto a la imagen
      contenedorMovil.appendChild(tablaCarrito);

      // Mostrar ingredientes y modo de uso
      ingredientesModoUso.style.display = 'block';

      // Cambiar texto botón a "Ver menos"
      btnVerMas.textContent = 'Ver menos';

      // Mostrar descripción completa
      descripcion.classList.add('descripcion-completa');
    }
  });
});
