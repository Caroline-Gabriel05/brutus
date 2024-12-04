<?php
if (isset($_POST["btn_salvar"])) {
    // Configuração da conexão
    $servername = "localhost";
    $database = "brutus";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    // Receber os dados do formulário
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria']; // Exemplo estático

    // Validar e processar upload de imagem
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
        $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
        $diretorio = '../produtos/';
        $nomeImagem = uniqid() . '.' . $extensao;

        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0777, true);
        }

        if (in_array($extensao, $extensoesPermitidas)) {
            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio . $nomeImagem)) {
                $caminhoimagem = $nomeImagem;
            } else {
                die("<div class='alert alert-danger text-center'>Erro ao mover o arquivo para o diretório de destino.</div>");
            }
        } else {
            die("<div class='alert alert-danger text-center'>Formato de imagem não permitido. Use JPG, JPEG, PNG ou GIF.</div>");
        }
    } else {
        die("<div class='alert alert-danger text-center'>Erro no envio da imagem.</div>");
    }

    // Inserir no banco de dados
    $sqlProduto = $conn->prepare("INSERT INTO itens (nome, preco, descricao, imagem, fk_Categoria_cod_categoria) 
                                  VALUES (?, ?, ?, ?, ?)");

    if (!$sqlProduto) {
        die("Erro ao preparar a consulta: " . $conn->error);
    }

    $sqlProduto->bind_param('sdsss', $nome, $preco, $descricao, $caminhoimagem, $categoria);

    if ($sqlProduto->execute()) {
        echo "<div class='alert alert-success text-center'>Produto adicionado com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Erro ao adicionar o produto: " . $sqlProduto->error . "</div>";
    }

    $sqlProduto->close();
    $conn->close();
}
?>
