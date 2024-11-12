@extends('layout')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Generar plan financiero</h1>
    </div>
    <div>
        <form method="POST" action="/save-plan">
            @csrf
            {{-- <div class="form-group">
                                <label for="concepto">Concepto</label>
                                <input type="text" class="form-control" id="concepto" placeholder="Ingrese el concepto"
                                    required>
                            </div> --}}

            <div class="form-group">
                <label for="monto">Monto</label>
                <input type="number" class="form-control" id="monto" name="monto" placeholder="Ingrese el monto (Máximo: 999999.99) "
                    required>
            </div>

            <div class="form-group">
                <input type="checkbox" name="necesidades" id="">
                <label for="descripcion">Necesidades</label>
            </div>

            <div class="form-group">
                <input type="checkbox" name="deseos" id="">
                <label for="descripcion">Deseos</label>
            </div>

            <div class="form-group">
                <input type="checkbox" name="ahorros" id="">
                <label for="descripcion">Ahorros</label>
            </div>

            <div class="form-group">
                <input type="checkbox" name="inversiones" id="">
                <label for="descripcion">Inversiones</label>
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
