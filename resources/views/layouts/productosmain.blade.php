
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detelsa - Detergentes de Calidad</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')

    <script src="{{ asset('vendor/bootstrap/js/bootstrap5.bundle.min.js') }}"></script>    
    <script src="{{ asset('javaproyecto/productosmain.js') }}"></script>
    <script src="{{ asset('javaproyecto/carrito.js') }}"></script>
    <script src="{{ asset('javaproyecto/productosinfo.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --primary: #198754;
            --primary-dark: #0d6e3f;
            --secondary: #f8f9fa;
            --accent: #ffc107;
            --light: #ffffff;
            --dark: #212529;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Header Styles */
        .navbar {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.6rem;
            letter-spacing: 0.5px;
            color: var(--light) !important;
            transition: transform 0.3s;
        }
        
        .navbar-brand:hover {
            transform: scale(1.03);
        }
        
        .logo-img {
            height: 45px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }
        
        .search-form {
            position: relative;
            max-width: 500px;
            margin: 0 auto;
        }
        
        .search-form input {
            border-radius: 50px;
            padding: 10px 20px;
            border: none;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .search-form button {
            position: absolute;
            right: 5px;
            top: 5px;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary);
            border: none;
        }
        
        .nav-btn {
            border-radius: 50px;
            padding: 8px 18px;
            font-weight: 500;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white !important;
            min-width: 110px;
        }
        
        .nav-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .nav-btn.active {
            background: var(--light);
            color: var(--primary) !important;
            font-weight: 600;
        }
        
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            font-size: 0.7rem;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--accent);
            color: var(--dark);
            font-weight: 700;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        
        .offcanvas-header {
            background: var(--primary);
            color: white;
        }
        
        .offcanvas-title {
            font-weight: 600;
        }
        
        .category-btn {
            border-radius: 8px;
            padding: 10px 15px;
            margin-bottom: 8px;
            transition: all 0.3s;
            text-align: left;
            position: relative;
            overflow: hidden;
        }
        
        .category-btn:hover {
            background: var(--primary);
            color: white;
            transform: translateX(5px);
        }
        
        .category-btn:hover::after {
            content: "→";
            position: absolute;
            right: 15px;
        }
        
        .category-btn.active {
            background: var(--primary);
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        /* Footer Styles */
        .footer {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 3rem 0 1.5rem;
            margin-top: auto;
        }
        
        .footer h5 {
            font-weight: 700;
            margin-bottom: 1.2rem;
            position: relative;
            display: inline-block;
        }
        
        .footer h5::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--accent);
            border-radius: 2px;
        }
        
        .footer p {
            line-height: 1.8;
            opacity: 0.9;
        }
        
        .footer ul {
            padding-left: 0;
            list-style: none;
        }
        
        .footer ul li {
            margin-bottom: 0.8rem;
        }
        
        .footer ul li i {
            margin-right: 10px;
            color: var(--accent);
            width: 20px;
        }
        
        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 1.2rem;
            transition: all 0.3s;
        }
        
        .social-link:hover {
            background: var(--accent);
            color: var(--dark);
            transform: translateY(-3px);
        }
        
        .newsletter-form {
            display: flex;
            margin-top: 15px;
        }
        
        .newsletter-form input {
            border-radius: 50px 0 0 50px;
            border: none;
            padding: 10px 20px;
            flex: 1;
        }
        
        .newsletter-form button {
            background: var(--accent);
            color: var(--dark);
            border: none;
            padding: 0 20px;
            border-radius: 0 50px 50px 0;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .newsletter-form button:hover {
            background: #e0a800;
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1.5rem;
            margin-top: 2rem;
            text-align: center;
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        .payment-methods {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 15px;
        }
        
        .payment-method {
            background: white;
            border-radius: 5px;
            padding: 5px 10px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--primary);
        }
        
        /* Responsive Adjustments */
        @media (max-width: 991px) {
            .navbar-collapse {
                padding-top: 15px;
            }
            
            .nav-btn {
                width: 100%;
                margin-bottom: 8px;
            }
            
            .search-form {
                margin-bottom: 15px;
            }
        }
        
        @media (max-width: 767px) {
            .footer .col-md-4 {
                margin-bottom: 30px;
            }
            
            .footer h5::after {
                left: 50%;
                transform: translateX(-50%);
            }
            
            .footer h5 {
                text-align: center;
                display: block;
            }
            
            .footer ul, .footer .social-links, .footer .newsletter-form {
                justify-content: center;
            }
        }
    </style>
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