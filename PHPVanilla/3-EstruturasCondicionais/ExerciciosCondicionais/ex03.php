<?php
declare(strict_types=1);
$peso = 85.5;
$altura = 1.75;
$imc = $peso / ($altura * $altura);



if ($imc < 18.5) {
    $classificacao = "Abaixo do peso";
} elseif ($imc < 25) {
    $classificacao = "Peso normal";
} elseif ($imc < 30) {
    $classificacao = "Sobrepeso";
} elseif ( $imc < 35) {
    $classificacao = "Obesidade grau I";
} else {
    $classificacao = "Obesidade grau III";
}

echo "Peso: $peso kg ";

echo "Altura: $altura m ";

echo "IMC: " . number_format($imc, 2, ',', '.');

echo " Classificação: $classificacao";






?>