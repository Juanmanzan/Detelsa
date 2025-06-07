@extends('layouts.productosmain')
@section('productosmain_container')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detelsa / Productos</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            padding-bottom: 30px;
        }
        
        .container {
            max-width: 1200px;
            padding-top: 20px;
        }
        
        .card {
            border: none !important;
            border-radius: 12px !important;
            overflow: hidden;
            background: white;
            box-shadow: 0 5px 20px rgba(0,0,0,0.06);
            margin-bottom: 25px;
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        
        .imagen-prioridad-1 {
            max-width: 220px;
            border-radius: 10px;
            object-fit: cover;
            margin-right: 25px;
            margin-bottom: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .titulo-prioridad-1 {
            color: #1a3a6c;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #4dabf7;
        }
        
        .contenido-prioridad-1 {
            flex: 1;
            font-size: 1.15rem; /* Texto más grande para prioridad 1 */
            text-align: justify; /* Texto justificado */
            line-height: 1.7;
            color: #495057;
        }
        
        .titulo-prioridad-2 {
            color: #1a3a6c;
            font-weight: 700;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #74c0fc;
        }
        
        .imagen-prioridad-2 {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        
        .contenido-prioridad-2 {
            text-align: justify; /* Texto justificado */
            line-height: 1.6;
            color: #495057;
        }
        
        .card-body {
            padding: 25px;
        }
        
        @media (max-width: 768px) {
            .imagen-prioridad-1 {
                max-width: 100%;
                margin-right: 0;
                margin-bottom: 20px;
            }
        }
    </style>
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