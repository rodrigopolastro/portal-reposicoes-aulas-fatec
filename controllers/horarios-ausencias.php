<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('models/horarios-ausencias.php');

$jsonRequest = json_decode(file_get_contents('php://input'), true);

if (isset($jsonRequest['acao'])) {
    $params = $jsonRequest['params'] ?? [];
    $response = controllerHorariosAusencias($jsonRequest['acao'], $params);
    echo json_encode($response);
} else if (isset($_POST['acao'])) {
    $params = $_POST['params'] ?? [];
    $response = controllerHorariosAusencias($_POST['acao'], $params);
    echo json_encode($response);
} else {
    echo json_encode(['erro' => 'Ação não definida.']);
}

function controllerHorariosAusencias($acao, $params = [])
{
    switch ($acao) {
        case 'insertHorarioAusencia':
            criaHorarioAusencia(
                $params['idJustificativa'],
                $params['dataFalta'],
                $params['idHorario']
            );
            break;

        default:
            $msgErro = "Ação inválida informada: '" . $acao . "'";
            return $msgErro;
    }
}
