@extends('layout')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
    </div>




    <div>
        <div class="container my-5">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h2>Calculadora de Inversiones</h2>
                </div>
                <iframe id="myIframe" src="{{url('isrsrc')}}" width="100%" frameborder="0"></iframe>
            </div>
        </div>
    </div>
    <script>
        function resizeIframe() {
            var iframe = document.getElementById('myIframe');
            iframe.height = iframe.contentWindow.document.documentElement.scrollHeight + "px";
        }

        // Llamamos a la función cada vez que el iframe cargue o cambie su contenido
        var iframe = document.getElementById('myIframe');
        iframe.onload = resizeIframe; // Ajusta la altura cuando el contenido cargue
    </script>
    {{-- </div> --}}
@endsection
