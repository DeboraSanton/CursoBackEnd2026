<?php
declare(strict_types=1);

// Aqui eu coloquei os filmes que vão ser usados no exercício
// Cada filme tem um título, gênero e classificação de idade
$filmes = [
    ["titulo" => "Matrix", "genero" => "Ficção", "classificacao_idade" => 16],
    ["titulo" => "Shrek", "genero" => "Animação", "classificacao_idade" => 0],
    ["titulo" => "Deadpool", "genero" => "Ação", "classificacao_idade" => 18],
    ["titulo" => "Procurando Nemo", "genero" => "Animação", "classificacao_idade" => 0],
    ["titulo" => "Vingadores", "genero" => "Ação", "classificacao_idade" => 12]
];

// Aqui eu uso o array_filter para pegar somente os filmes
// que possuem classificação menor ou igual a 12 anos
// A arrow function faz essa verificação para cada filme
$filmesInfantis = array_filter(
    $filmes,
    fn($filme) => $filme["classificacao_idade"] <= 12
);
// Aqui eu mostro somente os filmes que passaram pelo filtro
echo "<h2>Filmes para crianças</h2>";

foreach ($filmesInfantis as $filme) {
    // Aqui eu mostro somente os filmes que passaram pelo filtro
    echo "Título: " . $filme["titulo"] . "<br>";

     // Mostra o gênero do filme
    echo "Gênero: " . $filme["genero"] . "<br>";

      // Mostra a classificação do filme
    echo "Classificação: " . $filme["classificacao_idade"] . " anos<br><br>";
}
?>