@extends('layout')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Registro de Egresos</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generar reporte</a>
    </div>
    <div>
        <form method="POST" action="/update-egreso">
            @csrf
            {{-- <div class="form-group">
                <label for="concepto">Concepto</label>
                <input  name="concepto" class="form-control" id="concepto" placeholder="Ingrese el concepto" required>
            </div> --}}

            <input type="hidden" name="id" value="{{$expense->id}}">

            <div class="form-group">
                <label for="monto">Monto</label>
                <input type="number" value="{{ $expense->quantity }}" step="any" class="form-control" id="monto" name="monto"
                    placeholder="Ingrese el monto (Máximo: 999999.99)" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Ingrese una descripción">{{$expense->description}}</textarea>
            </div>

            {{-- <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" class="form-control" id="fecha" required>
            </div> --}}

            <div class="form-group">
                <label for="categoria">Categoría</label>
                <select class="form-control" id="categoria" name="categoria" required>
                    <option value="">Seleccione una categoría</option>
                    <option value="1" {{ $expense->category_id == 1 ? 'selected' : '' }}>Necesidades</option>
                    <option value="2" {{ $expense->category_id == 2 ? 'selected' : '' }}>Deseos</option>
                    <option value="3" {{ $expense->category_id == 3 ? 'selected' : '' }}>Ahorros</option>
                    <option value="4" {{ $expense->category_id == 4 ? 'selected' : '' }}>Inversiones</option>
                </select>
            </div>

            <div class="form-group">
                <label for="categoria">Sub-Categoría</label>
                <select class="form-control" id="sub_categoria" name="sub_categoria" required>
                    <option value="">Seleccione una Sub-categoría</option>
                </select>
            </div>

            <input type="hidden" value="{{$expense->sub_category_id}}" id="subCatId">

            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
        </form>
    </div>
    <br>
    <br>

    @push('js')
        <script src="{{ asset('js/registrar-egreso.js') }}"></script>
    @endpush
@endsection
