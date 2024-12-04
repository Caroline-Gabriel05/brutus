<?php
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

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_item = $_GET['id'];

    //executa a consulta para excluir o produto
    $sqlExcluir = $conn->prepare("DELETE FROM itens WHERE cod_item = ?");
    $sqlExcluir->bind_param('i', $id_item);

    if ($sqlExcluir->execute()) {
        // produto excluído com sucesso
        echo "<div class='alert alert-success text-center'>Produto excluído com sucesso!</div>";
        header("Location: produtos_adm.php"); // redireciona para a página de produtos
        exit();
    } else {
        //erro ao exckri
        echo "<div class='alert alert-danger text-center'>Erro ao excluir o produto: " . $sqlExcluir->error . "</div>";
    }
    $sqlExcluir->close();
    $conn->close();
} else {
    echo "<div class='alert alert-danger text-center'>Produto não encontrado.</div>";
}
?>
