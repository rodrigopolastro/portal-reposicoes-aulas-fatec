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
    require_once '../components/cabecalho-coordenador.php';
    ?>
    <main>
        <div class="titulo-inicio2">
            <h1 class="titulo-inicio2">Portal para Justificativa de Faltas</h1>
        </div>
        <div class="topoIndex">

            <div class="lateralEsquerda">
                <p class="parag-inicio"><strong>Bem-vindo(a)</strong></p>
                <p class="parag-inicio"><strong>Coordenador(a): </strong>Márcia Regina Reggiolli</p>
                <p class="parag-inicio"><strong>Matricula: </strong>0000000000005</p>
                <p class="parag-inicio"><strong>Curso: </strong>CST-DSM </p>
            </div>
            <div class="notificacao">
                <p><strong>Notificação: </strong>Nenhuma notificação.</p>
            </div>
        </div>

        <div class="lateralDireita">
            <div class="item-index">
                <p class="p-icone">Justificativas de Falta</p><br>
                <a href="lista-recebidos-faltas.php" class="link-index"><img
                        src="../../assets/images/justificativa.png" width="60px" class="icone"></a>
            </div>

            <div class="item-index">
                <p class="p-icone">Reposições de Aulas</p><br>
                <a href="lista-recebidos-reposicao.php" class="link-index"><img
                        src="../../assets/images/reposicao.png" width="60px" class="icone"></a>
            </div>

            <div class="item-index">
                <p class="p-icone">Informações do curso</p><br>
                <a href="informacoes.html" class="link-index"><img src="../../assets/images/informacoes.png"
                        width="60px" class="icone"></a>
            </div>


        </div>
    </main>
    <?php
    require_once '../components/rodape.php';
    ?>