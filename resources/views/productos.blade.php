@extends('layouts.productosmain')
@section('productosmain_container')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Detelsa / producto</title>
    <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
</head>
<body>

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <!-- Toast de notificación (se mostrará cuando se agregue al carrito) -->
        <div id="toastContainer" class="position-fixed bottom-0 end-0 p-3" style="z-index: 11"></div>

        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-start">
            @foreach ($productos as $producto)
                <div class="col mb-5">
                    
                   <div class="card h-100" onclick="window.location='{{ route('productoinfo', ['id' => $producto->id]) }}'" style="cursor: pointer;">
                        <!-- Imagen del producto -->
                        <img class="card-img-top" src="{{ asset($producto->imagen) ?? 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg' }}" alt="{{ $producto->nombre }}" />

                        <!-- Detalles del producto -->
                        <div class="card-body p-4">
                            <div class="text-start">
                                <h5 class="fw-bolder">{{ $producto->nombre }}</h5>
                                <p>${{ number_format($producto->precio, 2) }}</p>
                            </div>
                        </div>

                        <!-- Botones de acciones -->
                        <div class="d-flex flex-row justify-content-center">
                            <!-- Botón de WhatsApp -->
                            <button type="button"
                                class="btn btn-outline-success d-flex align-items-center justify-content-center ms--1 mb-5 btn-whatsapp-producto"
                                onclick="enviarProductoWhatsApp(this);  event.stopPropagation(); return false;">
                                <img src="https://cdn3.iconfinder.com/data/icons/2018-social-media-logotypes/1000/2018_social_media_popular_app_logo-whatsapp-512.png"
                                    alt="WhatsApp" style="width: 75%; height: 75%; object-fit: contain;">
                            </button>

                            <!-- Botón de Carrito (modificado) -->
                            <a class="btn btn-outline-success d-flex align-items-center justify-content-center ms-4 mb-5 btn-agregar-carrito" 
                                href="#"  
                                onclick="agregarAlCarrito({{ $producto->id }}); event.stopPropagation(); return false;">
                                <img src="https://cdn4.iconfinder.com/data/icons/eon-ecommerce-i-1/32/cart_shop_buy_retail-512.png"
                                    alt="Carrito" style="width: 75%; height: 75%; object-fit: contain;">
                                <!-- Badge para mostrar cantidad agregada -->
                                <span id="badge-{{ $producto->id }}" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="display: none;">
                                    0
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


</body>
</html>
@endsection
