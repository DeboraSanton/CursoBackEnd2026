<?php

declare(strict_types=1);

// Função que calcula o valor total do carrinho
function calcularCarrinho(array $produtos): float
{
    // Começa o total em zero
    $total = 0;

    // Percorre todos os produtos do carrinho
    foreach ($produtos as $produto) {

        // Multiplica o preço pela quantidade
        $total = $total + ($produto["preco"] * $produto["quantidade"]);
    }

    // Retorna o valor total da compra
    return $total;
}

// Lista de produtos do carrinho
$produtos = [
    ["nome" => "Caderno", "preco" => 25.00, "quantidade" => 2],
    ["nome" => "Caneta", "preco" => 3.50, "quantidade" => 4]
];

// Chama a função para calcular o total
$total = calcularCarrinho($produtos);

// Mostra o total formatado
echo "Total da compra: R$ " . number_format($total, 2, ",", ".");