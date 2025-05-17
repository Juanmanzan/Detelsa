<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DETELSA</title>
        <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">

    </head>
    <body>
        <header> 
            <div class="cabecera">

                <div class="Iconos">
                    <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" >
                        <img src="imagenes/icono-facebook.png" alt="Icono1">
                    </a>
                    <a href="https://www.tiktok.com" target="_blank" rel="noopener noreferrer" >
                        <img src="imagenes/icono-tiktok.png" alt="Icono2">
                    </a>
                </div>

                <div class="logo"> 
                    <img src="{{ asset('imagenes/logo.png') }}" alt="Logo">
                </div>
                
            
                <div class="busqueda"> 
                    <form action="" method="GET">
                        <input type="text" name="q" placeholder="Buscar...">
                    </form>
                </div>
                
            </div>
        </header>

        <div class="Container">
            <!-- Contenido adicional aquí -->
        </div>
</html>
