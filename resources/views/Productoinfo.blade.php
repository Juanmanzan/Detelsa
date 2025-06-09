@extends('layouts.productosmain')
@section('productosmain_container')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/productosinfo.css') }}">
@endpush

<div class="product-detail-container">
    <div class="container">
        <!-- Tarjeta principal del producto -->
        <div class="product-detail-card">
            <!-- Contenedor de imagen en la parte superior -->
            <div class="product-image-container">
                <img class="product-main-image" 
                     src="{{ asset($producto->imagen) }}" 
                     alt="{{ $producto->nombre }}" 
                     onerror="this.onerror=null; this.src='https://dummyimage.com/800x400/dee2e6/6c757d.jpg'" />
            </div>
            
            <div class="product-info-section">
                <h1 class="product-name">{{ $producto->nombre }}</h1>
                <p class="product-description">{{ $producto->descripcion }}</p>
                
                <div class="product-price">${{ number_format($producto->precio, 2) }}</div>
                
                <div class="product-actions">
                    <button class="btn-whatsapp"
                            onclick="enviarProductoWhatsApp(this);event.stopPropagation();"  data-id="{{ $producto->id }}">
                        <i class="fab fa-whatsapp"></i> Comprar
                    </button>
                        
                    
                    <button class="btn-cart" 
                            onclick="agregarAlCarrito({{ $producto->id }});">
                        <i class="fas fa-shopping-cart"></i> Añadir al carrito
                    </button>
                </div>
                
                <button class="product-details-toggle" id="btn-vermas">
                    <i class="fas fa-chevron-down"></i> Ver detalles del producto
                </button>
                
                <div class="product-details-content" id="product-details-content">
                    <div class="details-section">
                        <h4 class="details-title">Ingredientes</h4>
                        <ul class="ingredients-list">
                            @foreach(preg_split('/\r\n|\r|\n/', $producto->ingredientes) as $ingrediente)
                                @php
                                    $ingrediente = preg_replace('/^[\s\.\-\:\•\·]+/', '', trim($ingrediente));
                                @endphp
                                @if($ingrediente !== '')
                                    <li>{{ $ingrediente }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    
                    <div class="details-section">
                        <h4 class="details-title">Modo de uso</h4>
                        <p>{{ $producto->modo_de_uso }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sección de productos relacionados -->
        <div class="related-products-section">
            <div class="section-header">
                <h2 class="section-title">Productos Relacionados</h2>
                <p class="section-subtitle">Descubre más productos que podrían interesarte</p>
            </div>
            
            @if($productosRelacionados->count())
            <div class="related-products-grid">
                @foreach ($productosRelacionados as $prod)
                <div class="related-product-card" onclick="window.location='{{ route('productoinfo', $prod->id) }}'">
                    @if($prod->promocion)
                        <div class="related-product-badge">¡OFERTA!</div>
                    @endif
                    
                    <!-- Contenedor de imagen que ocupa todo el ancho -->

                        <div class="related-image-container" 
                        style="background-image: url('{{ asset($prod->imagen) }}');
                                background-size: contain;
                                background-position: center;
                                background-repeat: no-repeat;">
                    </div>

                    <div class="related-product-content">
                        <h3 class="related-product-name">{{ $prod->nombre }}</h3>
                        <p class="related-product-category">{{ $prod->categoria->nombre }}</p>
                        <div class="related-product-price">${{ number_format($prod->precio, 2) }}</div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="no-related-products">
                <div class="no-related-icon">
                    <i class="fas fa-box-open"></i>
                </div>
                <h3>No hay productos relacionados</h3>
                <p class="text-muted">Explora nuestra tienda para descubrir más productos</p>
                <a href="/tienda" class="btn btn-success mt-3">Ver todos los productos</a>
            </div>
            @endif
        </div>
    </div>
</div>


@endsection