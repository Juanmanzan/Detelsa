<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detelsa</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/productosmain.css') }}">

  
    <script src="{{ asset('vendor/bootstrap/js/bootstrap5.bundle.min.js') }}"></script>    
    <script src="{{ asset('javaproyecto/productosmain.js') }}"></script>
    <script src="{{ asset('javaproyecto/carrito.js') }}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>

<header>
    <div class="container-xl px-4">
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('imagenes/logo.png') }}" alt="Logo" class="me-2 logo-img" />
                <h4 class="mb-0">Detelsa</h4>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <form class="d-flex flex-grow-1 me-3 my-2 my-lg-0" role="search" style="max-width: 600px;">
                    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar" />
                    <button class="btn btn-success" type="submit">🔍</button>
                </form>

                <button class="btn btn-success d-none d-lg-inline-block" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#categoriasMenu" aria-controls="categoriasMenu">
                    Categorías
                </button>

                <ul class="navbar-nav ms-3 d-flex flex-lg-row flex-column gap-2 align-items-lg-center align-items-start">
                    <li class="nav-item">
                        <a href="/" class="btn btn-success btn-nav">
                            🏠 <span class="ms-2">Inicio</span>
                        </a>
                    </li>
                    <li class="nav-item position-relative">
                        <a href="#" class="btn btn-success btn-nav" data-bs-toggle="offcanvas" data-bs-target="#carritoMenu" aria-controls="carritoMenu">
                            🛒 <span class="ms-2">Carrito</span>
                        </a>
                         <span class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle" style="font-size: 0.75rem;" id="cart-count">
                          0
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Dropdown para móviles -->
            <ul class="navbar-nav d-lg-none w-100 mt-2">
                <li class="nav-item dropdown w-100">
                    <a class="nav-link dropdown-toggle btn btn-success w-100 text-center" href="#" id="categoriasDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categorías
                    </a>
                    <ul class="dropdown-menu w-100" aria-labelledby="categoriasDropdown">
                        @foreach ($categorias as $categoria)
                        <li><a class="dropdown-item" href="#">{{ $categoria->nombre }}</a></li>
                        @endforeach
                    </ul>
                     
                </li>
            </ul>
        </nav>
    </div>

    <!-- Menú Offcanvas -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="categoriasMenu" aria-labelledby="categoriasMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="categoriasMenuLabel">Categorías</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column gap-2">
            @foreach ($categorias as $categoria)
            <a href="/categoria/detergentes" class="btn btn-outline-success text-start">{{$categoria->nombre}}</a>
            @endforeach
        </div>
    </div>

        <!-- Menú Offcanvas del Carrito -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="carritoMenu" aria-labelledby="carritoMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="carritoMenuLabel">🛒 Tu Carrito</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
        </div>
        <div class="offcanvas-body" id="carritoContenido">
            <p>Tu carrito está vacío.</p>
        </div>
    </div>

</header>


@yield('productosmain_container')


<footer class="py-2 bg-success text-black mt-3">
    <div class="container text-center">
        <div class="row gx-4">
            <!-- Encuéntranos -->
            <div class="col-md-4 mb-2">
                <h5>Encuéntranos</h5>
                <hr class="border border-dark border-2 mx-auto w-55" style="border: 2px solid #000;">
                <p class="mb-1">📍 Calle Ejemplo #123</p>
                <p class="mb-1">📞 (555) 123-4567</p>
                <p class="mb-1">✉️  <a href="detelsa@gmail.com">detelsa@gmail.com</a></p>
            </div>

            <!-- ¿Quiénes somos? -->
            <div class="col-md-4 mb-2">
                <h5>¿Quiénes somos?</h5>
                <hr class="border border-dark border-2 mx-auto w-55">
                <p style="text-align: justify;">
                    Somos una empresa dedicada a la producción y distribución de detergentes líquidos de alta calidad.
                </p>
            </div>

            <!-- Redes Sociales -->
            <div class="col-md-4 mb-2">
                <h5>Redes sociales</h5>
                <hr class="border border-dark border-2 mx-auto w-55">
                <div class="d-flex justify-content-center gap-3 mt-2">
                    <a href="#"><img src="{{ asset('imagenes/TikTok.png') }}" alt="TikTok" width="50"></a>
                    <a href="#"><img src="{{ asset('imagenes/whatsapp.png') }}" alt="WhatsApp" width="50"></a>
                </div>
            </div>
        </div>
        <div class="text-center mt-2 small">
            &copy; {{ date('Y') }} Detelsa. Todos los derechos reservados.
        </div>
    </div>
</footer>



</body>
</html>
