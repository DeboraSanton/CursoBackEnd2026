<?php

declare(strict_types=1);

// A referência & permite alterar o preço original
function aplicarDesconto(float &$preco, float $porcentagem): void
{
    // Calcula o desconto e altera o preço
    $preco = $preco - ($preco * $porcentagem / 100);
}

// Preço original do produto
$preco = 200.00;

// Mostra o preço antes do desconto
echo "Antes: R$ " . number_format($preco, 2, ",", ".") . PHP_EOL;

// Aplica 15% de desconto
aplicarDesconto($preco, 15);

// Mostra o preço depois do desconto
echo "Depois: R$ " . number_format($preco, 2, ",", ".");