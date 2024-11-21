<?php
session_start();
include_once '/./backup/conexao.php'; 

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT); 
if (!empty($id)) {
    $query = "DELETE FROM itens WHERE id='$id'";
    $resultado = $conn->query($query);

    if ($conn->affected_rows > 0) {
        $_SESSION['msg'] = "<p style='color:green;'>Hambúrguer apagado com sucesso.</p>";
        header("Location: produtos.html"); 
    } else {
        $_SESSION['msg'] = "<p style='color:red;'>Erro: Não foi possível apagar o hambúrguer.</p>";
        header("Location: produtos.html");
    }
} else {
    $_SESSION['msg'] = "<p style='color:red;'>Nenhum hambúrguer selecionado para exclusão.</p>";
    header("Location: produtos.html");
}
?>
