@extends('layout')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
    </div>


    <!-- Bienvenida -->
    <header class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1 class="display-4">Curso de Educación Financiera</h1>
            <p class="lead">Aprende a gestionar tus finanzas desde una edad temprana y construye un
                futuro financiero sólido.</p>
        </div>
    </header>

    <div class="container my-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h2>Módulo 1: Introducción a la Educación Financiera</h2>
            </div>
            <div class="card-body">

                <div class="mb-4">
                    <h3 class="text-secondary">Objetivos del Módulo 1</h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Definir qué es la educación financiera y por qué es
                            crucial para el desarrollo personal y profesional.</li>
                        <li class="list-group-item">Ayudar a los jóvenes a identificar metas financieras
                            y cómo estas influyen en sus decisiones diarias.</li>
                        <li class="list-group-item">Presentar los conceptos básicos de finanzas que se
                            usarán en los módulos posteriores.</li>
                    </ul>
                </div>

                <div class="mb-4 border p-3 rounded">
                    <h3 class="text-secondary">1.1 ¿Qué es la educación financiera?</h3>
                    <p><strong>Definición:</strong> La educación financiera es el conjunto de
                        conocimientos y habilidades que permiten a una persona tomar decisiones
                        informadas sobre el uso y la administración de su dinero.</p>
                    <p><strong>Importancia:</strong></p>
                    <ul>
                        <li>Evita el endeudamiento excesivo y facilita la planificación a futuro.</li>
                        <li>Incrementa la seguridad financiera, reduciendo el estrés asociado a la falta
                            de control sobre las finanzas.</li>
                        <li>Favorece la autonomía financiera y la independencia económica.</li>
                    </ul>
                    <p><strong>Beneficios a largo plazo:</strong></p>
                    <ul>
                        <li>Mayor capacidad para alcanzar metas personales como comprar una casa, viajar
                            o ahorrar para la jubilación.</li>
                        <li>Facilidad para tomar decisiones de inversión informadas, minimizando
                            riesgos.</li>
                        <li>Mejor preparación para enfrentar imprevistos económicos.</li>
                    </ul>
                </div>

                <div class="mb-4 border p-3 rounded">
                    <h3 class="text-secondary">1.2 Objetivos financieros y metas personales</h3>
                    <p><strong>Diferencia entre metas y objetivos:</strong></p>
                    <ul>
                        <li><strong>Objetivos financieros:</strong> Logros económicos a alcanzar (ej.
                            ahorro para emergencias, compra de vivienda).</li>
                        <li><strong>Metas personales:</strong> Reflejan valores y prioridades
                            individuales (ej. estudiar en el extranjero, tener seguridad económica).
                        </li>
                    </ul>
                    <p><strong>Establecimiento de metas:</strong></p>
                    <ul>
                        <li><strong>A corto plazo:</strong> Menos de un año (ej. ahorrar para una compra
                            específica).</li>
                        <li><strong>A mediano plazo:</strong> Entre 1 y 5 años (ej. comprar un auto,
                            hacer un viaje largo).</li>
                        <li><strong>A largo plazo:</strong> Más de 5 años (ej. comprar una vivienda,
                            ahorrar para la jubilación).</li>
                    </ul>
                    <p><strong>Proceso de establecimiento de metas (SMART):</strong> Definir metas como
                        Específicas, Medibles, Alcanzables, Realistas y Temporales. Ejemplo: “Ahorrar
                        $5,000 en 12 meses para emergencias”.</p>
                </div>

                <div class="mb-4 border p-3 rounded">
                    <h3 class="text-secondary">1.3 Conceptos básicos de finanzas</h3>
                    <ul>
                        <li><strong>Ingreso:</strong> Dinero que se recibe regularmente por salario,
                            negocios o inversiones.</li>
                        <li><strong>Gasto:</strong> Salida de dinero para cubrir necesidades o deseos.
                            Existen gastos fijos, variables y discrecionales.</li>
                        <li><strong>Ahorro:</strong> Parte del ingreso que se guarda para usos futuros,
                            fundamental para enfrentar imprevistos o alcanzar metas.</li>
                        <li><strong>Inversión:</strong> Uso del dinero para generar ingresos adicionales
                            o aumentar el capital. Implica riesgo, pero también beneficios a largo
                            plazo.</li>
                        <li><strong>Presupuesto:</strong> Herramienta de planificación que permite
                            asignar el dinero a diferentes categorías para controlar el gasto y fomentar
                            el ahorro.</li>
                    </ul>
                </div>

                <div class="mb-4 border p-3 rounded">
                    <h3 class="text-secondary">1.4 Ciclo del dinero y economía personal</h3>
                    <p><strong>Ciclo del dinero:</strong> Explicación del flujo económico, desde que el
                        dinero se recibe como ingreso hasta que se gasta o se ahorra. Ejemplo: Recibir
                        salario → Pago de gastos esenciales → Asignación para ahorro → Inversión en
                        activos.</p>
                    <p><strong>Impacto de las decisiones personales en la economía personal:</strong>
                        Elecciones financieras inteligentes (como ahorrar regularmente, evitar deudas
                        innecesarias y construir activos) fortalecen la economía personal y brindan
                        seguridad.</p>
                </div>

                <div class="mb-4 border p-3 rounded">
                    <h3 class="text-secondary">Actividades Prácticas para el Módulo 1</h3>
                    <ul>
                        <li><strong>Actividad de Reflexión:</strong> Identificar y escribir tres metas
                            financieras a corto, mediano y largo plazo.</li>
                        <li><strong>Simulación de Presupuesto:</strong> Crear un presupuesto simple
                            donde se asignen ingresos simulados a necesidades, deseos y ahorro.</li>
                        <li><strong>Lista de Ingresos y Gastos:</strong> Hacer una lista detallada de
                            todos los ingresos y gastos mensuales estimados.</li>
                        <li><strong>Caso de Estudio:</strong> Analizar una historia ficticia de un joven
                            con metas financieras y proponer un plan de mejora.</li>
                    </ul>
                </div>

                <!-- Botón para el siguiente módulo -->
                <div class="text-end mt-4">
                    <a href="/curso2" class="btn btn-primary">Siguiente Módulo</a>
                </div>

            </div>
        </div>
    </div>
@endsection
