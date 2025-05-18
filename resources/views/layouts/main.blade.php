<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}">
     <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
</head>
<body>

<header>
    <div class="coantainer"> 

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm"> 

        <!-- Botón para abrir el menú -->

        <button class="btn btn-success ms-5" type="button" data-bs-toggle="offcanvas" data-bs-target="#categoriasMenu" aria-controls="categoriasMenu">
        Categorías
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            
            <div class="container d-flex align-items-center">

                <img src="{{ asset('imagenes/logo.png') }}" alt="Logo" style="width: 6%; height: 6%;">
                <h4> Detelsa</h4>

                <form class="d-flex ms-5" role="search" >
                    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
                    <button class="btn btn-success" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
                   
                </button>
            </div>

        </div>
    
    </nav>

     <!-- Menú lateral -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="categoriasMenu" aria-labelledby="categoriasMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title d-flex align-items-center" id="categoriasMenuLabel">
            <img src="{{ asset('imagenes/logo.png') }}" alt="Categorías">
            Categorías
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-group">
            <li class="list-group-item"><a href="#">Detergestes</a></li>
            <li class="list-group-item"><a href="#">Jabon</a></li>
            <li class="list-group-item"><a href="#">Cloro</a></li>
            </ul>
        </div>
        </div>

    </div>
</header>

  @yield('main_container')  
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Detelsa 2025</p></div>
</footer>

</body>
</html>