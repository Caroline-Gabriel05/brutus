<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "brutus";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ajuste na consulta para usar a tabela `itens`
$query = "SELECT * FROM itens";  // Agora é a tabela `itens` e não `produtos`

$result = $conn->query($query);

// Verifica se há produtos na tabela `itens`
if ($result->num_rows > 0) {
    $produtos = array();
    while($row = $result->fetch_assoc()) {
        $produtos[] = $row;  // Armazena os resultados da consulta
    }
    // Retorna os produtos como JSON
    echo json_encode($produtos);
} else {
    echo "0 resultados";
}

$conn->close();
?>
