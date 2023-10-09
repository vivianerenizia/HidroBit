<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        var firstLoad = true; // Flag para verificar se é o primeiro carregamento
        var lastAddedDate = null; // Armazena a última data adicionada

        // Função para inicializar o gráfico
        function initializeChart() {
            const ctx = document.getElementById('myChart');
            myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [], // Inicialmente vazio
                    datasets: [{
                        label: 'Turbidez',
                        data: [], // Inicialmente vazio
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

        // Função para adicionar dados incrementalmente ao gráfico
        function addDataToChart(meses, sensoriamento_ldr, turbidez) {
            const lastMonth = meses[meses.length - 1];
            const lastTurbidez = turbidez[turbidez.length - 1];

            myChart.data.labels.push(lastMonth);
            myChart.data.datasets[0].data.push(lastTurbidez);

            // Para manter o gráfico com um tamanho fixo (por exemplo, 50 pontos), remova os pontos antigos
            if(myChart.data.labels.length > 50) {
                myChart.data.labels.shift();
                myChart.data.datasets[0].data.shift();
            }

            myChart.update();
        }

        // Função para adicionar todos os dados ao gráfico na primeira vez
        function setInitialDataToChart(meses, turbidez) {
            myChart.data.labels = meses;
            myChart.data.datasets[0].data = turbidez;
            myChart.update();
        }

        function loadDataFromServer() {
            $.ajax({
                url: 'data.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
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

                    const latestDataDate = moment(data[data.length - 1].date_time).format("MMM Do, HH:mm:ss");
                    if (lastAddedDate === latestDataDate) {
                        return;  // If the latest data is the same as the last added, don't update the chart
                    }

                    if (firstLoad) {
                        setInitialDataToChart(meses, turbidez);
                        firstLoad = false;
                    } else {
                        addDataToChart(meses, sensoriamento_ldr, turbidez);
                    }

                    lastAddedDate = latestDataDate;  // Update the last added date

                    updateTable(allValues);
                },
                error: function(error) {
                    console.error('Erro ao carregar dados do servidor:', error);
                }
            });
        }

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

        // Inicializar o gráfico e carregar os dados quando a página for carregada
        initializeChart();
        loadDataFromServer();

        // Continuar atualizando a cada 5 segundos
        setInterval(loadDataFromServer, 1000);
    </script>

    <footer>
        <p>&copy; 2023 HidroBit</p>
    </footer>
</body>

</html>
