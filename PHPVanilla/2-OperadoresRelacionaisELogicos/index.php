<?php
declare(strict_types=1);
// Motor de analise de crédito
//Regras do Negocio
// Regra de Idade: O cliente precisa ter 18 anos ou mais E menos de 70 anos.
//Regra da Parcela (Renda): O valor da parcela do empréstimo NÃO pode ser maior que 30% da renda mensal do cliente.
//Regra VIP: Se o cliente tiver um "Score de Crédito" maior que 800, ele tem aprovação automática (as regras de idade e renda não importam).
// Aprovação Final: O crédito é liberado se: (Regra 1 E Regra 2 forem passarem) OU se (Regra 3 passar).

//1. Dados que vieram do aplicativo do celular do cliente
$idadeCliente = 25;
$rendaMensal = 4000.00;
$valorEmprestimo = 10000.00;
$numeroParcelas = 24;
$scoreCredito = 750; //Pontuação vai de 0 a 1000

//2. Calculo aritméticos
$taxaJuros = 0.02; // Juros de 2% ao mes
$valorJurosTotal = $valorEmprestimo * $taxaJuros * $numeroParcelas;
$valorTotalPagar = $valorEmprestimo + $valorJurosTotal;
$valorParcela = $valorTotalPagar/$numeroParcelas;

//3. O cerebro da operação: avaliação das regras (substitua ??? pelos Operadores logicos e relacionais )
//Regra 1: maior ou igual a 18 e menor que 70
$idadeValida = ($idadeCliente >= 18) && ($idadeCliente < 70);

//Regra 2: Parcela não pode ser maior que 30% da renda (renda * 0.3)
$limiteRenda = $rendaMensal * 0.30;
$rendaSulficiente = $valorParcela <= $limiteRenda;

//regra 3: cliente VIP (score > 800)
$isClienteVip = $scoreCredito > 800;

// Regra 4: Decisão final( a regra final)
// Passou da idade e na renda? ou é ClienteVIP?
$aprovado = ($idadeValida && $rendaSulficiente) || $isClienteVip;
?>