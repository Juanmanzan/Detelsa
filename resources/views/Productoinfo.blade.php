
@extends('layouts.productosmain')
@section('productosmain_container')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacion / producto </title>
    <link rel="stylesheet" href="{{ asset('css/productosinfo.css') }}">
    <script src="{{ asset('javaproyecto/productosinfo.js') }}"></script>
</head>
<body>
    

<div class="container my-5">
  <div class="row align-items-start">

    <!-- Imagen -->
    <div class="col-md-4" style="margin-left: 3%;">
      <img src="{{ asset('imagenes/producto1.jpg') }}" alt="Producto" class="img-fluid rounded">

      <!-- Aquí se moverá la tabla del carrito cuando se haga clic en "Ver más" -->
      <div id="contenedor-tabla-movil"></div>
    </div>

    <!-- Información -->
    <div class="col-md-6">
      <h4 class="fw-bold">Detergente líquido</h4>
      <p id="descripcion-producto" class="descripcion-corta">
       Para la limpieza profunda de todo tipo de pisos: cerámica, porcelanato, vinilo, mármol y granito. Su poderosa acción desinfectante elimina bacterias y residuos difíciles, 
       dejando las superficies relucientes y con un agradable aroma a frescura. Ideal para uso doméstico, institucional e industrial. Este detergente líquido ha sido 
       especialmente formulado para ofrecer una limpieza eficaz sin dañar las superficies delicadas, asegurando una higiene óptima en cada aplicación. Además, 
       su fórmula biodegradable y respetuosa con el medio ambiente contribuye a la conservación del entorno, haciendo de este producto una opción segura y responsable para el 
       hogar y los espacios comerciales. Con su agradable fragancia, no solo limpia sino que también refresca el ambiente, proporcionando una sensación de limpieza y bienestar 
       duradera. Perfecto para quienes buscan calidad, eficacia y cuidado en un solo producto.
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
          <li>Tensioactivos aniónicos</li>
          <li>Cloruro de benzalconio</li>
          <li>Solventes biodegradables</li>
          <li>Fragancia concentrada</li>
          <li>Colorante hidrosoluble</li>
          <li>Agua desmineralizada</li>
        </ul>
        <h5>Modo de uso</h5>
        <p>Diluir 100 ml del detergente en 5 litros de agua. Aplicar con trapeador o paño húmedo y dejar secar. No necesita enjuague.</p>
      </div>

      <!-- Tabla carrito (botones +, -, input, carrito y precio) que se mueve -->
      <div id="tabla-carrito" class="d-flex align-items-center justify-content-between border-top border-bottom py-3 px-2">
        <div class="d-flex align-items-center">
          <button type="button" class="btn btn-outline-secondary me-2" id="btn-mas">+</button>
          <input type="number" id="cantidad" class="form-control text-center" style="width: 60px;" value="1" min="1">
          <button type="button" class="btn btn-outline-secondary ms-2" id="btn-menos">-</button>
        </div>

        <button type="button" class="btn btn-outline-dark d-flex align-items-center justify-content-center" style="font-size: 1.5rem;">
          🛒
        </button>

        <p class="mb-0 fw-bold">Precio: $15.00</p>
      </div>

    </div>
  </div>
</div>

<div class="container">

   <section class="py-1">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-start">
            <div class="col mb-5">
                <div class="card h-100" onclick="window.location='{{ route('productoinfo') }}'" style="cursor: pointer;">

                    <!-- Imagen del producto -->
                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />

                    <!-- Detalles del producto -->
                    <div class="card-body p-4">
                        <div class="text-start">
                            <h5 class="fw-bolder">Detergente líquido</h5>
                            <p>Detergente</p>
                            <p>$15.00</p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
</div>

</body>
</html>
@endsection