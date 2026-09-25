<?php
declare(strict_types=1);

// Função para retirar uma quantidade do estoque
function retirarEstoque(array &$produto, int $quantidade): bool
{
    // Verifica se a quantidade é inválida
    // ou se é maior que o estoque disponível
    if ($quantidade <= 0 || $quantidade > $produto["estoque"]) {
        return false;
    }

    // Diminui a quantidade retirada do estoque
    $produto["estoque"] -= $quantidade;

    // Retorna true quando a retirada foi realizada
    return true;
}

// Produto com 10 unidades no estoque
$produto = [
    "nome" => "Camiseta",
    "estoque" => 10
];

// Teste de uma retirada permitida
if (retirarEstoque($produto, 3)) {
    echo "Retirada realizada com sucesso.<br>";
} else {
    echo "Não foi possível realizar a retirada.<br>";
}

// Mostra o estoque depois da retirada
echo "Estoque atual: " . $produto["estoque"] . "<br><br>";

// Teste de uma retirada maior que o estoque
if (retirarEstoque($produto, 20)) {
    echo "Retirada realizada com sucesso.";
} else {
    echo "Retirada recusada.";
}
?>