Crie a função classificarIMC(float $imc): string. Use if / elseif / else para retornar uma
classificação:
Menor que 18.5: Abaixo do peso;
De 18.5 até 24.9: Peso normal;
De 25.0 até 29.9: Sobrepeso;
Igual ou maior que 30.0: Obesidade.



<?php

declare(strict_types=1);

// Função que vai receber o IMC e retorna sua classificação
function classificarIMC(float $imc): string
{
    // Verifica se o IMC está abaixo de 18.5
    if ($imc < 18.5) {
        return "Abaixo do peso";

        // Verifica se o IMC está entre 18.5 e 24.9
    } elseif ($imc <= 24.9) {
        return "Peso normal";

    // Verifica se o IMC está entre 25 e 29.9
    } elseif ($imc <= 29.9) {
        return "Sobrepeso";

    // Se não entrou nas condições anteriores, é 30 ou mais
    } else {
        return "Obesidade";
    }
}

// Testando diferentes classificações
echo classificarIMC(17.5) . PHP_EOL;
echo classificarIMC(22.0) . PHP_EOL;
echo classificarIMC(27.0) . PHP_EOL;
echo classificarIMC(32.0) . PHP_EOL;
?>