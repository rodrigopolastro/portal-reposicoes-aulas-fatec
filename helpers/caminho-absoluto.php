<?php

//Retorna o caminho absoluto de de um arquivo para evitar conflitos
//em arquivos que são incluídos em locais diferentes do código
function caminhoAbsoluto($caminhoArquivo = "", $usarWebPath = false)
{
    if ($usarWebPath) {
        $raiz = '/'; #localhost/
    } else {
        $raiz = $_SERVER['DOCUMENT_ROOT'] . '/';
    }

    $caminhoAbsoluto =
        $raiz .
        'portal-reposicoes-aulas-fatec' . '/' .
        $caminhoArquivo;

    return $caminhoAbsoluto;
}
