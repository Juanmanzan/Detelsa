@extends('adminlte::page')

@section('title', 'Ordenes')

@section('css')
    <link rel="stylesheet" href="{{asset('css/admincolores.css')}}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tablas.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@stop

@section('content_header')
    <h1 class="text-azul">
        <i class="fas fa-clipboard-list mr-2"></i>Órdenes Registradas
    </h1>
@stop
@section('content')


    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-azul">
                    <tr>
                        <th>#Orden</th>
                        <th>Fecha</th>
                        <th>Producto</th>
                        <th>Precio Unitario</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ordenes as $orden)
                        @php $rowspan = $orden->detalles->count(); @endphp

                        @foreach($orden->detalles as $i => $detalle)
                            <tr>
                                @if ($i === 0)
                                    <td rowspan="{{ $rowspan }}" class="align-middle">
                                        <strong>{{ $orden->id }}</strong>
                                    </td>
                                    <td rowspan="{{ $rowspan }}" class="align-middle">
                                        {{ \Carbon\Carbon::parse($orden->fecha)->format('d/m/Y') }}
                                    </td>
                                @endif

                                <td class="nombre-producto">
                                    {{ $detalle->producto->nombre ?? 'Producto #'.$detalle->producto_id }}
                                </td>
                                <td class="precio-producto">
                                    ${{ number_format($detalle->precio_unitario, 2) }}
                                </td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td class="precio-producto">
                                    ${{ number_format($detalle->subtotal, 2) }}
                                </td>

                                @if ($i === 0)
                                    <td rowspan="{{ $rowspan }}" class="align-middle total-orden">
                                        <strong>${{ number_format($orden->total, 2) }}</strong>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="7" class="no-orders">
                                <i class="fas fa-info-circle mr-2"></i> No hay órdenes registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('js')
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // Función para buscar órdenes
        function searchOrders() {
            const searchTerm = $('#search-input').val().toLowerCase().trim();
            
            $('.orden-card').each(function() {
                const $card = $(this);
                const orderText = $card.text().toLowerCase();
                
                if (orderText.includes(searchTerm)) {
                    $card.show();
                } else {
                    $card.hide();
                }
            });
        }

        // Evento para el botón de búsqueda
        $('#search-button').click(searchOrders);
        
        // Evento para búsqueda al presionar Enter
        $('#search-input').keyup(function(e) {
            if (e.key === 'Enter') searchOrders();
        });
        
        // Evento para limpiar búsqueda
        $('#search-input').on('input', function() {
            if (!$(this).val()) {
                $('.orden-card').show();
            }
        });
    });
</script>