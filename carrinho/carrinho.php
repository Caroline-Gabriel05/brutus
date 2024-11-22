<?php
session_start();
include('conexao.php');
include('funcoes.php');

// Verifica se o item foi removido
if (isset($_GET['remover'])) {
    $itemId = $_GET['remover'];
    removerDoCarrinho($itemId);
    header('Location: carrinho.php');
    exit;
}

// Exibir os itens do carrinho
exibirCarrinho();
?>
