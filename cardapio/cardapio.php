<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hambúrguer | BRUTUS</title>
    <link rel="icon" href="..\img\favicon.svg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="custom.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="custom.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../custom.css">
    <style>
        .comp{
            background-color:saddlebrown;
        }
    </style>
 
</head>
<body>
    <?php 
        include_once "../cabecalho.html";
        $host = "localhost";
        $database = "brutus";
        $username = "root";
        $password = ""; 
     
     
        $conn = new PDO("mysql:host=$host;dbname=" . $database, $username, $password);

        $query_products = "SELECT cod_item, nome, descricao, preco, imagem FROM itens WHERE fk_Categoria_cod_categoria = 1";
        $result_products = $conn->prepare($query_products);
        $result_products->execute();
    ?>
    <div class="container my-5">
        <h2 class="text-center mb-4"><a name='hamburguer'>HAMBURGUER ARTESANAL</a></h2>
		<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-3">
            <?php 
            $contador = 0;
            while ($row_product = $result_products->fetch()) {
                extract($row_product); 
                if($contador>=3){$contador=1;}
                else{
                    $contador=$contador+1;
                }
            ?>
                <!--produto-->
                <div class="col">
                    <div class="card">
                    <?php   echo "<img src='../produtos/$imagem' class='card-img-top' alt='Produto $contador'><br>";
                            echo "<div class='card-body'>";
                            echo"<h5 class='card-title'>$nome</h5>";
                            echo"<p class='card-text'>R$ $preco</p>";
                            echo"<p class='card-text'>$descricao</p>"; ?>
                            <button class="comp btn w-100">Comprar</button>
                    </div>
                    </div>
                </div>
                
            <?php }?></div><?php
            $query_products = "SELECT cod_item, nome, descricao, preco, imagem FROM itens WHERE fk_Categoria_cod_categoria = 2";
            $result_products = $conn->prepare($query_products);
            $result_products->execute();?>
            <div class="container my-5">
        <h2 class="text-center mb-4 "><a name='kids'>Kids</a></h2>
		<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-3">
            <?php 
            $contador = 0;
            while ($row_product = $result_products->fetch()) {
                extract($row_product); 
                if($contador>=3){$contador=1;}
                else{
                    $contador=$contador+1;
                }
            ?>
                <!--produto-->
                <div class="col">
                    <div class="card">
                    <?php   echo "<img src='../produtos/$imagem' class='card-img-top' alt='Produto $contador'><br>";
                            echo "<div class='card-body'>";
                            echo"<h5 class='card-title'>$nome</h5>";
                            echo"<p class='card-text'>R$ $preco</p>";
                            echo"<p class='card-text'>$descricao</p>"; ?>
                            <button class="comp btn w-100">Comprar</button>
                    </div>
                    </div>
                </div>
            <?php }?>
        </div>
        </div><?php
            $query_products = "SELECT cod_item, nome, descricao, preco, imagem FROM itens WHERE fk_Categoria_cod_categoria = 3";
            $result_products = $conn->prepare($query_products);
            $result_products->execute();?>
            <div class="container my-5">
        <h2 class="text-center mb-4 "><a name='combo'>Combos</a></h2>
		<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-3">
            <?php 
            $contador = 0;
            while ($row_product = $result_products->fetch()) {
                extract($row_product); 
                if($contador>=3){$contador=1;}
                else{
                    $contador=$contador+1;
                }
            ?>
                <!--produto-->
                <div class="col">
                    <div class="card">
                    <?php   echo "<img src='../produtos/$imagem' class='card-img-top' alt='Produto $contador'><br>";
                            echo "<div class='card-body'>";
                            echo"<h5 class='card-title'>$nome</h5>";
                            echo"<p class='card-text'>R$ $preco</p>";
                            echo"<p class='card-text'>$descricao</p>"; ?>
                            <button class="comp btn w-100">Comprar</button>
                    </div>
                    </div>
                </div>
            <?php }?>
            </div><?php
            $query_products = "SELECT cod_item, nome, descricao, preco, imagem FROM itens WHERE fk_Categoria_cod_categoria = 4";
            $result_products = $conn->prepare($query_products);
            $result_products->execute();?>
            <div class="container my-5">
        <h2 class="text-center mb-4 "><a name='acompanhamento'>ACOMPANHAMENTO</a></h2>
		<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-3">
            <?php 
            $contador = 0;
            while ($row_product = $result_products->fetch()) {
                extract($row_product); 
                if($contador>=3){$contador=1;}
                else{
                    $contador=$contador+1;
                }
            ?>
                <!--produto-->
                <div class="col">
                    <div class="card">
                    <?php   echo "<img src='../produtos/$imagem' class='card-img-top' alt='Produto $contador'><br>";
                            echo "<div class='card-body'>";
                            echo"<h5 class='card-title'>$nome</h5>";
                            echo"<p class='card-text'>R$ $preco</p>";
                            echo"<p class='card-text'>$descricao</p>"; ?>
                            <button class="comp btn w-100">Comprar</button>
                    </div>
                    </div>
                </div>
            <?php }?>
            </div><?php
            $query_products = "SELECT cod_item, nome, descricao, preco, imagem FROM itens WHERE fk_Categoria_cod_categoria = 5";
            $result_products = $conn->prepare($query_products);
            $result_products->execute();?>
            <div class="container my-5">
                <h2 class="text-center mb-4 "><a name='bebidas'>BEBIDAS</a></h2>
		        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 g-3">
                <?php 
                $contador = 0;
                while ($row_product = $result_products->fetch()) {
                    extract($row_product); 
                    if($contador>=3){$contador=1;}
                    else{
                        $contador=$contador+1;
                    }
                ?>
                <!--produto-->
                <div class="col">
                    <div class="card">
                    <?php   echo "<img src='../produtos/$imagem' class='card-img-top' alt='Produto $contador'><br>";
                            echo "<div class='card-body'>";
                            echo"<h5 class='card-title'>$nome</h5>";
                            echo"<p class='card-text'>R$ $preco</p>";
                            echo"<p class='card-text'>$descricao</p>"; ?>
                            <button class="comp btn w-100">Comprar</button>
                    </div>
                </div>
            </div>
            <?php }?></div>
            <?php
            $query_products = "SELECT cod_item, nome, descricao, preco, imagem FROM itens WHERE fk_Categoria_cod_categoria = 6";
            $result_products = $conn->prepare($query_products);
            $result_products->execute();?>
            <div class="container my-5">
                <h2 class="text-center mb-4 "><a name='sobremesa'>SOBREMESAS</a></h2>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 g-3">
                <?php 
                $contador = 0;
                while ($row_product = $result_products->fetch()) {
                    extract($row_product); 
                    if($contador>=3){$contador=1;}
                    else{
                        $contador=$contador+1;
                    }
                ?>
                <!--produto-->
                <div class="col">
                    <div class="card">
                    <?php   echo "<img src='../produtos/$imagem' class='card-img-top' alt='Produto $contador'><br>";
                            echo "<div class='card-body'>";
                            echo"<h5 class='card-title'>$nome</h5>";
                            echo"<p class='card-text'>R$ $preco</p>";
                            echo"<p class='card-text'>$descricao</p>"; ?>
                            <button class="comp btn w-100">Comprar</button>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
        </div>
        </div>
    </div>
    <?php include_once "../rodape.html"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
