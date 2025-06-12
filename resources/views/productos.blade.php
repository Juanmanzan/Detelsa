@extends('layouts.productosmain')

@section('productosmain_container')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/productos.css') }}">
@endpush


<div class="products-container">
    <div class="container">
        
     <div class="products-header">
        <h2 class="section-title">Nuestros Productos</h2>
        <div class="d-flex align-items-center">
            <span class="me-2">Ordenar por:</span>
            <form method="GET" action="{{ route('tienda.productos') }}" >
                <select name="orden" class="form-select" onchange="this.form.submit()">
                    <option value="asc" {{ request('orden') == 'asc' ? 'selected' : '' }}>Precio: Menor a Mayor</option>
                    <option value="desc" {{ request('orden') == 'desc' ? 'selected' : '' }}>Precio: Mayor a Menor</option>
                </select>
            </form>
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
                    <p class="product-description">{{ Str::limit($producto->descripcion, 200) }}</p>
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