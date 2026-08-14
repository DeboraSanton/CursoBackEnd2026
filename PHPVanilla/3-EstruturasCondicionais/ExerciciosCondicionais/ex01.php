<?php
declare(strict_types=1);
// Exercicio 1: o sistema de TSE (votação)

$idade = 17;

if ($idade < 16) {
    echo "Voto Proibido";
} elseif ($idade < 18 || $idade >= 70) {
    echo "Voto Facultativo";
} else {
    echo "Voto Obrigatório";
};
?>


