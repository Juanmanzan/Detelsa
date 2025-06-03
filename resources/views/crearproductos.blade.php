@extends('adminlte::page')

@section('title', 'Productos')

@section('css')
    <link rel="stylesheet" href="/css/admincolores.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
   <style>

        th {
                background-color:#a7abb5;
                color: black !important;
        }

        table td {
            word-break: break-word;
            white-space: normal;
            
        }

        th, td {
            white-space: nowrap; 
            vertical-align: middle;
        }

        td img {
            max-width: 300px; 
            height: auto;
            display: block;
            margin: 0 auto;
            object-fit: contain;
        }
        .table td .btn {
            white-space: nowrap; 
        }
    </style>
@stop

@section('content_header')
    <h1>Productos</h1>
@stop

@section('content')

    @if(session('success'))
        <div id="mensaje-exito" style="background-color: #d4edda; padding: 10px; border-radius: 5px; color: #155724;">
            {{ session('success') }}
        </div>

        <script>
            // Esperar 3 segundos (3000 ms) y ocultar el mensaje
            setTimeout(() => {
                const mensaje = document.getElementById('mensaje-exito');
                if (mensaje) {
                    mensaje.style.transition = "opacity 0.5s ease";
                    mensaje.style.opacity = '0';
                    setTimeout(() => mensaje.remove(), 500); // eliminar del DOM después de la transición
                }
            }, 3000);
        </script>
    @endif

    <!-- Botón para abrir modal crear producto -->
    <button type="button" class="btn btn-success mb-3 mt-2" data-toggle="modal" data-target="#crearProductoModal">
        Crear Producto
    </button>

    <!-- Tabla productos -->

     <div class="table-responsive">
            

 <table class="table table-bordered">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Categoría</th>
                <th>Descripción</th>
                <th>Ingredientes</th>
                <th>Modo de Uso</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td><img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" ></td>
                    <td>{{ $producto->nombre }}</td>
                    <td>${{ number_format($producto->precio, 2) }}</td>
                    <td>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>{{ $producto->ingredientes }}</td>
                    <td>{{ $producto->modo_de_uso }}</td>
                    <td>
                        <!-- Botón editar abre modal con datos -->
                        <button type="button" class="btn btn-success btn-sm mb-3  " data-toggle="modal"
                            data-target="#editarProductoModal{{ $producto->id }}">
                            Editar
                        </button>

                        <!-- Formulario eliminar -->
                        <form action="{{ route('productos.destroy', $producto) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Está seguro de eliminar este producto?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Modal editar producto -->
                <div class="modal fade" id="editarProductoModal{{ $producto->id }}" tabindex="-1"
                    aria-labelledby="editarProductoModalLabel{{ $producto->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form action="{{ route('productos.update', $producto) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="modal-header">
                                    <h5 class="modal-title" id="editarProductoModalLabel{{ $producto->id }}">
                                        Editar Producto
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body row">
                                    <div class="form-group col-md-6">
                                        <label for="nombre{{ $producto->id }}">Nombre</label>
                                        <input type="text" class="form-control" id="nombre{{ $producto->id }}"
                                            name="nombre" value="{{ $producto->nombre }}" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="precio{{ $producto->id }}">Precio</label>
                                        <input type="number" class="form-control" id="precio{{ $producto->id }}"
                                            name="precio" step="0.01" value="{{ $producto->precio }}" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="categoria_id{{ $producto->id }}">Categoría</label>
                                        <select name="categoria_id" id="categoria_id{{ $producto->id }}" class="form-control" required>
                                            <option value="">Seleccione una categoría</option>
                                            @foreach($categorias as $categoria)
                                                <option value="{{ $categoria->id }}" 
                                                    {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                                                    {{ $categoria->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="imagen{{ $producto->id }}">Cambiar Imagen</label>
                                        <input type="file" class="form-control" id="imagen{{ $producto->id }}" name="imagen" accept="image/*">
                                        <small>Si no se selecciona imagen, se mantiene la actual.</small>
                                        <br>
                                        <img src="{{ asset($producto->imagen) }}" alt="Imagen actual" width="100">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="descripcion{{ $producto->id }}">Descripción</label>
                                        <textarea class="form-control" id="descripcion{{ $producto->id }}" name="descripcion" rows="2" required>{{ $producto->descripcion }}</textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="ingredientes{{ $producto->id }}">Ingredientes</label>
                                        <textarea class="form-control" id="ingredientes{{ $producto->id }}" name="ingredientes" rows="2" required>{{ $producto->ingredientes }}</textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="modo_de_uso{{ $producto->id }}">Modo de Uso</label>
                                        <textarea class="form-control" id="modo_de_uso{{ $producto->id }}" name="modo_de_uso" rows="2" required>{{ $producto->modo_de_uso }}</textarea>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Actualizar Producto</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            @endforeach
        </tbody>
    </table>

     
    </div>



   

    <!-- Modal Crear Producto -->
    <div class="modal fade" id="crearProductoModal" tabindex="-1" aria-labelledby="crearProductoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="formCrearProducto" action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearProductoModalLabel">Crear Nuevo Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body row">
                        <div class="form-group col-md-6">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" name="nombre" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="precio">Precio</label>
                            <input type="number" class="form-control" name="precio" step="0.01" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="categoria_id">Categoría</label>
                            <select name="categoria_id" class="form-control" required>
                                <option value="">Seleccione una categoría</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="imagen">Imagen</label>
                            <input type="file" class="form-control" name="imagen" accept="image/*" required>
                        </div>

                        <div class="form-group col-md-12 mt-3">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" name="descripcion" rows="2" required></textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="ingredientes">Ingredientes</label>
                            <textarea class="form-control" name="ingredientes" rows="2" required></textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="modo_de_uso">Modo de Uso</label>
                            <textarea class="form-control" name="modo_de_uso" rows="2" required></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Crear Producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop

