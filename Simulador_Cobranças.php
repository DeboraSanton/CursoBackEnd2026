<?php 
//Declaração das variaveis
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeção de Dívida</title>
</head>
<body>
    <h1>Simulador de Projeção de Dívida</h1>
    <hr>
    <?php

// definir a categoria do cliente
$categoriaCliente = "A";

// definir o valor inicial da divida
$dividaAtual = 2000.00;

//definir a taxa de juros usando o match que vai verificar a categoria do cliente
$taxa = match($categoriaCliente) {

    //categoria A: 1% de juros ao mes
    "A" => 0.01,

    //categoria B: 2% de juros ao mes
    "B" => 0.02,

    // categoria  C: 3% de juros ao mes
    "C" => 0.03,

    //qualquer outra categoria: 5% de juros ao mes
    default => 0.05

};

// informações do cliente
echo "<h2>Informções do Cliente</h2>";
echo "Categoria do cliente: $categoriaCliente <br>";
echo "Taxa de Juros: " . ($taxa * 100) . "% ao mes <br>";
echo "Taxa Inicial: R$ $dividaAtual <br>";
echo "<hr>";

?>

//Criação da tabela
<hr>
<h2>Projeção da divida</h2>

<table>
    <tr>
        <th>Mes</th>
        <th>Dívida Atual</th>
        <th>Juros do Mes</th>
        <th>Saldo Atualizado</th>
</tr>

<?php


for ($mes = 1; $mes <= 12; $mes++) {
    $dividaInicial = $dividaAtual;

    if ($mes == 6) {
        // no mes 6 não haverá cobrança de juros
        echo "<tr>";
        echo "<td>$mes</td>";
        echo "<td>R$ " . number_format($dividaInicial, 2, ',', '.') . "</td>";
        echo "<td>Isenção de Juros</td>";
        echo "<td>R$ " . number_format($dividaAtual, 2, ',', '.') . "</td>";
        echo "</tr>";

        // o continue; ele pula  o restante dessa repetição e ja vai direto para o proximo mes
        continue;
    }
//calcula os juros de cada mes e atualiza o valor da divida
$juros = $dividaAtual * $taxa;

$dividaAtual = $dividaAtual + $juros;

//resultado do mes com as formatação dos numero
 echo "<tr>"; 
    echo "<td>$mes</td>"; 
    echo "<td>R$ " . number_format($dividaInicial, 2, ',', '.') . "</td>"; 
    echo "<td>R$ " . number_format($juros, 2, ',', '.') . "</td>"; 
    echo "<td>R$ " . number_format($dividaAtual, 2, ',', '.') . "</td>"; 
    echo "</tr>"; 

}

?>
</table>
</body>
</html>
