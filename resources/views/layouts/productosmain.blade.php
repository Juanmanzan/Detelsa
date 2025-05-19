<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detelsa</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/productosmain.css') }}">
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
                        <a href="/carrito" class="btn btn-success btn-nav">
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
                        <li><a class="dropdown-item" href="/categoria/detergentes">Detergentes</a></li>
                        <li><a class="dropdown-item" href="/categoria/jabon">Jabón</a></li>
                        <li><a class="dropdown-item" href="/categoria/cloro">Cloro</a></li>
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
            <a href="/categoria/detergentes" class="btn btn-outline-success text-start">🧴 Detergentes</a>
            <a href="/categoria/jabon" class="btn btn-outline-success text-start">🧼 Jabón</a>
            <a href="/categoria/cloro" class="btn btn-outline-success text-start">🧪 Cloro</a>
        </div>
    </div>
</header>

<!-- CONTENIDO DE LA VISTA -->
<main>
    @yield('productosmain_container')
</main>

<<<<<<< HEAD
@yield('productosmain_container')

  
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Detelsa 2025</p></div>
=======
<footer class="py-5 bg-dark mt-4">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Detelsa 2025</p>
    </div>
>>>>>>> 35b149776cae833d9e0c8ac96e7c25e24ada2f0f
</footer>

<script src="{{ asset('javaproyecto/productosmain.js') }}"></script>

</body>
</html>
