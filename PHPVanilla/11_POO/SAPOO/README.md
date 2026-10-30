# Situação de Aprendizagem: SENAI Bank - Usando POO

## Montagem da Estrutura de Arquivos


```text
SAPOO/
├── src/
│   ├── Dominio/
│   │   ├── Titular.php                         <- Entidade imutável do correntista
│   │   ├── ContaBancaria.php                   <- Superclasse abstrata
│   │   ├── ContaCorrente.php                   <- Subclasse com cheque especial e taxa
│   │   └── ContaPoupanca.php                   <- Subclasse com rendimento e sem taxa
│   └── Exceptions/
│       ├── ContaException.php                  <- Exceção base do domínio
│       ├── SaldoInsuficienteException.php      <- Falha por fundos insuficientes
│       └── ValorInvalidoException.php          <- Valores negativos ou nulos
├── app_banco.php                               <- Simulador visual de operações bancárias
└── README.md                                   <- Documentação e testes
```

## Criação das Exceções de Domínio

## Entidade de Titularidade com Imutabilidade (`readonly`)

## Criação da SuperClasse Abstrata da Conta Bancaria

## Criação da classe herdeiras

## Criação da tela visual

### Desafios:

1. **Procedural vs. OO: Quais são os três principais riscos técnicos de manter regras financeiras críticas implementadas puramente através de arrays associativos e scripts procedurais?**

**Resposta:**
Os três principais riscos são a falta de encapsulamento, que permite fazer alterações indevidadas nos dados. A duplicação de código, que dificulta a manutenção do sistema. E a maior possibilidade de erros, como permitir saques inválidos ou deixar o saldo negativo indevidamente.



2. **Ciclo de Vida do Objeto: O que ocorre na memória Heap do servidor quando a instrução new ContaCorrente(...) é executada? Qual é o papel do método __construct() nesse processo?**

**Resposta:**
É criado um objeto na memória do servidor, com seus atributos e comportamentos. O método `__construct()` é executado automaticamente para iniciar o objeto, recebendo os dados necessários, como agência, número da conta, titular e saldo inicial.



3. **A Pseudo-Variável $this: Explique por que o comando $this->saldo é obrigatório para acessar um atributo dentro da classe, diferenciando-o de uma variável local $saldo.**


**Resposta:**
O `$this->saldo` acessa o atributo saldo pertencente ao objeto atual. Já `$saldo` é uma variável local, que existe apenas no contexto em que foi declarada e não representa necessariamente o atributo do objeto.



4. **Encapsulamento e Invariantes: Por que um desenvolvedor sênior de back-end nunca deve criar um método public function setSaldo(float $novoSaldo) para uma conta bancária?**

**Resposta:**
Porque esse método permitiria alterar o saldo diretamente, sem validar a origem do dinheiro ou registrar operações. O ideal é modificar o saldo por métodos controlados, como `depositar()`, `sacar()` e `transferir()`, preservando as regras de negócio.


5. **Modificadores de Acesso: Qual é a diferença prática entre os modificadores private e protected quando subclasses entram em cena através do extends?**

**Resposta:**
O private permite o acesso somente dentro da própria classe em que o atributo foi declarado. O protected permite o acesso dentro da classe e também nas subclasses que herdam dela.


6. **Constructor Property Promotion: Como o recurso de promoção de propriedades introduzido no PHP 8 reduz o boilerplate e melhora a legibilidade do código?**

**Resposta:**
Ele permite declarar os atributos diretamente nos parâmetros do construtor, usando modificadores como `public`, `private` e `readonly`. Assim, reduz a necessidade de declarar propriedades separadamente e atribuir cada valor manualmente.



7. **Propriedades readonly: Explique o mecanismo de segurança proporcionado pela palavra-chave readonly em atributos de classes de valor como Titular ou CPF.**

**Resposta:**
A palavra-chave readonly impede que a propriedade seja modificada depois de sua inicialização. Isso ajuda a preservar a integridade dos dados do titular, evitando alterações indevidas durante a execução do programa.



8. **Classes Abstratas: Por que faz todo sentido no modelo bancário que a classe ContaBancaria seja declarada como abstract enquanto ContaCorrente e ContaPoupanca são classes concretas?**

**Resposta:**
Porque ContaBancaria representa um modelo geral de conta e define características e comportamentos comuns. Já ContaCorrente e ContaPoupanca possuem regras específicas e podem ser instanciadas para criar objetos reais.



9. **Polimorfismo: Como o método transferir(float $valor, ContaBancaria $destino) consegue operar transferências entre quaisquer tipos de contas filhas sem precisar saber qual é a classe exata da conta de destino?**

**Resposta:**
Isso acontece porque o método recebe qualquer objeto que herde de ContaBancaria. Ao chamar sacar() ou depositar(), o PHP executa o comportamento correspondente à classe concreta do objeto, utilizando o polimorfismo.



10. **Exceções de Domínio: Por que é uma péssima prática retornar false ou null quando uma operação de saque é rejeitada por falta de saldo?**

**Resposta:**
Porque o retorno pode ser ignorado pelo código que chamou o método, fazendo com que a falha passe despercebida. Uma exceção específica, como SaldoInsuficienteException, comunica claramente o problema e permite tratá-lo de forma adequada.

