<?php
// Configurações do banco de dados
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "sin499-turbidimetro";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Consulta SQL para buscar os dados da tabela
$sql = "SELECT date_time, sensoriamento_ldr, turbidez FROM turbidimetro";

// Executar a consulta
$result = $conn->query($sql);

// Array para armazenar os dados
$data = array();

// Verificar se há dados retornados
if ($result->num_rows > 0) {
    // Ler os dados linha por linha
    while ($row = $result->fetch_assoc()) {
        // Converter a data para o formato desejado (se necessário)
        $row["date_time"] = date("Y-m-d H:i:s", strtotime($row["date_time"]));
        // Adicionar a linha aos dados
        $data[] = $row;
    }
}

// Fechar a conexão com o banco de dados
$conn->close();

// Retornar os dados como JSON
header('Content-Type: application/json');
echo json_encode($data);
?>