<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/utilidades.css">
    <link rel="stylesheet" href="../../assets/css/confirma-envio.css">
    <title>Confirmar Envio</title>
</head>

<body>
    <h1>Revise os Dados Preenchidos antes de prosseguir</h1>
    <div class="w-100 vh-100">
        <iframe src=" ../../private/temp_file.pdf" class="w-75 h-100">
            Seu navegador não suporta visualização de PDF.
            <a href="../../private/temp_file.pdf">Clique aqui para visualizar o PDF</a>.
        </iframe>
    </div>
    <div class="d-flex justify-content-center align-items-center py-20">
        <div class="px-20">
            <a href="./enviar-justificativa.php?editar_justificativa=<?= $_GET['id_justificativa'] ?>">
                <button class="py-20">Editar Informações</button>
            </a>
        </div>
        <div class="px-20">
            <a href="./formulario-enviado.html">
                <button id="btnConfirmarEnvio" class="py-20 bg-vermelho">Confirmar Envio</button>
            </a>
        </div>
    </div>
</body>

</html>