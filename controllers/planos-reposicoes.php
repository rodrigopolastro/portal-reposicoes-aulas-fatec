<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('models/planos-reposicoes.php');
require_once caminhoAbsoluto('controllers/horarios-reposicoes.php');

$idUsuarioLogado = 3; //Ana Célia

$jsonRequest = json_decode(file_get_contents('php://input'), true);

if (isset($jsonRequest['acao_planos_reposicoes'])) {
    $params = $jsonRequest['params'] ?? [];
    echo json_encode(controllerPlanosReposicoes($jsonRequest['acao_planos_reposicoes'], $params));
} else if (isset($_POST['acao_planos_reposicoes'])) {
    $params = $_POST ?? [];
    echo json_encode(controllerPlanosReposicoes($_POST['acao_planos_reposicoes'], $params));
}

function controllerPlanosReposicoes($acao_planos_reposicoes, $params = [])
{
    switch ($acao_planos_reposicoes) {
        case 'cria_plano_reposicao':
            try {
                global $idUsuarioLogado; // Ana Célia
                $idNovoPlanoReposicao = insertPlanoReposicao([
                    'id_justificativa' => $params['id_justificativa'],
                    'id_professor' => $idUsuarioLogado,
                    'status_reposicao' => 'em análise'
                ]);

                for ($i = 0; $i < count($params['datas-reposicoes']); $i++) {
                    controllerHorariosReposicoes(
                        'cria_horario_reposicao',
                        [
                            'id_reposicao' => $idNovoPlanoReposicao,
                            'data_reposicao' => $params['datas-reposicoes'][$i],
                            'id_horario' => $params['horarios-reposicoes'][$i]
                        ]
                    );
                }

                header(
                    "Location: ../scripts/gera-pdf-formulario.php" .
                        "?id_justificativa=" . $params['id_justificativa']
                );
                exit();
            } catch (Throwable $erro) {
                if (isset($idNovaJustificativa)) {
                    deletePlanoReposicao($idNovaJustificativa);
                }

                return [
                    'sucesso' => false,
                    'msgErro' => 'Ocorreu um erro interno ao executar a requisição: ' . $erro->getMessage()
                ];
            }
            break;

        case 'exclui_plano_reposicao':
            deletePlanoReposicao($params['id_plano_reposicao']);
            if (isset($params['url_destino'])) {
                header('Location: ' . $params['url_destino']);
            }
            break;

        default:
            return [
                'sucesso' => false,
                'msgErro' => "Ação para Horários de Ausências inválida informada: '" . $acao_planos_reposicoes . "'"
            ];
    }
}
