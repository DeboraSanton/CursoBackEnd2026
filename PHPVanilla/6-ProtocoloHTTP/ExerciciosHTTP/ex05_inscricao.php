<?php
declare(strict_types=1);

// Aqui o projeto pega os valores do formulário
$nome = $_POST['nome_candidato'] ?? '';
$idade = $_POST['idade'] ?? '';
$curso = $_POST['curso_desejado'] ?? '';

$erros = [];

// Cursos que podem ser escolhidos
$cursosPermitidos = [
    'Desenvolvimento de Sistemas',
    'Mecatrônica',
    'Redes'
];

// Aqui verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Verifica se o nome tem pelo menos 5 caracteres
    $nome = trim($nome);

    if (strlen($nome) < 5) {
        $erros['nome'] = 'O nome deve ter pelo menos 5 caracteres.';
    }

    // Verifica se a idade é maior ou igual a 16
    if (!filter_var($idade, FILTER_VALIDATE_INT) || $idade < 16) {
        $erros['idade'] = 'A idade deve ser maior ou igual a 16 anos.';
    }

    // Verifica se o curso escolhido é válido
    if (!in_array($curso, $cursosPermitidos, true)) {
        $erros['curso'] = 'Selecione um curso válido.';
    }

    // Verifica se os termos foram aceitos
    if (!isset($_POST['aceite_termos'])) {
        $erros['termos'] = 'Você deve aceitar os termos.';
    }
}
?>

<h1>Inscrição - SENAI</h1>

<!-- Formulário de inscrição -->
<form method="POST">

    Nome:
    <input type="text" name="nome_candidato">

    <?php if (isset($erros['nome'])): ?>
        <p><?= $erros['nome'] ?></p>
    <?php endif; ?>

    <br>

    Idade:
    <input type="number" name="idade">

    <?php if (isset($erros['idade'])): ?>
        <p><?= $erros['idade'] ?></p>
    <?php endif; ?>

    <br>

    Curso:
    <select name="curso_desejado">
        <option value="">Selecione</option>
        <option value="Desenvolvimento de Sistemas">
            Desenvolvimento de Sistemas
        </option>
        <option value="Mecatrônica">Mecatrônica</option>
        <option value="Redes">Redes</option>
    </select>

    <?php if (isset($erros['curso'])): ?>
        <p><?= $erros['curso'] ?></p>
    <?php endif; ?>

    <br>

    <!-- Checkbox dos termos -->
    <input type="checkbox" name="aceite_termos">
    Aceito os termos

    <?php if (isset($erros['termos'])): ?>
        <p><?= $erros['termos'] ?></p>
    <?php endif; ?>

    <br><br>

    <button>Inscrever-se</button>

</form>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($erros)): ?>

    <!-- Se não tiver erros, mostra que deu certo -->
    <h2>Inscrição realizada com sucesso!</h2>

    <p>Candidato: <?= $nome ?></p>
    <p>Curso: <?= $curso ?></p>

<?php endif; ?>

<style>

body {
    background-color: #F3E5F5;
    font-family: sans-serif;
    padding: 30px;
}

h1, h2 {
    color: #7B4FA3;
}

form, p {
    background-color: #DCC6E8;
    padding: 15px;
    width: 400px;
    border-radius: 8px;
}

input, select {
    padding: 7px;
    border: 1px solid #7B4FA3;
    border-radius: 5px;
}

button {
    background-color: #7B4FA3;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 5px;
    font-weight: bold;
}

</style>