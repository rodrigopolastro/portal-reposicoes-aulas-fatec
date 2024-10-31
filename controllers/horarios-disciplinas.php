<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('models/horarios-disciplinas.php');

$jsonRequest = json_decode(file_get_contents('php://input'), true);

if (isset($jsonRequest['acao_horarios_disciplinas'])) {
    $params = $jsonRequest['params'] ?? [];
    echo json_encode(controllerHorariosDisciplinas($jsonRequest['acao_horarios_disciplinas'], $params));
} else if (isset($_POST['acao_horarios_disciplinas'])) {
    $params = $_POST['params'] ?? [];
    echo json_encode(controllerHorariosDisciplinas($_POST['acao_horarios_disciplinas'], $params));
} else {
    echo json_encode(['erro' => 'Ação não definida.']);
}


function controllerHorariosDisciplinas($acao_horarios_disciplinas, $params = [])
{
    switch ($acao_horarios_disciplinas) {
        case 'select_aulas_professor_periodo':
            $idProfessor = 3; // ana célia
            $horariosDisciplinas = buscaAulasProfessorData($idProfessor, $params['dataAula']);
            return $horariosDisciplinas;
            break;

        default:
            $msgErro = "Ação para Horários de Disciplinas inválida informada: '" . $acao_horarios_disciplinas . "'";
            return $msgErro;
    }
}
