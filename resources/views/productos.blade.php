@extends('layouts.productosmain')
@section('productosmain_container')



<style>
    .products-container {
        padding: 2rem 0;
        background-color: #f8f9fa;
    }
    
    .products-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #198754;
    }
    
    .section-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #198754;
        margin: 0;
    }
    
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 1.5rem;
    }
    
    .product-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }
    
    .product-badge {
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
    
    .product-image-container {
        height: 200px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        position: relative;
    }
    
    .product-image {
        max-width: 100%;
        max-height: 180px;
        object-fit: contain;
        transition: transform 0.5s ease;
    }
    
    .product-card:hover .product-image {
        transform: scale(1.05);
    }
    
    .product-content {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .product-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        transition: color 0.3s;
    }
    
    .product-card:hover .product-name {
        color: #198754;
    }
    
    .product-description {
        font-size: 0.9rem;
        color: #7f8c8d;
        line-height: 1.5;
        margin-bottom: 1rem;
        flex-grow: 1;
    }
    
    .product-price {
        font-size: 1.25rem;
        font-weight: 700;
        color: #198754;
        margin-bottom: 1rem;
    }
    
    .product-actions {
        display: flex;
        justify-content: space-between;
        gap: 0.5rem;
    }
    
    .action-btn {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        padding: 0.6rem;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
    }
    
    .whatsapp-btn {
        background: #25D366;
        color: white;
    }
    
    .whatsapp-btn:hover {
        background: #128C7E;
        transform: translateY(-2px);
    }
    
    .cart-btn {
        background: #198754;
        color: white;
        position: relative;
    }
    
    .cart-btn:hover {
        background: #0d6e3f;
        transform: translateY(-2px);
    }
    
    .cart-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #ff6b6b;
        color: white;
        border-radius: 50%;
        width: 22px;
        height: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
        font-weight: 700;
    }
    
    .action-icon {
        width: 24px;
        height: 24px;
        object-fit: contain;
    }
    
    .filter-section {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }
    
    .filter-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #2c3e50;
    }
    
    .category-filter {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    
    .category-btn {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        background: #e8f5e9;
        color: #2e7d32;
        border: none;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .category-btn:hover, .category-btn.active {
        background: #2e7d32;
        color: white;
    }
    
    .no-products {
        grid-column: 1 / -1;
        text-align: center;
        padding: 3rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    
    .no-products-icon {
        font-size: 3rem;
        color: #bdc3c7;
        margin-bottom: 1rem;
    }
    
    /* Toast Notification */
    .toast {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: #4CAF50;
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        z-index: 1000;
        display: flex;
        align-items: center;
        transform: translateY(100px);
        opacity: 0;
        transition: all 0.3s ease;
    }
    
    .toast.show {
        transform: translateY(0);
        opacity: 1;
    }
    
    .toast-icon {
        margin-right: 10px;
        font-size: 1.5rem;
    }
    
    @media (max-width: 768px) {
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        }
        
        .products-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        
        .product-image-container {
            height: 180px;
        }
    }
    
    @media (max-width: 576px) {
        .products-grid {
            grid-template-columns: 1fr;
        }
        
        .product-image-container {
            height: 160px;
        }
    }
    
    .product-container {
    position: relative;
    width: 100%;
    height: 200px; /* ajusta según necesidad */
    overflow: hidden;
    }

    .product-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
    }

</style>

<div class="products-container">
    <div class="container">
        
        <div class="products-header">
            <h2 class="section-title">Nuestros Productos</h2>
            <div class="d-flex align-items-center">
                <span class="me-2">Ordenar por:</span>
                <select class="form-select" style="width: auto;">
                    <option>Precio: Menor a Mayor</option>
                    <option>Precio: Mayor a Menor</option>>
                </select>
            </div>
        </div>
        
        @if($productos->count() > 0)
        <div class="products-grid">
            @foreach ($productos as $producto)
            <div class="product-card" data-category="{{ $producto->categoria_id }}">
                @if($producto->promocion)
                    <div class="product-badge">¡OFERTA!</div>
                @endif
                
                <div class="product-image-container">
                    <img class="product-image" 
                         src="{{ asset($producto->imagen) ?? 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg' }}" 
                         alt="{{ $producto->nombre }}" />
                </div>
                
                <div class="product-content">
                    <h3 class="product-name">{{ $producto->nombre }}</h3>
                    <p class="product-description">{{ Str::limit($producto->descripcion, 80) }}</p>
                    <div class="product-price">${{ number_format($producto->precio, 2) }}</div>
                    
                    <div class="product-actions">
                        <button class="action-btn whatsapp-btn"
                                onclick="enviarProductoWhatsApp(this);  event.stopPropagation();" data-id="{{ $producto->id }}">
                            <img class="action-icon" 
                                 src="https://cdn3.iconfinder.com/data/icons/2018-social-media-logotypes/1000/2018_social_media_popular_app_logo-whatsapp-512.png" 
                                 alt="WhatsApp">
                        </button>
                        
                        <button class="action-btn cart-btn" 
                                onclick="agregarAlCarrito({{ $producto->id }}); event.stopPropagation();">
                            <img class="action-icon" 
                                 src="https://cdn4.iconfinder.com/data/icons/eon-ecommerce-i-1/32/cart_shop_buy_retail-512.png" 
                                 alt="Carrito">
                            <span id="badge-{{ $producto->id }}" class="cart-badge" style="display: none;">0</span>
                        </button>
                        
                        <button class="action-btn" 
                                onclick="window.location='{{ route('productoinfo', ['id' => $producto->id]) }}'; event.stopPropagation();"
                                style="background: #f1f8e9;">
                            <img class="action-icon" 
                                 src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-ios7-eye-512.png" 
                                 alt="Ver Detalles">
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="no-products">
            <div class="no-products-icon">
                <i class="bi bi-box-seam"></i>
            </div>
            <h3>No se encontraron productos</h3>
        </div>
        @endif
        
       
    </div>
</div>
@endsection