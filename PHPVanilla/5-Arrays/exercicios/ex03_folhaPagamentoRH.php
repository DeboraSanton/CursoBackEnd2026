<?php
declare(strict_types=1);
// Aqui eu coloquei os funcionários da empresa
// Cada funcionário tem seu id, nome, cargo e salário
$funcionarios = [
    ["id" => 1, "nome" => "Ana Souza", "cargo" => "Dev Front-End", "salario" => 4500.00],
    ["id" => 2, "nome" => "Bruno Costa", "cargo" => "Dev Back-End", "salario" => 5200.00],
    ["id" => 3, "nome" => "Carla Dias", "cargo" => "Tech Lead", "salario" => 8900.00],
    ["id" => 4, "nome" => "Daniel Silva", "cargo" => "Estagiário", "salario" => 1500.00]
];

// Começo o total da folha com 0
// Depois vou somar cada salário dentro do foreach
$totalFolha = 0;
?>

<!-- Aqui eu crio a tabela para organizar os funcionários -->
<table border="1">


    <!-- Essa primeira linha é o título de cada coluna -->
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Cargo</th>
        <th>Salário</th>
    </tr>

    <?php
   
   // Aqui eu passo por todos os funcionários do array
    // e mostro os dados de cada um em uma nova linha
    foreach ($funcionarios as $funcionario) {
    ?>

        <tr>

            <!-- Mostra o ID do funcionário -->
            <td><?php echo $funcionario["id"]; ?></td>

              <!-- Mostra o nome do funcionário -->
            <td><?php echo $funcionario["nome"]; ?></td>


            <!-- Mostra o cargo do funcionário -->
            <td><?php echo $funcionario["cargo"]; ?></td>
            <td>
                <?php
               
                // Aqui eu mostro o salário no formato de dinheiro brasileiro
                echo "R$ " . number_format($funcionario["salario"], 2, ',', '.');

                  // Também aproveito para somar esse salário ao total da folha
                $totalFolha += $funcionario["salario"];
                ?>
            </td>
        </tr>

    <?php
    }
    ?>

  <!-- Aqui eu mostro o valor total que a empresa gasta com os salários -->
    <tr>
        <td>Total da folha</td>
        <td></td>
        <td></td>
        <td>
            <?php
            // Mostra o total dos salários
            echo "R$ " . number_format($totalFolha, 2, ',', '.');
            ?>
        </td>
    </tr>
</table>