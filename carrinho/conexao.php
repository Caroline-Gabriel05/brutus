<?php
// Conectar ao banco de dados
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "brutus";

// Conexão
$conexao = mysqli_connect($host, $usuario, $senha, $banco);

// Verificar a conexão
if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}
?>
