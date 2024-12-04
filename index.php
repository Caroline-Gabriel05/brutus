<?php 
$host = "localhost"; 
$database = "brutus"; 
$username = "root"; 
$password = ""; 
$conn = new PDO("mysql:host=$host;dbname=" . $database, $username, $password); 

$query_products = "SELECT cod_item, nome, descricao, preco, imagem FROM itens WHERE fk_Categoria_cod_categoria = 2"; 
$result_products = $conn->prepare($query_products); 
$result_products->execute(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal | BRUTUS</title>
    <link rel="icon" href="img\favicon.svg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="custom.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="custom.css"> 
</head>
<body>

<?php include_once "cabecalho.html"; ?>
    <!-- Carousel -->

    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <a href="index.php">
                <img src="img/bannerbrutus.svg" class="d-block w-100" alt="Banner 1">
            </a>
            
            </div>
            <div class="carousel-item">
                <img src="img\bannerkids.svg" class="d-block w-100" alt="...">
            </div>
            <!--<div class="carousel-item">
                <img src="img\banner3.svg" class="d-block w-100" alt="...">
            </div> -->
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
        </button>
    </div> 
    <div class="container my-5">
    <h2 class = "logo">combos</h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-3">
        <?php 
        $contador = 0; 
        while ($row_product = $result_products->fetch()) { 
            extract($row_product); 
            if ($contador >= 4) { 
                $contador = 1; 
            } else { 
                $contador++; 
            } 
        ?>
        <div class="col">
            <div class="card">
                <img src='produtos/<?php echo $imagem; ?>' class='card-img-top' alt='Produto <?php echo $contador; ?>'>
                <div class='card-body'>
                    <h5 class='card-title'><?php echo $nome; ?></h5>
                    <p class='card-preco'>R$ <?php echo $preco; ?></p>
                    <p class='card-text'><?php echo $descricao; ?></p>
                    <button class='comp btn w-100 comprar'>Comprar</button>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

      <!--#include file='rodape.html'-->
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <?php include_once "rodape.html"; ?>
</body>
</html>
