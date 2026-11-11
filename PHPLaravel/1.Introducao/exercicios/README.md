## LISTA DE EXERCÍCIOS DE FIXAÇÃO E PRÁTICA - INTRODUÇÃO AO FRAMEWORK LARAVEL 11.X E ARTISAN CLI

### Questões Teóricas de Fixação


1. **Evolução Arquitetural: Quais foram os principais aprendizados técnicos obtidos na construção do MVC artesanal da Semana 12 que permitiram que você compreendesse o Laravel 11 com facilidade?**

**Resposta:**
Aprendi a organizar o projeto em Models, Views e Controllers, separar responsabilidades, utilizar rotas e trabalhar com autoload. Isso facilitou a compreensão do Laravel.



2. **A Nova Arquitetura do Laravel 11: O que mudou na estrutura de inicialização do Laravel 11 em relação às versões anteriores (Laravel 9 e 10)? Onde fica o novo ponto central de configuração?**

**Resposta:**
O Laravel 11 simplificou a estrutura inicial do projeto, centralizando configurações no arquivo bootstrap/app.php, reduzindo a quantidade de arquivos.



3. **Padrão 12-Factor App: Por que é uma violação grave de segurança gravar senhas de banco de dados diretamente dentro do arquivo config/database.php em vez de utilizar o arquivo .env?**

**Resposta:**
Porque deixar senhas diretamente no código expõe informações confidenciais e aumenta o risco de vazamentos. O .env mantém essas informações separadas do código-fonte.



4. **O Papel da APP_KEY: Qual é o risco técnico de alterar a APP_KEY de uma aplicação que já está em produção há meses com usuários reais cadastrados?**

**Resposta:**
Alterar a APP_KEY pode invalidar sessões, cookies e dados criptografados, fazendo com que usuários percam acessos e informações protegidas.



5. **Isolamento de Diretórios: Por que um servidor web de produção (Nginx/Apache) deve apontar rigorosamente para a pasta public/ e nunca para a raiz do projeto Laravel?**

**Resposta:**
Porque a pasta public/ contém apenas os arquivos que podem ser acessados pela internet. Isso protege arquivos internos, configurações e credenciais do projeto.



6. **Artisan CLI: Qual é a diferença prática entre executar um script PHP procedural com php arquivo.php e executar comandos através do php artisan?**

**Resposta:**
O php arquivo.php executa um script PHP diretamente. Já o php artisan executa comandos próprios do Laravel, facilitando tarefas como criar arquivos, migrar tabelas e limpar caches.



7. **O Arquivo .env.example: Por que manter o arquivo .env.example sempre atualizado é indispensável para o sucesso de equipes de desenvolvimento que utilizam Git?**

**Resposta:**
Porque ele serve como modelo de configuração para outros desenvolvedores, mostrando quais variáveis precisam ser preenchidas sem expor senhas ou dados privados.



8. **Motor de Templates Blade: Qual é a diferença entre a diretiva Blade {{ $variavel }} e a diretiva {!! $variavel !!} em termos de proteção contra ataques Cross-Site Scripting (XSS)?**

**Resposta:**
A diretiva {{ $variavel }} escapa automaticamente o HTML, ajudando a prevenir ataques XSS. Já {!! $variavel !!} exibe o conteúdo sem escapar, podendo permitir a execução de códigos maliciosos.



9. **Responsabilidade do Controller: Em uma aplicação profissional com Laravel, por que um método de Controller deve ser curto (≤ 20 linhas) e não deve conter consultas SQL cruas ou regras de negócio extensas?**

**Resposta:**
Porque o Controller deve apenas receber as requisições e direcionar as ações. Separar as regras de negócio e consultas SQL facilita a manutenção, organização e reutilização do código.



10. **A Ferramenta Tinker: Para que serve o comando php artisan tinker e em quais situações ele economiza tempo do desenvolvedor durante testes de laboratório?**

**Resposta:**
O php artisan tinker abre um ambiente interativo para executar códigos PHP e testar Models, consultas e funções do Laravel sem precisar criar arquivos ou telas para cada teste.