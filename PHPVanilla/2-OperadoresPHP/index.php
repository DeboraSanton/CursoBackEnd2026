<?php
//1. Declare => evitar operações entre variaveis de tipos diferentes
declare(strict_types=1);

//criar um calculo de holerite em php

//2. Declarar as Constantes
const TAXA_INSS = 0.08; //8% => 8/100
const DESCONTO_VT = 150.00;

//3. Declarar as Variaveis 
//dados do empregado
$nomeFuncionario = "Maria Silva";
$salarioBase = 3200.50;
$horasExtras = 10;

//Declaração de variaveis usando LowerCsamelCase
// Regra -> primeira palavra toda minúsculo e depois as demais palavras usa-se maiúscula na primeira letra
// exemplo: $hojeEstaUmDiaBonito

//4. Cálculos dos salarios
// Variavel valor hora extra
$valorHoraExtra = ($salarioBase / 220) * 1.6;
// -> Crie a variavel $totalHorasExtras
$totalHorasExtras = $valorHoraExtra * $horasExtras;
// -> Crie a variavel $salarioBruto
$salarioBruto = $salarioBase + $totalHorasExtras;
// -> Crie a variavel $descontoInss
$descontoInss = $salarioBruto * TAXA_INSS;
// -> Crie a Variavel $salarioLiquido
$salarioLiquido = ($salarioBruto - $ $descontoInss) - DESCONTO_VT;



?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>holerite - <?php $nomeFuncionario ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Demonstrativo de Pagamento</h2>
    <!-- Saida de dados misturando html e php -->
     <table>
        <tr>
            <th>Colaborador(a)</th>
            <td><?php echo $nomeFuncionario ?></td>
        </tr>
        <tr>
            <th>Salário Base</th>
            <!-- usar uma função chamada number format (formata saida de um numero ) -->
             <td>R$ <?php echo number_format($salarioBase,2,",","."); ?></td>
        </tr>
        <!--- Fazer as demais linhas da tabela utilizando as variaveis criadas -->
        <tr>
            <th>Valor de Horas Extras</th>
            <td><?php echo number_format($valorHoraExtra,2,",",".") ?></td>
        </tr>
        <tr>
            <th>Total de horas extras trabalhadas</th>
            <td>R$ <?php echo number_format($totalHorasExtras,2,",","."); ?> </td>
        </tr>
        <tr>
            <th>Salario bruto</th>
            <td>R$ <?php echo number_format($salarioBruto,2,",","."); ?></td>
        </tr>
        <tr>
            <th>Desconto do INSS</th>
            <td>R$ <?php echo number_format($descontoInss,2,",",".") ?></td>
        </tr>
        <tr>
            <th>Desconto da taxa do INSS</th>
            <td>R$ <?php echo number_format(DESCONTO_VT,2,",","."); ?></td>
        </tr>
        <tr>
            <th>Salário liquido do trabalhador</th>
            <td>R$ <?php echo number_format($salarioLiquido,2,",","."); ?></td>
        </tr>
     </table>
</body>