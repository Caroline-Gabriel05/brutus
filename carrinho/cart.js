// Função para obter produtos do banco e exibi-los
function loadProdutos() {
    fetch('getProdutos.php')
      .then(response => response.json())
      .then(data => {
        const listaProdutos = document.getElementById('produtos-list');
        listaProdutos.innerHTML = '';
  
        data.forEach(produto => {
          const itemDiv = document.createElement('div');
          itemDiv.classList.add('produto-item');
          
          // Exemplo de como exibir os produtos
          itemDiv.innerHTML = `
            <p>Nome: ${produto.nome}</p>
            <p>Descrição: ${produto.descricao}</p>
            <p>Preço: R$ ${produto.preco.toFixed(2)}</p>
            <button onclick="adicionarProduto(${produto.cod_item})">Adicionar ao Carrinho</button>
          `;
  
          listaProdutos.appendChild(itemDiv);
        });
      })
      .catch(error => console.error('Erro ao carregar os produtos:', error));
  }
  