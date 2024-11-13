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
                <h2>Módulo 5: Impuestos y Obligaciones Financieras</h2>
            </div>
            <div class="card-body">

                <div class="mb-4">
                    <h3 class="text-secondary">Objetivos del Módulo 5</h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Entender los diferentes tipos de impuestos y su
                            impacto en las finanzas personales.</li>
                        <li class="list-group-item">Aprender las responsabilidades fiscales y cómo
                            cumplir con ellas de manera efectiva.</li>
                        <li class="list-group-item">Familiarizarse con la planificación fiscal y cómo
                            reducir el impacto de los impuestos en las decisiones financieras.</li>
                    </ul>
                </div>

                <div class="mb-4 border p-3 rounded">
                    <h3 class="text-secondary">5.1 ¿Qué son los impuestos?</h3>
                    <p><strong>Definición:</strong> Los impuestos son cargas financieras que el gobierno
                        impone a los individuos y empresas para financiar sus actividades. Son
                        fundamentales para el funcionamiento del Estado y la provisión de bienes y
                        servicios públicos.</p>
                    <p><strong>Tipos de impuestos:</strong></p>
                    <ul>
                        <li><strong>Impuestos directos:</strong> Son aquellos que se aplican
                            directamente sobre el ingreso o la propiedad, como el Impuesto sobre la
                            Renta (ISR).</li>
                        <li><strong>Impuestos indirectos:</strong> Se aplican sobre el consumo de bienes
                            y servicios, como el IVA (Impuesto al Valor Agregado).</li>
                        <li><strong>Impuestos sobre la propiedad:</strong> Como los impuestos prediales,
                            que se aplican a la propiedad inmobiliaria.</li>
                    </ul>
                </div>

                <div class="mb-4 border p-3 rounded">
                    <h3 class="text-secondary">5.2 Cumplimiento fiscal</h3>
                    <p><strong>Obligaciones fiscales:</strong> Los individuos y las empresas deben
                        cumplir con sus obligaciones fiscales, lo que implica declarar sus ingresos y
                        pagar los impuestos correspondientes. En muchos países, existen plataformas
                        electrónicas que facilitan la declaración y el pago de impuestos.</p>
                    <p><strong>¿Cómo cumplir con las obligaciones fiscales?</strong></p>
                    <ul>
                        <li>Registrar los ingresos de manera clara y precisa.</li>
                        <li>Utilizar los formularios correspondientes para la declaración de impuestos.
                        </li>
                        <li>Realizar los pagos dentro de los plazos establecidos por la autoridad
                            fiscal.</li>
                        <li>Conocer las deducciones y beneficios fiscales a los que se puede acceder.
                        </li>
                    </ul>
                </div>

                <div class="mb-4 border p-3 rounded">
                    <h3 class="text-secondary">5.3 Planificación fiscal</h3>
                    <p><strong>¿Qué es la planificación fiscal?</strong> La planificación fiscal es el
                        proceso de estructurar las finanzas personales o empresariales de manera que se
                        minimice el impacto de los impuestos, aprovechando las deducciones y exenciones
                        permitidas por la ley.</p>
                    <p><strong>Estrategias para la planificación fiscal:</strong></p>
                    <ul>
                        <li><strong>Aprovechar las deducciones fiscales:</strong> Como los gastos
                            médicos, educativos, donaciones, etc.</li>
                        <li><strong>Optimizar el uso de los beneficios fiscales:</strong> Invertir en
                            fondos de pensiones o cuentas de ahorro con ventajas fiscales.</li>
                        <li><strong>Distribuir el ingreso adecuadamente:</strong> Realizar ajustes en
                            los ingresos y gastos para reducir la base imponible.</li>
                    </ul>
                </div>

                <div class="mb-4 border p-3 rounded">
                    <h3 class="text-secondary">5.4 Impacto de los impuestos en las finanzas personales
                    </h3>
                    <p><strong>¿Cómo afectan los impuestos a las finanzas personales?</strong> Los
                        impuestos impactan de manera significativa el dinero disponible para el ahorro,
                        el consumo y la inversión. Una buena planificación fiscal puede ayudar a
                        maximizar los ingresos disponibles después de impuestos.</p>
                    <p><strong>Ejemplo:</strong> Si una persona gana $50,000 al año y paga un 20% de
                        impuestos, su ingreso neto será de $40,000. Es importante tener en cuenta los
                        impuestos al calcular los presupuestos y las metas financieras.</p>
                </div>

                <div class="mb-4 border p-3 rounded">
                    <h3 class="text-secondary">Actividades Prácticas para el Módulo 5</h3>
                    <ul>
                        <li><strong>Actividad de Reflexión:</strong> Investigar los impuestos más
                            comunes en tu país y cómo afectan tus finanzas personales.</li>
                        <li><strong>Simulación de Declaración de Impuestos:</strong> Utilizar una
                            calculadora de impuestos en línea para realizar una declaración simulada y
                            ver cuánto tendrías que pagar según tus ingresos.</li>
                        <li><strong>Planificación Fiscal:</strong> Elaborar un plan fiscal personal
                            considerando las deducciones y beneficios fiscales a los que podrías tener
                            acceso.</li>
                        <li><strong>Estudio de Caso:</strong> Analizar un caso ficticio de una persona
                            que no está pagando sus impuestos correctamente y proponer un plan de mejora
                            para cumplir con sus obligaciones fiscales.</li>
                    </ul>
                </div>

                <!-- Botón para el siguiente módulo -->
                <div class="text-end mt-4">
                    <a href="/dashboard" class="btn btn-primary">Dashboard</a>
                </div>
            @endsection
