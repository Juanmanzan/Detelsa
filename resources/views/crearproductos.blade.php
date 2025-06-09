@extends('adminlte::page')
<link rel="icon" href="{{ asset('favicon_io/favicon.ico') }}" type="image/x-icon">
@section('title', 'Productos')

@section('css')
    <link rel="stylesheet" href="{{asset('css/admincolores.css')}}">
    <link rel="stylesheet" href="{{ asset('css/tablas.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   
@stop

@section('content_header')
    <h1 class="text-azul">Productos</h1>
@stop

@section('content')

    @if(session('success'))
        <div id="mensaje-exito" class="mensaje-exito">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>

        <script>
            setTimeout(() => {
                const mensaje = document.getElementById('mensaje-exito');
                if (mensaje) {
                    mensaje.style.opacity = '0';
                    setTimeout(() => mensaje.remove(), 500);
                }
            }, 3000);
        </script>
    @endif

    
    <form class="search-form">
        <input type="text" id="search-input" placeholder="Buscar..." class="search-input">
        <button type="button" id="search-button" class="search-button">
            🔍 Buscar
        </button>
    </form>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 text-muted">Gestión de productos</h2>
        <button type="button" class="btn btn-crear" data-toggle="modal" data-target="#crearProductoModal">
            <i class="fas fa-plus"></i> Crear Nuevo Producto
        </button>
    </div>

    <!-- Tabla productos -->
    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-azul">
                    <tr>
                        <th width="10%">Imagen</th>
                        <th width="15%">Nombre</th>
                        <th width="10%">Precio</th>
                        <th width="15%">Categoría</th>
                        <th width="20%">Descripción</th>
                        <th width="10%">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td>
                                <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}">
                            </td>
                            <td class="nombre-producto">{{ $producto->nombre }}</td>
                            <td class="precio-producto">${{ number_format($producto->precio, 2) }}</td>
                            <td>
                                <span class="categoria-producto">
                                    {{ $producto->categoria->nombre ?? 'Sin categoría' }}
                                </span>
                            </td>
                            <td class="descripcion-producto">
                                <div><strong>Descripción:</strong><br>{{ Str::limit($producto->descripcion, 100) }}</div>
                               
                                 <div><strong>Ingredientes:</strong><br>
                                    <ul>
                                         @foreach(preg_split('/[\r\n|\r|\n,]+/', $producto->ingredientes) as $ingrediente)
                                            @php
                                                $ingrediente = preg_replace('/^[\s\.\-\:\•\·]+/', '', trim($ingrediente));
                                            @endphp
                                            @if($ingrediente !== '')
                                                <li>{{ $ingrediente }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>

                                <div><strong>Modo de Uso:</strong><br>
                                 
                                    @foreach(preg_split('/[\r\n|\r|\n,]+/', $producto->modo_de_uso) as $modo)
                                        @php
                                            $modo = preg_replace('/^[\s\.\-\:\•\·]+/', '', trim($modo));
                                        @endphp
                                        @if($modo !== '')
                                            <p>{{ $modo }}</p>
                                        @endif
                                    @endforeach
                               </div>

                            </td>
                            <td>
                                <div class="btn-group-custom">
                                    <button type="button" class="btn btn-accion btn-editar" data-toggle="modal"
                                        data-target="#editarProductoModal{{ $producto->id }}">
                                        <i class="fas fa-edit"></i> Editar
                                    </button>

                                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-accion btn-eliminar"
                                            onclick="return confirm('¿Está seguro de eliminar este producto?')">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
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
                                            <h5 class="modal-title">
                                                <i class="fas fa-edit mr-2"></i>Editar Producto
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body row">
                                            <div class="form-group col-md-6">
                                                <label for="nombre{{ $producto->id }}" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="nombre{{ $producto->id }}"
                                                    name="nombre" value="{{ $producto->nombre }}" required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="precio{{ $producto->id }}" class="form-label">Precio</label>
                                                <input type="number" class="form-control" id="precio{{ $producto->id }}"
                                                    name="precio" step="0.01" value="{{ $producto->precio }}" required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="categoria_id{{ $producto->id }}" class="form-label">Categoría</label>
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

                                            <div class="form-group">
                                                    <div class="img-preview-container">
                                                            <span class="img-preview-label">Imagen Actual</span>
                                                            <img src="{{ asset($producto->imagen) }}" alt="Imagen actual" class="img-preview">
                                                    </div>
                                                    <label class="form-label">Cambiar Imagen (opcional)</label>
                                                    <input type="file" name="imagen" class="form-control">
                                                    <small class="form-text text-muted">Deje en blanco para mantener la imagen actual</small>
                                            </div>
                                    
                                            <div class="form-group col-md-12">
                                                <label for="descripcion{{ $producto->id }}" class="form-label">Descripción</label>
                                                <textarea class="form-control form-textarea" id="descripcion{{ $producto->id }}" name="descripcion" required>{{ $producto->descripcion }}</textarea>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="ingredientes{{ $producto->id }}" class="form-label">Ingredientes</label>
                                                <textarea class="form-control form-textarea" id="ingredientes{{ $producto->id }}" name="ingredientes" required>{{ $producto->ingredientes }}</textarea>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="modo_de_uso{{ $producto->id }}" class="form-label">Modo de Uso</label>
                                                <textarea class="form-control form-textarea" id="modo_de_uso{{ $producto->id }}" name="modo_de_uso" required>{{ $producto->modo_de_uso }}</textarea>
                                            </div>
                                            <div class="form-group col-md-12 ms-2"> 
                                                <div class="form-check">
                                                    <input 
                                                        type="checkbox" 
                                                        class="form-check-input" 
                                                        id="promocion{{ $producto->id }}" 
                                                        name="promocion" 
                                                        value="1"
                                                        {{ $producto->promocion ? 'checked' : '' }}
                                                    >
                                                    <label class="form-check-label" for="promocion{{ $producto->id }}">
                                                        Promoción
                                                    </label>
                                                </div>
                                            </div>


                                        </div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-guardar">Actualizar Producto</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Crear Producto -->
    <div class="modal fade" id="crearProductoModal" tabindex="-1" aria-labelledby="crearProductoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="formCrearProducto" action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fas fa-plus-circle mr-2"></i>Crear Nuevo Producto
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body row">
                        <div class="form-group col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" required placeholder="Nombre del producto">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" name="precio" step="0.01" required placeholder="0.00">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="categoria_id" class="form-label">Categoría</label>
                            <select name="categoria_id" class="form-control" required>
                                <option value="">Seleccione una categoría</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="imagen" class="form-label">Imagen</label>
                            <input type="file" class="form-control" name="imagen" accept="image/*" required>
                        </div>
                        
                        <div class="divider"></div>

                        <div class="form-group col-md-12">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control form-textarea" name="descripcion" required placeholder="Descripción del producto"></textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="ingredientes" class="form-label">Ingredientes</label>
                            <textarea class="form-control form-textarea" name="ingredientes" required placeholder="Ingredientes del producto"></textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="modo_de_uso" class="form-label">Modo de Uso</label>
                            <textarea class="form-control form-textarea" name="modo_de_uso" required placeholder="Modo de uso del producto"></textarea>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <input type="checkbox" name="promocion" value="1"> Promoción
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-guardar">Crear Producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop

@section('js')

<script src="{{ asset('javaproyecto/buscarpd.js') }}"></script>

@stop