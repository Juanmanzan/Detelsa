// Funciones para manejar cookies
function setCookie(name, value, days) {
    const d = new Date();
    d.setTime(d.getTime() + (days*24*60*60*1000));
    const expires = "expires=" + d.toUTCString();
    document.cookie = `${name}=${value};${expires};path=/`;
}

function getCookie(name) {
    const cname = name + "=";
    const decodedCookie = decodeURIComponent(document.cookie);
    const ca = decodedCookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i].trim();
        if (c.indexOf(cname) === 0) {
            return c.substring(cname.length, c.length);
        }
    }
    return null;
}

document.addEventListener("DOMContentLoaded", function () {
    const botonesCarrito = document.querySelectorAll(".btn-agregar-carrito");
    const badge = document.querySelector(".badge");

    // Obtener cantidad guardada en la cookie
    let cantidad = parseInt(getCookie("carritoCantidad")) || 0;
    badge.innerText = cantidad;

    botonesCarrito.forEach(boton => {
        boton.addEventListener("click", function (e) {
            e.preventDefault();

            cantidad += 1;
            badge.innerText = cantidad;

            // Guardar en cookie (por 7 días)
            setCookie("carritoCantidad", cantidad, 7);
        });
    });
});
