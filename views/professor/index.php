<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../assets/css/estilo-geral.css">
    <link rel="stylesheet" href="../../assets/css/index.css">
    <title>Início</title>
</head>

<body>
    <?php
    require_once '../components/cabecalho-professor.php';
    ?>
    <main>
        <div class="titulo-inicio2">
            <h1 class="titulo-inicio2">Portal para Justificativa de Faltas</h1>
        </div>
        <div class="corpo-inicio">

            <div class="lateralEsquerda">
                <h1 class="titulo-inicio">Bem-vindo(a)</h1>
                <p class="parag-inicio">Professor(a)</p><br>
                <p class="parag-inicio">Ana Célia Ribeiro Bizigato Portes</p><br>
                <p class="parag-inicio">Matricula: 0000000000005</p><br>
                <p class="parag-inicio">Docente no(s) curso(s): </p><br><br>
                <p class="parag-inicio">CST-DSM </p><br><br>
            </div>

            <div class="lateralDireita">

                <div class="item-index">
                    <p class="p-icone">Enviar Justificativa de Falta</p><br>
                    <a href="./enviar-justificativa.php" class="link-index"><img src="../../assets/images/editar (1).png"
                            width="60px" class="icone"></a>
                </div>

                <div class="item-index">
                    <p class="p-icone">Enviar Reposição de Aulas</p><br>
                    <a href="./enviar-reposicao.php" class="link-index"><img src="../../assets/images/calendario.png"
                            width="60px" class="icone"></a>
                </div>

                <div class="item-index">
                    <p class="p-icone">Ver formulários enviados</p><br>
                    <a href="./lista-enviados.php" class="link-index"><img src="../../assets/images/comente.png"
                            width="60px" class="icone"></a>
                </div>

                <div class="item-index">
                    <p class="p-icone">Sair</p><br>
                    <a href="../login.html" class="link-index"><img src="../../assets/images/poder.png" width="60px"
                            class="icone"></a>
                </div>

            </div>
        </div>
    </main>
    <?php
    require_once '../components/rodape.php';
    ?>