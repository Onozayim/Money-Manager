@extends('layout')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Histórico Ingresos</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generar reporte</a>
    </div>

    <!-- Page Heading -->
    <p class="mb-4"></p>

    <!-- Gastos Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Registro de Ingresos</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableIngresos" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Descripción</th>
                            <th>Monto del Ingreso</th>
                            <th>Fecha del Ingreso</th>
                            <th>Eliminar</th>
                            <th>Actualizar</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Descripción</th>
                            <th>Monto del Ingreso</th>
                            <th>Fecha del Ingreso</th>
                            <th>Eliminar</th>
                            <th>Actualizar</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($incomes as $income)
                            <tr>
                                <td>{{$income->description}}</td>
                                <td>{{$income->quantity}}</td>
                                <td>{{$income->created_at}}</td>
                                <td class="text-center">
                                    <a class="btn btn-danger mb-3" href="/delete-ingreso/{{ $income->id }}">
                                        <i class="fa fa-trash" role="button"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-info block text-center" href="/edit-ingreso/{{ $income->id }}">
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
