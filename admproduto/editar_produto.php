<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    //conexão com o banco de dados
    $host = 'localhost';      
    $user = 'root';           
    $pass = '';              
    $dbname = 'brutus';       
    
    $conn = new mysqli($host, $user, $pass, $dbname);
    
    //se houve erro na conexão
    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }    
    $id_item = $_GET['id'];  // atribui o ID do item passado na URL à variável $id_item

    // consulta para buscar o produto pelo id
    $sqlProduto = $conn->prepare("SELECT * FROM itens WHERE cod_item = ?");
    $sqlProduto->bind_param('i', $id_item);  // vincula o id
    $sqlProduto->execute();  // executa a consulta
    $result = $sqlProduto->get_result();  // tme o resultado da consulta
    $produto = $result->fetch_assoc();  // converte o resultado para um array associativo

    if (!$produto) {
        die("<div class='alert alert-danger text-center'>Produto não encontrado.</div>");
    }
} else {

    die("<div class='alert alert-danger text-center'>ID do produto inválido ou não especificado.</div>");
}
?>
 <!-- formulário para editar as informações do produto -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>Brutus | Editar Produto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="custom.css">
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">Editar Produto</h2>

        <form action="" method="POST" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome do Produto</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $produto['nome']; ?>" required>
            </div>
            <div class="col-md-6">
                <label for="preco" class="form-label">Preço (R$)</label>
                <input type="number" class="form-control" id="preco" name="preco" step="0.01" value="<?php echo $produto['preco']; ?>" required>
            </div>
            <div class="col-md-6">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" required><?php echo $produto['descricao']; ?></textarea>
            </div>
            <div class="col-md-6">
                <label for="imagem" class="form-label">Imagem Principal do Produto</label>
                <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*" onchange="previewImagem()">
                <div class="imgprod">
                    <img id="imgprod" style="width: 150px; height: 150px;" src="../../imgburguer/burguer/<?php echo $produto['imagem']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <label for="categoria" class="form-label">Categoria</label>
                <?php 
                // consulta para pegar todas as categorias disponíveis
                $cmdsql = "SELECT * FROM categoria";
                $execcmd = mysqli_query($conn, $cmdsql);
                echo "<select name='categoria' class='form-select'>";
                // exibe todas as categorias no campo de seleção
                while ($reglido = mysqli_fetch_array($execcmd)) {
                    $selected = ($reglido['cod_categoria'] == $produto['fk_Categoria_cod_categoria']) ? 'selected' : '';
                    echo "<option value='$reglido[cod_categoria]' $selected>$reglido[cod_categoria] - $reglido[nome]</option>";
                }
                echo "</select>";
                ?>
            </div>
            <div class="col-12">
                <button type="submit" style="background-color: saddlebrown;" name="btn_editar" class="btn w-100">Salvar Alterações</button>
            </div>
        </form>
    </div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    //exibir a prévia da imagem carregada
    function previewImagem(){
        var imagem = document.querySelector('input[name=imagem]').files[0];  //pega o arquivo da imagem
        var preview = document.querySelector('img#imgprod');  //pega o elemento da imagem para exibição
        
        var reader = new FileReader();  //cria um objeto FileReader para ler o arquivo
        
        reader.onloadend = function () {
            preview.src = reader.result;  //exibe a imagem na página
        }

        if(imagem){
            reader.readAsDataURL(imagem);  //le a imagem
        }else{
            preview.src = "";  //se nenhuma imagem for selecionada, limpa a prévia
        }
    }
</script>

<?php
//verifica se o formulário foi enviado para editar o produto
if (isset($_POST['btn_editar'])) {
    //pega os dados do formulário e limpa
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $preco = mysqli_real_escape_string($conn, $_POST['preco']);
    $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
    $categoria = $_POST['categoria'];
    $caminhoimagem = $produto['imagem']; //deixa a imagem antiga caso não seja alterada.

    //verifica se uma nova imagem foi carregada
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];  //extensoes para a imagem
        $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));  //extensao da imagem

        //verifica se a extensão da imagem é permitida
        if (bin_array($extensao, $extensoesPermitidas)) {
            $nomeImagem = uniqid() . '.' . $extensao;  //gera nome unico para a imagem
            $diretorio = '../../brutus/burguer/';  //caminho do diretorio para salvar a imagem
            
            //move o arquivo para o diretorio especificado
            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio . $nomeImagem)) {
                $caminhoimagem = $nomeImagem;  //atualiza o caminho da imagem
            } else {
                die("<div class='alert alert-danger text-center'>Erro ao salvar a imagem.</div>");
            }
        } else {
            die("<div class='alert alert-danger text-center'>Formato de imagem não permitido.</div>");
        }
    }

    //atuzaliza o produto no banco de dados com os novos dados
    if ($caminhoimagem) {
        $sqlProduto = $conn->prepare("UPDATE itens SET nome = ?, preco = ?, descricao = ?, imagem = ?, fk_Categoria_cod_categoria = ? WHERE cod_item = ?");
        $sqlProduto->bind_param('sdsssi', $nome, $preco, $descricao, $caminhoimagem, $categoria, $id_item);
    } else {
        $sqlProduto = $conn->prepare("UPDATE itens SET nome = ?, preco = ?, descricao = ?, fk_Categoria_cod_categoria = ? WHERE cod_item = ?");
        $sqlProduto->bind_param('sdssi', $nome, $preco, $descricao, $categoria, $id_item);
    }

    //executa a atualização no banco de dados
    if ($sqlProduto->execute()) {
        echo "<div class='alert alert-success text-center'>Produto editado com sucesso!</div>";
        header("Location: produtos_adm.php");  //mistra a página de administração
        exit();
    } else {
        echo "<div class='alert alert-danger text-center'>Erro ao editar o produto: " . $sqlProduto->error . "</div>";
    }
    $sqlProduto->close();
    $conn->close();
}
?>
