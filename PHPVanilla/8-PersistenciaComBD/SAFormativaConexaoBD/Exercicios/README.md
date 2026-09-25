## LISTA DE EXERCÍCIOS DE FIXAÇÃO E PRÁTICA – CONEXÃO BANCO DE DADOS PDO


#### 1. Abstração de Dados

O que é o PDO no PHP e por que ele é preferível em relação a extensões especializadas procedurais como o antigo pgsql em projetos corporativos?

**Resposta:**
O PDO (PHP Data Objects) é uma extensão do PHP que permite fazer conexão e trabalhar com diferentes bancos de dados usando uma mesma estrutura. Ele é preferível em projetos corporativos porque facilita a manutenção e permite trocar o banco de dados com menos alterações no código. Além disso, possui recursos de segurança, como prepared statements, que ajudam a evitar ataques de SQL Injection.

#### 2. Ciclo do DSN

Explique o que é a string DSN e detalhe a finalidade de cada um dos parâmetros configurados para o PostgreSQL (host, port, dbname).

**Resposta:**
A DSN (Data Source Name) é uma string usada para informar ao PDO onde e como encontrar o banco de dados.

host: informa o endereço do servidor onde o banco está instalado.
port: informa a porta utilizada pelo PostgreSQL.
dbname: informa o nome do banco de dados que será acessado.

**Exemplo:**

`$dsn = "pgsql:host=localhost;port=5432;dbname=meu_banco";`


#### 3. Padrão de Portas

Qual é a porta padrão de escuta do SGBD PostgreSQL (5432) e como ela é referenciada dentro da string de conexão?

**Resposta:**
A porta padrão utilizada pelo PostgreSQL é a 5432. Ela é informada na string de conexão através do parâmetro port.

**Exemplo:**

`$dsn = "pgsql:host=localhost;port=5432;dbname=meu_banco";`

Nesse caso, o `port=5432` informa ao PHP que ele deve tentar acessar o PostgreSQL através da porta 5432.

#### 4. Flags de Integridade

O que acontece quando definimos o atributo PDO::ATTR_ERRMODE com o valor PDO::ERRMODE_EXCEPTION? Qual seria o comportamento padrão caso essa flag não fosse definida?

**Resposta:**
Quando usamos PDO::ATTR_ERRMODE com `PDO::ERRMODE_EXCEPTION`, o PDO passa a lançar uma exceção sempre que ocorrer um erro na conexão ou em uma operação com o banco de dados. Isso facilita o tratamento dos erros usando try e catch.

Se essa configuração não for definida, o PDO utiliza o modo padrão, que é `PDO::ERRMODE_SILENT`. Nesse caso, o erro não gera uma exceção automaticamente, sendo necessário verificar o erro manualmente.

#### 5. Fetch Mode

Qual é a vantagem de utilizar `PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC` para o consumo de memória RAM do servidor?

**Resposta:**
O `PDO::FETCH_ASSOC` faz com que os resultados das consultas sejam retornados somente como arrays associativos, utilizando os nomes das colunas como índices. Isso evita que os mesmos dados sejam armazenados também com índices numéricos, diminuindo a quantidade de memória utilizada.

#### 6. Padrão Singleton

Por que abrir uma nova conexão com new PDO() a cada consulta executada no PostgreSQL pode esgotar o limite de max_connections do servidor?

**Resposta:**
Porque cada `new PDO()` pode criar uma nova conexão com o banco de dados. Se o sistema fizer muitas consultas e abrir uma conexão nova para cada uma delas, várias conexões ficarão abertas ao mesmo tempo. Isso pode atingir o limite definido em `max_connections` no PostgreSQL e impedir que novas conexões sejam realizadas.

#### 7. Encapsulamento do Singleton

Por que o construtor da classe ConexaoBanco precisa ser declarado como private e quais métodos mágicos devem ser bloqueados para garantir a unicidade da instância?

**Resposta:**
O construtor deve ser private para impedir que outras partes do sistema criem objetos diretamente usando new. Dessa forma, a própria classe controla a criação da única instância.

Também é importante bloquear os métodos mágicos` __clone() `e `__wakeup()`, evitando que a instância seja duplicada por clonagem ou desserialização.

#### 8. Segurança de Credenciais

Por que nunca devemos deixar o usuário e senha do banco de dados salvos de forma estática (hardcoded) dentro dos scripts PHP do projeto?

**Resposta:**
Porque as credenciais podem ser expostas caso o código seja compartilhado, publicado em um repositório ou acessado por alguém que não deveria ter essas informações. Se usuário e senha forem descobertos, uma pessoa mal-intencionada pode tentar acessar o banco de dados. Por isso, o ideal é utilizar variáveis de ambiente ou arquivos de configuração protegidos e fora do controle de versão.

#### 9. Tratamento de Exceções & LGPD

Por que a exibição direta de `$e->getMessage()` de uma `PDOException` na tela do navegador é considerada uma falha grave de segurança (Information Disclosure)?

**Resposta:**
Porque a mensagem da exceção pode revelar informações internas do sistema, como nome do banco, tabelas, consultas SQL, caminhos de arquivos e outras informações que podem ajudar um invasor a encontrar vulnerabilidades. Além disso, dependendo do erro, podem aparecer informações relacionadas aos dados armazenados.

Por isso, em um sistema em produção, o erro deve ser registrado em um log seguro para análise dos desenvolvedores, enquanto o usuário deve receber apenas uma mensagem genérica, sem informações internas do sistema.