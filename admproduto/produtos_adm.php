<?php
// Incluindo o arquivo de conexão
include_once "../admproduto/conexao.php"; // Ajuste o caminho conforme necessário

// Consulta para pegar todos os produtos
$sqlProduto = "SELECT * FROM itens";
$resultado = $conexao->query($sqlProduto);

// Verificando se a consulta retornou resultados
if (!$resultado) {
    die("Erro na consulta: " . $conexao->error);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hambúrguer | BRUTUS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="custom.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">BURGUER</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-3">
            <?php
            // Verificando se a consulta retornou resultados
            if ($resultado->num_rows > 0) {
                // Exibindo os produtos dinamicamente
                while ($produto = $resultado->fetch_assoc()) {
            ?>
                <!-- Produto -->
                <div class="col">
                    <div class="card">
                        <img src="../burguer/<?php echo htmlspecialchars($produto['imagem']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($produto['nome']); ?></h5>
                            <p class="card-text">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                            <p class="card-text"><?php echo htmlspecialchars($produto['descricao']); ?></p>
                        </div>
                        <div class="mt-2 d-flex justify-content-between">
                            <!-- Botão de Editar -->
                            <button class="btn btn-warning btn-sm" onclick="window.location.href='editar_produto.php?id=<?php echo $produto['cod_item']; ?>'">
                                <i class="fas fa-edit"></i>
                            </button>
                             <!-- Botão de Excluir -->
                            <button class="btn btn-danger btn-sm" onclick="window.location.href='excluir_produto.php?id=<?php echo $produto['cod_item']; ?>'">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Fim do Produto -->
            <?php
                }
            } else {
                // Caso não haja produtos
                echo "<div class='alert alert-info text-center'>Nenhum produto encontrado.</div>";
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
