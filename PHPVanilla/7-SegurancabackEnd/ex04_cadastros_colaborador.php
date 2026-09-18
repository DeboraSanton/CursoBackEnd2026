<?php
declare(strict_types=1);


// Essa função protege os textos que serão mostrados na página.
// Ela impede que códigos HTML ou JavaScript sejam executados.
function e(string $t): string {
    return htmlspecialchars(
        $t,
        ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5,
        "UTF-8"
    );
}


// Essa função limpa os dados recebidos do formulário.
// trim() remove espaços desnecessários do começo e do final.
// strip_tags() remove possíveis tags HTML digitadas pelo usuário.
function sanitizarTexto(string $d): string {
    return strip_tags(trim($d));
}


// Essa função verifica se os dados do colaborador estão corretos.
// Ela recebe os dados e devolve uma lista com os erros encontrados.
function validarColaborador(array $d): array {

    // Aqui vamos guardar os erros encontrados.
    $e = [];


    // Verifica se o nome possui pelo menos 3 caracteres.
    if (mb_strlen($d['nome']) < 3) {
        $e[] = 'Nome curto demais.';
    }


    // Verifica se o e-mail possui um formato válido.
    if (!filter_var($d['email'], FILTER_VALIDATE_EMAIL)) {
        $e[] = 'E-mail inválido.';
    }


    // Verifica se a matrícula é um número inteiro válido.
    if (filter_var($d['matricula'], FILTER_VALIDATE_INT) === false) {
        $e[] = 'Matrícula inválida.';
    }


    // Verifica se o salário foi informado como um número decimal válido.
    if (filter_var($d['salario'], FILTER_VALIDATE_FLOAT) === false) {
        $e[] = 'Salário inválido.';
    }


    // Devolve a lista de erros.
    return $e;
}


// Aqui criamos as variáveis que serão usadas no programa.
// $erros vai guardar os erros encontrados.
// $colaborador vai guardar os dados quando estiverem corretos.
$erros = [];
$colaborador = null;


// Verifica se o formulário foi enviado usando o método POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // Aqui pegamos os dados enviados pelo formulário
    // e passamos todos eles pela função sanitizarTexto().
    //
    // O array_map() aplica a mesma função para todos os valores.
    $dados = array_map(
        'sanitizarTexto',
        [
            'nome' => $_POST['nome'] ?? '',
            'email' => $_POST['email'] ?? '',
            'matricula' => $_POST['matricula'] ?? '',
            'salario' => $_POST['salario'] ?? '',
        ]
    );


    // Depois de limpar os dados, verificamos
    // se eles estão corretos.
    $erros = validarColaborador($dados);


    // Se não houver nenhum erro,
    // guardamos os dados na variável $colaborador.
    if (!$erros) {
        $colaborador = $dados;
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>

    <!-- Define a codificação dos caracteres da página. -->
    <meta charset="UTF-8">

    <!-- Faz a página se adaptar a diferentes tamanhos de tela. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Colaboradores</title>


    <style>

        /* Cores principais utilizadas no projeto. */
        :root {
            --cor1: #166534;
            --cor2: #facc15;
        }


        /* Faz com que padding e bordas sejam considerados
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


        /* Caixa principal que contém o cadastro. */
        .container {
            max-width: 600px;
            margin: 30px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.12);
            overflow: hidden;
        }


        /* Cabeçalho verde da página. */
        header {
            background: var(--cor1);
            color: #fff;
            padding: 22px 28px;
            border-bottom: 5px solid var(--cor2);
        }


        /* Estilo do título. */
        header h1 {
            margin: 0;
            font-size: 1.6rem;
        }


        /* Espaçamento do conteúdo principal. */
        .conteudo {
            padding: 26px 28px;
        }


        /* Caixa que mostra os erros encontrados. */
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


        /* Caixa que aparece quando o cadastro foi realizado corretamente. */
        .sucesso {
            background: #f0fdf4;
            border-left: 5px solid var(--cor1);
            padding: 14px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }


        /* Estilo do texto "Colaborador cadastrado com sucesso". */
        .sucesso p {
            color: var(--cor1);
            font-weight: bold;
            margin-top: 0;
        }


        /* Remove os marcadores da lista de informações. */
        .sucesso ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }


        /* Espaçamento entre as informações do colaborador. */
        .sucesso li {
            padding: 4px 0;
        }


        /* Estilo dos textos dos campos do formulário. */
        form label {
            font-weight: 600;
            color: var(--cor1);
            display: block;
            margin-top: 12px;
        }


        /* Estilo dos campos de texto. */
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
        a borda muda para a cor amarela. */
        form input:focus {
            border-color: var(--cor2);
            outline: none;
        }


        /* Estilo do botão Cadastrar. */
        button {
            margin-top: 18px;
            background: var(--cor2);
            color: #3f3300;
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

    </style>
</head>


<body>

    <!-- Caixa principal do cadastro. -->
    <div class="container">


        <!-- Cabeçalho da página. -->
        <header>
            <h1>🧑‍💼 Cadastro de Colaborador</h1>
        </header>


        <!-- Conteúdo principal. -->
        <div class="conteudo">


    <!--
        Se existir algum erro, mostramos uma lista
        com todas as mensagens encontradas.
    -->
    <?php if ($erros): ?>

        <ul class="erros">

            <?php foreach ($erros as $erro): ?>

                <!--
                    Mostra cada erro.
                    A função e() protege o texto antes de exibi-lo.
                -->
                <li><?= e($erro) ?></li>

            <?php endforeach; ?>

        </ul>

    <?php endif; ?>


    <!--
        Se $colaborador tiver dados,
        significa que o cadastro foi validado corretamente.
    -->
    <?php if ($colaborador): ?>

        <div class="sucesso">

            <!-- Mensagem de sucesso. -->
            <p>Colaborador cadastrado com sucesso:</p>


            <!-- Lista com os dados cadastrados. -->
            <ul>

                <!-- Mostra o nome do colaborador. -->
                <li>
                    Nome: <?= e($colaborador['nome']) ?>
                </li>


                <!-- Mostra o e-mail do colaborador. -->
                <li>
                    E-mail: <?= e($colaborador['email']) ?>
                </li>


                <!-- Mostra a matrícula do colaborador. -->
                <li>
                    Matrícula: <?= e($colaborador['matricula']) ?>
                </li>


                <!-- Mostra o salário informado. -->
                <li>
                    Salário: <?= e($colaborador['salario']) ?>
                </li>

            </ul>

        </div>

    <?php endif; ?>


    <!-- Formulário de cadastro. -->
    <form method="POST" action="">


        <!-- Campo para o nome. -->
        <label>Nome:</label>
        <input
            type="text"
            name="nome"
            required
        >


        <!-- Campo para o e-mail. -->
        <label>E-mail:</label>
        <input
            type="text"
            name="email"
            required
        >


        <!-- Campo para a matrícula. -->
        <label>Matrícula:</label>
        <input
            type="text"
            name="matricula"
            required
        >


        <!-- Campo para o salário. -->
        <label>Salário:</label>
        <input
            type="text"
            name="salario"
            required
        >


        <!-- Botão para enviar o formulário. -->
        <button type="submit">Cadastrar</button>

    </form>


        </div>
    </div>

</body>
</html>