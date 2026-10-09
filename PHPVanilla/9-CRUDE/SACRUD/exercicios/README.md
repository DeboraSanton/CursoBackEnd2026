
## Lista de Exercicios de Fixação e Prática

**1. Definição de CRUD: O que significa o acrônimo CRUD e qual é a correspondência direta de cada uma de suas letras com as instruções SQL no PostgreSQL?**

**Resposta:**
CRUD significa Create, Read, Update e Delete, que são as quatro operações básicas realizadas em um banco de dados.

C — Create: criar/inserir dados → `INSERT`
R — Read: consultar/ler dados → `SELECT`
U — Update: atualizar dados → `UPDATE`
D — Delete: excluir dados → `DELETE`

---

**2. Anatomia do SQL Injection: Explique com suas próprias palavras como um atacante consegue alterar a lógica de uma consulta quando o código utiliza concatenação de strings com $_GET ou $_POST.**

**Respostas:**
O SQL Injection acontece quando o sistema coloca diretamente o que o usuário digitou dentro de uma consulta SQL, principalmente usando dados vindos de `$_GET` ou `$_POST.`

O problema é que o banco pode acabar entendendo o que o usuário digitou como parte do próprio comando SQL. Dessa forma, uma pessoa mal-intencionada pode tentar alterar a consulta, acessar informações que não deveria ou até modificar dados do banco.

Por isso não é seguro simplesmente juntar o que o usuário digitou com o comando SQL. É melhor usar Prepared Statements, que separam o comando dos dados.

---

**3. Mecanismo das Prepared Statements: Por que o envio de uma consulta em duas etapas (prepare e depois execute) impede que um texto digitado pelo usuário seja executado como instrução SQL pelo banco?**

**Resposta:**
As Prepared Statements funcionam separando a consulta SQL dos valores que serão enviados pelo usuário.

Primeiro usamos o `prepare()` para preparar o comando SQL, normalmente colocando marcadores como `:id` ou `:sku`. Depois usamos o `execute()` para enviar os valores.

Assim, se o usuário digitar alguma coisa que pareça um comando SQL, o banco vai entender aquilo como apenas um valor, e não como uma parte nova do comando.

Por isso o uso de `prepare()` e `execute()` ajuda bastante a evitar ataques de SQL Injection.

---

**4. Marcadores Nomeados: Qual é a vantagem de utilizar marcadores nomeados como :sku e :preco em vez de pontos de interrogação posicionais (?) em instruções SQL complexas?**

**Resposta:**
Os marcadores nomeados, como `:sku` `:preco` e `:id`, deixam o código mais fácil de entender porque conseguimos identificar qual informação será colocada em cada parte da consulta.

Por exemplo, olhando para `:preco`, já dá para entender que ali será colocado o preço.

Usando `?`, precisamos seguir a ordem dos valores no `execute()`. Em consultas maiores, isso pode acabar deixando o código mais confuso e aumentar a chance de colocar algum valor no lugar errado.

---

**5. Diferença entre Bindings: Explique a diferença de comportamento entre os métodos $stmt->bindValue() e $stmt->bindParam().**

**Resposta:**
A principal diferença é a forma como cada um trabalha com a variável.

O `bindValue()` pega o valor que a variável possui naquele momento e associa esse valor ao parâmetro.

Já o `bindParam()` fica ligado diretamente à variável. Então, se o valor dessa variável mudar antes do `execute()`, o novo valor será usado na consulta.

Por exemplo, podemos pensar assim:

`bindValue()` → pega o valor naquele momento.
`bindParam()` → fica ligado à variável e pode pegar um valor alterado depois.

Os dois podem ser usados para passar valores para uma consulta preparada, mas funcionam de maneiras diferentes.

---

**6. Tipagem no PDO: Qual é o risco de omitir o tipo de dado (ex: PDO::PARAM_INT) ao vincular uma variável que deveria ser estritamente numérica em uma cláusula LIMIT?**

**Resposta:**
Se não informarmos corretamente o tipo do dado, podemos ter problemas porque o valor pode ser interpretado de uma forma diferente da esperada.

Por exemplo, se temos um valor que deveria ser um número inteiro, como em um `LIMIT`, podemos usar `PDO::PARAM_INT` para informar ao PDO que aquele valor realmente é um inteiro.

Isso ajuda na segurança e também evita problemas com valores que deveriam ser numéricos, principalmente quando eles vêm de informações digitadas pelo usuário.

---


**7. Padrão DAO: Qual é o benefício do padrão Data Access Object (DAO) em termos de manutenibilidade de software e do princípio de responsabilidade única (SOLID)?**

**Resposta:**
O padrão **DAO (Data Access Object)** serve para separar as funções relacionadas ao banco de dados do restante do sistema.

No nosso caso, a classe `PecaDAO` fica responsável por fazer operações como `SELECT`, `INSERT` e `UPDATE` na tabela de peças.

Isso deixa o projeto mais organizado, porque cada classe fica responsável por uma função. Também facilita a manutenção, porque se precisarmos mudar alguma coisa relacionada ao banco, conseguimos procurar diretamente na classe DAO.

Isso está relacionado ao princípio da **Responsabilidade Única do SOLID**, onde cada parte do código deve ter uma responsabilidade principal.

---

**8. Operações de Update: Por que a ausência de uma cláusula WHERE em um comando UPDATE é considerada um incidente gravíssimo em ambientes de produção?**

**Resposta:**
A falta do `WHERE` em um comando `UPDATE` pode ser muito perigosa porque o comando pode alterar todos os registros da tabela, e não apenas aquele que queríamos modificar.

Por exemplo:

UPDATE pecas_industriais
SET preco_unitario = 100;

Nesse caso, o banco vai colocar o preço `100` em todas as peças da tabela.

Se tivéssemos usado:

UPDATE pecas_industriais
SET preco_unitario = 100
WHERE id = 5;

somente a peça que possui o `id` igual a 5 seria alterada.

Por isso o `WHERE` é muito importante no `UPDATE`, principalmente em sistemas reais, porque um erro desse tipo pode causar uma alteração enorme e difícil de desfazer.

---

**9. Impacto da LGPD: De acordo com a Lei Geral de Proteção de Dados (LGPD), quais são as penalidades e impactos que uma organização pode sofrer caso ocorra vazamento de dados de clientes por falha de SQL Injection?**

**Resposta:**
A LGPD existe para proteger os dados pessoais das pessoas e define regras para empresas e organizações que trabalham com esses dados.

Se acontecer um vazamento de dados por causa de uma falha de segurança, como uma vulnerabilidade de SQL Injection, a organização pode sofrer consequências. Dependendo do caso, podem existir advertências, multas e outras penalidades previstas na LGPD.

Além da possível penalidade, a empresa também pode ter gastos para descobrir e corrigir a falha, proteger novamente os dados e lidar com os clientes afetados.

Também pode haver problemas para a imagem da empresa, já que os clientes podem perder a confiança no sistema.

Por isso é importante tomar medidas de segurança, como usar `Prepared Statements`, validar os dados recebidos e controlar corretamente o acesso ao banco de dados.
