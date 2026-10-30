## LISTA DE EXERCÍCIOS DE FIXAÇÃO E PRÁTICA - MVC

###  Questões Teóricas

1. **O Colapso do Código Espaguete: Explique por que manter consultas SQL, regras de validação e marcação HTML no mesmo arquivo inviabiliza a manutenção e a escalabilidade de um sistema corporativo.**

**Resposta:**
Porque deixar tudo no mesmo arquivo dificulta a organização, a manutenção e a identificação de erros. Além disso, qualquer alteração pode afetar outras partes do sistema, tornando seu crescimento mais complicado.


2. **A Tríade MVC: Qual é a função específica de cada um dos três componentes do padrão MVC (Model, View, Controller)? Qual deles deve conter as regras de negócio?**

**Resposta:**
O Model cuida dos dados e das regras de negócio, a View é responsável pela parte visual do sistema e o Controller recebe as requisições e faz a comunicação entre Model e View. As regras de negócio devem ficar no Model.


3. **O Papel do Composer: Diferencie o papel do arquivo composer.json do arquivo composer.lock. Por que a pasta vendor/ nunca deve ser versionada no Git?**

**Resposta:**
O composer.json define as dependências e configurações do projeto, enquanto o composer.lock registra as versões exatas das dependências instaladas. A pasta vendor/ não deve ser versionada porque pode ser recriada pelo Composer, evitando arquivos desnecessários no Git.


4. **A Especificação PSR-4: Como o Autoloader PSR-4 consegue localizar o arquivo src/Controllers/ProdutoController.php a partir do namespace App\Controllers\ProdutoController?**

**Resposta:**
O PSR-4 utiliza o namespace para identificar o caminho do arquivo. No exemplo, o namespace App\Controllers é associado à pasta src/Controllers, permitindo localizar automaticamente o arquivo ProdutoController.php.


5. **Front Controller: Qual é a principal vantagem de segurança ao centralizar todas as requisições em public/index.php e isolar os arquivos-fonte do projeto fora da raiz pública da web?**

**Resposta:**
A principal vantagem é aumentar a segurança, pois centraliza as requisições em um único arquivo e impede que usuários acessem diretamente arquivos internos, como configurações, Models e arquivos de conexão com o banco de dados.


6. **Roteador HTTP: Como o objeto Roteador diferencia uma requisição GET /produtos de uma requisição POST /produtos?**

**Resposta:**
O roteador verifica o método HTTP da requisição e sua URL. Assim, consegue diferenciar um GET /produtos, utilizado para consultar produtos, de um POST /produtos, utilizado para cadastrar novos produtos.


7. **Injeção de Dados na View: Como a função nativa extract() atua no método renderizar() do Controller para disponibilizar variáveis para as Views?**

**Resposta:**
A função extract() transforma as chaves de um array em variáveis PHP. Dessa forma, os dados enviados pelo Controller podem ser utilizados diretamente dentro da View.


8. **Segurança contra XSS nas Views: Por que todas as saídas dinâmicas exibidas em tabelas e formulários devem ser envolvidas com htmlspecialchars()?**

**Resposta:**
Porque htmlspecialchars() transforma caracteres especiais em entidades HTML, impedindo que códigos maliciosos sejam executados na página e protegendo o sistema contra ataques XSS.


9. **Single Responsibility no Controller: Por que um Controller nunca deve conter comandos SQL com strings concatenadas ou conexões diretas via new PDO()?**

**Resposta:**
Porque a responsabilidade do Controller é receber as requisições e controlar o fluxo do sistema. As consultas SQL e as conexões com o banco devem ficar em outras camadas, facilitando a organização, a manutenção e a segurança.


10. **Transição para o Framework Laravel: Identifique quais conceitos aprendidos neste MVC artesanal são exatamente os mesmos utilizados pelo Laravel 11.**

**Resposta:**
Conceitos como MVC, rotas HTTP, Controllers, Models, Views, Composer, autoload PSR-4 e separação de responsabilidades também são utilizados no Laravel 11. A diferença é que o Laravel já oferece essas funcionalidades prontas, facilitando o desenvolvimento.