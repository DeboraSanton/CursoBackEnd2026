<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudo de Variaveis</title>
</head>
<body>
    <h1>Estudo de variaveis</h1>
    <hr>
    <?php
    // Para criar variaveis em php basta usar o sinal de $
    // Variaveis em php são não tipadas, não precisa declarar o tipo (texto, numeros, booleanas)
    // Ao atribuir valor para a variavel a tipagem é automatica
    $nome = "João"; //Criação da variavel nome com o valor textual "João"
    $idade = 25; // Criação da variavel idade com o valor numérico 25
    $ativo = true; // Criação da variavel ativo com o valor booleano true
    $salario = 1520.68; // CRiação da variavel salario com o valor numérica - decimal
    $status = null; // Criação da variavel null de valor nulo

    // Dica para a criaçãõ de Variavel
    // Não inicie o nome de uma variavel com numeros 
    // Não utilize espaços em branco
    // Não utilize caracteres especiais, somente o underline
    // Crie variaveis com nomes que ajudarão a identificar melhor a mesma 
    // Evite utilizar letras maiúsculas

    echo $nome;
    echo "<br>";
    echo "Idade: $idade;"

    ?>


</body>
</html>