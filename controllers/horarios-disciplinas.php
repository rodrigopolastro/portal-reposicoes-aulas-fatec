<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('models/horarios-disciplinas.php');

$jsonRequest = json_decode(file_get_contents('php://input'), true);

if (isset($jsonRequest['acao'])) {
    $params = $jsonRequest['params'] ?? [];
    $response = controllerHorariosDisciplinas($jsonRequest['acao'], $params);
    echo json_encode($response);
} else if (isset($_POST['acao'])) {
    $params = $_POST['params'] ?? [];
    $response = controllerHorariosDisciplinas($_POST['acao'], $params);
    echo json_encode($response);
} else {
    echo json_encode(['erro' => 'Ação não definida.']);
}

function controllerHorariosDisciplinas($acao, $params = [])
{
    switch ($acao) {
        case 'selectAulasProfessorData':
            $idProfessor = 3; // ana célia
            $horariosDisciplinas = buscaAulasProfessorData($idProfessor, $params['dataAula']);
            return $horariosDisciplinas;
            break;

        default:
            $msgErro = "Ação inválida informada: '" . $acao . "'";
            return $msgErro;
    }
}
