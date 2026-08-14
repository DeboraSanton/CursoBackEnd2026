<?php
declare(strict_types=1);
//Exercicio 2: o operador de 1 linha (e-commerce)

$valorCompra = 300.00;

$statusFrete = ($valorCompra >= 250) ? "Frete Grátis" : "Frete R$ 25,00";
echo $statusFrete;
?>