Crie a função senhaForte(string $senha): bool. 
Ela deve retornar true quando a senha possuir
mais de 8 caracteres e false caso contrário.
Use strlen() e mostre uma mensagem de acordo com o resultado.


<?php

declare(strict_types=1);

// Verifica se a senha possui mais de 8 caracteres
function senhaForte(string $senha): bool
{
    // strlen conta a quantidade de caracteres da senha
    if (strlen($senha) > 8) {
        return true;
    } else {
        return false;
    }
}

// Senha usada para testar a função
$senha = "123456789";

// Mostra uma mensagem de acordo com o resultado
if (senhaForte($senha)) {
    echo "Senha forte";
} else {
    echo "Senha fraca";
}
?>