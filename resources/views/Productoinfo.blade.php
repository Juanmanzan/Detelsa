
@extends('layouts.productosmain')
@section('productosmain_container')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacion / </title>
    <link rel="stylesheet" href="{{ asset('css/productosinfo.css') }}">
    <script src="{{ asset('javaproyecto/productosinfo.js') }}"></script>
</head>
<body>
    

<div class="container my-5">

  <div class="row align-items-start">

    <!-- Imagen -->
    <div class="col-md-4" style="margin-left: 3%;">
      <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" class="img-fluid rounded mb-3" id="imagen-producto">
      <!-- Aquí se moverá la tabla del carrito cuando se haga clic en "Ver más" -->
      <div id="contenedor-tabla-movil"></div>
    </div>

    <!-- Información -->
    <div class="col-md-6">
      <h4 class="fw-bold">{{ $producto->nombre }}</h4>
      <p id="descripcion-producto" class="descripcion-corta">
       {{ $producto->descripcion }}
      </p>

      <div class="d-flex justify-content-center mb-4">
        <button type="button" class="btn btn-vermas" id="btn-vermas" data-img-url="{{ asset('imagenes/Vermas.png') }}">
            Ver más <img src="{{ asset('imagenes/Vermas.png') }}" alt="Más" id="icono-vermas">
        </button>

      </div>

      <!-- Ingredientes y modo de uso: siempre abajo del texto -->
      <div id="ingredientes-modouso" class="mt-4" style="display: none; margin-left: 1.5rem;">
        <h5 class="fw-bold">Ingredientes</h5>
        <ul>
          @foreach(explode(',', $producto->ingredientes) as $ingrediente)
            <li>{{ trim($ingrediente) }}</li>
          @endforeach
        </ul>
        <h5>Modo de uso</h5>
        <p>{{ $producto->modo_de_uso }}</p>
      </div>

      <!-- Tabla carrito (botones +, -, input, carrito y precio) que se mueve -->
      <div id="tabla-carrito" class="d-flex align-items-center justify-content-between border-top border-bottom py-3 px-2">
        <button type="button" 
          class="btn btn-outline-dark btn-agregar-carrito" 
          onclick="agregarAlCarrito({{ $producto->id }});">
          🛒
        </button>

        <p class="mb-0 fw-bold">Precio: ${{ number_format($producto->precio, 2) }}</p>
      </div>

    </div>
  </div>
</div>

<div class="container">

   <section class="py-1">
    <div class="text-center mb-4">
        <h2 class="fw-bold">Productos Relacionados</h2>
        <p>Descubre más productos que podrían interesarte</p>
      
        @if($productosRelacionados->count())
          <div class="container px-4 px-lg-5 mt-5">
              <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-start">

                @foreach ($productosRelacionados as $prod)
                  <div class="col mb-5">
                      <div class="card h-100" onclick="window.location='{{ route('productoinfo', $prod->id) }}'" style="cursor: pointer;">

                          <!-- Imagen del producto -->
                          <img class="card-img-top" src="{{ asset('storage/' . $prod->imagen) }}" alt="{{ $prod->nombre }}" />

                          <!-- Detalles del producto -->
                          <div class="card-body p-4">
                              <div class="text-start">
                                  <h5 class="fw-bolder">{{ $prod->nombre }}</h5>
                                  <p>{{ $prod->categoria->nombre }}</p>
                                  <p>{{ number_format($prod->precio, 2) }}</p>
                              </div>
                          </div>

                      </div>
                  </div>
                @endforeach

              </div>
          </div>
        @else
          <p>No hay productos relacionados para mostrar.</p>
        @endif

    </div>
   </section>

</div>




</body>
</html>
@endsection