<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('models/horarios-fatec.php');

$jsonRequest = json_decode(file_get_contents('php://input'), true);

if (isset($jsonRequest['acao_horarios_fatec'])) {
    $params = $jsonRequest['params'] ?? [];
    echo json_encode(controllerHorariosFatec($jsonRequest['acao_horarios_fatec'], $params));
} else if (isset($_POST['acao_horarios_fatec'])) {
    $params = $_POST ?? [];
    echo json_encode(controllerHorariosFatec($_POST['acao_horarios_fatec'], $params));
}

function controllerHorariosFatec($acao_horarios_fatec, $params = [])
{
    switch ($acao_horarios_fatec) {
        case 'busca_horarios_fatec_data':
            $sequenciaDias = selectHorariosFatecData($params['data_aula']);
            return $sequenciaDias;
            break;

        default:
            return [
                'sucesso' => false,
                'msgErro' => "Ação para Horários de Disciplinas inválida informada: '" . $acao_horarios_fatec . "'"
            ];
    }
}
