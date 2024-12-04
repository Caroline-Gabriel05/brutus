<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    // Se o usuário não está logado, envie para a página de login
    header('Location: login.php');
    exit;
}

// Verifica o tipo de usuário e redireciona
if ($_SESSION['tipo_usuario'] == 1) {
    // Administrador
    header('Location: ../admproduto/pagina.php');
} else {
    // Cliente
    header('Location: ../index.php');
}
exit;
?>
