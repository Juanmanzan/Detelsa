@extends('layouts/productosmain')
@section('productosmain_container')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DETELSA</title>
        <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


    </head>
    <body>
        
        <div class="container">
             <!--Carusel-->
            <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
                <div class="carousel-indicators"> 
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button> 
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button> 
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button> 
                </div> 
                <div class="carousel-inner"> 
                    <div class="carousel-item active"> 
                        <img src="{{ asset('imagenes/producto1.jpg') }}" class="img-fluid mx-auto d-block carousel-img" alt="producto1">
                        <div class="container"> 
                            <div class="carousel-caption text-start caption-bg"> 
                                <h2>Example headline.</h2> 
                                <p class="opacity-75">Some representative placeholder content for the first slide of the carousel.</p> 
                                <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a>
                                </p> 
                            </div> 
                        </div> 
                    </div> 
                    <div class="carousel-item"> 
                        <img src="{{ asset('imagenes/producto1.jpg') }}" class="img-fluid mx-auto d-block carousel-img" alt="producto1">
                        <div class="container"> 
                            <div class="carousel-caption caption-bg"> 
                                <h1>Another example headline.</h1> 
                                <p>Some representative placeholder content for the second slide of the carousel.</p> 
                                <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p> 
                            </div> 
                        </div> 
                    </div> 
                    <div class="carousel-item"> 
                        <img src="{{ asset('imagenes/producto1.jpg') }}" class="img-fluid mx-auto d-block carousel-img" alt="producto1"> 
                        <div class="container"> 
                            <div class="carousel-caption text-end caption-bg"> 
                                <h1>One more for good measure.</h1> 
                                <p>Some representative placeholder content for the third slide of this carousel.</p> 
                                <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p> 
                            </div> 
                        </div> 
                    </div> 
                </div> 
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev"> 
                    <span class="custom-icon bg-success text-white rounded-circle p-2">
                        <i class="bi bi-arrow-left"></i> 
                    </span>
                    <span class="visually-hidden">Previous</span> 
                </button> 
                    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next"> 
                    <span class="custom-icon bg-success text-white rounded-circle p-2">
                        <i class="bi bi-arrow-right"></i>
                    </span>
                    <span class="visually-hidden">Next</span> 
                </button> 
            </div>
            <!--Categorias-->
            
            <div class="container my-5">
                <h2 class="mb-4">Categorías</h2>
                <div class="scroll-grid">  
                    @foreach ($categorias as $categoria)
                        <div class="card text-center scroll-item">
                            <img src="{{ $categoria->imagen}}" alt="categoria1" class="card-img-circle">
                            <div class="card-body">
                                <h5 class="card-title">{{ $categoria->nombre }}</h5>
                                <a href="#" class="btn btn-secondary btn-sm">Ir &raquo;</a>
                            </div>
                        </div>
                     @endforeach
                </div>
            </div> 
        </div>        
    </body>
</html>

@endsection
