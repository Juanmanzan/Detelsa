@extends('adminlte::page')
<link rel="icon" href="{{ asset('favicon_io/favicon.ico') }}" type="image/x-icon">

@section('title', 'Panel de Administración')



@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Panel de Administración</h1>
        <span class="badge bg-primary">{{ now()->format('d M Y') }}</span>
    </div>
@stop

@section('content')

<div class="container-fluid mt-4">
        <div class="row mb-4">

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                <div class="small-box bg-info shadow-sm text-white">
                    <div class="inner">
                        <h3>{{ $ordenesHoy }}</h3>
                        <p>Órdenes de Hoy</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                <div class="small-box bg-success shadow-sm text-white">
                    <div class="inner">
                        <h3>${{ number_format($ventasTotales, 2) }}</h3>
                        <p>Ventas Totales</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                <div class="small-box bg-warning shadow-sm text-white">
                    <div class="inner">
                        <h3 title="{{ $productoNombre }}">
                            {{ Str::limit($productoNombre, 50) }}
                            <small class="text-muted">({{ $productoCantidad }})</small>
                        </h3>
                        <p>Producto Más Vendido</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-crown"></i>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                <div class="small-box bg-danger shadow-sm text-white">
                    <div class="inner">
                        <h3>{{ $promocionesActivas }}</h3>
                        <p>Promociones Activas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-percent"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Gráficos y visualizaciones -->
    <div class="row">
        <!-- Gráfico de ventas por categoría -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-info py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0 text-white">
                            <i class="fas fa-chart-pie mr-2"></i>Ventas por Categoría
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool text-white" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="p-4">
                        <canvas id="categoriaChart" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico de tendencia de órdenes -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-primary py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0 text-white">
                            <i class="fas fa-chart-line mr-2"></i>Tendencia de Órdenes
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool text-white" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="p-4">
                        <canvas id="tendenciaChart" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Resumen detallado -->
    <div class="row">
        <!-- Tabla Ventas por Categoría -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-secondary py-3">
                    <h3 class="card-title mb-0 text-white">
                        <i class="fas fa-list mr-2"></i>Detalle por Categoría
                    </h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Categoría</th>
                                    <th class="text-right">Ventas</th>
                                    <th class="text-right">Porcentaje</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalVentas = $ventasPorCategoria->sum('total');
                                @endphp
                                @foreach($ventasPorCategoria as $categoria)
                                    <tr>
                                        <td>{{ $categoria->nombre }}</td>
                                        <td class="text-right">${{ number_format($categoria->total, 2) }}</td>
                                        <td class="text-right">
                                            @if($totalVentas > 0)
                                                {{ number_format(($categoria->total / $totalVentas) * 100, 1) }}%
                                            @else
                                                0%
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                @if($ventasPorCategoria->isEmpty())
                                    <tr>
                                        <td colspan="3" class="text-center py-4">No hay datos disponibles</td>
                                    </tr>
                                @endif
                            </tbody>
                            @if($totalVentas > 0)
                                <tfoot class="bg-light">
                                    <tr>
                                        <th>Total</th>
                                        <th class="text-right">${{ number_format($totalVentas, 2) }}</th>
                                        <th class="text-right">100%</th>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla Tendencia de Órdenes -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-success py-3">
                    <h3 class="card-title mb-0 text-white">
                        <i class="fas fa-calendar-alt mr-2"></i>Historial Reciente
                    </h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Fecha</th>
                                    <th class="text-right">Órdenes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $previous = null;
                                @endphp
                                @foreach($tendenciaOrdenes as $tendencia)
                                    @php
                                        $change = $previous !== null ? 
                                            ($tendencia->total - $previous) / $previous * 100 : 
                                            null;
                                        $previous = $tendencia->total;
                                    @endphp
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($tendencia->fecha)->format('d M') }}</td>
                                        <td class="text-right">{{ $tendencia->total }}</td>
                                    </tr>
                                @endforeach
                                @if($tendenciaOrdenes->isEmpty())
                                    <tr>
                                        <td colspan="3" class="text-center py-4">No hay datos disponibles</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')

<link rel="stylesheet" href="/css/admincolores.css">
<style>
    .small-box {
        border-radius: 10px;
        transition: all 0.3s ease;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 180px; /* Puedes ajustar este valor según convenga */
        padding: 20px;
        border-radius: 8px;
        color: white;
    }
    .small-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .small-box .inner h3 {
        font-size: 1.8rem;
        font-weight: 700;
    }
    .small-box .icon {
        transition: all 0.3s ease;
    }
    .small-box:hover .icon {
        transform: scale(1.1);
    }
    .card {
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    .card-header {
        border-bottom: none;
    }
    .bg-gradient-info {
        background: linear-gradient(120deg, #17a2b8, #1abc9c);
    }
    .bg-gradient-primary {
        background: linear-gradient(120deg, #4e73df, #224abe);
    }
    .bg-gradient-secondary {
        background: linear-gradient(120deg, #6c757d, #5a6268);
    }
    .bg-gradient-success {
        background: linear-gradient(120deg, #28a745, #218838);
    }
    .table thead th {
        border-top: none;
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        // Inicializar tooltips
        $('[data-toggle="tooltip"]').tooltip({
            placement: 'top'
        });
        
        // Gráfico de ventas por categoría
        const categoriaCtx = document.getElementById('categoriaChart').getContext('2d');
        const categoriaChart = new Chart(categoriaCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($ventasPorCategoria->pluck('nombre')) !!},
                datasets: [{
                    data: {!! json_encode($ventasPorCategoria->pluck('total')) !!},
                    backgroundColor: [
                        '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e',
                        '#e74a3b', '#858796', '#5a5c69', '#2e59d9',
                        '#17a2b8', '#20c997', '#6f42c1'
                    ],
                    borderWidth: 0,
                    hoverOffset: 15
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            font: {
                                size: 11
                            },
                            padding: 15
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed || 0;
                                const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: $${value.toFixed(2)} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        // Gráfico de tendencia de órdenes
        const tendenciaCtx = document.getElementById('tendenciaChart').getContext('2d');
        const tendenciaChart = new Chart(tendenciaCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($tendenciaOrdenes->pluck('fecha')->map(fn($date) => \Carbon\Carbon::parse($date)->format('d M'))) !!},
                datasets: [{
                    label: 'Órdenes Diarias',
                    data: {!! json_encode($tendenciaOrdenes->pluck('total')) !!},
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78, 115, 223, 0.1)',
                    borderWidth: 3,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#4e73df',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        },
                        ticks: {
                            precision: 0
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    },
                    legend: {
                        display: false
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'nearest'
                }
            }
        });
    });
</script>
@stop