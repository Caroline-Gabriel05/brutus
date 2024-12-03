<?php
session_start();
include('conexao.php');
include('funcoes.php');

// ID do usuário (pode ser recuperado de um sistema de login)
$usuarioId = 1;

// Finalizar pedido
finalizarPedido($usuarioId);
?>
