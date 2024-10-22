<?php

require_once $_SERVER['DOCUMENT_ROOT'] . 
    '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('models/tipos-faltas.php');

if (isset($_POST['acao'])) {
    controllerTiposFaltas($_POST['acao']);
}

function controllerTiposFaltas($acao)
{
    switch ($acao) {
        case 'selectTiposFaltas':
            $tiposFaltas = buscaTiposFaltas();
            return $tiposFaltas;
            break;

        default:
            $msgErro = "Ação inválida informada: '" . $acao . "'";
            return $msgErro;
    }
}