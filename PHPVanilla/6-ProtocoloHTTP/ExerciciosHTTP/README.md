## Exercícios Teóricos de Fixação.

1. Diferença Estrutural:

No método GET, os dados são anexados ao final da  URL. formando uma (*Query String*). Já no POST, os dados são enviados dentro do corpo da requisição HTTP, não ficando visiveis na URL.

2. Segurança e Privacidade:

As senhas não devem ser enviadas por GET porque ficam visiveis na URL. Elas podem ficar gravadas no **histórico do navegador** e nos **logs do servidor**, por exemplo.

3. Coalescência Nula:

Porque quando a página abre pela primeira vez, o formulário ainda não foi enviado e o $_POST['nome'] pode não existir. O `?? ` serve para colocar um valor padrão caso ele não exista

EX: `$nome = $_POST['nome'] ?? "";`

4. Idempotência:

Quer dizer que uma requisição GET pode ser repetida sem ficar alterando os dados. Usar GET para deletar ou atualizar dados é ruim porque só de clicar em um link poderia acontecer uma alteração no banco.

5. Validação Client vs Server:

Essa afirmação é falsa porque essas validações do HTML podem ser burladas. Por isso, também precisamos validar os dados no **backend**, antes de processá-los.

6. XSS e Sanitização:

Se colocar um `$_POST` direto na tela, alguém pode enviar um código malicioso que o navegador pode executar. O `htmlspecialchars()` ajuda a evitar esse tipo de problema.

7. Sticky Forms:

É quando o formulário mantém os dados que a pessoa já digitou mesmo depois de dar algum erro. Assim, ela não precisa preencher tudo de novo.

8. DevTools:

-> Na aba Network do navegador, ao enviar o formulário e clicar na requisição, a aba Headers mostra se o método usado foi POST ou GET. Se for POST, os dados enviados aparecerão na seção  Body, separados da URL, comprovando que não estão na Query String. Ou então, se fosse GET, os mesmos dados apareceriam diretamente na própria URL da requisição, na seção de Query String Parameters.