// Actualizar contador globalmente
function actualizarContadorCarrito() {
  fetch("/carrito/contador")
    .then(res => res.json())
    .then(data => {
      const contador = document.getElementById("cart-count");
      if (contador) {
        contador.innerText = data.total ?? 0;
      }
    })
    .catch(err => {
      console.error('Error actualizando contador:', err);
    });
}

// Función para agregar producto al carrito
function agregarAlCarrito(productoId, cantidad = 1) {
  fetch("/carrito/agregar", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
    },
     body: JSON.stringify({
      producto_id: productoId,
      cantidad: cantidad,
      actualizar: true })
  })
  .then(res => res.json())
  .then(data => {
    console.log(data.mensaje);
    actualizarContadorCarrito();

    const carritoOffcanvas = document.getElementById('carritoMenu');
    const carritoOffcanvasInstance = bootstrap.Offcanvas.getInstance(carritoOffcanvas);
    if (carritoOffcanvasInstance) carritoOffcanvasInstance.show();
  })
  .catch(error => {
    console.error("Error al agregar al carrito:", error);
    alert('No se pudo agregar el producto al carrito. Intenta de nuevo.');
  });
}

document.addEventListener('DOMContentLoaded', function () {
  const carritoOffcanvas = document.getElementById('carritoMenu');

  // Cargar carrito y actualizar modal
  function cargarCarrito() {
  fetch("/carrito/mostrar")
    .then(res => res.json())
    .then(carrito => {
      const contenedor = document.getElementById('carritoContenido');
      if (Object.keys(carrito).length === 0) {
        contenedor.innerHTML = '<p>Tu carrito está vacío.</p>';
        return;
      }

      let html = '<ul class="list-group">';
      let totalGeneral = 0;
      let mensajeWhatsApp = 'Hola, quiero realizar el siguiente pedido:%0A';

      for (const id in carrito) {
        const item = carrito[id];
        const totalProducto = item.precio * item.cantidad;
        totalGeneral += totalProducto;

        // Agregar detalle del producto al mensaje de WhatsApp
        mensajeWhatsApp += `• ${item.nombre} - Cantidad: ${item.cantidad} - Total: $${totalProducto.toFixed(2)}%0A`;

        html += `
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <img src="${item.imagen ?? 'https://dummyimage.com/50x50/dee2e6/6c757d.jpg'}" alt="${item.nombre}" style="width:50px; height:50px; object-fit: cover; margin-right: 10px;">
              <div>
                <strong>${item.nombre}</strong><br>
                $${item.precio.toFixed(2)}<br>
                Total: $${totalProducto.toFixed(2)}
              </div>
            </div>
            <div class="d-flex align-items-center">
              <input type="number" value="${item.cantidad}" min="1" class="form-control cantidad-input" data-id="${id}" style="width: 60px; margin-right: 10px;">
              <button class="btn btn-sm btn-danger eliminar-producto" data-id="${id}">🗑️</button>
            </div>
          </li>`;
      }

      mensajeWhatsApp += `%0A ------ Dando un total: $${totalGeneral.toFixed(2)}`;

      html += `</ul>
        <hr>
        <h5 class="text-end me-3">Total: $${totalGeneral.toFixed(2)}</h5>
        <div class="text-end me-3 mb-3">
          <a href="https://wa.me/593999999999?text=${mensajeWhatsApp}" 
             class="btn btn-success" target="_blank" rel="noopener noreferrer">
            🛒 Finalizar pedido por WhatsApp
          </a>
        </div>`;

      contenedor.innerHTML = html;
    })
    .catch(err => {
      console.error('Error cargando carrito:', err);
    });
}


  // Cuando se abra el offcanvas, carga el carrito
  carritoOffcanvas.addEventListener('show.bs.offcanvas', function () {
    cargarCarrito();
  });

 // Eliminar producto (usando POST para mayor seguridad)
document.addEventListener('click', function (e) {
  if (e.target.classList.contains('eliminar-producto')) {
    const id = e.target.getAttribute('data-id');

    fetch(`/carrito/eliminar/${id}`, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({}) // puede ir vacío si no necesitas más datos
    })
    .then(res => res.json())
    .then(data => {
      alert(data.mensaje);
      actualizarContadorCarrito();
      cargarCarrito();
    })
    .catch(err => {
      console.error('Error eliminando producto:', err);
    });
  }
});


// Cambiar cantidad
document.addEventListener('change', function (e) {
  if (e.target.classList.contains('cantidad-input')) {
    const id = e.target.getAttribute('data-id');
    let cantidad = parseInt(e.target.value);
    if (isNaN(cantidad) || cantidad < 1) {
      cantidad = 1;
      e.target.value = cantidad;
    }

    fetch("/carrito/agregar", {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ producto_id: id, cantidad: cantidad, actualizar: true })
    })
    .then(res => res.json())
    .then(data => {
      console.log(data.mensaje);
      actualizarContadorCarrito();
      cargarCarrito();
    })
    .catch(err => {
      console.error('Error actualizando cantidad:', err);
    });
  }
});


  // Inicializar contador al cargar página
  actualizarContadorCarrito();
});

document.addEventListener('click', function (e) {
  if (e.target.classList.contains('finalizar-pedido-wp')) {
    e.preventDefault();  // Evita que siga el link

    const mensajeRaw = e.target.getAttribute('data-mensaje');
    const mensaje = encodeURIComponent(mensajeRaw);
    const numero = '593999999999'; // Cambia a tu número real

    fetch('/carrito/vaciar', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      },
      body: JSON.stringify({})  // Puede ser vacío, depende de tu backend
    })
    .then(res => {
      if (!res.ok) throw new Error('No se pudo vaciar el carrito');
      return res.json();
    })
    .then(data => {
      actualizarContadorCarrito();
      alert("Gracias por tu pedido 😄");

      window.open(`https://wa.me/${numero}?text=${mensaje}`, '_blank');

      // Cerrar el modal (offcanvas)
      const carritoOffcanvas = document.getElementById('carritoMenu');
      const offcanvasInstance = bootstrap.Offcanvas.getInstance(carritoOffcanvas);
      if (offcanvasInstance) offcanvasInstance.hide();

      // Refrescar contenido del carrito (vacío)
      cargarCarrito();
    })
    .catch(err => {
      console.error('Error vaciando carrito:', err);
      alert('Error al finalizar pedido, intenta de nuevo.');
    });
  }
});


// Evento para botón de finalizar pedido por WhatsApp


