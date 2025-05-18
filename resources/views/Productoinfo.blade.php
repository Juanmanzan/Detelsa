
@extends('layouts.productosmain')
@section('productosmain_container')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacion / producto </title>
    <link rel="stylesheet" href="{{ asset('css/productosinfo.css') }}">
</head>
<body>
    
<div class="container my-5">
    <div class="row align-items-start">
        <!-- Imagen -->
        <div class="col-md-4" style="margin-left: 3%;">
            <img src="{{ asset('imagenes/producto1.jpg') }}" alt="Producto" class="img-fluid rounded">
        </div>

        <!-- Información -->
        <div class="col-md-6">
            <!-- Título -->
            <h5 class="fw-bold">Detergente líquido</h5>

            <!-- Descripción -->
            <p>
                Para la limpieza profunda de todo tipo de pisos: cerámica, porcelanato, vinilo, mármol y granito.
                Su poderosa acción desinfectante elimina bacterias y residuos difíciles, dejando las superficies relucientes y con un agradable aroma a frescura.
                Ideal para uso doméstico, institucional e industrial.
            </p>

            <!-- ver mas -->

          <div class="d-flex justify-content-center mb-4">
            <button type="button" class="btn btn-vermas">
                Ver más <img src="{{ asset('imagenes/Vermas.png') }}" alt="Más">
            </button>
          </div>

            <!-- Línea con botones y precio estilo tabla -->
            <div class="d-flex align-items-center justify-content-between border-top border-bottom py-3 px-2">
                <!-- Botones cantidad -->
                <div class="d-flex align-items-center">
                    <button type="button" class="btn btn-outline-secondary me-2">+</button>
                    <p class="mb-0 mx-2">5</p>
                    <button type="button" class="btn btn-outline-secondary ms-2">-</button>
                </div>

                <!-- Botón carrito -->
                <button type="button" class="btn btn-outline-dark d-flex align-items-center justify-content-center" style="font-size: 1.5rem;">
                     🛒
                </button>

                <!-- Precio -->
                <p class="mb-0 fw-bold">Precio: $15.00</p>
            </div>
        </div>
    </div>
</div>




</body>
</html>
@endsection