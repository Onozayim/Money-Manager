@extends('layout')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Histórico Egresos</h1>
    </div>

    <!-- Page Heading -->
    <p class="mb-4"></p>

    <!-- Gastos Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Registro de Gastos</h6>
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
