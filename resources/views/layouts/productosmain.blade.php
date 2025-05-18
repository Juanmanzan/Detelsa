<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}">
     <link rel="stylesheet" href="{{ asset('css/productosmain.css') }}">
</head>
<body>

<header>


  <!-- Contenedor principal con margen lateral automático y ancho máximo -->
<div class="container-xl px-4">
  <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">

    <!-- Logo + nombre -->
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="{{ asset('imagenes/logo.png') }}" alt="Logo" class="me-2 logo-img" />
      <h4 class="mb-0">Detelsa</h4>
    </a>

    <!-- Botón hamburguesa -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
      aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Contenido colapsable -->
    <div class="collapse navbar-collapse" id="navbarContent">

      <!-- Formulario búsqueda -->
      <form class="d-flex flex-grow-1 me-3 my-2 my-lg-0" role="search" style="max-width: 600px;">
        <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar" style="flex-grow: 1;" />
        <button class="btn btn-success" type="submit" style="min-width: 90px;">🔍</button>
      </form>

      <!-- Botón Categorías (solo en pantallas grandes) -->
      <button class="btn btn-success d-none d-lg-inline-block" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#categoriasMenu" aria-controls="categoriasMenu">
        Categorías
      </button>

      <!-- Botones Inicio y Carrito -->
      <ul class="navbar-nav ms-3 d-flex flex-lg-row flex-column gap-2 align-items-lg-center align-items-start">
        <li class="nav-item">
          <button type="button" class="btn btn-success btn-nav">
            🏠 <span class="ms-2">Inicio</span>
          </button>
        </li>

        <li class="nav-item position-relative">
          <button type="button" class="btn btn-success btn-nav">
            🛒 <span class="ms-2">Carrito</span>
          </button>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
            style="font-size: 0.75rem;">
            3
            <span class="visually-hidden">productos en el carrito</span>
          </span>
        </li>
      </ul>

    </div>

    <!-- Menú Categorías para móviles -->
    <ul class="navbar-nav d-lg-none w-100 mt-2">
      <li class="nav-item dropdown w-100">
        <a class="nav-link dropdown-toggle btn btn-success w-100 text-center" href="#" id="categoriasDropdown"
          role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-weight: 600;">
          Categorías
        </a>
        <ul class="dropdown-menu w-100" aria-labelledby="categoriasDropdown">
          <li><a class="dropdown-item" href="#">Detergentes</a></li>
          <li><a class="dropdown-item" href="#">Jabón</a></li>
          <li><a class="dropdown-item" href="#">Cloro</a></li>
        </ul>
      </li>
    </ul>

  </nav>
</div>

<!-- Offcanvas Categorías (pantallas grandes) -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="categoriasMenu" aria-labelledby="categoriasMenuLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="categoriasMenuLabel">Categorías</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
  </div>
  <div class="offcanvas-body d-flex flex-column gap-2">
    <a href="/categoria/detergentes" class="btn btn-outline-success text-start">
      🧴 <span class="ms-2">Detergentes</span>
    </a>
    <a href="/categoria/jabon" class="btn btn-outline-success text-start">
      🧼 <span class="ms-2">Jabón</span>
    </a>
    <a href="/categoria/cloro" class="btn btn-outline-success text-start">
      🧪 <span class="ms-2">Cloro</span>
    </a>
  </div>
</div>   
</header>


  @yield('productosmain_container')

  
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Detelsa 2025</p></div>
</footer>

</body>
</html>