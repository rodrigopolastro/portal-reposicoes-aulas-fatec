<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('models/justificativas-faltas.php');
require_once caminhoAbsoluto('controllers/horarios-disciplinas.php');
require_once caminhoAbsoluto('controllers/horarios-ausencias.php');

$idUsuarioLogado = 3; // Ana Célia

$jsonRequest = json_decode(file_get_contents('php://input'), true);

if (isset($jsonRequest['acao_justificativas_faltas_justificativas_faltas'])) {
    $params = $jsonRequest['params'] ?? [];
    echo json_encode(controllerJustificativasFaltas($jsonRequest['acao_justificativas_faltas'], $params));
} else if (isset($_POST['acao_justificativas_faltas'])) {
    $params = $_POST['params'] ?? [];
    echo json_encode(controllerJustificativasFaltas($_POST['acao_justificativas_faltas'], $params));
}

function controllerJustificativasFaltas($acao_justificativas_faltas, $params = [])
{
    switch ($acao_justificativas_faltas) {
        case 'busca_justificativa_falta':
            // $jutificativa_falta = buscaJustifativaFalta($params['id_justificativa']);

        case 'cria_justificativa_falta':
            try {
                $idNovaJustificativa = criaJustificativaFalta(
                    $_POST['id_tipo_falta'],
                    '',
                    'em análise'
                );

                if ($_POST['tipo_intervalo'] == 'dias') {
                    $aulasPerdidas = controllerHorariosDisciplinas(
                        'busca_aulas_professor_periodo',
                        [
                            'data_inicial' => $_POST['data_inicial_falta'],
                            'quantidade_dias' => $_POST['quantidade_dias']
                        ]
                    );

                    foreach ($aulasPerdidas as $aulaPerdida) {
                        controllerHorariosAusencias('cria_horario_ausencia', [
                            'id_justificativa' => $idNovaJustificativa,
                            'data_falta' => $aulaPerdida['data_aula'],
                            'id_horario' => $aulaPerdida['HRF_id']
                        ]);
                    }
                }

                header("Location: ../views/professor/gera-pdf-formulario.php");
                exit();
            } catch (Throwable $erro) {
                return [
                    'sucesso' => false, 
                    'msgErro' => 'Ocorreu um erro interno ao executar a requisição: ' . $erro->getMessage()
                ];
            }
            break;

        default:
            return [
                'sucesso' => false,
                'msgErro' => "Ação para Justificativa de Falta inválida informada: '" . $acao_justificativas_faltas . "'"
            ];
    }
}
