@extends('layouts.productosmain')

@section('productosmain_container')
<style>
    .welcome-page {
        --primary-color: #2A7B9B;
        --secondary-color: #3CC274;
        --accent-color: #FF6B6B;
        --light-bg: #f8f9fa;
        --dark-text: #333;
        --light-text: #fff;
        --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
        padding-top: 20px;
        padding-bottom: 60px;
    }
    
    .welcome-page .container {
        max-width: 1400px;
    }
    
    .welcome-page .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--primary-color);
    }
    
    .welcome-page .section-title {
        font-size: 28px;
        font-weight: 700;
        color: var(--primary-color);
        display: flex;
        align-items: center;
        margin: 0;
    }
    
    .welcome-page .section-title i {
        margin-right: 10px;
        font-size: 32px;
    }
    
    /* Mejoras en tarjetas de categorías */
    .welcome-page .categories-container {
        margin-bottom: 60px;
    }
    
    .welcome-page .scroll-grid {
        display: flex;
        overflow-x: auto;
        padding: 20px 10px;
        scrollbar-width: thin;
        scrollbar-color: var(--primary-color) #f1f1f1;
        gap: 25px;
    }
    
    .welcome-page .scroll-grid::-webkit-scrollbar {
        height: 8px;
    }
    
    .welcome-page .scroll-grid::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .welcome-page .scroll-grid::-webkit-scrollbar-thumb {
        background: var(--primary-color);
        border-radius: 10px;
    }
    
    .welcome-page .scroll-grid::-webkit-scrollbar-thumb:hover {
        background: #1a5a72;
    }
    
    .welcome-page .category-card {
        flex: 0 0 auto;
        width: 260px;
        height: 320px;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        background: white;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        display: flex;
        flex-direction: column;
    }
    
    .welcome-page .category-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        z-index: 10;
    }
    
    .welcome-page .category-img-container {
        height: 160px;
        overflow: hidden;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #e0f7fa 0%, #b2ebf2 100%);
    }
    
    .welcome-page .category-img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid var(--primary-color);
        transition: all 0.5s ease;
    }
    
    .welcome-page .category-card:hover .category-img {
        transform: scale(1.15);
        border-color: #1a5a72;
    }
    
    .welcome-page .category-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--accent-color);
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        z-index: 2;
    }
    
    .welcome-page .category-content {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .welcome-page .category-name {
        font-size: 20px;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 10px;
        text-align: center;
        transition: color 0.3s;
    }
    
    .welcome-page .category-card:hover .category-name {
        color: #1a5a72;
    }
    
    .welcome-page .category-description {
        font-size: 14px;
        color: #666;
        line-height: 1.5;
        margin-bottom: 15px;
        flex-grow: 1;
        text-align: center;
    }
    
    .welcome-page .category-stats {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        padding-top: 10px;
        border-top: 1px dashed #eee;
    }
    
    .welcome-page .stat-item {
        text-align: center;
        flex: 1;
    }
    
    .welcome-page .stat-value {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary-color);
    }
    
    .welcome-page .stat-label {
        font-size: 12px;
        color: #777;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .welcome-page .category-btn {
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 30px;
        padding: 10px 20px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
        width: 100%;
        text-decoration: none;
    }
    
    .welcome-page .category-btn:hover {
        background: #1a5a72;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(42, 123, 155, 0.3);
    }
    
    .welcome-page .category-btn i {
        margin-left: 8px;
        transition: transform 0.3s;
    }
    
    .welcome-page .category-btn:hover i {
        transform: translateX(5px);
    }
    
    /* Promociones */
    .welcome-page .promo-section {
        margin-bottom: 50px;
        position: relative;
    }
    
    .welcome-page .promo-container {
        position: relative;
        height: 500px;
        overflow: hidden;
        border-radius: 15px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }
    
    .welcome-page .promo-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 1s ease-in-out;
        background-size: cover;
        background-position: center;
    }
    
    .welcome-page .promo-slide.active {
        opacity: 1;
        z-index: 1;
    }
    
    .welcome-page .promo-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 25px;
        transform: translateY(100%);
        transition: transform 0.5s ease;
    }
    
    .welcome-page .promo-slide:hover .promo-overlay {
        transform: translateY(0);
    }
    
    .welcome-page .promo-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 10px;
        color: #fff;
    }
    
    .welcome-page .promo-desc {
        font-size: 16px;
        margin-bottom: 15px;
        color: #ddd;
    }
    
    .welcome-page .promo-price {
        font-size: 32px;
        font-weight: 700;
        color: #3CC274;
    }
    
    .welcome-page .promo-badge {
        background: #ff6b6b;
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 16px;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 15px;
    }
    
    .welcome-page .promo-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 100%;
        display: flex;
        justify-content: space-between;
        padding: 0 20px;
        z-index: 10;
    }
    
    .welcome-page .nav-btn {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(42, 123, 155, 0.8);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .welcome-page .nav-btn:hover {
        background: #1a5a72;
        transform: scale(1.1);
    }
    
    .welcome-page .promo-indicators {
        position: absolute;
        bottom: 20px;
        left: 0;
        width: 100%;
        display: flex;
        justify-content: center;
        gap: 10px;
        z-index: 10;
    }
    
    .welcome-page .indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .welcome-page .indicator.active {
        background: #2A7B9B;
        transform: scale(1.2);
    }
    
    .welcome-page .view-all {
        background: #2A7B9B;
        color: white;
        padding: 8px 20px;
        border-radius: 30px;
        font-size: 16px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
    }
    
    .welcome-page .view-all:hover {
        background: #1a5a72;
        color: white;
        transform: translateY(-2px);
    }
    
    .welcome-page .view-all i {
        margin-left: 5px;
        transition: transform 0.3s;
    }
    
    .welcome-page .view-all:hover i {
        transform: translateX(3px);
    }
    
    /* Hero Banner */
    .welcome-page .hero-banner {
        background: linear-gradient(135deg, #2a7b9b 0%, #3cc274 100%);
        border-radius: 15px;
        padding: 60px 40px;
        margin-bottom: 60px;
        color: white;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        position: relative;
        overflow: hidden;
    }
    
    .welcome-page .hero-banner::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><circle cx="100" cy="100" r="80" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="2"/></svg>');
        background-size: 30%;
        opacity: 0.3;
    }
    
    .welcome-page .hero-title {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 20px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    
    .welcome-page .hero-subtitle {
        font-size: 1.5rem;
        margin-bottom: 30px;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .welcome-page .hero-btn {
        background: white;
        color: #2A7B9B;
        border: none;
        border-radius: 50px;
        padding: 12px 35px;
        font-size: 1.1rem;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    
    .welcome-page .hero-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.25);
    }
    
    .welcome-page .hero-btn i {
        margin-left: 8px;
        transition: transform 0.3s;
    }
    
    .welcome-page .hero-btn:hover i {
        transform: translateX(5px);
    }
    
    /* Beneficios */
    .welcome-page .benefit-card {
        height: 100%;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.3s;
        border-radius: 12px;
        overflow: hidden;
    }
    
    .welcome-page .benefit-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }
    
    .welcome-page .benefit-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 28px;
        color: white;
    }
    
    /* Responsive */
    @media (max-width: 992px) {
        .welcome-page .hero-title {
            font-size: 2.5rem;
        }
        
        .welcome-page .hero-subtitle {
            font-size: 1.3rem;
        }
    }
    
    @media (max-width: 768px) {
        .welcome-page .section-title {
            font-size: 24px;
        }
        
        .welcome-page .category-card {
            width: 240px;
            height: 300px;
        }
        
        .welcome-page .category-img-container {
            height: 140px;
        }
        
        .welcome-page .promo-container {
            height: 350px;
        }
        
        .welcome-page .promo-title {
            font-size: 22px;
        }
        
        .welcome-page .promo-price {
            font-size: 26px;
        }
        
        .welcome-page .hero-title {
            font-size: 2rem;
        }
        
        .welcome-page .hero-subtitle {
            font-size: 1.1rem;
        }
    }
    
    @media (max-width: 576px) {
        .welcome-page .section-title {
            font-size: 20px;
        }
        
        .welcome-page .category-card {
            width: 220px;
            height: 280px;
        }
        
        .welcome-page .category-img-container {
            height: 120px;
        }
        
        .welcome-page .promo-container {
            height: 300px;
        }
        
        .welcome-page .hero-banner {
            padding: 40px 20px;
        }
        
        .welcome-page .hero-title {
            font-size: 1.8rem;
        }
        
        .welcome-page .hero-subtitle {
            font-size: 1rem;
        }
    }
