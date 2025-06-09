@extends('layouts.productosmain')
@section('productosmain_container')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detelsa / Productos</title>
    <link rel="stylesheet" href="{{ asset('css/acercade.css') }}">
</head>
<body>
    <div class="container mt-4">
        <!-- Tarjetas prioridad 1 - Texto justificado, sin bordes y tamaño aumentado -->
        @foreach ($contenido as $item)
            @if($item->prioridad == 1)
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="titulo-prioridad-1">{{ $item->titulo }}</h3>
                        <div class="d-flex flex-wrap flex-md-nowrap align-items-center">
                            @if ($item->imagen)
                                <img src="{{ asset($item->imagen) }}" alt="{{ $item->titulo }}" 
                                     class="img-fluid imagen-prioridad-1 me-md-3 mb-3 mb-md-0">
                            @endif
                            <p class="contenido-prioridad-1 m-0">{{ $item->contenido }}</p>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        <!-- Tarjetas prioridad 2 - Texto justificado y sin bordes -->
        <div class="row">
            @foreach ($contenido as $item)
                @if($item->prioridad == 2)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column">
                                <h5 class="titulo-prioridad-2">{{ $item->titulo }}</h5>
                                @if ($item->imagen)
                                    <img src="{{ asset($item->imagen) }}" alt="{{ $item->titulo }}" class="imagen-prioridad-2 img-fluid mb-3">
                                @endif
                                <p class="contenido-prioridad-2 flex-grow-1">{{ $item->contenido }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</body>
</html>
@endsection