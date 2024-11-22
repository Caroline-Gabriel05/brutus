<?php
session_start();
include('conexao.php');

$sql = "SELECT * FROM produtos";
$resultado = mysqli_query($conexao, $sql);

echo "<h1>Produtos</h1>";
echo "<table>";
echo "<thead><tr><th>Produto</th><th>Preço</th><th>Ação</th></tr></thead><tbody>";

while ($produto = mysqli_fetch_assoc($resultado)) {
    $idProduto = $produto['id_produto'];
    $nomeProduto = $produto['nome'];
    $precoProduto = $produto['preco'];

    echo "<tr>
            <td>$nomeProduto</td>
            <td>R$ " . number_format($precoProduto, 2, ',', '.') . "</td>
            <td><a href='adicionar.php?adicionar=$idProduto'>Adicionar ao Carrinho</a></td>
          </tr>";
}

echo "</tbody></table>";
?>
