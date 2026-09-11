<?php

// Aqui eu criei a função que calcula o IMC
function calcularIMC(float $peso, float $altura): float
{
    return $peso / ($altura * $altura);
}

// Aqui eu criei a função que classifica o resultado
function classificarIMC(float $imc): string
{
    if ($imc < 25) {
        return "Normal";
    } elseif ($imc < 30) {
        return "Sobrepeso";
    } else {
        return "Obesidade";
    }
}

// Aqui o projeto pega os valores do formulário
$nome = $_POST['nome'] ?? '';
$peso = $_POST['peso'] ?? '';
$altura = $_POST['altura'] ?? '';

$erro = '';

// Aqui ele verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Aqui verifica se o peso está válido
    if (!is_numeric($peso) || $peso < 20 || $peso > 300) {
        $erro = "Digite um peso válido.";

    // Aqui verifica se a altura está válida
    } elseif (!is_numeric($altura) || $altura < 0.5 || $altura > 2.5) {
        $erro = "Digite uma altura válida.";

    // Se estiver tudo certo, calcula o IMC
    } else {
        $imc = calcularIMC($peso, $altura);
        $classificacao = classificarIMC($imc);
    }
}
?>

<h1>Calculadora de IMC</h1>

<form method="POST">

    <!-- Campo para colocar o nome -->
    Nome:
    <input type="text" name="nome">

    <br><br>

    <!-- Campo para colocar o peso -->
    Peso:
    <input type="number" name="peso" step="0.1">

    <br><br>

    <!-- Campo para colocar a altura -->
    Altura:
    <input type="number" name="altura" step="0.01">

    <br><br>

    <button>Calcular</button>

</form>

<?php if ($erro != ''): ?>

    <!-- Mostra o erro caso tenha algum problema -->
    <p><?= $erro ?></p>

<?php endif; ?>

<?php if (isset($imc)): ?>

    <!-- Aqui mostra o resultado do cálculo -->
    <div class="resultado">

        <h2>Resultado</h2>

        <p>Nome: <?= $nome ?></p>
        <p>IMC: <?= number_format($imc, 2, ',', '.') ?></p>
        <p>Classificação: <?= $classificacao ?></p>

    </div>

<?php endif; ?>

<style>

body {
    background-color: #f5efc6;
    font-family: sans-serif;
    padding: 30px;
}

h1 {
    color: #D88BA8;
}

form, .resultado {
    background-color: #facbe0;
    padding: 20px;
    width: 400px;
    border-radius: 10px;
}

input {
    padding: 6px;
    border: 1px solid #D88BA8;
    border-radius: 5px;
}

button {
    background-color: #EFA9C4;
    border: none;
    padding: 8px 15px;
    border-radius: 5px;
    font-weight: bold;
}

</style>