<?php
declare(strict_types=1);

// Essa função serve para proteger os textos que aparecem na página.
// Ela transforma caracteres especiais em texto normal para evitar
// que alguém consiga colocar códigos HTML ou JavaScript no mural.
function e(string $texto): string {
    return htmlspecialchars($texto, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, "UTF-8");
}

// Aqui estamos definindo onde o arquivo que guarda os recados ficará.
// __DIR__ representa a pasta onde este arquivo PHP está.
$arquivo = __DIR__ . '/recados.json';

// Se o arquivo recados.json existir, pegamos os recados que estão nele.
// Caso contrário, começamos com uma lista vazia.
$recados = file_exists($arquivo) ? json_decode(file_get_contents($arquivo), true) : [];

// Aqui vamos guardar possíveis erros encontrados no formulário.
$erros = [];


// Verifica se o formulário foi enviado usando o método POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Pegamos o nome digitado e tiramos os espaços desnecessários do começo e do final.
    $nome = trim($_POST['nome'] ?? '');

    // Pegamos a mensagem digitada e também retiramos os espaços desnecessários.
    $mensagem = trim($_POST['mensagem'] ?? '');


    // Verifica se o nome possui pelo menos 3 caracteres.
    // Se não tiver, adicionamos uma mensagem de erro.
    if (mb_strlen($nome) < 3) {
        $erros[] = "Nome precisa ter no mínimo 3 caracteres.";
    }

    // Verifica se a mensagem possui pelo menos 5 caracteres.
    if (mb_strlen($mensagem) < 5) {
        $erros[] = "Mensagem precisa ter no mínimo 5 caracteres.";
    }


    // Se não tiver nenhum erro, podemos salvar o recado.
    if (empty($erros)) {

        // Adicionamos o novo recado na lista.
        // Também salvamos a data e a hora em que ele foi enviado.
        $recados[] = [
            'nome' => $nome,
            'mensagem' => $mensagem,
            'data' => date('d/m/Y H:i')
        ];

        // Transformamos a lista de recados em JSON
        // e salvamos dentro do arquivo recados.json.
        file_put_contents(
            $arquivo,
            json_encode($recados, JSON_UNESCAPED_UNICODE)
        );

        // Depois de salvar, atualizamos a página.
        // Isso evita que o mesmo recado seja enviado novamente
        // se a página for atualizada.
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">

    <!-- Faz a página se adaptar melhor a celulares e outros tamanhos de tela. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mural de Recados Blindado</title>

    <style>

        /* Aqui criamos duas variáveis para facilitar o uso das cores. */
        :root {
            --cor1: #0c2c57;
            --cor2: #a9c6ec;
        }

        /* Faz com que padding e bordas sejam considerados no tamanho dos elementos. */
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

        /* Caixa principal onde ficará todo o mural. */
        .container {
            max-width: 700px;
            margin: 30px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.12);
            overflow: hidden;
        }

        /* Cabeçalho azul do mural. */
        header {
            background: var(--cor1);
            color: #fff;
            padding: 22px 28px;
            border-bottom: 5px solid var(--cor2);
        }

        /* Tamanho do título do cabeçalho. */
        header h1 {
            margin: 0;
            font-size: 1.6rem;
        }

        /* Espaçamento do conteúdo principal. */
        .conteudo {
            padding: 26px 28px;
        }

        /* Estilo da caixa que aparece quando existe algum erro. */
        .erros {
            background: #fdecea;
            border-left: 4px solid #d33;
            padding: 10px 15px;
            border-radius: 6px;
            margin-bottom: 18px;
            list-style: none;
        }

        /* Cor das mensagens de erro. */
        .erros li {
            color: #a30000;
        }

        /* Estilo dos textos "Nome" e "Mensagem" do formulário. */
        form label {
            font-weight: 600;
            color: var(--cor1);
            display: block;
            margin-top: 12px;
        }

        /* Estilo dos campos de nome e mensagem. */
        form input[type="text"],
        form textarea {
            width: 100%;
            padding: 9px 12px;
            border: 2px solid #dcdcdc;
            border-radius: 8px;
            margin-top: 5px;
            font-size: 1rem;
            font-family: inherit;
        }

        /* Quando o usuário clicar em um campo,
        a borda muda para a segunda cor do projeto. */
        form input[type="text"]:focus,
        form textarea:focus {
            border-color: var(--cor2);
            outline: none;
        }

        /* Estilo do botão de enviar. */
        button {
            margin-top: 16px;
            background: var(--cor2);
            color: #08144b;
            border: none;
            padding: 10px 22px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            font-size: 0.95rem;
        }

        /* Quando o mouse passa pelo botão, ele fica um pouco transparente. */
        button:hover {
            opacity: 0.85;
        }

        /* Estilo do título "Recados". */
        h2 {
            color: var(--cor1);
            border-bottom: 3px solid var(--cor2);
            padding-bottom: 6px;
            margin-top: 30px;
        }

        /* Estilo de cada recado que aparece no mural. */
        .recado {
            border-left: 5px solid var(--cor2);
            background: #f9fafb;
            margin: 14px 0;
            padding: 14px 16px;
            border-radius: 8px;
        }

        /* Cor do nome da pessoa que enviou o recado. */
        .recado strong {
            color: var(--cor1);
        }

        /* Cor e tamanho da data do recado. */
        .recado small {
            color: #888;
        }

    </style>
