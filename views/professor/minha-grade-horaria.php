<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/estilo-geral.css">
    <link rel="stylesheet" href="../../assets/css/utilidades.css">
    <link rel="stylesheet" href="../../assets/css/grade-horaria.css">
    <title>Minha Grade Horária</title>
</head>

<body>
    <?php
    require_once '../components/cabecalho-professor.php';
    ?>
    <div class="d-flex justify-content-center">
        <div class="w-75">
            <div class="">
                <h1>Minha Grade Horária</h1>
            </div>
            <div class="py-20">
                <?php
                require_once '../components/grade-horaria.php';
                ?>
            </div>
        </div>
    </div>
    <?php
    require_once '../components/rodape.php'
    ?>
</body>

</html>