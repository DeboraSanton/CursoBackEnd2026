<?php
declare(strict_types=1);

// Essa função protege os textos que serão mostrados na página.
// Ela evita que códigos HTML ou JavaScript digitados pelo usuário
// sejam executados.
function e(string $t): string {
    return htmlspecialchars(
        $t,
        ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5,
        "UTF-8"
    );
}


// Pega o que foi digitado no campo de busca.
// O trim() remove espaços desnecessários do começo e do final.
$busca = trim($_GET['q'] ?? '');


// Aqui temos a lista de produtos que poderão ser encontrados.
$produtos = [
    'Notebook',
    'Mouse',
    'Teclado Mecânico',
    'Monitor 24"',
    'Cadeira Gamer'
];


// Verifica se existe alguma coisa sendo pesquisada.
// Se tiver, procura o texto digitado dentro dos nomes dos produtos.
// Se não tiver nada digitado, deixa os resultados vazios.
$resultados = $busca !== ''
    ? array_filter(
        $produtos,
        fn($p) => stripos($p, $busca) !== false
    )
    : [];

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <!-- Define a codificação dos caracteres da página. -->
    <meta charset="UTF-8">

    <!-- Faz a página se adaptar a diferentes tamanhos de tela. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Busca de Produtos</title>


    <style>

        /* Cores principais usadas no projeto. */
        :root {
            --cor1: #6d28d9;
            --cor2: #ec4899;
        }


        /* Faz com que padding e bordas sejam incluídos
        no tamanho total dos elementos. */
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


        /* Caixa principal onde fica o sistema de busca. */
        .container {
            max-width: 600px;
            margin: 30px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.12);
            overflow: hidden;
        }


        /* Cabeçalho roxo da página. */
        header {
            background: var(--cor1);
            color: #fff;
            padding: 22px 28px;
            border-bottom: 5px solid var(--cor2);
        }


        /* Estilo do título do cabeçalho. */
        header h1 {
            margin: 0;
            font-size: 1.6rem;
        }


        /* Espaçamento do conteúdo principal. */
        .conteudo {
            padding: 26px 28px;
        }


        /* Organiza o campo de busca e o botão lado a lado. */
        .busca-form {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }


        /* Estilo do campo onde o produto será pesquisado. */
        .busca-form input[type="text"] {
            flex: 1;
            padding: 10px 14px;
            border: 2px solid #dcdcdc;
            border-radius: 8px;
            font-size: 1rem;
            font-family: inherit;
        }


        /* Quando o usuário clica no campo,
        a borda muda para a cor rosa. */
        .busca-form input:focus {
            border-color: var(--cor2);
            outline: none;
        }


        /* Estilo do botão Buscar. */
        .busca-form button {
            background: var(--cor2);
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }


        /* Quando o mouse passa pelo botão,
        ele fica um pouco transparente. */
        .busca-form button:hover {
            opacity: 0.85;
        }


        /* Estilo do termo que o usuário pesquisou. */
        .termo-buscado {
            color: var(--cor1);
            font-weight: 600;
        }


        /* Remove os marcadores padrão da lista. */
        ul.resultados {
            list-style: none;
            padding: 0;
        }


        /* Estilo de cada produto encontrado. */
        ul.resultados li {
            background: #faf5ff;
            border-left: 4px solid var(--cor1);
            padding: 10px 14px;
            margin: 8px 0;
            border-radius: 6px;
        }


        /* Estilo da mensagem quando nenhum produto é encontrado. */
        .vazio {
            color: #888;
            font-style: italic;
        }

    </style>
</head>


<body>

    <!-- Caixa principal da página. -->
    <div class="container">


        <!-- Cabeçalho da página. -->
        <header>
            <h1>🔍 Buscar Produtos</h1>
        </header>


        <!-- Conteúdo principal. -->
        <div class="conteudo">


    <!--
        Formulário de busca.
        O método GET faz com que o termo pesquisado
        apareça na URL como ?q=...
    -->
    <form class="busca-form" method="GET" action="">

        <!--
            Campo onde o usuário digita o nome do produto.
            
            O value mantém o que foi digitado depois da busca.
            A função e() protege esse conteúdo.
        -->
        <input
            type="text"
            name="q"
            value="<?= e($busca) ?>"
            placeholder="Digite o nome do produto"
        >

        <!-- Botão que envia a pesquisa. -->
        <button type="submit">Buscar</button>

    </form>


    <!--
        Só mostra os resultados se o usuário
        realmente tiver digitado alguma coisa.
    -->
    <?php if ($busca !== ''): ?>


        <!--
            Mostra para o usuário qual termo ele pesquisou.
            A função e() protege o texto digitado.
        -->
        <p>
            Você buscou por:
            <span class="termo-buscado"><?= e($busca) ?></span>
        </p>


        <!--
            Teste de segurança:
            
            Se alguém tentar pesquisar:
            "><script>alert('XSS')</script>
            
            o código não será executado porque usamos
            a função e() ao mostrar o texto.
        -->


        <!-- Verifica se nenhum produto foi encontrado. -->
        <?php if (!$resultados): ?>

            <!-- Mensagem mostrada quando não existe resultado. -->
            <p class="vazio">Nenhum produto encontrado.</p>


        <?php else: ?>

            <!--
                Se houver resultados, criamos uma lista
                com os produtos encontrados.
            -->
            <ul class="resultados">

                <?php foreach ($resultados as $p): ?>

                    <!--
                        Mostra cada produto encontrado.
                        A função e() também protege o nome do produto.
                    -->
                    <li><?= e($p) ?></li>

                <?php endforeach; ?>

            </ul>

        <?php endif; ?>


    <?php endif; ?>


        </div>
    </div>

</body>
</html>