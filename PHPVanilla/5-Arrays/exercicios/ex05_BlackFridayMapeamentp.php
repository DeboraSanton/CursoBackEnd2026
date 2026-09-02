<?php
declare(strict_types=1);

// Aqui eu coloquei os produtos que estão no carrinho e o preço de cada um.
// Esses são os valores que vou usar para aplicar o desconto da Black Friday.
$carrinho = [
    ["produto" => "Notebook", "preco" => 4000.00],
    ["produto" => "Mouse", "preco" => 150.00],
    ["produto" => "Teclado", "preco" => 300.00]
];
// Aqui eu coloquei os produtos que estão no carrinho e o preço de cada um.
// Esses são os valores que vou usar para aplicar o desconto da Black Friday.
$carrinhoBlackFriday = array_map(function ($item) {
    $item["preco"] *= 0.80;

 // Retorna o produto com o novo preço.
    return $item;
}, $carrinho);
?>

<table border="1">
    <tr>
        <th>Produto</th>
        <th>Preço Black Friday</th>
    </tr>

    <?php foreach ($carrinhoBlackFriday as $item) { ?>
        <tr>
            <td><?php echo $item["produto"]; ?></td>
            <td>
                // Aqui eu mostro o preço já com o desconto
                // e uso o number_format para deixar no formato de dinheiro.
                R$ <?php echo number_format($item["preco"], 2, ',', '.'); ?>
            </td>
        </tr>
    <?php } ?>
</table>