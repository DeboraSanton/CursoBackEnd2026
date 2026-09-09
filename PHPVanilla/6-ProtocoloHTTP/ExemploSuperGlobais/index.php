<?php
// Aplicação de página unica de variaveis superGlobais ($_GET, $_POST, $_SERVER)
declare(strict_types=1);

//Dados Simulados
$produtos = [
    ['nome' => 'Teclado USB', 'categoria' => 'Eletrônicos', 'preco' => 80.00],
    ['nome' => 'Mouse sem fio', 'categoria' => 'Eletrônicos', 'preco' => 65.00],
    ['nome' => 'Monitor 24 polegadas', 'categoria' => 'Eletrônicos', 'preco' => 899.90],
    ['nome' => 'Fone de ouvido', 'categoria' => 'Eletrônicos', 'preco' => 120.00],
    ['nome' => 'Webcam HD', 'categoria' => 'Eletrônicos', 'preco' => 180.00],
    ['nome' => 'Caixa de som', 'categoria' => 'Eletrônicos', 'preco' => 150.00],
    ['nome' => 'Pen Drive 64GB', 'categoria' => 'Eletrônicos', 'preco' => 45.00],
    ['nome' => 'Carregador USB', 'categoria' => 'Eletrônicos', 'preco' => 55.00],
    ['nome' => 'Caderno', 'categoria' => 'Papelaria', 'preco' => 25.00],
    ['nome' => 'Caneta azul', 'categoria' => 'Papelaria', 'preco' => 3.50],
    ['nome' => 'Lápis', 'categoria' => 'Papelaria', 'preco' => 2.00],
    ['nome' => 'Borracha', 'categoria' => 'Papelaria', 'preco' => 2.50],
    ['nome' => 'Marca-texto', 'categoria' => 'Papelaria', 'preco' => 6.00],
    ['nome' => 'Régua 30cm', 'categoria' => 'Papelaria', 'preco' => 5.00],
    ['nome' => 'Agenda', 'categoria' => 'Papelaria', 'preco' => 35.00],
    ['nome' => 'Mochila', 'categoria' => 'Acessórios', 'preco' => 150.00],
    ['nome' => 'Garrafa térmica', 'categoria' => 'Acessórios', 'preco' => 70.00],
    ['nome' => 'Estojo', 'categoria' => 'Acessórios', 'preco' => 30.00],
    ['nome' => 'Relógio digital', 'categoria' => 'Acessórios', 'preco' => 90.00],
    ['nome' => 'Óculos de sol', 'categoria' => 'Acessórios', 'preco' => 60.00],
];

//Declarar algumas Variáveis
$mensagemSucesso = "";
$erro = [];

$nome = "";
$email = "";

//Processamento usando o GET (busca na lista de produtos) = index.php?produto=mouse&preco_maximo=100

$buscaProduto = trim((string) ($_GET["produto"] ?? "")); //verificação/operação de nulidade de uma variavel (coalescência nula)
$precoMaximoTexto = trim((string) ($_GET["preco_maximo"] ?? ""));

$produtosFiltrados = $produtos; //filtro para a linha de produtos

if ($buscaProduto !== "" || $precoMaximoTexto !== ""){
    $produtosFiltrados = array_filter($produtos,
                            function (array $produto) use ($buscaProduto, $precoMaximoTexto):bool{
                                $nomeCorrespondente = true;
                                $precoCorrespondente = true;
                                if($buscaProduto !== ""){
                                    $nomeCorrespondente = str_contains(
                                        strtolower(($produto["nome"])),
                                        strtolower($buscaProduto)
                                    );
                                }

                                if ($precoMaximoTexto !== ""){
                                    $precoMaximo = filter_var(
                                    $precoMaximoTexto, FILTER_VALIDATE_FLOAT
                                    );
                                    $precoCorrespondente = $precoMaximo !==false && $produto["preco"] <= $precoMaximo;
                                }
                                return $nomeCorrespondente && $precoCorrespondente;
                            });          

    
}

//Processamento do POST

if($_SERVER["REQUEST_METHOD"] === "POST"){
    //Recuperar os Dados de um formulario
    $nome = trim((string) ($_POST["nome"] ?? ""));
    $email = trim((string) ($_POST["email"] ?? ""));

    //Validação do servidor
    
    if(strlen($nome) < 3){
        $erro["nome"] = "Informe um nome com pelo menos 3 caracteres";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $erro["email"] = "Informe um email Válido";
    }

    //SE não existir erros, o cadastro será realizado
    if($erro ===[]){
        $mensagemSucesso = "Cadastro Realizado com Sucesso!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo de GET e POST no PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
    <h1>Exemplo prático : GET e POST</h1>
    <section>
        <p>Os Filtro serão enviados pela URL (GET)</p>
    </section>
    
    <form action="index.php" method="get">
        <label for ="produto">Nome do produto</label>
        <input type="text" name="produto" id="produto" placeholder="Escreva o nome de um produto">

        <label for="preco_maximo">Preçp Máximo</label>
        <input type="number" name="preco_maximo" id="preco_maximo" step="0.01" placeholder="100">

         <button type="submit">Pesquisar</button>
    </form>

    <h2>Lista de Produtos Filtrados</h2>
    <p>Observer que os dados da pesquisa aparecem na URL</p>

    <?php if ($produtosFiltrados === []): ?>
            <p class="vazio">Nenhum produto encontrado.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Categoria</th>
                        <th>Preço</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($produtosFiltrados as $produto): ?>
                    <tr>
                        <td><?=($produto['nome']) ?></td>
                        <td><?=($produto['categoria']) ?></td>
                        <td>
                            R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

    </section>

    <section>
        <h2>Cadastro de Alunos com POST</h2>
        <p> Os dados serão salvos no corpo da requisição e não aparecerão na URL</p>

        <?php if($mensagemSucesso !== "") :?>
            <div class="sucesso">
                <?= $nome ?>
                <?= $email ?>
            </div>
            <?php endif; ?>

           <form action="index.php" method="POST" novalidate>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" placeholder="Digite seu Nome">
            <?php if(isset($erro["nome"])): ?>
                <div class="erro">
                    <?= $erro["nome"] ?>
                </div>
            <?php endif; ?>
            
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Digite seu Email">
            <?php if(isset($erro["email"])): ?>
                <div class="erro">
                    <?= $erro["email"] ?>
                </div>
            <?php endif; ?>
            
            <button type="submit">Cadas</button>


           </form>    
    </section>
</main>

</body>
</html>
 