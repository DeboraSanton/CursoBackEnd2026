<?php
declare(strict_types=1);

// Aqui o projeto pega os valores digitados
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

$erro = '';
$sucesso = false;

// Aqui verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Verifica se o e-mail é válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'Digite um e-mail válido.';

    // Verifica se a senha tem pelo menos 6 caracteres
    } elseif (strlen($senha) < 6) {
        $erro = 'A senha deve ter no mínimo 6 caracteres.';

    // Compara os dados com o login correto
    } elseif ($email === 'admin@senai.br' && $senha === 'senhaSegura123') {
        $sucesso = true;

    } else {
        $erro = 'Credenciais inválidas.';
    }
}
?>

<h1>Login</h1>

<!-- Formulário do login -->
<form method="POST">

    E-mail:
    <input type="email" name="email">

    <br><br>

    Senha:
    <input type="password" name="senha">

    <br><br>

    <button>Entrar</button>

</form>

<?php if ($erro != ''): ?>

    <!-- Mostra o erro -->
    <p><?= $erro ?></p>

<?php endif; ?>

<?php if ($sucesso): ?>

    <!-- Mostra quando o login estiver correto -->
    <h2>Bem-vindo!</h2>
    <p>Login realizado com sucesso.</p>

<?php endif; ?>

<style>

body {
    background-color: #E8F5E9;
    font-family: sans-serif;
    padding: 30px;
}

h1 {
    color: #6BAF7A;
}

form, p {
    background-color: white;
    padding: 15px;
    width: 400px;
    border-radius: 8px;
}

button {
    background-color: #E8A9BE;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 5px;
    font-weight: bold;
}

</style>