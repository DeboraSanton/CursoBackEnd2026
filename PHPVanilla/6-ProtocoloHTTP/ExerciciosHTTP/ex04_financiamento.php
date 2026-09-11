<?php
declare(strict_types=1);

// Aqui o projeto pega os valores do formulário
$valorVeiculo = $_POST['valor_veiculo'] ?? '';
$valorEntrada = $_POST['valor_entrada'] ?? '';
$numeroParcelas = $_POST['numero_parcelas'] ?? '';

$erro = '';

// Parcelas que podem ser escolhidas
$parcelasPermitidas = [12, 24, 36, 48, 60];

// Aqui verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Verifica se os valores são válidos
    $valorVeiculo = filter_var($valorVeiculo, FILTER_VALIDATE_FLOAT);
    $valorEntrada = filter_var($valorEntrada, FILTER_VALIDATE_FLOAT);

    // Verifica se o veículo e a entrada estão corretos
    if ($valorVeiculo === false || $valorVeiculo <= 0) {
        $erro = 'Digite um valor válido para o veículo.';

    } elseif ($valorEntrada === false || $valorEntrada < $valorVeiculo * 0.20) {
        $erro = 'A entrada deve ser de pelo menos 20% do valor do veículo.';

    // Verifica se a quantidade de parcelas é permitida
    } elseif (!in_array((int)$numeroParcelas, $parcelasPermitidas, true)) {
        $erro = 'Número de parcelas inválido.';

    } else {

        // Aqui calcula o valor financiado e os juros
        $valorFinanciado = $valorVeiculo - $valorEntrada;
        $totalJuros = $valorFinanciado * 0.015 * $numeroParcelas;

        // Calcula o valor de cada parcela
        $valorParcela = ($valorFinanciado + $totalJuros) / $numeroParcelas;
    }
}
?>

<h1>Financiamento de Veículos</h1>

<!-- Formulário do financiamento -->
<form method="POST">

    Valor do veículo:
    <input type="number" name="valor_veiculo" step="0.01">

    <br><br>

    Valor da entrada:
    <input type="number" name="valor_entrada" step="0.01">

    <br><br>

    Número de parcelas:
    <select name="numero_parcelas">
        <option value="">Selecione</option>
        <option value="12">12x</option>
        <option value="24">24x</option>
        <option value="36">36x</option>
        <option value="48">48x</option>
        <option value="60">60x</option>
    </select>

    <br><br>

    <button>Calcular</button>

</form>

<?php if ($erro != ''): ?>

    <!-- Mostra o erro -->
    <p><?= $erro ?></p>

<?php endif; ?>

<?php if (isset($valorParcela)): ?>

    <!-- Aqui mostra o resultado -->
    <h2>Memória de cálculo</h2>

    <p>
        Valor Financiado:
        R$ <?= number_format($valorFinanciado, 2, ',', '.') ?>
    </p>

    <p>
        Total de Juros:
        R$ <?= number_format($totalJuros, 2, ',', '.') ?>
    </p>

    <p>
        Valor de Cada Parcela:
        R$ <?= number_format($valorParcela, 2, ',', '.') ?>
    </p>

<?php endif; ?>

<style>

body {
    background-color: #EAF4FF;
    font-family: sans-serif;
    padding: 30px;
}

h1, h2 {
    color: #3F7FD9;
}

form, p {
    background-color: #FFF4B8;
    padding: 15px;
    width: 400px;
    border-radius: 8px;
}

input, select {
    padding: 7px;
    border: 1px solid #3F7FD9;
    border-radius: 5px;
}

button {
    background-color: #3F7FD9;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 5px;
    font-weight: bold;
}

</style>