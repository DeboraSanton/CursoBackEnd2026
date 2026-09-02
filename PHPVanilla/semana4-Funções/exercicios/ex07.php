<?php
declare(strict_types=1);

// Função para calcular a média das notas
function calcularMedia(array $notas): float
{
    // Soma todas as notas e divide pela quantidade de notas
    return array_sum($notas) / count($notas);
}

// Função para verificar se o aluno foi aprovado
function verificarAprovacao(float $media): string
{
    // Se a média for maior ou igual a 7, está aprovado
    if ($media >= 7) {
        return "Aprovado";
    } else {
        return "Reprovado";
    }
}

// Notas do aluno
$notas = [8, 7, 6, 9];

// Calcula a média
$media = calcularMedia($notas);

// Mostra os resultados
echo "Média: " . $media . "<br>";
echo "Situação: " . verificarAprovacao($media) . "<br>";

// Mostra a maior e a menor nota
echo "Maior nota: " . max($notas) . "<br>";
echo "Menor nota: " . min($notas);
?>