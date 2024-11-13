@extends('layout')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Registro de Ingresos</h1>
    </div>
    <div>
        <form method="POST" action="/update-ingreso">
            @csrf
            {{-- <div class="form-group">
                                <label for="concepto">Concepto</label>
                                <input type="text" class="form-control" id="concepto" placeholder="Ingrese el concepto"
                                    required>
                            </div> --}}

            <input type="hidden" value="{{ $income->id }}" name="id">

            <div class="form-group">
                <label for="monto">Monto</label>
                <input type="number" value="{{ $income->quantity }}" class="form-control" id="monto" name="monto"
                    placeholder="Ingrese el monto (Máximo: 999999.99)" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"
                    placeholder="Ingrese una descripción">{{ $income->description }}</textarea>
            </div>

            {{-- <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input type="date" class="form-control" id="fecha" required>
                            </div> --}}
            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
        </form>
    </div>
    <br>
    <br>
@endsection
