<?php
declare(strict_types=1);

//Aqui estão os dados do usuário que vou usar para montar o perfil
$usuario = [
    "nome" => "Carlos Eduardo",
    "idade" => 28,
    "cidade" => "Americana",
    "estado" => "SP",
    "premium" => true
];


//  Começo a variável vazia porque só vou colocar a estrela
// se o usuário tiver uma conta premium
$estrela = "";

// Aqui eu verifico se o usuário é premium
if ($usuario["premium"] === true) {
    $estrela = "⭐";
}
?>

<!-- Aqui começa o card que vai mostrar as informações do usuário -->
<div style="border: 1px solid #ccc; padding: 20px; width: 300px;">

 <!-- Mostra o nome e a estrela caso ele seja premium -->
    <h2>
        <?php echo $usuario["nome"] . $estrela; ?>
    </h2>

       <!-- Mostra a idade do usuário -->
    <p>Idade: <?php echo $usuario["idade"]; ?></p>

       <!-- Mostra a idade do usuário -->
    <p>
        Cidade:
        <?php echo $usuario["cidade"] . " - " . $usuario["estado"]; ?>
    </p>

</div>