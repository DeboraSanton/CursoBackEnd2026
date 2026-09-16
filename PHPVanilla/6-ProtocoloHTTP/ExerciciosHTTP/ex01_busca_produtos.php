<?php

// Lista dos produtos
$produtos = [
    ['nome' => 'Notebook', 'categoria' => 'Eletrônicos', 'preco' => 3500],
    ['nome' => 'Mouse', 'categoria' => 'Eletrônicos', 'preco' => 80],
    ['nome' => 'Teclado', 'categoria' => 'Eletrônicos', 'preco' => 150],
    ['nome' => 'Caderno', 'categoria' => 'Papelaria', 'preco' => 30],
    ['nome' => 'Mochila', 'categoria' => 'Acessórios', 'preco' => 200],
    ['nome' => 'Fone', 'categoria' => 'Eletrônicos', 'preco' => 120]
];

// Aqui o projeto pega os valores que foram digitados
$nome = $_GET['nome'] ?? '';
$preco = $_GET['preco_maximo'] ?? '';

// Aqui vai acontecer a filtragem dos produtos
$resultado = array_filter($produtos, function ($produto) use ($nome, $preco) {

    // Verifica se o nome digitado existe no produto
    if ($nome != '' && stripos($produto['nome'], $nome) === false) {
        return false;
    }

    // Verifica se o preço passou do valor máximo
    if ($preco != '' && $produto['preco'] > $preco) {
        return false;
    }

    return true;
});
?>

<h1>Buscar Produtos</h1>

<!-- Formulário para fazer a busca -->
<form method="GET">

    <input type="text" name="nome" placeholder="Nome do produto">

    <input type="number" name="preco_maximo" placeholder="Preço máximo">

    <button>Buscar</button>

</form>

<h2>Produtos</h2>

<!-- Aqui mostra os produtos encontrados -->
<?php foreach ($resultado as $produto): ?>

    <p>
        <?= $produto['nome'] ?> -
        <?= $produto['categoria'] ?> -
        R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
    </p>

<?php endforeach; ?>

<style>

body {
    background-color: #EAF4FF;
    font-family: Arial;
    padding: 30px;
}

form, p {
    background-color: white;
    padding: 15px;
    width: 400px;
    border-radius: 8px;
}

button {
    background-color: #5A90F5;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 5px;
}

</style>