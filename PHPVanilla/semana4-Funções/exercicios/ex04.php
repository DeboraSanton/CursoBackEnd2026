<?php

declare(strict_types=1);

// Função que organiza o formato do nome
function formatarNome(string $nome): string
{
    // Remove espaços do começo e do final
    $nome = trim($nome);

    // Converte todas as letras para minúsculas
    $nome = strtolower($nome);

    // Deixa a primeira letra maiúscula
    $nome = ucfirst($nome);

    // Retorna o nome formatado
    return $nome;
}

// Testando a função com nomes escritos de formas diferentes
echo formatarNome("   MARIANA   ") . PHP_EOL;
echo formatarNome("JOAO") . PHP_EOL;
echo formatarNome("   carlos") . PHP_EOL;