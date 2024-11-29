<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../assets/css/estilo-geral.css">
    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/utilidades.css">
    <title>Início</title>
</head>

<body>
    <?php
    require_once '../components/cabecalho-professor.php';
    ?>
    <main>
        <div class="d-flex justify-content-center">
            <div class="w-75">
                <div class="titulo-inicio2">
                    <h1 class="titulo-inicio2">Portal para Justificativa de Faltas</h1>
                </div>
                <div class="topoIndex">

                    <div class="lateralEsquerda">
                        <p class="parag-inicio"><strong>Bem-vindo(a)</strong></p>
                        <p class="parag-inicio"><strong>Professor(a): </strong>Ana Célia Ribeiro Bizigato Portes</p>
                        <p class="parag-inicio"><strong>Matricula: </strong>0000000000005</p>
                        <p class="parag-inicio"><strong>Docente no(s) curso(s): </strong>CST-DSM </p>
                    </div>
                    <div class="notificacao">
                        <p class="text-center" style="font-size: 25px; margin:0 0 20px 0; font-weight: 500">Notificações</p>
                        <p style="margin: 0">Nenhuma notificação.</p>
                    </div>
                </div>

                <div class="lateralDireita">
                    <div class="item-index">
                        <a href="./enviar-justificativa.php" class="link-index">
                            <img src="../../assets/images/editar (1).png"
                                width="60px" class="icone">
                        </a>
                        <p class="p-icone text-center w-75 mb-0">Enviar Justificativa de Falta</p>
                    </div>
                    <div class="item-index">
                        <a href="./lista-enviados.php" class="link-index">
                            <img src="../../assets/images/comente.png"
                                width="60px" class="icone">
                        </a>
                        <p class="p-icone text-center w-75 mb-0">Ver formulários enviados</p>
                    </div>
                    <div class="item-index">
                        <a href="./minha-grade-horaria.php" class="link-index">
                            <img src="../../assets/images/calendario.png"
                                width="60px" class="icone">
                        </a>
                        <p class="p-icone text-center w-75 mb-0">Minha Grade Horária</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
    <?php
    require_once '../components/rodape.php';
    ?>
</body>

</html>