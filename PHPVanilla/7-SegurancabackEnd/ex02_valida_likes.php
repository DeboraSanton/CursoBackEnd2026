<?php
declare(strict_types=1);

// Essa função protege os textos que aparecem na página.
// Ela impede que códigos HTML ou JavaScript sejam executados.
function e(string $t): string {
    return htmlspecialchars(
        $t,
        ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5,
        "UTF-8"
    );
}


// Aqui criamos as variáveis que vamos usar no código.
// $erro vai guardar uma mensagem caso alguma informação esteja errada.
// $nome guarda o nome digitado pelo usuário.
// $linkValido vai guardar o link somente se ele passar pela validação.
$erro = '';
$nome = '';
$linkValido = null;


// Verifica se o formulário foi enviado usando o método POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Pega o nome digitado e remove espaços desnecessários
    // do começo e do final.
    $nome = trim($_POST['nome'] ?? '');

    // Pega o link digitado e verifica se ele possui
    // um formato válido de URL.
    $link = filter_var(
        trim($_POST['link'] ?? ''),
        FILTER_VALIDATE_URL
    );


    // Verifica se o nome possui pelo menos 3 caracteres.
    if (mb_strlen($nome) < 3) {

        // Se tiver menos de 3 caracteres, aparece uma mensagem de erro.
        $erro = 'Nome inválido.';

    // Se o link não for válido ou não começar com http:// ou https://,
    // também mostramos uma mensagem de erro.
    } elseif (
        !$link ||
        (!str_starts_with($link, 'http://') &&
         !str_starts_with($link, 'https://'))
    ) {

        $erro = 'Link inválido.';

    } else {

        // Se o nome e o link estiverem corretos,
        // guardamos o link na variável $linkValido.
        $linkValido = $link;
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>

    <!-- Define a codificação dos caracteres da página. -->
    <meta charset="UTF-8">

    <!-- Faz a página se adaptar melhor a celulares e outros tamanhos de tela. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Validador de Links de Portfólio</title>


    <style>

        /* Aqui criamos duas variáveis para as cores principais do projeto. */
        :root {
            --cor1: #0f766e;
            --cor2: #fb7185;
        }


        /* Faz com que o tamanho dos elementos
        considere também o padding e a borda. */
        * {
            box-sizing: border-box;
        }


        /* Estilo geral da página. */
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #eef1f5;
            margin: 0;
            color: #222;
        }


        /* Caixa principal que contém o formulário. */
        .container {
            max-width: 600px;
            margin: 30px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.12);
            overflow: hidden;
        }


        /* Estilo do cabeçalho. */
        header {
            background: var(--cor1);
            color: #fff;
            padding: 22px 28px;
            border-bottom: 5px solid var(--cor2);
        }


        /* Estilo do título dentro do cabeçalho. */
        header h1 {
            margin: 0;
            font-size: 1.6rem;
        }


        /* Espaçamento da parte onde fica o formulário. */
        .conteudo {
            padding: 26px 28px;
        }


        /* Caixa que aparece quando existe algum erro. */
        .aviso-erro {
            background: #fff0f1;
            border-left: 4px solid var(--cor2);
            padding: 10px 15px;
            border-radius: 6px;
            margin-bottom: 18px;
            color: #b91c3c;
        }


        /* Estilo dos textos "Nome" e "Link". */
        form label {
            font-weight: 600;
            color: var(--cor1);
            display: block;
            margin-top: 12px;
        }


        /* Estilo dos campos onde o usuário digita. */
        form input[type="text"] {
            width: 100%;
            padding: 9px 12px;
            border: 2px solid #dcdcdc;
            border-radius: 8px;
            margin-top: 5px;
            font-size: 1rem;
            font-family: inherit;
        }


        /* Quando o usuário clica em um campo,
        a borda muda para a cor rosa. */
        form input:focus {
            border-color: var(--cor2);
            outline: none;
        }


        /* Estilo do botão Cadastrar. */
        button {
            margin-top: 18px;
            background: var(--cor2);
            color: #fff;
            border: none;
            padding: 10px 22px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }


        /* Quando o mouse passa pelo botão,
        ele fica um pouco transparente. */
        button:hover {
            opacity: 0.85;
        }


        /* Estilo da caixa que mostra o resultado quando
        o link foi validado corretamente. */
        .resultado {
            margin-top: 22px;
            padding: 14px 16px;
            background: #f0fdfa;
            border-left: 5px solid var(--cor1);
            border-radius: 8px;
        }


        /* Estilo do link "Visitar Portfólio". */
        .resultado a {
            color: var(--cor1);
            font-weight: bold;
            text-decoration: none;
        }


        /* Quando o mouse passa pelo link,
        aparece um sublinhado. */
        .resultado a:hover {
            text-decoration: underline;
        }

    </style>
</head>


<body>

    <!-- Caixa principal da página. -->
    <div class="container">


        <!-- Cabeçalho com o título do projeto. -->
        <header>
            <h1>🔗 Cadastro de Portfólio</h1>
        </header>


        <!-- Conteúdo principal da página. -->
        <div class="conteudo">


    <!--
        Se existir alguma mensagem em $erro,
        ela será mostrada para o usuário.
        
        A função e() protege a mensagem antes de exibi-la.
    -->
    <?php if ($erro): ?>
        <p class="aviso-erro"><?= e($erro) ?></p>
    <?php endif; ?>


    <!--
        Teste de segurança:
        
        Se alguém tentar colocar:
        javascript:alert(document.cookie)
        
        o link será rejeitado porque o código só permite
        links que começam com http:// ou https://.
    -->


    <!-- Formulário para cadastrar o nome e o link. -->
    <form method="POST" action="">


        <!-- Campo para digitar o nome. -->
        <label>Nome:</label>

        <!--
            O value mantém o nome digitado caso aconteça algum erro.
            A função e() também protege esse valor.
        -->
        <input
            type="text"
            name="nome"
            value="<?= e($nome) ?>"
            required
        >


        <!-- Campo para colocar o link do GitHub ou LinkedIn. -->
        <label>Link do GitHub/LinkedIn:</label>

        <input
            type="text"
            name="link"
            required
        >


        <!-- Botão para enviar o formulário. -->
        <button type="submit">Cadastrar</button>

    </form>


    <!--
        Se $linkValido tiver algum valor,
        significa que o link passou pelas validações.
    -->
    <?php if ($linkValido): ?>

        <div class="resultado">

            <!--
                Mostra uma mensagem e cria um link para o portfólio.
                
                target="_blank" faz o link abrir em uma nova aba.
                A função e() protege o endereço antes de colocá-lo no HTML.
            -->
            Perfil cadastrado:
            <a
                href="<?= e($linkValido) ?>"
                target="_blank"
            >
                Visitar Portfólio
            </a>

        </div>

    <?php endif; ?>


        </div>
    </div>

</body>
</html>