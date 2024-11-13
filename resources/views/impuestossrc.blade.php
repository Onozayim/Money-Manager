<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="md:col-span-2 space-y-8">
                <div>
                    <label for="amount" class="block text-xl font-semibold text-gray-700 mb-2">Monto a Invertir (MXN)</label>
                    <input
                        id="amount"
                        type="number"
                        placeholder="Ingrese el monto"
                        class="mt-1 block w-full text-2xl py-3 px-4 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    >
                </div>
                <div>
                    <span class="block text-sm font-medium text-gray-700">Plazo de Inversión</span>
                    <div class="flex space-x-4 mt-1">
                        <button id="term6" class="term-btn px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">6 meses</button>
                        <button id="term12" class="term-btn px-4 py-2 bg-white text-indigo-600 border border-indigo-600 rounded-md hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">12 meses</button>
                        <button id="term18" class="term-btn px-4 py-2 bg-white text-indigo-600 border border-indigo-600 rounded-md hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">18 meses</button>
                    </div>
                </div>
                <div id="investmentSummary" class="bg-white shadow-lg rounded-lg p-6 mt-6">
                    <h2 class="text-2xl font-semibold mb-4">Resumen de Inversión</h2>
                    <div class="grid grid-cols-2 gap-4 text-lg">
                        <div>
                            <p class="font-medium text-gray-600">Banco:</p>
                            <p id="selectedBank" class="font-bold text-gray-800">-</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-600">Tasa de Interés:</p>
                            <p id="interestRate" class="font-bold text-gray-800">-</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-600">Plazo:</p>
                            <p id="selectedTerm" class="font-bold text-gray-800">-</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-600">Monto a Invertir:</p>
                            <p id="investmentAmount" class="font-bold text-gray-800">$0.00</p>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <p class="text-xl font-medium text-gray-600">Retorno Estimado:</p>
                        <p id="estimatedReturn" class="text-3xl font-bold text-indigo-600">$0.00</p>
                        <p class="text-sm text-gray-500 mt-1">Incluye el monto inicial más los intereses generados</p>
                    </div>
                </div>
            </div>
            <div id="bankOptions" class="grid grid-cols-2 gap-4 content-start">
                <!-- Bank options will be dynamically inserted here -->
            </div>
        </div>
    </div>
    <script>
        const banks = [
            { name: "BBVA México", rates: { 6: 7.5, 12: 8.3, 18: 8.5 }, logo: "img/BBVA-logo.png" },
            { name: "Banorte", rates: { 6: 6.8, 12: 7.1, 18: 7.3 }, logo: "https://lasmasinnovadoras.com/2020/wp-content/uploads/2020/10/banorte.jpg" },
            { name: "Citibanamex", rates: { 6: 6.9, 12: 7.2, 18: 7.4 }, logo: "https://upload.wikimedia.org/wikipedia/commons/thumb/9/92/Citibanamex_logo.svg/2560px-Citibanamex_logo.svg.png" },
            { name: "Santander México", rates: { 6: 7.1, 12: 7.6, 18: 7.8 }, logo: "https://upload.wikimedia.org/wikipedia/commons/thumb/b/b8/Banco_Santander_Logotipo.svg/2560px-Banco_Santander_Logotipo.svg.png" },
            { name: "HSBC México", rates: { 6: 6.5, 12: 7.0, 18: 7.3 }, logo: "data:image/png;base64,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" },
            { name: "Scotiabank México", rates: { 6: 7.0, 12: 7.5, 18: 7.7 }, logo: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAVwAAACRCAMAAAC4yfDAAAAAkFBMVEX////sERrrAADsCRTsAA3819ntLzX/+vrsDRf+8fL3ra/rAAbxaW3xYGXydnn2nJ74srTuQUb4ubv96uv829z6zs/95eb709T5vsD1l5r2oaPuNDr1kpXtICjxZmrvRUrzfoHwWFzzgYTuOkDtJSzwVlryb3P0jI7tGSH5w8Xyd3rvT1T2p6nuKjH1oKL+7u++90TCAAAJbElEQVR4nO2baXuCOhOGYZIKGK0rLnWvimuP///fvYRkQgLU2lbOdd5ec3/ChITwZJuZoOcRBEEQBEEQBEEQBEEQBEEQBEEQBEEQBEEQBEEQBEEQBEEQBEEQBEEQBEEQBEEQBEEQBEEQxH+D6DYYjW5BTbWPRjVV/H9AcN0sOACIxv4QP7/67gxg1nzo1rdpRzKvpZdfVOXTbh2Vf0YHgIeh7/shSyUWnei51R+A+T6D90fuXYCiFnGvuvJNHZVXM+iBFNYQAps8tX5VfQiPLA0NlrWhHnGbkFXO23VUXsmIc78A9J/5AP1KPlwfuPlviRs0Stqy7e+q/GfZkix1F/2D4nYeKPu3xD1DUVsfTr+r8hW4BMWcoLiPzIc/Je4w15YJkb0ZW/2yzlfhjNRgl80NdnxEsD8l7juKy2F7Pq9Ss+HXA7corjcUwBjAyyNl/5S4R20oiEu2lwenDfx24JbE9aJ5r3e4PVT2L4k70AM3DE3S+KERdo+SuN/gL4l7ws1m/sRKSVxFH8Wd3r0tGI3jYdX7Vqavtbhvd+uMXuJxuUpX3HEcf7qa3NLydx+QNnsYD21v818WF82ke6btqLNVXuPxMLTTg/5ep7/n6XG7lczUOs56rVY7XckDZfa22tZ7Ds8sK9pLzbNAZS9fpaCWuJNVdgs7V0Q7XhKeZV5SXzLSZvVatrWtKmul1+NldstibvqnIG6Q6JvbT3WaDCM0FiD55I5BG4DpHgBYDkzGWwO0+xFa6f3UxkVnmnEhTYQIhDR7BRhxo7RO3QGwGnkiy4edLa43WunqQwGbguN824AItY1zGQSqfpDjY6xMbCE8bw5CP4Kja1gQ96xu5jCrKRi4YKjuol/1iI5uokbgXL9tUXKdriNNfdcngaEUV1+juBO7Tg7XRSYUa9jidoHb9zjBjkJeEydKmvWinpXuz+u8ISG8qoKuuDhrQxh49XAwbWBwTEoWbtl/U8GtISs4zSGsswIPiNt040Q+rky2uD4vxJKsuMS1GGfyy+LuJk474J+yuDdfVwOPBUN/QGS9RToBYe0YYknZNxaNSK4mrJQBh8fEnRS0RVxxS7Wbsdstt0mVt8T1j6zQAaOSuBc9faBVl7bFtqbLZztf4N4qtJ1JiWalYI+vQxJfijsQ1dp+IW7I9NwdfdI3rriltp2L4mI4ifl1nb5IDoXWCjNNBiYnzLZtH7Wdgp2OQmfNdDc0rjY0W9w2rrdynoA1A0riZpWbJsBSNerCPytfEFeaIyJ/gYK4Q6wYajh5sZiCOw5x+cz3hNQIm0zeVhAqbW+mYYt599S8mJ+p1xBv2ssG7jDLttznHXFNoIjD+TSMO7t8zS+IC8dOPIwPPnYGZPZebMqL99NLPF3k5V1xYfZ26idG/ExDS9wPnaEWsxoZ9sDdP9QTA6Ptu5o5MTSywddBtV51OlMtZTvdKa4T4YibaK3EVq8+JnJUEBfWqvJoj8Wzmd3WAwFWapkIzJbriqtdziFaQ1ljcnHxqbxXq7JKngs4WxRI38fEYc3h11CZ42gu5el6+ukpVnB/bXEDH0e1WenmldaCdeKmF4JQhixvehTwPLqEOjniCtylTMLay8Vt4fgPxb9yKj3ozCx9xTJvNWsUb9Xmjp8n6bGsLZ474uKqYMcf9eByxGUf+TaDjo7c8WPrGgnLdq6Vv+FaUM+Iy/a72q2wIrfpzhj3cv3fc1uxHP2CdlxG68fVpnNHXG2bsA+rvg52ou1E2IEkbEjf2C/Mns0HKw3tXDC5V8tCwNM8tNPqtMJKBBuzZKUT/MLMpYOOpDnpO2a98x1xtZDCPmaPq8S13Rk9heSyqYV0tO9XiMtMbrdCXA3b1WmFldnikjfJxS3GnlBcO32lxFUryNfiOuIMq8S1e26aTxUU1w7ixT8VVzz0JcXzMIZAN5+NxY8YcFmw09WBxtcjFyepPR9PVeLacapzbn3gyF9b2d1vi2ts598eaH2J4+8acSfGahKvhQJ6pInks6Q74poNyapPa+eIa6sf7HLBtQUTCqt8i39T3LBhQjY1GwsD2Fvyov8j+/SKL1JsgTaHrJbpftDhlTviovNrBWLQJXHEtV/bfFQysiyH/HMvTHpcXJ6g+Ve3mbsUHPa4whm/Vkbh0GxiDYwVHtQraUM+T59ar+/dFdfroXj4yKjH8TG2nat+SXCwq3g+ii9wREQzLPG4uG1vj1GbfFoG015j/dyRnDWdwyxp9vvXnvF2Ml8LXUR+zFZAGTbPLtC74Ivs52iJv7Vlf0/cq5mR00y9kzH/Ch4a353UKxvnOtvEjMuhLcTJ0YQ2viNuxHHnRkt35F+j4LR46pmEHjfMjYKoWWsCZiEcl4k8eAjVdDSDBcLN68qEJnCLuydugDZmCCJ5X8/yZxZjCwwa6/eNidyE6lgtyn+z1/f1h1X+O+KmgyrU1egp8DGerFZxwB77AuAhqoOj6B+tTEQn5Kqrlbp5JDrkInfr9t7X4pqhm4W1hOVzl0OOaY/nISWsrfNp+W+Jm4cc1YdA4403v0ZH7+0nR9bVBMeq8KlZECtip2E2j14r+oRxPC25K64JUpfK343nigu2eVsVS/6+uB4uZpD96h68adKcefFnZ4nfp1M1cMPc4644NeAgJ86+VJDl4YL74kYfxROiKnELGvPQnG7ejp+U/6a4gYkRSY/mlKTi7mKvv36auOn+UBoH3DJzUgO/kA++Oka/FEPsLD9evy+uN1g4PSN2x7K4rOfcAwtrGx/5bl7jZ+K68fIAgnkznnmrZ8bOR/vi8e7eMUcGe/eoNcER1AHrFRlsrI8SvhDXC5b5NhRCOzpWnP4GSd57HDZOECBq2+WTSPxMXLPhhOFA/m8jnXnDZdFj+iVxIs9DOJOHMgCt0lcs8tuMLFv+mcDKHbzKIx6eFds6fmSi/3qgAwCR/pl/t+CdGmlRJr9rSO2SQGdnh1lH85+IZvZYWXuvNJr6H6Z819QvAxtjfJa5takT5G57ta4lZ7xbWp6TxWrv3//w6EfE1+Sy7V1a01NlmOjWXe97vc26W/gjStB/b122l9bb0E0fvShwg9M/HT97PG2vtpekG+T5WS1DdZ11Yjdt1aXdqfwwMJ5n5fueWz4oPSvSCXI+3qxr1QqdMM7ebFR4D4IgCIIgCIIgCIIgCIIgCIIgCIIgCIIgCIIgCIIgCIIgCIIgCIIgCIIgCIIgCIIgCIIgCIIg/hT/AzWfhsukc+/zAAAAAElFTkSuQmCC" },
            { name: "Inbursa", rates: { 6: 6.6, 12: 7.0, 18: 7.2 }, logo: "https://rastreosatelital.inbursa.com/static/res/logo_inbursa_acceso.png" },
            { name: "Banco Azteca", rates: { 6: 7.8, 12: 8.1, 18: 8.3 }, logo: "https://upload.wikimedia.org/wikipedia/commons/thumb/0/0c/Logo_Banco_Azteca.svg/2560px-Logo_Banco_Azteca.svg.png" },
            { name: "BanCoppel", rates: { 6: 7.5, 12: 8.0, 18: 8.2 }, logo: "https://upload.wikimedia.org/wikipedia/commons/thumb/3/3d/Logo_de_BanCoppel.svg/4192px-Logo_de_BanCoppel.svg.png" },
            { name: "BanBajío", rates: { 6: 6.7, 12: 7.2, 18: 7.5 }, logo: "https://upload.wikimedia.org/wikipedia/commons/2/21/Logo_de_BanBaj%C3%ADo.svg" }
        ];

        let selectedBank = null;
        let selectedTerm = 6;
        let amount = 0;

        function updateBankOptions() {
            const bankOptionsContainer = document.getElementById('bankOptions');
            bankOptionsContainer.innerHTML = '';
            banks.forEach(bank => {
                const bankElement = document.createElement('div');
                bankElement.className = `bg-white p-4 rounded-lg shadow-md cursor-pointer hover:shadow-lg transition-shadow duration-300 flex flex-col items-center justify-center ${selectedBank === bank ? 'ring-2 ring-indigo-500' : ''}`;
                bankElement.innerHTML = `
                    <img src="${bank.logo}" alt="${bank.name}" class="w-16 h-16 object-contain mb-2">
                    <p class="text-center text-sm font-medium">${bank.name}</p>
                `;
                bankElement.addEventListener('click', () => selectBank(bank));
                bankOptionsContainer.appendChild(bankElement);
            });
        }

        function selectBank(bank) {
            selectedBank = bank;
            updateBankOptions();
            updateSummary();
        }

        function selectTerm(term) {
            selectedTerm = term;
            document.querySelectorAll('.term-btn').forEach(btn => {
                btn.classList.remove('bg-indigo-600', 'text-white');
                btn.classList.add('bg-white', 'text-indigo-600', 'border', 'border-indigo-600');
            });
            document.getElementById(`term${term}`).classList.remove('bg-white', 'text-indigo-600', 'border', 'border-indigo-600');
            document.getElementById(`term${term}`).classList.add('bg-indigo-600', 'text-white');
            updateSummary();
        }

        function updateSummary() {
            document.getElementById('selectedBank').textContent = selectedBank ? selectedBank.name : '-';
            document.getElementById('interestRate').textContent = selectedBank ? `${selectedBank.rates[selectedTerm]}%` : '-';
            document.getElementById('selectedTerm').textContent = `${selectedTerm} meses`;
            document.getElementById('investmentAmount').textContent = formatCurrency(amount);

            let estimatedReturn = amount;
            if (selectedBank) {
                const rate = selectedBank.rates[selectedTerm];
                estimatedReturn += (amount * rate * (selectedTerm / 12)) / 100;
            }
            document.getElementById('estimatedReturn').textContent = formatCurrency(estimatedReturn);
        }

        function formatCurrency(value) {
            return new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(value);
        }

        document.getElementById('amount').addEventListener('input', (e) => {
            amount = parseFloat(e.target.value) || 0;
            updateSummary();
        });

        document.querySelectorAll('.term-btn').forEach(btn => {
            btn.addEventListener('click', () => selectTerm(parseInt(btn.id.replace('term', ''))));
        });

        // Initialize
        updateBankOptions();
        selectTerm(6);
        updateSummary();
    </script>
</body>
</html>