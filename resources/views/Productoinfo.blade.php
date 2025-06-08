@extends('layouts.productosmain')
@section('productosmain_container')

<style>
    /* Estilos para la vista de detalles del producto */
    .product-detail-container {
        padding: 2rem 0;
    }
    
    .product-detail-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        overflow: hidden;
        margin-bottom: 3rem;
    }
    
    /* Contenedor de imagen en la parte superior */
    .product-image-container {
        position: relative;
        width: 100%;
        height: 400px; /* Altura fija para la imagen */
        background: #f8f9fa;
        display: flex;
        align-items: flex-start; /* Alineado arriba */
        justify-content: center;
        overflow: hidden;
    }
    
    .product-main-image {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        object-position: top; /* Fuerza alineación superior */
        padding: 2rem;
    }
    
    .product-info-section {
        padding: 2rem;
    }
    
    .product-name {
        font-size: 2.2rem;
        font-weight: 700;
        color: #198754;
        margin-bottom: 1.5rem;
    }
    
    .product-description {
        font-size: 1.1rem;
        color: #555;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }
    
    .product-price {
        font-size: 1.8rem;
        font-weight: 700;
        color: #e74c3c;
        margin-bottom: 2rem;
    }
    
    .product-actions {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
    }
    
    .btn-whatsapp {
        background: #25D366;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0.8rem 1.5rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s;
    }
    
    .btn-whatsapp:hover {
        background: #128C7E;
        transform: translateY(-2px);
    }
    
    .btn-cart {
        background: #198754;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0.8rem 1.5rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s;
    }
    
    .btn-cart:hover {
        background: #0d6e3f;
        transform: translateY(-2px);
    }
    
    .product-details-toggle {
        background: #f8f9fa;
        border: none;
        border-radius: 8px;
        padding: 0.8rem 1.5rem;
        font-weight: 600;
        color: #198754;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .product-details-toggle:hover {
        background: #e9ecef;
    }
    
    .product-details-content {
        padding: 1.5rem;
        background: #f8f9fa;
        border-radius: 12px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s ease, padding 0.5s ease;
    }
    
    .product-details-content.expanded {
        max-height: 1000px; /* Valor suficiente para mostrar todo el contenido */
        padding: 1.5rem;
    }
    
    .details-section {
        margin-bottom: 1.5rem;
    }
    
    .details-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #198754;
        margin-bottom: 0.8rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #e9ecef;
    }
    
    .ingredients-list {
        padding-left: 1.5rem;
    }
    
    .ingredients-list li {
        margin-bottom: 0.5rem;
    }
    
    /* Sección de productos relacionados */
    .related-products-section {
        padding: 2rem 0;
        background: #f8f9fa;
        border-radius: 12px;
        margin-bottom: 2rem;
    }
    
    .section-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .section-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #198754;
        margin-bottom: 0.5rem;
    }
    
    .section-subtitle {
        font-size: 1.1rem;
        color: #6c757d;
        max-width: 600px;
        margin: 0 auto;
    }
    
    .related-products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
        padding: 0 1rem;
    }
    
    .related-product-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
        cursor: pointer;
    }
    
    .related-product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }
    
    .related-product-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: #ff6b6b;
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        z-index: 2;
    }
    
    .related-image-container {
        position: relative;
        width: 100%;
        height: 200px;
        background: #f1f8e9;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .related-product-image {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain; /* Opcional para navegadores modernos */
        display: block;
        transition: transform 0.5s ease;
    }

    
    .related-product-card:hover .related-product-image {
        transform: scale(1.05);
    }
    
    .related-product-content {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .related-product-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        transition: color 0.3s;
        height: 3.2rem;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    
    .related-product-card:hover .related-product-name {
        color: #198754;
    }
    
    .related-product-category {
        font-size: 0.9rem;
        color: #7f8c8d;
        margin-bottom: 0.5rem;
        height: 1.4rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    
    .related-product-price {
        font-size: 1.25rem;
        font-weight: 700;
        color: #198754;
        margin-top: auto;
    }
    
    .no-related-products {
        grid-column: 1 / -1;
        text-align: center;
        padding: 3rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    
    .no-related-icon {
        font-size: 3rem;
        color: #bdc3c7;
        margin-bottom: 1rem;
    }
    
    /* Responsive */
    @media (max-width: 992px) {
        .product-image-container {
            height: 350px;
        }
        
        .related-products-grid {
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        }
    }
    
    @media (max-width: 768px) {
        .product-info-section {
            padding: 1.5rem;
        }
        
        .product-name {
            font-size: 1.8rem;
        }
        
        .related-products-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }
        
        .product-actions {
            flex-direction: column;
        }
    }
    
    @media (max-width: 576px) {
        .related-products-grid {
            grid-template-columns: 1fr;
        }
        
        .product-name {
            font-size: 1.5rem;
        }
        
        .product-price {
            font-size: 1.5rem;
        }
        
        .product-image-container {
            height: 300px;
        }
    }
</style>

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
                                background-size: cover;
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