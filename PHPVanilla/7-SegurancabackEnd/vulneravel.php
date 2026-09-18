<?php
//código vulneravel para fins de estudo de segurança
$nome = $_GET["nome"] ?? "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Vulneravel a XSS</title>
</head>
<body>
    <h1>Perfil do Usuario</h1>

    <!-- Erro Grave: o dado é impresso diretamente sem escape -->
     <p>Bem-Vindo, <?PHP echo $nome ?></p>

      <form action="seguro.php" method="GET">
        <label for="">Digite seu nome:</label>
        <input type="text" name="nome" value="<?php echo $nome ?>">
        <button type="submit">Atualizar</button>
    </form>
</body>
</html>