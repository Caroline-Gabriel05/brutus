<?php
session_start(); // Inicie a sessão no topo do código
require_once("../funcao.php");

$usuario = $_POST["email"];
$senha = $_POST["password"];
$tipo = "2"; // Por padrão, é cliente, senão é ADM

$erro = "";

if ($usuario == "") { 
    $erro .= "Digite o usuário<br/>";
} elseif ($senha == "") { 
    $erro .= "Digite a senha<br/>";
}

if ($erro) {
    $_SESSION['erro_login'] = $erro; // Armazena os erros na sessão
    header('Location: login.php'); // Redireciona para a página de login
    exit;
}

$senha_md5 = md5($senha);
$usuarioSenha = "SELECT * FROM usuario WHERE email = '$usuario' AND senha = '$senha_md5' ";

$result = mysqli_query($conexao, $usuarioSenha) or die("Impossível verificar o cliente");
$qtdREGISTRO = mysqli_num_rows($result);
$linha = mysqli_fetch_assoc($result);

if ($qtdREGISTRO > 0) {
    $c = $linha["fk_tipos_usuario_codigo"];
    $_SESSION['id_logado'] = $linha['codigo'];
    header('Location: /brutus/index.php'); // Redireciona para a página inicial
} else {
    $_SESSION['erro_login'] = 'E-mail ou senha incorretos!'; // Mensagem de erro
    header('Location: login.php'); // Redireciona para a página de login
    exit;
}
?>

