@extends('layouts.productosmain')

@section('productosmain_container')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
@endpush

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
document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.promo-slide');
    const indicators = document.querySelectorAll('.indicator');
    let currentSlide = 0;
    let intervalId;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
            indicators[i].classList.toggle('active', i === index);
        });
        currentSlide = index;
    }

    function nextSlide() {
        const nextIndex = (currentSlide + 1) % slides.length;
        showSlide(nextIndex);
    }

    function startAutoplay() {
        intervalId = setInterval(nextSlide, 5000);
    }

    function stopAutoplay() {
        clearInterval(intervalId);
    }

    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            stopAutoplay();           // Detenemos autoplay antes de cambiar
            showSlide(index);         // Mostramos el slide deseado
            startAutoplay();          // Reiniciamos autoplay
        });
    });

    // Inicialización
    showSlide(0);
    startAutoplay();
});
</script>
@endsection