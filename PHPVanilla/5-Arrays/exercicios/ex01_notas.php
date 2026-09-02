<?php
declare(strict_types=1);

// Aqui eu coloquei as notas que vvou usar para calcular a média do aluno
$notas = [7.5, 8.0, 6.5, 9.0, 5.5];

// Essa variavel começa em 0 porque vou usar ela para somar todas as notas
$soma = 0;

//  Aqui eu passo por cada nota do array e vou somando elas
foreach ($notas as $nota) {
    $soma += $nota;
}

//  O count() conta quantas notas existem dentro do array
$quantidadeNotas = count($notas);

// Agora eu divido a soma pela quantidade de notas para descobrir a média
$media = $soma / $quantidadeNotas;

// Aqui eu mostro a média final do aluno na tela
echo "A média final do aluno é " . number_format($media, 2, ',', '.') . "<br>";
if ($media >= 7) {
    echo "<br><span style='color: green;'>Aprovado</span>";
} else {
    echo "<br><span style='color: red;'>Reprovado</span>";
}
?>