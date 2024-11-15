<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Grade Horária</title>
</head>
<body>
    <?php
    require_once '../components/cabecalho-professor.php';
    ?>
    <main>
        <h1>Grade Horária</h1>
        <div class="topo-form">
            <?php
            require_once 'grade-horaria.php';
            ?>
        </div>
    </main>    
    <?php
    require_once '../components/rodape.php'
    ?>
</body>
</html>