</head>

<body>

    <!-- Essa é a caixa principal que envolve todo o mural. -->
    <div class="container">

        <!-- Cabeçalho do mural. -->
        <header>
            <h1>📋 Mural de Recados</h1>
        </header>

        <!-- Área onde ficam o formulário e os recados. -->
        <div class="conteudo">


    <!-- Verifica se existe algum erro no formulário. -->
    <?php if (!empty($erros)): ?>

        <!-- Lista os erros encontrados. -->
        <ul class="erros">

            <?php foreach ($erros as $erro): ?>

                <!-- Mostra cada erro usando a função e() para manter a segurança. -->
                <li><?= e($erro) ?></li>

            <?php endforeach; ?>

        </ul>

    <?php endif; ?>


    <!-- Formulário usado para enviar um novo recado. -->
    <form method="POST" action="">

        <!-- Campo para digitar o nome. -->
        <label>Nome:</label>
        <input type="text" name="nome" required>

        <!-- Campo para digitar a mensagem. -->
        <label>Mensagem:</label>
        <textarea name="mensagem" rows="4" required></textarea>

        <!-- Botão que envia o formulário. -->
        <button type="submit">Enviar recado</button>

    </form>


    <!--
        Teste de segurança:
        Se alguém tentar escrever:
        <script>alert('Mural Invadido')</script>

        o código será mostrado como texto e não será executado,
        porque usamos a função e() antes de mostrar o conteúdo.
    -->


    <!-- Título da lista de recados. -->
    <h2>Recados</h2>


    <!--
        Percorre todos os recados.
        array_reverse() faz com que os recados mais recentes
        apareçam primeiro.
    -->
    <?php foreach (array_reverse($recados) as $recado): ?>

        <!-- Caixa de cada recado. -->
        <div class="recado">

            <!-- Mostra o nome de quem enviou o recado. -->
            <strong><?= e($recado['nome']) ?></strong>

            <!-- Mostra a data e a hora em que o recado foi enviado. -->
            <small> — <?= e($recado['data']) ?></small>

            <!--
                Mostra a mensagem.
                nl2br() faz com que as quebras de linha digitadas
                no textarea também apareçam na página.
                
                A função e() é usada antes para evitar que códigos
                HTML ou JavaScript sejam executados.
            -->
            <p><?= nl2br(e($recado['mensagem'])) ?></p>

        </div>

    <?php endforeach; ?>


        </div>
    </div>

</body>
</html>