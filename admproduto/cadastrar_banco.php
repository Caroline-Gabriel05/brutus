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
    
    // Receber e sanitizar os dados do formulário
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $preco = mysqli_real_escape_string($conn, $_POST['preco']);
    $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
    $categoria = 1;
    
    // Validar e processar upload de imagem
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
        $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
        
        if (in_array($extensao, $extensoesPermitidas)) {
            $nomeImagem = uniqid() . '.' . $extensao; // Garante um nome único para a imagem
            $diretorio = '../../imgburguer/burguer/';
            
            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio . $nomeImagem)) {
                $caminhoimagem = $nomeImagem;
            } else {
                die("<div class='alert alert-danger text-center'>Erro ao salvar a imagem.</div>");
            }
        } else {
            die("<div class='alert alert-danger text-center'>Formato de imagem não permitido.</div>");
        }
    } else {
        die("<div class='alert alert-danger text-center'>Imagem não enviada.</div>");
    }
    
    // Inserir no banco de dados usando Prepared Statement
    $sqlProduto = $conn->prepare("INSERT INTO itens (nome, preco, descricao, imagem,fk_Categoria_cod_categoria) 
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
