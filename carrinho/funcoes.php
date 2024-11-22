<?php
// Adicionar item ao carrinho
function adicionarAoCarrinho($itemId, $quantidade) {
    // Verifica se o carrinho já existe na sessão
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    // Verifica se o item já está no carrinho
    if (isset($_SESSION['carrinho'][$itemId])) {
        $_SESSION['carrinho'][$itemId]['quantidade'] += $quantidade;
    } else {
        // Se não, adiciona o item
        $_SESSION['carrinho'][$itemId] = [
            'quantidade' => $quantidade
        ];
    }
}

// Exibir itens do carrinho
function exibirCarrinho() {
    global $conexao;
    
    if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
        echo "Carrinho vazio!";
        return;
    }

    // Cabeçalho da tabela
    echo "<table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Total</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>";
    
    $totalCarrinho = 0;

    // Loop para exibir os itens
    foreach ($_SESSION['carrinho'] as $itemId => $item) {
        // Buscar o produto do banco
        $sql = "SELECT * FROM produtos WHERE id_produto = '$itemId'";
        $resultado = mysqli_query($conexao, $sql);
        $produto = mysqli_fetch_assoc($resultado);

        $nomeProduto = $produto['nome'];
        $precoUnitario = $produto['preco'];
        $quantidade = $item['quantidade'];
        $totalItem = $precoUnitario * $quantidade;

        $totalCarrinho += $totalItem;

        echo "<tr>
                <td>$nomeProduto</td>
                <td>$quantidade</td>
                <td>R$ " . number_format($precoUnitario, 2, ',', '.') . "</td>
                <td>R$ " . number_format($totalItem, 2, ',', '.') . "</td>
                <td><a href='carrinho.php?remover=$itemId'>Remover</a></td>
              </tr>";
    }

    echo "</tbody>
          </table>";

    // Exibe o total
    echo "<p>Total: R$ " . number_format($totalCarrinho, 2, ',', '.') . "</p>";

    echo "<a href='finalizar_pedido.php'>Finalizar Pedido</a>";
}

// Remover item do carrinho
function removerDoCarrinho($itemId) {
    unset($_SESSION['carrinho'][$itemId]);
}

// Finalizar pedido (salvar no banco de dados)
function finalizarPedido($usuarioId) {
    global $conexao;

    // Verifica se o carrinho está vazio
    if (empty($_SESSION['carrinho'])) {
        echo "Carrinho vazio!";
        return;
    }

    // Inserir pedido no banco
    $sql = "INSERT INTO pedidos (usuario_id, data_pedido) VALUES ('$usuarioId', NOW())";
    if (mysqli_query($conexao, $sql)) {
        // Recupera o ID do pedido
        $pedidoId = mysqli_insert_id($conexao);

        // Inserir itens do pedido
        foreach ($_SESSION['carrinho'] as $itemId => $item) {
            $quantidade = $item['quantidade'];

            // Buscar o preço do produto
            $sqlProduto = "SELECT preco FROM produtos WHERE id_produto = '$itemId'";
            $resultadoProduto = mysqli_query($conexao, $sqlProduto);
            $produto = mysqli_fetch_assoc($resultadoProduto);
            $precoUnitario = $produto['preco'];

            $totalItem = $precoUnitario * $quantidade;

            // Inserir item no pedido
            $sqlItem = "INSERT INTO itens_pedido (pedido_id, produto_id, quantidade, preco_unitario, total) 
                        VALUES ('$pedidoId', '$itemId', '$quantidade', '$precoUnitario', '$totalItem')";
            mysqli_query($conexao, $sqlItem);
        }

        // Limpar o carrinho após finalizar
        unset($_SESSION['carrinho']);

        echo "Pedido realizado com sucesso!";
    } else {
        echo "Erro ao realizar pedido: " . mysqli_error($conexao);
    }
}
?>
