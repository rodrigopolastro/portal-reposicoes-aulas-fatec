<?php

//Retorna o caminho absoluto de de um arquivo para evitar conflitos
//em arquivos que são incluídos em locais diferentes do código
function caminhoAbsoluto($caminhoArquivo = "")
{
    $caminhoAbsoluto =
        $_SERVER['DOCUMENT_ROOT'] . '/' .
        'portal-reposicoes-aulas-fatec' . '/' .
        $caminhoArquivo;

    return $caminhoAbsoluto;
}
