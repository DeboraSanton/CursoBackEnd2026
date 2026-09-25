<?php
declare(strict_types=1);

// Função para procurar um cliente pelo nome
function buscarCliente(array $clientes, string $nome): ?array
{
    // Percorre todos os clientes
    foreach ($clientes as $cliente) {

        // Verifica se o nome é igual ao nome procurado
        if ($cliente["nome"] === $nome) {
            return $cliente;
        }
    }

    // Caso não encontre o cliente
    return null;
}

// Lista de clientes
$clientes = [
    ["nome" => "João", "idade" => 20],
    ["nome" => "Maria", "idade" => 25],
    ["nome" => "Pedro", "idade" => 18]
];

// Teste procurando um cliente que existe
$cliente = buscarCliente($clientes, "Maria");

if ($cliente !== null) {
    print_r($cliente);
} else {
    echo "Cliente não encontrado";
}

echo "<br><br>";

// Teste procurando um cliente que não existe
$cliente = buscarCliente($clientes, "Ana");

if ($cliente !== null) {
    print_r($cliente);
} else {
    echo "Cliente não encontrado";
}
?>