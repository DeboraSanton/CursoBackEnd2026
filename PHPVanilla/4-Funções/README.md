## Parte A: Exercícios Teóricos


## Conceito de Função
 A Função é tipo um "pedacinho" do código que você separa e dá um nome, para fazer uma tarefa especifica. ela serve para ao em vez de você ficar copiando e colando o mesmo codigo varias vezes, você pode simplismente só chamar a função. **Duas Vantagens**: economiza tempo pois não precisa ficar repetindo o codigo e o seu trabalho fica mais organizado e mais "limpo" para ler.

 ## Principio DRY
 Repetir o codigo varias vezes é ruim pois por exemplo: você copiou o mesmo codigo em 6 lugares diferentes do sistema. Ai um dia você precisa atualizar algo, você vai ter que lembrar de mudar esses 6 locais, e pode acontecer de você acabar esquecendo de algum e o sistema acaba bugando. Com a Função, você escreve a logica uma vez só, e se precisar mudar algo, muda so ali, pois em todo lugar que chamar essa função já vai funcionar certo automaticamente.

 ## Parâmetros e retorno
O Parâmetro é o valor que a função recebe para conseguir executar uma determinada tarefa. Na função `calcularTotal`, os parâmetros são `$preco` e `$quantidade` pois eles são as informações necessárias para fazer o calculo. O valor retornado é o resultadoque a função delvolve depois de realizar a operação. Nesse caso, a função multiplica o preço pela quantidade usando `return $preco * $quantidade`. Por exemplo, se o preço for R$10,00 e a quantidade for 3, a função retornará R$30,00.

## Tipagem
Na declaração `function cadastrar(string $nome, int $icade): bool`, o `$nome` é do tipo string, pois representa um texto, e o `$idade` é do tipo int, pois representa um numero inteiro. O `bool` indica que a função deve retornar um valor booleano, ou seja `true` ou `false`.

## Void e Return
Uma função que retorna string devolve um texto como resultado. Por exemplo, uma função pode receber um nome e retornar uma mensagem com esse nome. Já uma função que retorna void não devolve nenhum valor ela apenas executa uma ação, como mostrar uma mensagem na tela.

**Exemplo**: string
```php
function saudacao(): string {
    return "Olá, tudo bem?";
}
```

**Exemplo**: Void
```php
function mostrarMensagem(): void {
    echo "Olá, tudo bem!";
}
```

## Escopo
A função não consegue acessar $cliente porque essa variavel foi criada fora dela. A função só consegue acessar diretamente as variaveis que estão dentro dela.
Uma forma de resolver é passar o `$cliente` como parâmetro.

```php
$cliente = "Mariana";

function exibirCliente(string $cliente): string {
    return $cliente;
}
```

## Referencias
Quando usamos `float &$valor`, o `&` faz com que a função mexa diretamente na variavel original, e não em uma copia dela.
Sem o `&`, a função recebe uma copia do valorEntão, se mudar o parâmetro dentro da função, a variável original continua igual.
Com o `&`, qualquer mudança feita no parâmetro também muda a variável original.

## Funções Nativas











## Previsão de saida

O resultado será: 90100

Isso acontece porque a função `aplicarDesconto()` pega o valor de `100.00` e multiplica por 0.90, então retorna `90.00`.

Depois, o `echo $valor` mostra o valor original, que continua sendo `100.00`, porque a função recebeu uma cópia do valor e não alterou a variável original.

`echo aplicarDesconto($valor); → 90`
`echo $valor; → 100`

## Documentação
Segundo a documentação oficial do PHP, a sintaxe é:
```php
strlen(string $string): int
```
O parâmetro recebido é uma string, que é o texto que queremos medir. A função retorna um int, que representa o tamanho da string em bytes.

Por exemplo:
```php
$texto = "Olá";
echo strlen($texto);
```
A função strlen() serve para descobrir o tamanho de uma string.


## Parte B: Exercícios Práticos

#### Exercicio 1: calculadora de IMC




