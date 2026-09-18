<?php
declare(strict_types=1);

// Essa função protege os textos antes de mostrar na página.
// O htmlspecialchars transforma caracteres especiais em texto,
// evitando que códigos HTML ou JavaScript sejam executados.
function e(string $t): string
{
    return htmlspecialchars($t, ENT_QUOTES|ENT_SUBSTITUTE|ENT_HTML5, "UTF-8");
}

// Define o caminho do arquivo onde as mensagens serão salvas.
$arq = __DIR__.'/chat.json';

// Se o arquivo existir, carrega as mensagens salvas.
// Se não existir, começa com uma lista vazia.
$mensagens = file_exists($arq) ? json_decode(file_get_contents($arq), true) : [];

// Variável que vai guardar alguma mensagem de erro.
$erro = '';

// Verifica se o formulário foi enviado pelo método POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Pega o nome digitado e remove espaços desnecessários.
    $autor = trim($_POST['autor'] ?? '');

    // Pega a mensagem digitada e remove espaços desnecessários.
    $msg = trim($_POST['mensagem'] ?? '');

    // Verifica se a mensagem passou do limite de 250 caracteres.
    if (mb_strlen($msg) > 250)
        $erro = 'Mensagem muito longa.';

    // Verifica se o nome ou a mensagem ficaram vazios.
    elseif ($autor === '' || $msg === '')
        $erro = 'Preencha os campos.';

    // Se não tiver nenhum erro, salva a mensagem.
    else {

        // Adiciona a nova mensagem no final da lista.
        // Também salva o nome, a mensagem e o horário.
        $mensagens[] = [
            'autor'=>$autor,
            'mensagem'=>$msg,
            'hora'=>date('H:i')
        ];

        // Salva todas as mensagens no arquivo JSON.
        // O JSON_UNESCAPED_UNICODE permite manter os acentos.
        file_put_contents(
            $arq,
            json_encode($mensagens, JSON_UNESCAPED_UNICODE)
        );

        // Recarrega a página depois do envio.
        // Isso evita que a mensagem seja enviada novamente
        // caso a página seja atualizada.
        header('Location: '.$_SERVER['PHP_SELF']);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <!-- Define os caracteres usados na página -->
    <meta charset="UTF-8">

    <!-- Faz a página se adaptar a diferentes tamanhos de tela -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Chat Industrial</title>

    <style>
        :root { --cor1: #374151; --cor2: #f97316; }

        /* Faz os elementos considerarem padding e borda dentro do tamanho */
        * { box-sizing: border-box; }

        /* Estilo geral da página */
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #eef1f5; margin: 0; color: #222; }

        /* Caixa principal do chat */
        .container { max-width: 600px; margin: 30px auto; background: #fff; border-radius: 12px; box-shadow: 0 6px 18px rgba(0,0,0,0.12); overflow: hidden; }

        /* Cabeçalho do chat */
        header { background: var(--cor1); color: #fff; padding: 22px 28px; border-bottom: 5px solid var(--cor2); }

        /* Título do cabeçalho */
        header h1 { margin: 0; font-size: 1.6rem; }

        /* Espaçamento da área principal */
        .conteudo { padding: 26px 28px; }

        /* Estilo da mensagem de erro */
        .aviso-erro { background: #fff7ed; border-left: 4px solid var(--cor2); padding: 10px 15px; border-radius: 6px; margin-bottom: 16px; color: #9a3412; }

        /* Caixa onde ficam as mensagens */
        .chat-box { border: 2px solid #e5e7eb; background: #f9fafb; border-radius: 10px; padding: 14px; height: 220px; overflow-y: auto; margin-bottom: 18px; }

        /* Estilo de cada mensagem */
        .chat-box p { background: #fff; border-left: 4px solid var(--cor2); border-radius: 6px; padding: 8px 12px; margin: 8px 0; }

        /* Cor do nome do usuário */
        .chat-box strong { color: var(--cor1); }

        /* Estilo do horário */
        .chat-box small { color: #888; margin-left: 4px; }

        /* Estilo dos campos do formulário */
        form input[type="text"], form textarea { width: 100%; padding: 9px 12px; border: 2px solid #dcdcdc; border-radius: 8px; margin-top: 5px; margin-bottom: 12px; font-size: 1rem; font-family: inherit; }

        /* Muda a borda quando o usuário clica no campo */
        form input:focus, form textarea:focus { border-color: var(--cor2); outline: none; }

        /* Estilo do botão */
        button { background: var(--cor2); color: #fff; border: none; padding: 10px 22px; border-radius: 8px; font-weight: bold; cursor: pointer; }

        /* Deixa o botão um pouco transparente quando passa o mouse */
        button:hover { opacity: 0.85; }
    </style>

</head>

<body>

    <div class="container">

        <!-- Cabeçalho do chat -->
        <header><h1>💬 Chat Operador x Supervisor</h1></header>

        <div class="conteudo">

    <!--
        Se existir uma mensagem de erro, ela será mostrada aqui.
        A função e() também protege o texto do erro antes de mostrar.
    -->
    <?php if ($erro): ?><p class="aviso-erro"><?= e($erro) ?></p><?php endif; ?>

    <!-- Caixa onde as mensagens enviadas aparecem -->
    <div class="chat-box">

        <!-- Percorre todas as mensagens salvas -->
        <?php foreach ($mensagens as $m): ?>

            <p>

                <!-- Mostra o nome de quem enviou a mensagem -->
                <strong><?= e($m['autor']) ?></strong>

                <!-- Mostra o horário em que a mensagem foi enviada -->
                <small>(<?= e($m['hora']) ?>)</small>:

                <!--
                    DESAFIO DE ORDEM DE EXECUÇÃO:

                    Aqui usamos:
                    nl2br(e($m['mensagem']))

                    Primeiro o e() protege a mensagem usando
                    htmlspecialchars(), evitando que códigos HTML
                    ou JavaScript digitados pelo usuário sejam executados.

                    Depois o nl2br() transforma as quebras de linha
                    da mensagem em <br>, fazendo com que elas apareçam
                    corretamente na tela.

                    Se fizéssemos:
                    e(nl2br($m['mensagem']))

                    seria um erro grave de renderização.

                    Isso acontece porque o nl2br() criaria as tags <br>
                    primeiro e depois o e() também iria transformar
                    essas tags em texto.

                    Então o navegador mostraria algo como "<br>"
                    na tela em vez de realmente quebrar a linha.

                    Por isso a ordem correta é:
                    nl2br(e($m['mensagem']))

                    Assim primeiro protegemos o texto e depois
                    transformamos as quebras de linha em <br>.
                -->

                <?= nl2br(e($m['mensagem'])) ?>

            </p>

        <?php endforeach; ?>

    </div>

    <!-- Formulário usado para enviar novas mensagens -->
    <form method="POST" action="">

        <!-- Campo para colocar o nome do usuário -->
        <input type="text" name="autor" placeholder="Seu nome" required>

        <!--
            Campo para escrever a mensagem.
            O maxlength também limita a mensagem a 250 caracteres.
        -->
        <textarea
            name="mensagem"
            rows="3"
            maxlength="250"
            placeholder="Mensagem (máx. 250 caracteres)"
            required
        ></textarea>

        <!-- Botão que envia o formulário -->
        <button type="submit">Enviar</button>

    </form>

        </div>
    </div>

</body>
</html>