</style>

<div class="welcome-page">
   

    <div class="container mb-5">
        <div class="hero-banner">
            <h1 class="hero-title">Bienvenido a Detelsa</h1>
            <p class="hero-subtitle">Descubre nuestra línea de detergentes ecológicos de alta calidad que limpian mejor y cuidan el medio ambiente</p>
        </div>
    </div>

    <!-- Sección de productos en promoción -->
    @if($productos->where('promocion', 1)->count() > 0)
    <div class="container promo-section">
        <div class="section-header">
            <h2 class="section-title"><i class="bi bi-percent"></i> Promociones Destacadas</h2>
        </div>
        
        <div class="promo-container">
            @php
                $promoProducts = $productos->where('promocion', 1);
            @endphp
            
            @foreach($promoProducts as $index => $producto)
            <div class="promo-slide {{ $index === 0 ? 'active' : '' }}" 
                 style="background-image: url('{{ $producto->imagen }}');">
                <div class="promo-overlay">
                    <span class="promo-badge">OFERTA ESPECIAL</span>
                    <h3 class="promo-title">{{ $producto->nombre }}</h3>
                    <p class="promo-desc">{{ $producto->descripcion }}</p>
                    <div class="promo-price">${{ number_format($producto->precio, 2) }}</div>
                </div>
            </div>
            @endforeach
            
            <div class="promo-indicators">
                @foreach($promoProducts as $index => $producto)
                <div class="indicator {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"></div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    
    <!-- Sección de categorías -->
    <div class="container categories-container">
        <div class="section-header">
            <h2 class="section-title"><i class="bi bi-grid"></i> Nuestras Categorías</h2>
        </div>
        
        <div class="scroll-grid">  
            @foreach ($categorias as $categoria)
                <div class="category-card">
                    <div class="category-img-container">
                        <img src="{{ $categoria->imagen }}" alt="{{ $categoria->nombre }}" class="category-img">
                    </div>
                    <div class="category-content">
                        <h3 class="category-name">{{ $categoria->nombre }}</h3>
                        <a href="{{ route('tienda.productos', ['categoria' => $categoria->id]) }}"
                            class="category-btn">
                            Explorar <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <!-- Sección de beneficios -->
    <div class="container mb-5">
        <div class="section-header">
            <h2 class="section-title"><i class="bi bi-star"></i> ¿Por qué elegir Detelsa?</h2>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card benefit-card h-100 border-0">
                    <div class="card-body text-center p-4">
                        <div class="benefit-icon bg-primary">
                            <i class="bi bi-recycle"></i>
                        </div>
                        <h4 class="card-title">Ecológicos</h4>
                        <p class="card-text">Productos biodegradables que respetan el medio ambiente y reducen tu huella ecológica.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card benefit-card h-100 border-0">
                    <div class="card-body text-center p-4">
                        <div class="benefit-icon bg-primary">
                            <i class="bi bi-gem"></i>
                        </div>
                        <h4 class="card-title">Alta Concentración</h4>
                        <p class="card-text">Mayor rendimiento por gota, lo que significa más lavados por envase y mejor economía.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card benefit-card h-100 border-0">
                    <div class="card-body text-center p-4">
                        <div class="benefit-icon bg-primary">
                            <i class="bi bi-heart"></i>
                        </div>
                        <h4 class="card-title">Suaves con la piel</h4>
                        <p class="card-text">Fórmulas hipoalergénicas que protegen tu piel y son seguras para toda la familia.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>        

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Elementos del carrusel
        const slides = document.querySelectorAll('.promo-slide');
        const indicators = document.querySelectorAll('.indicator');
        const prevBtn = document.querySelector('.prev-btn');
        const nextBtn = document.querySelector('.next-btn');
        
        if (slides.length > 0) {
            let currentSlide = 0;
            const slideCount = slides.length;
            
            // Función para cambiar de slide
            function goToSlide(index) {
                // Desactivar slide actual
                slides[currentSlide].classList.remove('active');
                indicators[currentSlide].classList.remove('active');
                
                // Actualizar índice
                currentSlide = (index + slideCount) % slideCount;
                
                // Activar nuevo slide
                slides[currentSlide].classList.add('active');
                indicators[currentSlide].classList.add('active');
            }
            
            
            // Eventos para indicadores
            indicators.forEach(indicator => {
                indicator.addEventListener('click', function() {
                    const index = parseInt(this.getAttribute('data-index'));
                    goToSlide(index);
                });
            });
            
            // Cambio automático de slides
            if (slideCount > 1) {
                setInterval(() => {
                    goToSlide(currentSlide + 1);
                }, 5000);
            }
            
            // Mostrar overlay al pasar el ratón
            slides.forEach(slide => {
                slide.addEventListener('mouseenter', function() {
                    this.querySelector('.promo-overlay').style.transform = 'translateY(0)';
                });
                
                slide.addEventListener('mouseleave', function() {
                    this.querySelector('.promo-overlay').style.transform = 'translateY(100%)';
                });
            });
        }
    });
</script>
@endsection