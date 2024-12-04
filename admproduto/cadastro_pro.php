<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>Brutus | Administrador</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="custom.css">
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">Adicionar Produto</h2>

        <form action="cadastrar_banco.php" method="POST"  enctype="multipart/form-data" class="row g-3">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome do Produto</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="col-md-6">
                <label for="preco" class="form-label">Preço (R$)</label>
                <input type="number" class="form-control" id="preco" name="preco" step="0.01" required>
            </div>
            <div class="col-md-6">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
            </div>
            <div class="col-md-6">
                <label for="imagem" class="form-label">Imagem Principal do Produto</label>
                <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*" onchange="previewImagem()"  required>
                <div class="imgprod">
                  <img id="imgprod" style="width: 150px; height: 150px;">
                </div>
            </div>
            <div class="col-md-6">
                <label for="categoria" class="form-label">Categoria</label>
                <?php 
                $servername = "localhost";
                $database = "brutus";
                $username = "root";
                $password = "";
            
                $conn = mysqli_connect($servername, $username, $password, $database);
                $cmdsql="SELECT * FROM categoria";
                $execcmd=mysqli_query($conn,$cmdsql);
                printf("<select name='categoria'>\n");
                while ( $reglido=mysqli_fetch_array($execcmd) )
                { 
                printf("  <option value='$reglido[cod_categoria]'>$reglido[$cod_categoria]-$reglido[nome]</option>\n");
                } 
                printf("</select>\n");
?>
            </div>
            <div class="col-12">
                <button type="submit" style="background-color: saddlebrown;" name="btn_salvar" class="btn w-100">Adicionar Produto</button>
            </div>
        </form>
    </div>
    
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<script>
			function previewImagem(){
				var imagem = document.querySelector('input[name=imagem]').files[0];
       
				var preview = document.querySelector('img#imgprod');
       

				var reader = new FileReader();
				
				reader.onloadend = function () {
					preview.src = reader.result;
        
				}
				
				if(imagem){
					reader.readAsDataURL(imagem);
         
				}else{
					preview.src = "";
       
				}
			}

</script>
