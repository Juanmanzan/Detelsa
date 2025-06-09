
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detelsa - Detergentes de Calidad</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/productosmain.css') }}">
    @stack('styles')

    <script src="{{ asset('vendor/bootstrap/js/bootstrap5.bundle.min.js') }}"></script>    
   
    <script src="{{ asset('javaproyecto/carrito.js') }}"></script>
    <script src="{{ asset('javaproyecto/productosinfo.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-xl px-4">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('imagenes/logo.png') }}" alt="Detelsa Logo" class="me-2 logo-img" />
                <span>Detelsa</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">

              <form class="search-form d-flex flex-grow-1 me-3 my-2 my-lg-0" role="search" method="GET" action="{{ route('productos.buscar') }}">
                <input class="form-control" type="search" name="q" placeholder="Buscar productos..." aria-label="Buscar">
                <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            </form>
                
                <ul class="navbar-nav ms-auto d-flex flex-lg-row flex-column align-items-lg-center">
                    @if(!request()->is('/'))
                    <li class="nav-item me-lg-2 mb-lg-0 mb-2">
                        <a href="/" class="btn nav-btn {{ request()->is('/') ? 'active' : '' }}">
                            <i class="fas fa-home"></i> <span>Inicio</span>
                        </a>
                    </li>
                    @endif
                    
                    @if(!request()->is('tienda') && !request()->is('tienda/*'))
                    <li class="nav-item me-lg-2 mb-lg-0 mb-2">
                        <a href="/tienda" class="btn nav-btn">
                            <i class="fas fa-box"></i> <span>Productos</span>
                        </a>
                    </li>
                    @endif
                    
                    @if(request()->is('tienda') || request()->is('tienda/*'))
                    <li class="nav-item me-lg-2 mb-lg-0 mb-2 d-none d-lg-block">
                        <button class="btn nav-btn" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#categoriasMenu" aria-controls="categoriasMenu">
                            <i class="fas fa-list"></i> <span>Categorías</span>
                        </button>
                    </li>
                    @endif
                    
                    <li class="nav-item position-relative">
                        <a href="#" class="btn nav-btn" data-bs-toggle="offcanvas" data-bs-target="#carritoMenu" aria-controls="carritoMenu">
                            <i class="fas fa-shopping-cart"></i> <span>Carrito</span>
                            <span class="cart-badge" id="cart-count">0</span>
                        </a>
                    </li>

                    <li class="nav-item position-relative ms-2">
                        <a href="/acercadenosotros" class="btn nav-btn">
                            <i class="fas fa-info-circle"></i> <span>Acerca de nosotros</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Mobile categories dropdown -->
    <div class="container d-lg-none">
        @if(request()->is('tienda') || request()->is('tienda/*'))
        <div class="d-grid mt-2">
            <button class="btn btn-light" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#categoriasMenu" aria-controls="categoriasMenu">
                <i class="fas fa-list me-2"></i> Ver categorías
            </button>
        </div>
        @endif
    </div>

    <!-- Categories Offcanvas -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="categoriasMenu" aria-labelledby="categoriasMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="categoriasMenuLabel"><i class="fas fa-list me-2"></i> Categorías</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
        </div>
        <div class="offcanvas-body">
            @foreach ($categorias as $categoria)
                @php 
                    $esActiva = request('categoria') == $categoria->id; 
                    $ruta = $esActiva ? route('tienda.productos') : route('tienda.productos', ['categoria' => $categoria->id]);
                @endphp
            <a href="{{ $ruta }}"
               class="d-block btn btn-outline-success category-btn {{ $esActiva ? 'active' : '' }}">
                {{$categoria->nombre}}
            </a>
            @endforeach
        </div>
    </div>

    <!-- Shopping Cart Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="carritoMenu" aria-labelledby="carritoMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="carritoMenuLabel"><i class="fas fa-shopping-cart me-2"></i> Tu Carrito</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
        </div>
        <div class="offcanvas-body" id="carritoContenido">
            <p>Tu carrito está vacío.</p>
        </div>
    </div>
</header>

@yield('productosmain_container')

<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- Contact Info -->
            <div class="col-md-4 mb-4 mb-md-0">
                <h5>Encuéntranos</h5>
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i> Calle Ejemplo #123, Ciudad</li>
                    <li><i class="fas fa-phone"></i> (555) 123-4567</li>
                    <li><i class="fas fa-envelope"></i> <a href="mailto:detelsa@gmail.com" class="text-white">detelsa@gmail.com</a></li>
                    <li><i class="fas fa-clock"></i> Lunes a Viernes: 9:00 AM - 6:00 PM</li>
                </ul>
            </div>
            
            <!-- About -->
            <div class="col-md-4 mb-4 mb-md-0">
                <h5>¿Quiénes somos?</h5>
                <p>Somos una empresa dedicada a la producción y distribución de detergentes líquidos de alta calidad, comprometidos con la excelencia y el cuidado del medio ambiente.</p>
                
            </div>
            
            <!-- Social & Links -->
            <div class="col-md-4">
                <h5>Síguenos</h5>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-tiktok"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-whatsapp"></i></a>
                </div>
                
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6 text-md-start text-center mb-3 mb-md-0">
                    &copy; {{ date('Y') }} Detelsa. Todos los derechos reservados.
                </div>

            </div>
        </div>
    </div>
</footer>
</body>
</html>