# Curso BackEnd - 1 Semestre - 105h

Prof. Diogo Barbosa

escola SENAI Americana

2 Semestre de 2026

## Objetivo do curso

- Desenvolver Aplicações Web server Side, utilizando a linguagem PHP;
- Aplicar sintaxe nativa php Vanilla;
- Manipulação HTTP;
- Percistencia de dados (Armazenamento em BD);
- Segurança contra SQL Injection/csrf;
- Refatoração em POO (programação orientada objeto);
- Arquitetura MVC;
- Utilização do FrameWork Laravel

## Cronograma do semestre

Carga horária: 105h

Duração: 20 semanas

### Semana 1: Introdução ao BackEnd e configuração do ambiente PHP

#### O que é BackEnd?
O BackEnd é a parte de um site ou aplicativo que o usuario não ve, mas que faz tudo funcionar por trás das telas.

As principais linguagens utilizandas no desenvolvimento Back-End são PHP, JavaScript/typeScript, Python, Java, Kotlin, Go (Golang), C# e Rust.

- Guarda e organiza informações em um banco de dados;
- confere se o login e a senha estão corretos;
- Calcula valores, como o frete ou o total de uma compra;
- Garante que os dados de um usuario não apareçam para o outro;
- faz o sistema suportar muitas pessoas usando ao mesmo empo, sem travar

O Back-End é o "Cérebro"oculto de um site ou aplicativo.ele roda em um servidor e cuida de tudo o que o usuario não ve na tela.

## As 3 partes básicas de todo BackEnd:
1. **Servidor**
O "computador" que fica ligado esperando pedidos  (requisições);
2. **Banco de dados:**  onde as informações ficam guardadas (usuários, produtos, mensagens, etc.);
3. **Lógica de negócio:**  as regras do sistema (ex: "não deixa comprar se não tiver estoque").

**O Mercado de Trabalho em Back-end**

O desenvolvimento Back-end é uma das áreas mais cruciais da Tecnologia da Informação. 

- Com a transformação digital acelerada, empresas de todos os portes e setores dependem de infraestruturas sólidas e seguras. 

- Setores de Atuação: Bancos, hospitais, e-commerces, logística, indústrias, startups e órgãos públicos utilizam Back-end para suportar suas operações críticas.

- Fatores de Crescimento: O avanço da computação em nuvem, aplicativos móveis, Big Data e IA impulsiona continuamente a busca por profissionais da área.

- Modelos de Trabalho: Alta flexibilidade com vagas presenciais, híbridas e remotas (inclusive com oportunidades internacionais).


#### Ciclo de vida da requisição HTTP

##### Oque é HTTP?

HTTP, Hypertext Tranfer Protocolo, é um protocolo de comunicação utilizado para tranferencia de informações na  www(Word Wide Web) e em outros sistemas de redes

O HTTP é a base para que o cliente e um servidor web troquem informações. ele permite a requisição e a resposta de recursos, como imagens, arquivos e as proprias paginas web, por meio de mensagens (protocolos);

##### Como Funciona o HTTP?

1. O cliente estabele contato com o servidor, encamihando uma requisição HTTP;
2. Nessa Requisição o cliente especifica o método pretendido (read-GET, create-POST, update-PUT/PATCH, delete-DELETE)
3.  O servidor processa ou responde com uma mensagem HTTP, com os recursos solicitados .´

```mermaid

graph TD

    A[Navegador]
    B[HTTP]
    c[Servidor]

    A --> |Request| B
    B --> |Request| C
    C --> |Response| B
    B --> |Response| A

```
#### Como funciona na pratica o BackEnd

- **Ação do usuario:** Envia uma solicitação pera UI (Interface do Usuario). Exemplo de UI: Tela do celular, Navegador da Internet, Alexa...
- **Envio da requisição:** a UI transforma ação do usuario em requisição HTTP
- **O processamento BackEnd:** o codigo backEnd recebe o pedido, valida os dados e decide o que fazer (ex: consulta uma informação no banco de dados)
- **Resposta:** O servidor devolve o resultado para a UI (Ex: um login autorizado, uma compra confirmada, )

#### Tipos de Requisição HTTP
 os tipos de requisição HTTP indicam a ação que o usuario deseja executar no servidor. as principais ações são:

 - **GET:** pede dados de um lugar especifico. "Não faz alterações no servidor"
 - **POST:** Envia dados novos para *criar* algo ou processar informações.
 - **PUT/PATCH:** Modificar dados já existentes. *PUT* Atualização geral dos dados. *PATCH* Atualização parcial dos dados.
 - **DELETE:** Apaga um dado do servidor.

#### Iniciando o PHP


##### O que é PHP?

**PHP** (Hypertext PreProcessor) é uma linguagem de programação interpretada e open source, focada no desenvolvimento de sistemas para web, pode ser usada junto com HTML para criação de paginas web dinamicas

##### Instalando o PHP
- fazer o Dowload do PHP (php.net);
- ZIP - non theread safe 8.5
- Descompactar o arquivo do php na pasta C:\src\php (para Descompacatar, usar o 7Zip = Melhor) => nunca salvar um arquivo na raiz do sistema(c:)
- Modificar o arquivo php.ini-development para => php.ini (Criar as configurações do PHP na Maquina) - adicional ou remover funcionalidade do PHP
- Adicionar a pasta do PHP(c:\src\php) as variaveis de ambiente do sistema (PATCH)
- verificar a instalação rodando o comando php --version

##### Contextualizando o PHP
O PHP de fato é uma das linguagens de programação mais populares da atualizada. Ela permite que voce crie aplicações web robustas, de uma maneira muito simplificada e direto ao ponto.
sem contar que a linguagem traz diversos recursos que faciitam e aceleram o processo de desenvolvimento de sites e sistemas para a web. E além do mais, ela ainda tem um otimo ecossistema, uma exelente comunidade e um grande mercado de trbalho.

##### Criando minha primeira aplicação em PHP
Criando um Hello, Word!