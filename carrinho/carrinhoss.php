<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras | BRUTUS</title>
    <link rel="icon" href="..\img\favicon.svg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="custom.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="custom.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../custom.css">
    <style>
        /* Estilo adicional */

        .text-warning {
            color: #ef890d !important;
        }

        .table-hover tbody tr:hover {
            background-color: #ef890d;
        }
    </style>
</head>
<body>
    <?php include_once "..\..\brutus-main\cabecalho.html"; ?>
            <!-- mobile -->
            <!--<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>-->
           <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cardápio
                        </a>
                        <ul class="dropdown-menu custom-bg-color" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="./burguerfrango.html">Burguer Frango</a></li>
                            <li><a class="dropdown-item" href="./burguervegetariano.html">Burguer Vegetariano</a></li>
                            <li><a class="dropdown-item" href="./burguerinfantil.html">Burguer Infantil</a></li>
                            <li><a class="dropdown-item" href="./acompanhamentos.html">Acompanhamentos</a></li>
                            <li><a class="dropdown-item" href="./bebidas.html">Bebidas</a></li>
                            <li><a class="dropdown-item" href="./sobremesas.html">Sobremesas</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutus.php">Sobre Nós</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./combos.html">Combos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./promocoes.html">Promoções</a>
                    </li>
                </ul>

                <div class="navbar-icons">
                    <a href="carrinho.html" class="me-3"><i class="fas fa-shopping-cart"></i></a>
                    <a href="./login/login.html"><i class="fas fa-user"></i></a>
                </div>
            </div>
        </div>
    </nav>-->
<div
            
     <main class="container my-5">
        <h1 class="text-center text-warning mb-4">Carrinho de Compras</h1>
        
        <!-- Exibição dos produtos -->
        <div class="row produtos"></div>
        
        <h3 class="text-warning">Carrinho</h3>
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço Unitário</th>
                    <th>Total</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="itensCarrinho">
                <!-- Os itens serão carregados dinamicamente -->
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center">
            <h3 class="text-warning" id="total">Total: R$ 0,00</h3>
            <button class="btn btn-success btn-lg" id="finalizarCompra">Finalizar Compra</button>
        </div>
    </main>

   
    <!-- Scripts -->
    <script>
        // Itens iniciais no carrinho
        const itensCarrinho = [
            { id: 1, nome: "X-Burguer", preco: 15.00, quantidade: 1 },
            { id: 2, nome: "Coca-Cola", preco: 8.00, quantidade: 2 }
        ];

        const itensCarrinhoTabela = document.getElementById("itensCarrinho");
        const totalElement = document.getElementById("total");
        const finalizarCompraBtn = document.getElementById("finalizarCompra");

        function carregarCarrinho() {
            itensCarrinhoTabela.innerHTML = "";
            let total = 0;

            itensCarrinho.forEach(item => {
                const totalItem = item.preco * item.quantidade;
                total += totalItem;

                const row = `
                    <tr>
                        <td>${item.nome}</td>
                        <td>
                            <input type="number" value="${item.quantidade}" 
                                class="quantidade form-control" data-id="${item.id}" min="0" style="width: 70px;" />
                        </td>
                        <td>R$ ${item.preco.toFixed(2)}</td>
                        <td>R$ ${totalItem.toFixed(2)}</td>
                        <td>
                            <button class="btn btn-danger btn-sm remover" data-id="${item.id}">Remover</button>
                            <button class="btn btn-info btn-sm adicionar" data-id="${item.id}">Adicionar</button>
                        </td>
                    </tr>
                `;
                itensCarrinhoTabela.innerHTML += row;
            });

            totalElement.innerText = `Total: R$ ${total.toFixed(2)}`;
        }

        // Funções para manipulação do carrinho
        document.addEventListener("click", function (e) {
            const id = e.target.getAttribute("data-id");

            if (e.target.classList.contains("remover")) {
                const index = itensCarrinho.findIndex(item => item.id == id);
                if (index !== -1) {
                    itensCarrinho.splice(index, 1);
                    carregarCarrinho();
                }
            }

            if (e.target.classList.contains("adicionar")) {
                const item = itensCarrinho.find(item => item.id == id);
                if (item) {
                    item.quantidade += 1;
                    carregarCarrinho();
                }
            }
        });

        document.addEventListener("input", function (e) {
            if (e.target.classList.contains("quantidade")) {
                const id = e.target.getAttribute("data-id");
                const quantidade = parseInt(e.target.value);

                const item = itensCarrinho.find(item => item.id == id);
                if (item) {
                    item.quantidade = isNaN(quantidade) || quantidade < 0 ? 0 : quantidade;
                    carregarCarrinho();
                }
            }
        });

        // Finalizar compra
        finalizarCompraBtn.addEventListener("click", function () {
            if (itensCarrinho.length === 0) {
                alert("O carrinho está vazio. Adicione itens antes de finalizar.");
            } else {
                alert("Venda Concluída!");
                itensCarrinho.length = 0; // Limpa o carrinho
                carregarCarrinho(); // Atualiza a tabela
            }
        });

        // Inicializar o carrinho
        carregarCarrinho();
    </script>
    </div>
    <?php include_once "../rodape.html"; ?>
</body>
</html>