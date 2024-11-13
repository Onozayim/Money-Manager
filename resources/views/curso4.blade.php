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
                <h2>Módulo 4: Deudas y Crédito Responsable</h2>
            </div>
            <div class="card-body">

                <div class="mb-4">
                    <h3 class="text-secondary">Objetivos del Módulo 4</h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Comprender cómo funciona el crédito y cómo usarlo de
                            forma responsable.</li>
                        <li class="list-group-item">Aprender a evaluar las deudas y sus costos.</li>
                        <li class="list-group-item">Desarrollar estrategias para reducir o eliminar
                            deudas de manera efectiva.</li>
                    </ul>
                </div>

                <div class="mb-4 border p-3 rounded">
                    <h3 class="text-secondary">4.1 Qué es el Crédito y Cómo Funciona</h3>
                    <p>El crédito es un préstamo de dinero que permite financiar compras o gastos y
                        devolverlo en cuotas. Comprender sus términos y condiciones es esencial para
                        evitar problemas financieros.</p>
                    <p><strong>Principales tipos de crédito:</strong></p>
                    <ul>
                        <li><strong>Crédito personal:</strong> Préstamo sin garantía que suele tener una
                            tasa de interés alta.</li>
                        <li><strong>Crédito hipotecario:</strong> Préstamo para comprar propiedades,
                            normalmente con tasas más bajas y a largo plazo.</li>
                        <li><strong>Tarjetas de crédito:</strong> Línea de crédito renovable para
                            compras diarias; requieren pago puntual para evitar intereses altos.</li>
                    </ul>
                </div>

                <div class="mb-4 border p-3 rounded">
                    <h3 class="text-secondary">4.2 Evaluación de Deudas</h3>
                    <p>Evaluar las deudas permite identificar su costo real, entender su impacto en las
                        finanzas y priorizar su pago.</p>
                    <p><strong>Costo de las deudas:</strong></p>
                    <ul>
                        <li><strong>Tasa de interés:</strong> Costo de pedir dinero prestado, que puede
                            variar dependiendo del tipo de crédito.</li>
                        <li><strong>Plazo:</strong> Tiempo que se tiene para devolver la deuda, donde
                            plazos más largos pueden aumentar el costo total.</li>
                        <li><strong>Cuota mensual:</strong> Monto que se debe pagar cada mes, que
                            impacta directamente en el presupuesto personal.</li>
                    </ul>
                </div>

                <div class="mb-4 border p-3 rounded">
                    <h3 class="text-secondary">4.3 Estrategias para Reducir o Eliminar Deudas</h3>
                    <p>Existen diversas estrategias para reducir deudas de forma más rápida y eficiente.
                        Algunas de las más comunes son:</p>
                    <ul>
                        <li><strong>Método de la bola de nieve:</strong> Consiste en pagar primero las
                            deudas más pequeñas, para ganar impulso y reducir el número total de deudas.
                        </li>
                        <li><strong>Método de la avalancha:</strong> Se enfoca en pagar las deudas con
                            mayor tasa de interés primero, para reducir el costo total de intereses.
                        </li>
                        <li><strong>Consolidación de deudas:</strong> Unifica varias deudas en una sola
                            con una tasa de interés más baja y pagos más manejables.</li>
                        <li><strong>Renegociación de deudas:</strong> Hablar con los acreedores para
                            ajustar plazos o tasas de interés, facilitando el pago de la deuda.</li>
                    </ul>
                </div>

                <div class="mb-4 border p-3 rounded">
                    <h3 class="text-secondary">4.4 Uso Responsable del Crédito</h3>
                    <p>El uso responsable del crédito ayuda a evitar problemas financieros y construir
                        un buen historial crediticio. Algunas recomendaciones incluyen:</p>
                    <ul>
                        <li>Evitar utilizar el crédito para gastos no esenciales o impulsivos.</li>
                        <li>Pagar el saldo completo de las tarjetas de crédito cada mes para evitar
                            intereses.</li>
                        <li>Mantener el uso del crédito por debajo del 30% de la línea de crédito
                            disponible.</li>
                        <li>Revisar el historial de crédito regularmente para asegurar su precisión y
                            mejorar la puntuación crediticia.</li>
                    </ul>
                </div>

                <div class="mb-4 border p-3 rounded">
                    <h3 class="text-secondary">Actividades Prácticas para el Módulo 4</h3>
                    <ul>
                        <li><strong>Análisis de Deudas:</strong> Revisar y analizar las deudas
                            personales, calculando el costo real de cada una.</li>
                        <li><strong>Plan de Pago de Deudas:</strong> Crear un plan de pago basado en el
                            método de bola de nieve o avalancha.</li>
                        <li><strong>Simulación de Costo de Créditos:</strong> Comparar diferentes
                            opciones de crédito y su impacto financiero a largo plazo.</li>
                    </ul>
                </div>

                <!-- Botón para el siguiente módulo -->
                <div class="text-end mt-4">
                    <a href="curso5" class="btn btn-primary">Siguiente Módulo</a>
                </div>
            @endsection
