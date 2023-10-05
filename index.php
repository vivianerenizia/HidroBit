<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <!-- Load d3.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8"></script>
    <script src="node_modules/chartjs-plugin-zoom/dist/chartjs-plugin-zoom.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tabulator/5.1.0/js/tabulator.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tabulator/5.1.0/css/tabulator.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <header>
        <img src="./Logos/2.png" alt="Logo">
        <h1>Monitoramento de turbidez em tempo real</h1>
    </header>

    <div class="container">
    <div class="left-panel">
        <div id="tabela-container">
            <div id="tabela"></div>
        </div>
        <img src="./Logos/1.png" alt="Logo" class="logo">
    </div>
        <div class="right-panel">
            <canvas id='myChart'></canvas>
        </div>
    </div>

    <script>
        var myChart;

        // Função para carregar os dados do servidor usando AJAX
        function loadDataFromServer() {
            $.ajax({
                url: 'data.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Processa os dados recebidos do servidor
                    var meses = [];
                    var sensoriamento_ldr = [];
                    var turbidez = [];
                    var allValues = [];

                    data.forEach(function(value) {
                        meses.push(moment(value.date_time).format("MMM Do, HH:mm:ss"));
                        sensoriamento_ldr.push(value.sensoriamento_ldr);
                        turbidez.push(value.turbidez);
                        allValues.push({
                            meses: moment(value.date_time).format("MMM Do, HH:mm:ss"),
                            sensoriamento_ldr: value.sensoriamento_ldr,
                            turbidez: value.turbidez
                        });
                    });

                    // Atualiza o gráfico e a tabela com os dados carregados
                    updateChart(meses, sensoriamento_ldr, turbidez);
                    updateTable(allValues);
                },
                error: function(error) {
                    console.error('Erro ao carregar dados do servidor:', error);
                }
            });
        }

        // Função para atualizar o gráfico com os novos dados
        function updateChart(meses, sensoriamento_ldr, turbidez) {
            // Verifica se há um gráfico existente e o destrói antes de criar um novo
            if (myChart) {
                myChart.destroy();
            }

            const ctx = document.getElementById('myChart');
            myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: meses,
                    datasets: [{
                        label: 'Turbidez',
                        data: turbidez,
                        borderWidth: 1,
                        tension: 0,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            suggestedMax: 1000,
                            beginAtZero: true
                        }
                    },
                    fill: true,
                    plugins: {
                        zoom: {
                            zoom: {
                                wheel: {
                                    enabled: true,
                                },
                                pinch: {
                                    enabled: true
                                },
                                mode: 'x',
                            }
                        }
                    }
                }
            });
        }

        // Função para atualizar a tabela com os novos dados
        function updateTable(tableData) {
            var table = new Tabulator("#tabela", {
                data: tableData,
                layout: "fitColumns",
                responsiveLayout: "hide",
                addRowPos: "top",
                history: true,
                pagination: "local",
                paginationSize: 20,
                paginationCounter: "rows",
                columns: [{
                        title: "Data",
                        field: "meses"
                    },
                    {
                        title: "Resistência",
                        field: "sensoriamento_ldr"
                    },
                    {
                        title: "Turbidez",
                        field: "turbidez"
                    },
                ],
            });
        }

        // Carrega os dados do servidor quando a página for carregada
        loadDataFromServer();

        // Atualiza os dados a cada 5 segundos (5000 milissegundos)
        setInterval(loadDataFromServer, 5000);
    </script>
    <footer>
    <p>&copy; 2023 HidroBit</p>
    </footer>
</body>

</html>
