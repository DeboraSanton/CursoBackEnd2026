<?php
declare(strict_types=1);

//Exercicio 4: Autenticação de sistema (Login Múltiplo)

$senhaSistema = "SenhaSegura123";
$cargoUsuario = "Gerente";
if (($cargoUsuario ==="Diretor" || $cargoUsuario === "Gerente") && $senhaSistema === "SenhaSegura123") {
    echo "Acesso Permitido";
} else {
    echo "Acesso Negado";
}


?>