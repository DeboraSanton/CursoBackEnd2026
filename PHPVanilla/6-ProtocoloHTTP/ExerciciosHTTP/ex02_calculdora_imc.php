<?php

// Aqui eu criei a função que calcula o IMC
function calcularIMC(float $peso, float $altura): float
{
    return $peso / ($altura * $altura);
}

// Aqui criei a função que classifica o IMC
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

// O projeto pega os valores enviados pelo formulário
$nome = $_POST['nome'] ?? '';
$peso = $_POST['peso'] ?? '';
$altura = $_POST['altura'] ?? '';

$erro = '';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Verifica se o peso é válido
    if (!is_numeric($peso) || $peso < 20 || $peso > 300) {
        $erro = "Digite um peso válido.";
    }

    // Verifica se a altura é válida
    elseif (!is_numeric($altura) || $altura < 0.5 || $altura > 2.5) {
        $erro = "Digite uma altura válida.";
    }

    // Se tudo estiver certo, calcula o IMC
    else {
        $imc = calcularIMC((float)$peso, (float)$altura);

        // Classifica o resultado
        $classificacao = classificarIMC($imc);
    }
}
?>

<h1>Calculadora de IMC</h1>

<form method="POST">

    <!-- Campo do nome -->
    Nome:
    <input type="text" name="nome"
        value="<?= htmlspecialchars($nome) ?>">

    <br><br>

    <!-- Campo do peso -->
    Peso:
    <input type="number" name="peso" step="0.1"
        value="<?= htmlspecialchars($peso) ?>">

    <br><br>

    <!-- Campo da altura -->
    Altura:
    <input type="number" name="altura" step="0.01"
        value="<?= htmlspecialchars($altura) ?>">

    <br><br>

    <button type="submit">Calcular</button>

</form>

<!-- Mostra o erro se houver algum problema -->
<?php if ($erro != ''): ?>

    <p style="color: red;">
        <?= htmlspecialchars($erro) ?>
    </p>

<?php endif; ?>

<!-- Mostra o resultado se o cálculo foi realizado -->
<?php if (isset($imc)): ?>

    <?php
    // Define a cor do resultado
    $cor = "green";

    if ($classificacao == "Sobrepeso") {
        $cor = "orange";
    }

    if ($classificacao == "Obesidade") {
        $cor = "red";
    }
    ?>

    <div style="color: <?= $cor ?>">

        <h2>Resultado</h2>

        <p>
            Nome: <?= htmlspecialchars($nome) ?>
        </p>

        <p>
            IMC: <?= number_format($imc, 2, ',', '.') ?>
        </p>

        <p>
            Classificação: <?= htmlspecialchars($classificacao) ?>
        </p>

    </div>

<?php endif; ?>

<style>
    body {
        background-color: #f5efc6;
        margin: 0;
        font-family: sans-serif;
        padding: 30px;
    }

    h1 {
        color: #f3b4cc;
    }

    form {
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
        cursor: pointer;
    }
</style>