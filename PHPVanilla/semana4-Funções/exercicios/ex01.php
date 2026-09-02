//Crie a função calcularIMC(float $peso, float $altura): float.
 Ela deve calcular e retornar o IMC usando a fórmula peso / (altura * altura). 
 Teste com pelo menos três combinações de peso e altura e formate o resultado com duas casas decimais.


<?php
declare(strict_types=1);

//Função que calcula o IMC
function calcularIMC(float $peso, float $altura): float
{
    //Formula do IMC: peso dividido pela altura ao quadrado
    return $peso / ($altura * $altura);
}
//Teste da função com tres pessoas
$imc1 = calcularIMC(60, 1.65);
$imc2 = calcularIMC(70, 1.70);
$imc3 = calcularIMC(80, 1.75);

//Mostra os resultados com duas casas decimais.
echo "IMC 1: " . number_format($imc1, 2) . PHP_EOL;
echo "IMC 2: " . number_format($imc2, 2) . PHP_EOL;
echo "IMC 3: " . number_format($imc3, 2) . PHP_EOL;
?>

