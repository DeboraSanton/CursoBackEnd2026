## LISTA DE EXERCÍCIOS: SEGURANÇA E HIGIENIZAÇÃO DE DADOS


### Parte A: Exercícios Teóricos de Fixação

1. **Conceituação OWASP:O que significa XSS e por que é uma vulnerabilidade do lado do cliente que o Back-End precisa prevenir?**

XSS significa Cross-Site Scripting. É quando um site deixa passar, sem tratar, um código malicioso (geralmente em JavaScript) digitado por um usuário, e esse código acaba sendo executado no navegador de quem visita a página. Mesmo o ataque "acontecendo" no navegador (client-side), quem tem que impedir isso é o Back-End, porque é ele quem recebe o dado que o usuário digitou e quem decide como esse dado vai ser mostrado na tela depois. Se o Back-End não fizer o escape certo antes de exibir, o navegador de outra pessoa acaba rodando o script sem saber que é malicioso.


2. **Reflected vs Stored: Qual é a diferença entre um ataque XSS Refletido e um XSS Gravado (Stored)? Qual dos dois apresenta maior potencial de estrago para uma empresa e por quê?**

No XSS Refletido, o código malicioso vem direto na própria requisição (por exemplo, num link com parâmetro na URL) e só afeta quem clicar naquele link específico. Já no XSS Gravado, o código malicioso fica salvo no servidor (banco de dados, arquivo, etc.), como se fosse um comentário ou mensagem normal, e é executado toda vez que qualquer pessoa acessar aquela página.

O Stored é bem mais perigoso, porque não depende de enganar uma pessoa específica com um link malicioso: ele ataca automaticamente todo mundo que acessar a página, inclusive pode pegar vários usuários ao mesmo tempo sem que ninguém precise clicar em nada suspeito.


3. **Mecanismo de Escapamento: Explique detalhadamente a transformação que a função htmlspecialchars() realiza nos caracteres < e >. Por que o navegador não executa o código após essa transformação?**

Essa função transforma o < na entidade HTML `&lt;` e o > na entidade `&gt;`. Assim, quando o navegador vai renderizar a página, ele não entende mais aquilo como abertura/fechamento de uma tag HTML, ele só mostra o símbolo < ou > na tela como texto puro. Como o navegador não reconhece mais uma tag de verdade tipo `<script>`, ele simplesmente exibe o conteúdo como texto e não executa nada.

4. **Flags de Proteção: Qual é a função da flag ENT_QUOTES na chamada de htmlspecialchars()? O que pode acontecer se essa flag for omitida em um campo `<input value="...">`?**

A flag ENT_QUOTES faz o htmlspecialchars() converter tanto as aspas duplas (") quanto as aspas simples (') em entidades HTML. Se essa flag for esquecida (ou usada uma configuração que não protege as aspas), um atacante consegue colocar uma aspas dupla dentro do valor digitado e "fechar" o atributo value="..." antes da hora. Com isso, ele consegue injetar uma tag nova logo depois, tipo `<script>alert('XSS')</script>`, e o navegador vai interpretar isso como uma tag de verdade, executando o script.

5. **Anti-Alucinação PHP: Por que não devemos utilizar o filtro FILTER_SANITIZE_STRING em projetos modernos desenvolvidos em PHP 8.3?**

Porque esse filtro foi descontinuado (deprecated) nas versões mais recentes do PHP, incluindo a 8.3. Ou seja, ele ainda pode até funcionar em algumas situações, mas está marcado para ser removido em versões futuras da linguagem e o próprio PHP já avisa isso com um aviso de erro. Além disso, ele nunca foi 100% confiável pra proteger contra XSS, porque a forma certa de proteger contra isso é fazer o escape na hora de exibir o dado (com htmlspecialchars()), e não tentar "limpar" o dado de outras formas na entrada.

6. **Validação de E-mail: Qual é a diferença prática entre verificar um e-mail com empty($email) e verificar com filter_var($email, FILTER_VALIDATE_EMAIL)?**

empty($email) só verifica se a variável está vazia, nula ou não preenchida — ou seja, ela garante que o campo foi preenchido, mas não garante que o que foi digitado é realmente um e-mail válido. Já o filter_var($email, FILTER_VALIDATE_EMAIL) verifica de verdade o formato do e-mail, conferindo se tem o @, um domínio válido, etc. Então é possível passar no empty() (o campo não está vazio) e mesmo assim ter digitado algo que não é um e-mail de verdade, tipo "batata123".


7. **Roubo de Sessão: Como um atacante pode usar uma brecha XSS para capturar o cookie de sessão de um usuário logado?**

Se o site tem uma falha de XSS, o atacante consegue injetar um código JavaScript que vai ser executado no navegador da vítima. Esse script pode acessar document.cookie, que guarda as informações da sessão (o cookie que prova que aquele usuário está logado), e enviar essas informações para um servidor controlado pelo próprio atacante. Com o cookie de sessão em mãos, o atacante consegue se passar pela vítima e entrar na conta dela sem precisar saber a senha.


8. **Segurança em Camadas: Por que sanitizar na entrada (ex: com strip_tags) não elimina a necessidade de codificar na saída com htmlspecialchars()?**

Porque são duas etapas diferentes e uma não substitui a outra. Sanitizar na entrada serve pra limpar/formatar o dado antes de guardar ou processar (por exemplo, tirar tags HTML que o usuário digitou por engano). Mas isso não garante 100% de proteção, porque sempre pode existir algum vetor de ataque que passa despercebido pela sanitização (como o exemplo do onerror numa tag <img>, ou o javascript: num link). Já o escapamento na saída, feito bem na hora de imprimir o dado na tela, é a camada que realmente impede o navegador de interpretar aquilo como código executável. É por isso que se usa segurança em camadas: uma proteção reforça a outra, e nenhuma delas sozinha é suficiente.