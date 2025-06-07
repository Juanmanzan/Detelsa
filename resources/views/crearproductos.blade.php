@extends('adminlte::page')

@section('title', 'Productos')

@section('css')
    <link rel="stylesheet" href="/css/admincolores.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --azul-principal: #1a3a6c;
            --azul-secundario: #2c5282;
            --azul-claro: #4dabf7;
            --gris-claro: #f8f9fa;
            --gris-medio: #e9ecef;
        }
        
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            padding-bottom: 30px;
        }
        
        .text-azul {
            color: var(--azul-principal);
            font-weight: 700;
        }
        
        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(26, 58, 108, 0.12);
            overflow: hidden;
            margin-top: 20px;
            padding: 0;
            border: none;
        }
        
        .table {
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }
        
        .thead-azul th {
            background: linear-gradient(135deg, var(--azul-principal), var(--azul-secundario));
            color: white !important;
            font-weight: 600;
            padding: 16px 15px;
            border: none;
            font-size: 1.05rem;
            position: relative;
            text-align: center;
        }
        
        .thead-azul th:first-child {
            border-top-left-radius: 12px;
        }
        
        .thead-azul th:last-child {
            border-top-right-radius: 12px;
        }
        
        .table-bordered th, 
        .table-bordered td {
            border: 1px solid var(--gris-medio);
            padding: 14px 15px;
            vertical-align: middle;
            text-align: center;
        }
        
        .table-bordered thead th {
            border-bottom: 2px solid var(--gris-medio);
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(26, 58, 108, 0.03);
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transform: translateY(-1px);
            transition: all 0.3s ease;
        }
        
        td img {
            width: 120px;
            height: 120px;
            display: block;
            margin: 0 auto;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border: 1px solid var(--gris-medio);
            transition: all 0.3s ease;
        }
        
        td img:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }
        
        .nombre-producto {
            font-weight: 600;
            color: var(--azul-principal);
            font-size: 1.1rem;
        }
        
        .precio-producto {
            font-weight: 700;
            color: #28a745;
            font-size: 1.15rem;
        }
        
        .categoria-producto {
            background-color: #e9f7fe;
            color: var(--azul-secundario);
            padding: 5px 18px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-block;
        }
        
        .descripcion-producto {
            color: #495057;
            font-size: 0.95rem;
            line-height: 1.5;
            text-align: left;
            padding: 8px;
        }
        
        .btn-group-custom {
            display: flex;
            flex-direction: column;
            gap: 10px;
            justify-content: center;
        }
        
        .btn-accion {
            padding: 8px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 3px 8px rgba(0,0,0,0.12);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            width: 100%;
        }
        
        .btn-accion i {
            margin-right: 6px;
        }
        
        .btn-editar {
            background: linear-gradient(135deg, #28a745, #218838);
            color: white !important;
        }
        
        .btn-editar:hover {
            background: linear-gradient(135deg, #218838, #1e7e34);
            transform: translateY(-2px);
            box-shadow: 0 5px 12px rgba(40, 167, 69, 0.25);
        }
        
        .btn-eliminar {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white !important;
        }
        
        .btn-eliminar:hover {
            background: linear-gradient(135deg, #c82333, #bd2130);
            transform: translateY(-2px);
            box-shadow: 0 5px 12px rgba(220, 53, 69, 0.25);
        }
        
       
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 15px 35px rgba(26, 58, 108, 0.2);
            overflow: hidden;
        }
        
        .modal-header {
            border-bottom: 1px solid var(--gris-medio);
            background: linear-gradient(135deg, var(--azul-principal), var(--azul-secundario));
            color: white;
            padding: 18px 20px;
        }
        
        .modal-title {
            font-weight: 700;
            font-size: 1.3rem;
        }
        
        .close {
            color: white;
            text-shadow: none;
            opacity: 0.8;
            font-size: 1.8rem;
        }
        
        .close:hover {
            color: white;
            opacity: 1;
        }
        
        .modal-body {
            padding: 25px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--azul-principal);
            margin-bottom: 8px;
            display: block;
        }
        
        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 10px 17px;
            height: 50px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--azul-claro);
            box-shadow: 0 0 0 0.2rem rgba(26, 58, 108, 0.2);
        }
        
        .alert-danger {
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 0.95rem;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
        
        .modal-footer {
            border-top: 1px solid var(--gris-medio);
            padding: 15px 20px;
            background-color: var(--gris-claro);
        }
        
        .btn-modal {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: none;
        }
        
        .btn-cancelar {
            background: linear-gradient(135deg, #6c757d, #5a6268);
            color: white;
        }
        
        .btn-cancelar:hover {
            background: linear-gradient(135deg, #5a6268, #495057);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(108, 117, 125, 0.25);
        }
        
        .btn-guardar {
            background: linear-gradient(135deg, #28a745, #218838);
            color: white;
        }
        
        .btn-guardar:hover {
            background: linear-gradient(135deg, #218838, #1e7e34);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(40, 167, 69, 0.3);
        }
        
        .btn-crear {
            background: linear-gradient(135deg, var(--azul-principal), var(--azul-secundario));
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 25px;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: 0 5px 15px rgba(26, 58, 108, 0.25);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }
        
        .btn-crear i {
            margin-right: 8px;
        }
        
        .btn-crear:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(26, 58, 108, 0.35);
            background: linear-gradient(135deg, var(--azul-secundario), var(--azul-principal));
        }
        
       .img-preview-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 15px 0;
        margin-bottom: 20px;
        background-color: var(--gris-claro);
        padding: 15px;
        border-radius: 10px;
        border: 1px dashed var(--azul-claro);
    }
    
    .img-preview-label {
        font-weight: 600;
        color: var(--azul-principal);
        margin-bottom: 10px;
    }
    
    .img-preview {
        max-width: 200px;
        max-height: 200px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        margin-bottom: 10px;
        border: 1px solid var(--gris-medio);

    }
    
    .img-actions {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }
        
        
    .mensaje-exito i {
        margin-right: 10px;
        font-size: 1.2rem;
    }
    
    .form-textarea {
        min-height: 100px;
        resize: vertical;
    }

    
    @media (max-width: 992px) {
        .table-responsive {
            overflow-x: auto;
        }
        
        .table {
            min-width: 900px;
        }
    }
    
    @media (max-width: 768px) {
        .modal-dialog {
            margin: 1rem;
        }
        
        .modal-body .row > [class*="col-"] {
            margin-bottom: 15px;
        }
    }
    </style>
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
                                <div><strong>Descripción:</strong> {{ Str::limit($producto->descripcion, 100) }}</div>
                                <div><strong>Ingredientes:</strong> {{ Str::limit($producto->ingredientes, 100) }}</div>
                                <div><strong>Modo de Uso:</strong> {{ Str::limit($producto->modo_de_uso, 100) }}</div>
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
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script>
$(document).ready(function() {
    // Efecto hover en filas de la tabla
    $('.table-hover tbody tr').hover(
        function() {
            $(this).css('transform', 'translateY(-2px)');
        },
        function() {
            $(this).css('transform', 'translateY(0)');
        }
    );
});
</script>
@stop