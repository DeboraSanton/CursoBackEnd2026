<?php
declare(strict_types=1);

// Função para remover os pontos e o traço do CPF
function limparCPF(string $cpf): string
{
    return str_replace([".", "-"], "", $cpf);
}

// Função para verificar se o CPF possui 11 números
function cpfValido(string $cpf): bool
{
    // Verifica se possui exatamente 11 caracteres e se são números
    return strlen($cpf) === 11 && is_numeric($cpf);
}

// CPF para teste
$cpf = "123.456.789-00";

// Limpa o CPF
$cpfLimpo = limparCPF($cpf);

echo "CPF limpo: " . $cpfLimpo . "<br>";

// Verifica se o CPF é válido
if (cpfValido($cpfLimpo)) {
    echo "CPF válido";
} else {
    echo "CPF inválido";
}
?>