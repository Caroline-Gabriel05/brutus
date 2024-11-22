// Função para atualizar o carrinho
function atualizarCarrinho() {
    const carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
    const carrinhoContainer = document.getElementById('carrinho-container');
    const subtotalElement = document.getElementById('subtotal');
    
    // Limpar conteúdo atual do carrinho
    carrinhoContainer.innerHTML = '';
    
    // Adicionar itens do carrinho
    let subtotal = 0;
    carrinho.forEach(item => {
        const itemElement = document.createElement('div');
        itemElement.classList.add('item-carrinho');
        itemElement.innerHTML = `
            <p>${item.nome}</p>
            <p>Quantidade: ${item.quantidade}</p>
            <p>Preço Unitário: R$ ${item.preco}</p>
            <p>Total: R$ ${(item.preco * item.quantidade).toFixed(2)}</p>
            <button class="remover-item" onclick="removerItem(${item.id})">Remover</button>
        `;
        carrinhoContainer.appendChild(itemElement);
        
        // Somando o total
        subtotal += item.preco * item.quantidade;
    });

    // Exibir o subtotal
    if (subtotalElement) {
        subtotalElement.textContent = `Subtotal: R$ ${subtotal.toFixed(2)}`;
    }
}

// Função para adicionar um item ao carrinho
function adicionarAoCarrinho(id, nome, preco) {
    const carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
    
    // Verificar se o item já está no carrinho
    const itemExistente = carrinho.find(item => item.id === id);
    if (itemExistente) {
        itemExistente.quantidade += 1;
    } else {
        carrinho.push({
            id,
            nome,
            preco,
            quantidade: 1
        });
    }
    
    // Salvar carrinho no localStorage
    localStorage.setItem('carrinho', JSON.stringify(carrinho));
    
    // Atualizar a exibição do carrinho
    atualizarCarrinho();
}

// Função para remover um item do carrinho
function removerItem(id) {
    let carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
    
    // Filtrar o item removido
    carrinho = carrinho.filter(item => item.id !== id);
    
    // Atualizar o carrinho no localStorage
    localStorage.setItem('carrinho', JSON.stringify(carrinho));
    
    // Atualizar a exibição do carrinho
    atualizarCarrinho();
}

// Função para adicionar produtos ao frontend
function exibirProdutos(produtos) {
    const produtosContainer = document.querySelector('.produtos');
    
    produtos.forEach(produto => {
        const produtoElement = document.createElement('div');
        produtoElement.classList.add('produto');
        produtoElement.innerHTML = `
            <h3>${produto.nome}</h3>
            <p>R$ ${produto.preco}</p>
            <button onclick="adicionarAoCarrinho(${produto.id}, '${produto.nome}', ${produto.preco})">Adicionar ao Carrinho</button>
        `;
        produtosContainer.appendChild(produtoElement);
    });
}

// Produtos para exibição (exemplo, substitua com dados reais)
const produtosExemplo = [
    { id: 1, nome: 'Hamburguer', preco: 15.00 },
    { id: 2, nome: 'Batata Frita', preco: 10.00 },
    { id: 3, nome: 'Refrigerante', preco: 5.00 }
];

// Exibir os produtos na tela
document.addEventListener('DOMContentLoaded', () => {
    exibirProdutos(produtosExemplo);
    atualizarCarrinho();
});
