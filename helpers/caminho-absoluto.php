<?php

function caminhoAbsoluto($caminhoArquivo = "")
{
    $caminhoAbsoluto =
        $_SERVER['DOCUMENT_ROOT'] . '/' .
        'portal-reposicoes-aulas-fatec' . '/' .
        $caminhoArquivo;

    return $caminhoAbsoluto;
}
