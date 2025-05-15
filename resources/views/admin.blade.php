
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('imagenes/logo.png') }}">
</head>
<body>
    
<header > 
       <div class = "cabecera">

             <div class = "logo"> 
                <img src="{{asset('imagenes/logo.png') }}" alt="Logo">
            </div>

            <div class = "categoria"> 
                      <button type="submit">Crear categoria</button>
            </div>
            
            <div class = "busqueda"> 
                   <form action = "" method = "GET">
                      <input type="text" name="q" placeholder="Buscar...">
                    </form>
            </div>
            
            <div class = "filtrosCategorias"> 
                   <form action="" method="GET">
                       <select name="categoria" id="categoria">
                          <option value="" > Selecciona una categoría </option>
                          <option value="papeleria">Papelería</option>
                          <option value="oficina">Oficina</option>
                         <option value="arte">Arte</option>
                        </select>
                        <button type="submit">Buscar</button>
                    </form>
            </div>

       </div>

</header>


<div class="container">


<div class = "producto1">

         <div class = " imagenProducto">
            <img src="{{asset('imagenes/producto1.jpg') }}" alt=" producto1">
         </div>

         <div class = "Texto">
              <p>
                 Detergente liquido sabor a manzana
              </p>
         </div>

         <div class = "precio">
              <p>
                $15
              </p>
         </div>

         <div class = "botones">
              
                <button class = "comprar" type="submit"> <p>Comprar</p></button>

                <Button class = "carritoComprar" type=" submit" > <img src="{{asset('imagenes/carrito.png') }}" alt=" carrito"></Button>

         </div>
</div>




</div>

</body>
</html>