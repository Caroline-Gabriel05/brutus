<?php
session_start(); // Inicie a sessão no topo do código
require_once("../funcao.php");

$usuario = $_POST["email"];
$senha = $_POST["password"];
$tipo = "2"; // Por padrão, é cliente, senão é ADM

$erro = "";

if (empty($usuario)) { 
    $erro .= "Digite o usuário<br/>";
} 
if (empty($senha)) { 
    $erro .= "Digite a senha<br/>";
}

if ($erro) {
    $_SESSION['erro_login'] = $erro; // Armazena os erros na sessão
    header('Location: login.php'); // Redireciona para a página de login
    exit;
}

$senha_md5 = md5($senha); // Cuidado: MD5 é inseguro para armazenamento de senhas
$usuarioSenha = "SELECT * FROM usuario WHERE email = '$usuario' AND senha = '$senha_md5'";

$result = mysqli_query($conexao, $usuarioSenha);

if (!$result) {
    die("Erro na consulta SQL: " . mysqli_error($conexao)); // Diagnostica erros na consulta
}

$qtdREGISTRO = mysqli_num_rows($result);

if ($qtdREGISTRO > 0) {
    $linha = mysqli_fetch_assoc($result); // Pega os dados do usuário

    $_SESSION['usuario_id'] = $linha['codigo']; // Corrigido: pega o campo 'codigo' da tabela
    $_SESSION['tipo_usuario'] = $linha['fk_tipos_usuario_codigo']; // Corrigido: pega o campo 'tipo_usuario'

    // Redireciona de acordo com o tipo de usuário
    if ($linha['fk_tipos_usuario_codigo'] == 1) {
        header('Location: ../admproduto/pagina.php');
    } else if ($linha['fk_tipos_usuario_codigo'] == 2) {
        header('Location: ../index.php');
    }
    exit;
} else {
    $_SESSION['erro_login'] = 'E-mail ou senha incorretos!';
    header('Location: login.php');
    exit;
}
?>
