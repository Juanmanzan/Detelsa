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

// Función para mostrar un toast
function mostrarToast(mensaje) {
  const toastElement = document.getElementById('miToast');
  if (!toastElement) return;

  const toastBody = toastElement.querySelector('.toast-body');
  toastBody.textContent = mensaje;

  const toast = new bootstrap.Toast(toastElement);
  toast.show();
}

// Función para agregar producto al carrito
function agregarAlCarrito(productoId, cantidad = 1) {
    fetch("/carrito/agregar", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            producto_id: productoId,
            cantidad: cantidad,
            incrementar: true // ¡Clave para sumar en lugar de reemplazar!
        })
    })
    .then(response => {
        if (!response.ok) throw new Error("Error en el servidor");
        return response.json();
    })
    .then(data => {
        // Actualiza el contador global
        const contadorGlobal = document.getElementById("cart-count");
        if (contadorGlobal) {
            contadorGlobal.textContent = data.total || 0;
        }
        actualizarContadorCarrito();
        // Actualiza el badge del producto (si existe)
        const badge = document.getElementById(`badge-${productoId}`);
        if (badge) {
            badge.textContent = (parseInt(badge.textContent) || 0) + cantidad;
            badge.style.display = "block";
            setTimeout(() => { badge.style.display = "none"; }, 2000);
        }

        // Muestra feedback
        mostrarToast("¡Producto agregado!");

        // Recarga el carrito si está visible
        const carritoVisible = document.querySelector('.offcanvas.show');
        if (carritoVisible) cargarCarrito();
    })
    .catch(error => {
        console.error("Error:", error);
        mostrarToast("Error al agregar producto", "danger");
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
      let mensajeWhatsApp = 'Hola, quiero realizar el siguiente pedido:\n';

      for (const id in carrito) {
        const item = carrito[id];
        const totalProducto = item.precio * item.cantidad;
        totalGeneral += totalProducto;

        // Agregar detalle del producto al mensaje de WhatsApp
        mensajeWhatsApp += `• ${item.nombre} - Cantidad: ${item.cantidad} - Total: $${totalProducto.toFixed(2)}\n`;

        html += `
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <img src="${ item.imagen ?? 'https://dummyimage.com/50x50/dee2e6/6c757d.jpg'}" alt="${item.nombre}" style="width:50px; height:50px; object-fit: cover; margin-right: 10px;">
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

      mensajeWhatsApp += `\n ------ Dando un total: $${totalGeneral.toFixed(2)}`;

      html += `</ul>
        <hr>
        <h5 class="text-end me-3">Total: $${totalGeneral.toFixed(2)}</h5>
        <div class="text-end me-3 mb-3">
        <a href="#" 
           class="btn btn-success finalizar-pedido-wp" 
           data-mensaje="${mensajeWhatsApp}"
           onclick="finalizarPedido(event)"> 
            Finalizar pedido por WhatsApp
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

// Función para finalizar pedido por WhatsApp
async function finalizarPedido(event) {
  event.preventDefault();

  const boton = event.currentTarget;
  const mensaje = boton.getAttribute('data-mensaje');
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

  if (!csrfToken) {
    alert('Token CSRF no encontrado.');
    return;
  }

  try {
    // Obtener carrito actual
    const carritoResponse = await fetch("/carrito/mostrar");
    const carrito = await carritoResponse.json();

    // Enviar carrito al backend para crear orden
    const crearOrden = await fetch("/orden/crear", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": csrfToken
      },
      body: JSON.stringify({ carrito: carrito })
    });

    const crearOrdenData = await crearOrden.json();

    if (!crearOrden.ok || !crearOrdenData.success) {
      throw new Error('No se pudo crear la orden');
    }

    // Luego vaciar el carrito
    const response = await fetch('/carrito/vaciar', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Content-Type': 'application/json'
      }
    });

    if (!response.ok) {
      throw new Error(`Error HTTP al vaciar carrito: ${response.status}`);
    }

    if (typeof actualizarContadorCarrito === 'function') {
      actualizarContadorCarrito();
    }

    const carritoMenu = document.getElementById('carritoMenu');
    const offcanvas = carritoMenu ? bootstrap.Offcanvas.getInstance(carritoMenu) : null;
    if (offcanvas) offcanvas.hide();

    setTimeout(() => {
      const numero = '593964131003';
      const url = `https://api.whatsapp.com/send?phone=${numero}&text=${encodeURIComponent(mensaje)}`;
      window.open(url, '_blank');
    }, 300);

    if (typeof mostrarToast === 'function') {
      mostrarToast('¡Pedido enviado por WhatsApp y almacenado!');
    }

  } catch (error) {
    console.error('Error al finalizar pedido:', error);
    alert('Ocurrió un error al finalizar el pedido. Intenta nuevamente.');
  }
}

//Mensaje de wp 
function enviarProductoWhatsApp(boton) {
  const card = boton.closest('.card');
  if (!card) {
    alert('No se pudo obtener el producto');
    return;
  }

  // Obtener nombre del producto
  const nombre = card.querySelector('.fw-bolder')?.textContent.trim();
  // Obtener precio del producto
  const precioTexto = card.querySelector('p')?.textContent.trim();

  if (!nombre || !precioTexto) {
    alert('Datos incompletos del producto');
    return;
  }

  const mensaje = `Hola, estoy interesado en el producto: ${nombre}\nPrecio: ${precioTexto}`;

  // Reemplaza el número de WhatsApp con el tuyo real
  const numero = '593964131003';
  const url = `https://api.whatsapp.com/send?phone=${numero}&text=${encodeURIComponent(mensaje)}`;

  // Abrir WhatsApp
  window.open(url, '_blank');

  // (Opcional) Toast de confirmación
  if (typeof mostrarToast === 'function') {
    mostrarToast('Redirigiendo a WhatsApp...');
  }
}


