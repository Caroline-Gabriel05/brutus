<?php
 //login do usuário
 session_start(); 
 require_once("../funcao.php");

 $usuario=$_POST["email"];
 $senha=$_POST["password"];
 $tipo="2"; //por padrao é cliente, ~senão é ADM 

 $erro="";

 if ($usuario == "") 
 { 
	$erro .= "Digite o usuário/>";
 }

 elseif ($senha == "") 
 { 
	$erro .= "Digite a senha<br/>";
 }

 $senha_md5 = md5($senha);

 $usuarioSenha="SELECT * FROM usuario WHERE email = '$usuario' and senha = '$senha_md5' ";

 $result=mysqli_query($conexao,$usuarioSenha)or die ("Impossivel verificar o cliente");
 $qtdREGISTRO = 0; // incializo
 $qtdREGISTRO = mysqli_num_rows($result);
 $linha=mysqli_fetch_assoc($result);

 if ($qtdREGISTRO > 0)
 {
	$c = $linha["fk_tipos_usuario_codigo"];
    if ( $linha["fk_tipos_usuario_codigo"] == $tipo ){
        session_start();

		$_SESSION['id_logado'] = $linha['codigo'];
		header ('location: ../index.php');
    }
    else
    {
		session_start();

		$_SESSION['id_logado'] = $linha['COD_CLIENTE'];
		header ('location: ../index.php');
    }
 			
} 
else{
    //$_SESSION["msg"]=true
	$_SESSION["msg"]="<script>alert('Login incorreto')</script>";
	header ('location: login.html');
}
?>
