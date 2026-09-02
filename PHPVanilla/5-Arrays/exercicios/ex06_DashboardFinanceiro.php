<?php
declare(strict_types=1);

// Aqui estão as movimentações da conta
$extrato = [
    ["data" => "2026-09-01", "descricao" => "Salário", "tipo" => "Entrada", "valor" => 4000.00],
    ["data" => "2026-09-02", "descricao" => "Supermercado", "tipo" => "Saida", "valor" => 450.50],
    ["data" => "2026-09-05", "descricao" => "Pix João", "tipo" => "Entrada", "valor" => 200.00],
    ["data" => "2026-09-10", "descricao" => "Conta de Luz", "tipo" => "Saida", "valor" => 120.00],
    ["data" => "2026-09-12", "descricao" => "Cinema", "tipo" => "Saida", "valor" => 65.00]
];

// Aqui eu separo o total de entradas e saídas
$totalEntradas = 0;
$totalSaidas = 0;

foreach ($extrato as $item) {
    if ($item["tipo"] === "Entrada") {
        $totalEntradas += $item["valor"];
    } else {
        $totalSaidas += $item["valor"];
    }
}

// Calcula o saldo atual
$saldo = $totalEntradas - $totalSaidas;
?>

<h2>Dashboard Financeiro</h2>

<p>Entradas: R$ <?php echo number_format($totalEntradas, 2, ',', '.'); ?></p>
<p>Saídas: R$ <?php echo number_format($totalSaidas, 2, ',', '.'); ?></p>

<p>
    Saldo:
    <?php
    if ($saldo >= 0) {
        echo "<span style='color: green;'>R$ " . number_format($saldo, 2, ',', '.') . "</span>";
    } else {
        echo "<span style='color: red;'>R$ " . number_format($saldo, 2, ',', '.') . "</span>";
    }
    ?>
</p>

<table border="1">
    <tr>
        <th>Data</th>
        <th>Descrição</th>
        <th>Tipo</th>
        <th>Valor</th>
    </tr>

    <?php foreach ($extrato as $item) { ?>
        <tr>
            <td><?php echo $item["data"]; ?></td>
            <td><?php echo $item["descricao"]; ?></td>
            <td><?php echo $item["tipo"]; ?></td>
            <td>R$ <?php echo number_format($item["valor"], 2, ',', '.'); ?></td>
        </tr>
    <?php } ?>
</table>
