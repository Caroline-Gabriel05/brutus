<?php

function conecta($server,$username,$senha,$dbname){
    global $conexao;
    $conexao=mysqli_connect($server,$username,$senha,$dbname);
    if (!$conexao) {
        die("Erro ao conectar com o banco de dados: " . mysqli_connect_error());
    }

    return $conexao; // Retorna a conexão
}

conecta("localhost","root","","brutus");
?>