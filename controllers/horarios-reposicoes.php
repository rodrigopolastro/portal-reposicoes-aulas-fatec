<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('models/horarios-reposicoes.php');

$jsonRequest = json_decode(file_get_contents('php://input'), true);

if (isset($jsonRequest['acao_horarios_reposicoes'])) {
    $params = $jsonRequest['params'] ?? [];
    echo json_encode(controllerHorariosReposicoes($jsonRequest['acao_horarios_reposicoes'], $params));
} else if (isset($_POST['acao_horarios_reposicoes'])) {
    $params = $_POST ?? [];
    echo json_encode(controllerHorariosReposicoes($_POST['acao_horarios_reposicoes'], $params));
}

function controllerHorariosReposicoes($acao_horarios_reposicoes, $params = [])
{
    switch ($acao_horarios_reposicoes) {
        case 'busca_datas_reposicoes_justificativa':
            $horariosReposicoes = selectDatasReposicoesJustificativa($params['id_reposicao']);
            return $horariosReposicoes;
            break;

        case 'cria_horario_reposicao':
            insertHorarioReposicao([
                'id_reposicao' => $params['id_reposicao'],
                'data_reposicao' => $params['data_reposicao'],
                'id_horario' => $params['id_horario']
            ]);
            return ['sucesso' => true];
            break;

        default:
            return [
                'sucesso' => false,
                'msgErro' => "Ação para Horários de Reposições inválida informada: '" . $acao_horarios_reposicoes . "'"
            ];
    }
}
