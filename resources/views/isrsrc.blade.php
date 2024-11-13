<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de ISR</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center mb-8">Calculadora de ISR</h1>
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Calculadora -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Cálculo de ISR</h2>
                <div class="space-y-4">
                    <div>
                        <label for="monthlyIncome" class="block text-sm font-medium text-gray-700">Ingresos Mensuales</label>
                        <input type="number" id="monthlyIncome" name="monthlyIncome" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Ingrese su salario mensual">
                    </div>
                    <div id="results" class="p-4 bg-gray-100 rounded-lg">
                        <div class="space-y-2">
                            <p class="text-sm font-medium text-gray-700">Pago de ISR</p>
                            <p id="isrPayment" class="text-2xl font-bold text-indigo-600">$0.00</p>
                        </div>
                        <div class="space-y-2 mt-4">
                            <p class="text-sm font-medium text-gray-700">Percepción Efectiva</p>
                            <p id="effectiveIncome" class="text-2xl font-bold text-indigo-600">$0.00</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de Rangos -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Tabla de Rangos ISR</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Límite Inferior</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Límite Superior</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cuota Fija</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">% Sobre Excedente</th>
                            </tr>
                        </thead>
                        <tbody id="taxBracketsBody" class="bg-white divide-y divide-gray-200">
                            <!-- Tax brackets will be inserted here by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sección teórica sobre el ISR -->
        <div class="mt-12 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4">¿Qué es el ISR y cómo se calcula?</h2>
            <div class="space-y-4 text-gray-700">
                <p>El Impuesto Sobre la Renta (ISR) es un impuesto que grava los ingresos de las personas físicas y morales en México. Es un impuesto progresivo, lo que significa que la tasa aumenta a medida que aumentan los ingresos.</p>
                <p>El cálculo del ISR se realiza siguiendo estos pasos:</p>
                <ol class="list-decimal list-inside space-y-2 pl-4">
                    <li>Se identifica el rango de ingresos en la tabla de ISR.</li>
                    <li>Se resta el límite inferior del rango a los ingresos totales.</li>
                    <li>El resultado se multiplica por el porcentaje sobre el excedente del límite inferior.</li>
                    <li>A este resultado se le suma la cuota fija correspondiente al rango.</li>
                </ol>
                <p>La percepción efectiva es la cantidad que queda después de restar el ISR a los ingresos totales.</p>
                <p>Es importante notar que esta calculadora proporciona una estimación y no toma en cuenta deducciones personales u otros factores que podrían afectar el cálculo final del ISR.</p>
            </div>
        </div>
    </div>

    <script>
        const taxBrackets = [
            { lowerLimit: 0.01, upperLimit: 8952.49, fixedFee: 0.00, rate: 1.92 },
            { lowerLimit: 8952.50, upperLimit: 75984.55, fixedFee: 171.88, rate: 6.40 },
            { lowerLimit: 75984.56, upperLimit: 133536.07, fixedFee: 4461.94, rate: 10.88 },
            { lowerLimit: 133536.08, upperLimit: 155229.80, fixedFee: 10723.55, rate: 16.00 },
            { lowerLimit: 155229.81, upperLimit: 185852.57, fixedFee: 14194.54, rate: 17.92 },
            { lowerLimit: 185852.58, upperLimit: 374837.88, fixedFee: 19682.13, rate: 21.36 },
            { lowerLimit: 374837.89, upperLimit: 590795.99, fixedFee: 60049.40, rate: 23.52 },
            { lowerLimit: 590796.00, upperLimit: 1127926.84, fixedFee: 110842.74, rate: 30.00 },
            { lowerLimit: 1127926.85, upperLimit: 1503902.46, fixedFee: 271981.99, rate: 32.00 },
            { lowerLimit: 1503902.47, upperLimit: 4511707.37, fixedFee: 392294.17, rate: 34.00 },
            { lowerLimit: 4511707.38, upperLimit: Infinity, fixedFee: 1414947.85, rate: 35.00 }
        ];

        function calculateISR(income) {
            if (income <= 0) return 0;

            const bracket = taxBrackets.find(
                bracket => income >= bracket.lowerLimit && income <= bracket.upperLimit
            );

            if (!bracket) return 0;

            const excessIncome = income - bracket.lowerLimit;
            const taxOnExcess = (excessIncome * bracket.rate) / 100;
            return bracket.fixedFee + taxOnExcess;
        }

        function formatCurrency(amount) {
            return new Intl.NumberFormat('es-MX', {
                style: 'currency',
                currency: 'MXN',
                minimumFractionDigits: 2
            }).format(amount);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const incomeInput = document.getElementById('monthlyIncome');
            const isrPaymentElement = document.getElementById('isrPayment');
            const effectiveIncomeElement = document.getElementById('effectiveIncome');
            const taxBracketsBody = document.getElementById('taxBracketsBody');

            incomeInput.addEventListener('input', updateResults);

            function updateResults() {
                const income = parseFloat(incomeInput.value) || 0;
                const isr = calculateISR(income);
                const effectiveIncome = income - isr;

                isrPaymentElement.textContent = formatCurrency(isr);
                effectiveIncomeElement.textContent = formatCurrency(effectiveIncome);
            }

            // Inicializar resultados con cero
            updateResults();

            // Populate tax brackets table
            taxBrackets.forEach(bracket => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">${formatCurrency(bracket.lowerLimit)}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${bracket.upperLimit === Infinity ? 'En adelante' : formatCurrency(bracket.upperLimit)}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${formatCurrency(bracket.fixedFee)}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${bracket.rate.toFixed(2)}%</td>
                `;
                taxBracketsBody.appendChild(row);
            });
        });
    </script>
</body>
</html>