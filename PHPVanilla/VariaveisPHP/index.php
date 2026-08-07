<?php
declare(strict_types=1);
?>
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
    $salario = 1520.68; // CRiação da variavel salario com o valor numérica - decimal(float - double)
    $status = null; // Criação da variavel null de valor nulo
    //$endereço; // Variavel undefined, não é possivel declarar uma variavel sem atribuir um valor a ela, não existe undefined em PHP

    // Dica para a criaçãõ de Variaveis: ./
    // Não inicie o nome de uma variavel com numeros 
    // Não utilize espaços em branco
    // Não utilize caracteres especiais, somente o underline
    // Crie variaveis com nomes que ajudarão a identificar melhor a mesma 
    // Evite utilizar letras maiúsculas

    // Exibir aas variaveis na tela
    echo "Nome: $nome <br>";
    echo "Idade: $idade <br>";
    echo "Ativo: $ativo <br>";
    echo "Salario: $salario <br>";
    echo "Status: $status <br>";


    echo "<br><h3> Constantes </h3><br>";
    // Constantes são representadas pela palavra "const" ou "define" seguidas do nome da constante
    //Exemplo de constantes
    const PI = 3.14; //Constante do tipo number (float)
    const EMPRESA = "Google"; //Constante do tipo string
    define("SITE", "www.google.com"); //Declaração de Constantes do tipo string usando "define"
    //Uma boa prática é utilizar letras muiusculas para nomear constantes, para deiferenciar das variaveis

    //Exibir as constantes na tela
    echo "Valor de PI: " . PI . "<br>";
    echo "Nome da Empresa: " . EMPRESA . "<br>";
    echo "Site: " . SITE . "<br>";

    //Tentar alterar o valor de uma contante, isso irá gerar um erro de codigo, pois contantes não podem ser alteradas
    //PI = 3.14159; // isso gera um erro
    // redeclarar uma conatante tambem irá gerar um erro 
    //const SITE = "www.google.com.br"; // isso é um erro 

    //Regra de Ouro: Sempre coloque a instrução "declare(strict_types=1);" no inicio do seu codigo PHP,
    //Isso blinda o seu sistema contra mistura acidentais de tipos de dados.
    

    // Utilização de texto (concatenação Vs interpolação)

    // Exemplo de concatenação => juntar duas ou mais strings utilizando p operador "."(ponto)
    echo "Olá, ".$nome ."! Seja Bem-Vindo ao Nosso Site! <br>";

    // Exemplo de interpolação => Utilização de variaveis dentro de um texto, utilizando aspas duplas no texto
    echo "$nome, tem $idade anos e o seu salario é R$ $salario reais. <br>";//forma mais correta de misturar texto e variaveis 

    ?>


</body>
</html>