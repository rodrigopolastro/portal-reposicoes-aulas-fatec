<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('models/disciplinas.php');

$jsonRequest = json_decode(file_get_contents('php://input'), true);

if (isset($jsonRequest['acao_disciplinas'])) {
    $params = $jsonRequest['params'] ?? [];
    echo json_encode(controllerDisciplinas($jsonRequest['acao_disciplinas'], $params));
} else if (isset($_POST['acao_disciplinas'])) {
    $params = $_POST ?? [];
    echo json_encode(controllerDisciplinas($_POST['acao_disciplinas'], $params));
}

function controllerDisciplinas($acao_disciplinas, $params = [])
{
    switch ($acao_disciplinas) {
        case 'busca_disciplinas_justificativa':
            $disciplinas = selectDisciplinasJustificativa($params['id_justificativa']);
            return $disciplinas;
            break;

        default:
            return [
                'sucesso' => false,
                'msgErro' => "Ação para Disciplinas inválida informada: '" . $acao_disciplinas . "'"
            ];
    }
}
