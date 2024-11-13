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
                <h2>Módulo 2: Presupuesto y Control de Gastos</h2>
            </div>
            <div class="card-body">

                <div class="mb-4">
                    <h3 class="text-secondary">Objetivos del Módulo 2</h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Comprender qué es un presupuesto y cómo aplicarlo en la vida diaria.
                        </li>
                        <li class="list-group-item">Identificar diferentes tipos de gastos y cómo controlarlos.</li>
                        <li class="list-group-item">Aprender a crear y mantener un presupuesto efectivo para alcanzar metas
                            financieras.</li>
                    </ul>
                </div>

                <div class="mb-4 border p-3 rounded">
                    <h3 class="text-secondary">2.1 ¿Qué es un presupuesto?</h3>
                    <p><strong>Definición:</strong> Un presupuesto es una herramienta financiera que ayuda a planificar y
                        controlar cómo se distribuyen los ingresos en gastos y ahorros.</p>
                    <p><strong>Importancia de un presupuesto:</strong></p>
                    <ul>
                        <li>Permite una visión clara de los ingresos y gastos, evitando el endeudamiento innecesario.</li>
                        <li>Facilita el logro de objetivos financieros al asignar fondos específicos para cada necesidad.
                        </li>
                        <li>Ayuda a identificar áreas de oportunidad para ahorrar o reducir gastos.</li>
                    </ul>
                </div>

                <div class="mb-4 border p-3 rounded">
                    <h3 class="text-secondary">2.2 Tipos de Gastos</h3>
                    <ul>
                        <li><strong>Gastos Fijos:</strong> Aquellos que se mantienen constantes cada mes, como la renta,
                            servicios básicos y seguros.</li>
                        <li><strong>Gastos Variables:</strong> Fluctúan cada mes, como alimentación, transporte y
                            entretenimiento.</li>
                        <li><strong>Gastos Discrecionales:</strong> Son opcionales y representan gustos personales, como
                            compras de lujo, cenas fuera de casa y vacaciones.</li>
                        <li><strong>Gastos de Emergencia:</strong> Surgen de manera inesperada, como reparaciones o gastos
                            médicos.</li>
                    </ul>
                    <p>Identificar estos tipos de gastos ayuda a organizar mejor el presupuesto y saber dónde se puede
                        reducir.</p>
                </div>

                <div class="mb-4 border p-3 rounded">
                    <h3 class="text-secondary">2.3 Cómo crear un presupuesto</h3>
                    <p><strong>Paso 1:</strong> Identificar y registrar todas las fuentes de ingreso.</p>
                    <p><strong>Paso 2:</strong> Hacer una lista de todos los gastos, categorizándolos en fijos, variables y
                        discrecionales.</p>
                    <p><strong>Paso 3:</strong> Asignar un monto específico a cada categoría de gasto, basándose en ingresos
                        y objetivos financieros.</p>
                    <p><strong>Paso 4:</strong> Analizar y ajustar el presupuesto según cambios en ingresos o prioridades.
                    </p>
                    <p><strong>Paso 5:</strong> Revisar el presupuesto de manera periódica para asegurarse de que se está
                        cumpliendo.</p>
                </div>

                <div class="mb-4 border p-3 rounded">
                    <h3 class="text-secondary">2.4 Herramientas para el Control de Gastos</h3>
                    <p><strong>Apps de Finanzas Personales:</strong> Herramientas digitales, como Mint, YNAB y Wallet, que
                        permiten gestionar ingresos y gastos en tiempo real.</p>
                    <p><strong>Hojas de Cálculo:</strong> Excel o Google Sheets permiten llevar un control manual de los
                        gastos y ajustar el presupuesto mensualmente.</p>
                    <p><strong>Enfoque de "Sobres de Dinero":</strong> Consiste en asignar dinero físico a diferentes sobres
                        para cada categoría de gasto, ayudando a visualizar los fondos disponibles.</p>
                    <p>Utilizar alguna de estas herramientas facilita el seguimiento y control de los gastos, promoviendo
                        hábitos financieros saludables.</p>
                </div>

                <div class="mb-4 border p-3 rounded">
                    <h3 class="text-secondary">Actividades Prácticas para el Módulo 2</h3>
                    <ul>
                        <li><strong>Creación de Presupuesto:</strong> Completar una plantilla de presupuesto incluyendo
                            ingresos y todos los gastos identificados.</li>
                        <li><strong>Análisis de Gastos:</strong> Revisar el historial de gastos del último mes y
                            clasificarlos en categorías para identificar posibles ajustes.</li>
                        <li><strong>Simulación de Emergencia:</strong> Simular un gasto inesperado y reorganizar el
                            presupuesto para hacerle frente sin endeudarse.</li>
                    </ul>
                </div>

                <!-- Botón para el siguiente módulo -->
                <div class="text-end mt-4">
                    <a href="/curso3" class="btn btn-primary">Siguiente Módulo</a>
                </div>
            @endsection
