@extends('layout')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="/generar-plan" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Generar plan</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Gastos (Mensuales)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{number_format((float)$gastos_mensuales, 2, '.', ',')}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Ingresos (Mensuales)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{number_format((float)$ingresos_mensuales, 2, '.', ',')}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Cantidad administrada
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{number_format((float)$objetivo_gasto, 2, '.', '')}}%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: {{$objetivo_gasto}}%"
                                            aria-valuenow="{{$objetivo_gasto}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Ingresos gastados
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{number_format((float)$ingresos_gastados, 2, '.', '')}}%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{$ingresos_gastados}}%"
                                            aria-valuenow="{{$ingresos_gastados}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-primary">Gastos (Predicción) </h5>
                    <div class="dropdown no-arrow">
                        @if (!$hasLinear)
                            <a class="font-weight-bold text-primary" href="/predict/expense">GENERAR PREDICCION</a>
                        @endif
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Acciones:</div>
                            <a class="dropdown-item" href="/predict/expense">Generar Predicción</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="predictChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-primary">Plan de gastos</h5>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="/generar-plan">Generar Plan</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        @if ($hasNecesidades)
                            <span class="mr-2">
                                {{-- <i class="fas fa-circle text-primary"></i> Necesidades --}}
                                <i class="fas fa-circle text-primary"></i> Necesidades
                            </span>
                        @endif
                        @if ($hasAhorros)
                            <span class="mr-2">
                                {{-- <i class="fas fa-circle text-success"></i> Ahorros --}}
                                <i class="fas fa-circle text-info"></i> Ahorros
                            </span>
                        @endif
                        @if ($hasDeseos)
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> Deseos
                            </span>
                        @endif
                        @if ($hasInversiones)
                            <span class="mr-2">
                                <i class="fas fa-circle text-danger"></i> Inversiones
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Histórico de Gastos</h1>
    <p class="mb-4"></p>

    <!-- Gastos Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Registro de Gastos de Este Mes</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Descripción</th>
                            <th>Categoría del Gasto</th>
                            <th>Subcategoría del Gasto</th>
                            <th>Fecha del Gasto</th>
                            <th>Monto del Gasto</th>
                            <th>Eliminar</th>
                            <th>Actualizar</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Descripción</th>
                            <th>Categoría del Gasto</th>
                            <th>Subcategoría del Gasto</th>
                            <th>Fecha del Gasto</th>
                            <th>Monto del Gasto</th>
                            <th>Eliminar</th>
                            <th>Actualizar</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($expenses as $expense)
                            <tr>
                                <td>{{ $expense->description }}</td>
                                <td>{{ $expense->category->name }}</td>
                                <td>{{ $expense->sub_category->name }}</td>
                                <td>{{ $expense->created_at }}</td>
                                <td>{{ number_format((float)$expense->quantity, 2, '.', ',') }}</td>
                                <td class="text-center">
                                    <a class="btn btn-danger mb-3" href="/delete-egreso/{{ $expense->id }}">
                                        <i class="fa fa-trash" role="button"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-info block text-center" href="/edit-egreso/{{ $expense->id }}">
                                        <i class="fa fa-edit" role="button"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
