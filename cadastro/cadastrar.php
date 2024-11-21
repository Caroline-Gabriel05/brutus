<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | JANTA</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../custom.css">
</head>
<body>
    
<?php include_once "../cabecalho.html"; ?>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Criar Conta</h2>
        <form action="cadastro.php" method="POST" onsubmit="return validarSenhas();">
            <div class="form-group">
                <label for="nome">Nome* </label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome e sobrenome" required>
                <small class="form-text text-danger">O campo Nome* é obrigatório.</small>
            </div>
    
            <div class="form-group">
                <label for="email">E-mail*</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="email@email.com" required>
            </div>
    
            <div class="form-group">
                <label for="cpf">CPF*</label>
                <input type="text" style="color: black;" class="form-control" id="cpf" name="cpf" placeholder="123.456.789-00" required>
            </div>
    
            <div class="form-group">
                <label for="telefone">Telefone*</label>
                <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="(14) 99899-9999" required>
                <small class="form-text text-danger d-none" id="telefoneError">Telefone inválido.</small>
            </div>
    
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="cep">CEP*</label>
                    <input type="text" class="form-control" id="cep" name="cep" placeholder="00000-000" required>
                </div>
    
                <div class="form-group col-md-8">
                    <label for="rua">Rua*</label>
                    <input type="text" class="form-control" id="rua" name="rua" placeholder="Digite sua rua" required>
                </div>
            </div>
    
            <div class="form-row">
                <div class="form-group col-md-9">
                    <label for="bairro">Bairro*</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Digite seu bairro" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="numero">Nº da Casa*</label>
                    <input type="text" class="form-control" id="numero" name="numero" placeholder="Número" required>
                </div>
            </div>
    
            <div class="form-group">
                <label for="complemento">Complemento</label>
                <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Apartamento, bloco, etc.">
            </div>
    
            <div class="form-group">
                <label for="senha">Senha*</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="**********" required>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary"style="background-color:saddlebrown;" type="button" onclick="togglePassword('senha')">Mostrar</button>
                    </div>
                </div>
            </div>
    
            <div class="form-group">
                <label for="confirmSenha">Confirmar Senha*</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="confirmarSenha" name="confirmarSenha" placeholder="**********" required>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" style="background-color: saddlebrown;" type="button" onclick="togglePassword('confirmSenha')">Mostrar</button>
                    </div>
                </div>
            </div>
    
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="termos" required>
                <label class="form-check-label" for="termos">
                    Aceito os termos e condições da Política de Privacidade. *
                </label>
            </div> 
    
            <button type="submit" class="btn btn-block mt-4"  name="btnCadastrar" style="background-color: saddlebrown;"><a href="#">Criar Conta</a></button>
        </form>
    </div>
    <?php include_once "../rodape.html"; ?>
<script type="text/javascript" src="cep.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js"></script>

<script>
// mascara
$(document).ready(function() {
    $('#cpf').inputmask('999.999.999-99'); // mascara cpf
    $('#telefone').inputmask('(99) 99999-9999'); // mascara telefone
    $('#cep').inputmask('99999-999'); // mascara cep

    $('#telefone').on('input', function() {
        if (!$(this).inputmask("isComplete")) {
            $('#telefoneError').removeClass('d-none');
        } else {
            $('#telefoneError').addClass('d-none');
        }
    });
});

function togglePassword(id) {
    const passwordInput = document.getElementById(id);
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}



    function validarSenhas() {
      const senha = document.getElementById("senha").value;
      const confirmarSenha = document.getElementById("confirmarSenha").value;

      if (senha !== confirmarSenha) {
        alert("As senhas não coincidem!");
        return false; // Impede o envio do formulário
      }
      return true; // Permite o envio do formulário
    }


</script>

</body>
</html>
