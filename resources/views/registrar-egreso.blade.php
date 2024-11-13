@extends('layout')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Registro de Gastos</h1>
    </div>
    <div>
        <form method="POST" action="/save-egreso">
            @csrf
            {{-- <div class="form-group">
                <label for="concepto">Concepto</label>
                <input  name="concepto" class="form-control" id="concepto" placeholder="Ingrese el concepto" required>
            </div> --}}

            <div class="form-group">
                <label for="monto">Monto</label>
                <input type="number" class="form-control" step="any" id="monto" name="monto" placeholder="Ingrese el monto (Máximo: 999999.99)" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Ingrese una descripción"></textarea>
            </div>

            {{-- <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" class="form-control" id="fecha" required>
            </div> --}}

            <div class="form-group">
                <label for="categoria">Categoría</label>
                <select class="form-control" id="categoria" name="categoria" required>
                    <option value="">Seleccione una categoría</option>
                    <option value="1">Necesidades</option>
                    <option value="2">Deseos</option>
                    <option value="3">Ahorros</option>
                    <option value="4">Inversiones</option>
                </select>
            </div>

            <div class="form-group">
                <label for="categoria">Sub-Categoría</label>
                <select class="form-control" id="sub_categoria" name="sub_categoria" required>
                    <option value="">Seleccione una Sub-categoría</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
        </form>
    </div>
    <br>
    <br>

    @push('js')
        <script src="{{ asset('js/registrar-egreso.js') }}"></script>
    @endpush
@endsection
