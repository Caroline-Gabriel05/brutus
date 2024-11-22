<?php
session_start();
include('conexao.php');
include('funcoes.php');

// Verifica se foi clicado para adicionar o produto
if (isset($_GET['adicionar'])) {
    $itemId = $_GET['adicionar'];
    $quantidade = 1; // Definido como 1, pode ser ajustado conforme necessário
    
    // Adiciona o produto ao carrinho
    adicionarAoCarrinho($itemId, $quantidade);

    // Redireciona para a página do carrinho
    header('Location: carrinho.php');
    exit;
}
?>
