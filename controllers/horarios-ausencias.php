<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('models/horarios-ausencias.php');

$jsonRequest = json_decode(file_get_contents('php://input'), true);

if (isset($jsonRequest['acao_horarios_ausencias'])) {
    $params = $jsonRequest['params'] ?? [];
    echo json_encode(controllerHorariosAusencias($jsonRequest['acao_horarios_ausencias'], $params));
} else if (isset($_POST['acao_horarios_ausencias'])) {
    $params = $_POST ?? [];
    echo json_encode(controllerHorariosAusencias($_POST['acao_horarios_ausencias'], $params));
}

function controllerHorariosAusencias($acao_horarios_ausencias, $params = [])
{
    switch ($acao_horarios_ausencias) {
        case 'cria_horario_ausencia':
            insertHorarioAusencia(
                $params['id_justificativa'],
                $params['data_falta'],
                $params['id_horario']
            );
            return ['sucesso' => true];
            break;

        default:
            return [
                'sucesso' => false,
                'msgErro' => "Ação para Horários de Ausências inválida informada: '" . $acao_horarios_ausencias . "'"
            ];
    }
}
