<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('models/tipos-faltas.php');

$jsonRequest = json_decode(file_get_contents('php://input'), true);

if (isset($jsonRequest['acao_tipos_faltas'])) {
    $params = $jsonRequest['params'] ?? [];
    echo json_encode(controllerTiposFaltas($jsonRequest['acao_tipos_faltas'], $params));
} else if (isset($_POST['acao_tipos_faltas'])) {
    $params = $_POST ?? [];
    echo json_encode(controllerTiposFaltas($_POST['acao_tipos_faltas'], $params));
}

function controllerTiposFaltas($acao_tipos_faltas, $params = [])
{
    switch ($acao_tipos_faltas) {
        case 'busca_tipos_faltas':
            $tiposFaltas = selectTiposFaltas();
            return $tiposFaltas;
            break;

        default:
            return [
                'sucesso' => false,
                'msgErro' => "Ação para Tipos de Faltas inválida informada: '" . $acao_tipos_faltas . "'"
            ];
    }
}
