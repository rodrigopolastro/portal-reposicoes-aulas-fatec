<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('models/justificativas-faltas.php');
require_once caminhoAbsoluto('controllers/horarios-disciplinas.php');
require_once caminhoAbsoluto('controllers/horarios-ausencias.php');
require_once caminhoAbsoluto('controllers/comprovantes-faltas.php');

define('CAMINHO_PASTA_COMPROVANTES', caminhoAbsoluto('private/comprovantes-faltas'));

$idUsuarioLogado = 3;

$jsonRequest = json_decode(file_get_contents('php://input'), true);

if (isset($jsonRequest['acao_justificativas_faltas'])) {
    $params = $jsonRequest['params'] ?? [];
    echo json_encode(controllerJustificativasFaltas($jsonRequest['acao_justificativas_faltas'], $params));
} else if (isset($_POST['acao_justificativas_faltas'])) {
    $params = $_POST ?? [];
    echo json_encode(controllerJustificativasFaltas($_POST['acao_justificativas_faltas'], $params));
}

function controllerJustificativasFaltas($acao_justificativas_faltas, $params = [])
{
    switch ($acao_justificativas_faltas) {
        case 'busca_formularios_professor':
            global $idUsuarioLogado;
            $formularios = selectFormulariosProfessor($idUsuarioLogado);
            return $formularios;
            break;

        case 'busca_justificativa_falta':
            $justificativa_falta = selectJustificativaFalta($params['id_justificativa']);
            return $justificativa_falta;
            break;

        case 'cria_justificativa_falta':
            try {
                global $idUsuarioLogado; // Ana Célia
                $idNovaJustificativa = insertJustificativaFalta([
                    'id_professor' => $idUsuarioLogado,
                    'id_tipo_falta' => $params['id_tipo_falta'],
                    'texto_justificativa' => $params['texto_justificativa'],
                    'quantidade_dias' => $params['quantidade_dias'],
                    'status_justificativa' => 'em análise',
                ]);

                if ($params['tipo_intervalo'] == 'dias') {
                    $aulasPerdidas = controllerHorariosDisciplinas(
                        'busca_aulas_professor_periodo',
                        [
                            'data_inicial' => $params['data_inicial_falta'],
                            'quantidade_dias' => $params['quantidade_dias']
                        ]
                    );

                    foreach ($aulasPerdidas as $aulaPerdida) {
                        controllerHorariosAusencias('cria_horario_ausencia', [
                            'id_justificativa' => $idNovaJustificativa,
                            'data_falta' => $aulaPerdida['data_aula'],
                            'id_horario' => $aulaPerdida['HRF_id']
                        ]);
                    }
                } else if ($params['tipo_intervalo'] == 'horas') {
                    $idsHorariosFaltas = json_decode($params['ids_horarios_falta']);
                    foreach ($idsHorariosFaltas as $idHorario) {
                        controllerHorariosAusencias('cria_horario_ausencia', [
                            'id_justificativa' => $idNovaJustificativa,
                            'data_falta' => $params['data_inicial_falta'],
                            'id_horario' => $idHorario
                        ]);
                    }
                }

                if (isset($_FILES['comprovante']) && $_FILES['comprovante']['error'] === UPLOAD_ERR_OK) {
                    $arquivo = $_FILES['comprovante'];
                    if (!is_dir(CAMINHO_PASTA_COMPROVANTES)) {
                        mkdir(CAMINHO_PASTA_COMPROVANTES);
                    }

                    if ($arquivo['error'] === UPLOAD_ERR_OK) {
                        $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
                        $nomeArquivo = "comprovanteJustificativa{$idNovaJustificativa}." . $extensao;
                        $caminhoDestino = CAMINHO_PASTA_COMPROVANTES . "/" . $nomeArquivo;

                        if (move_uploaded_file($arquivo['tmp_name'], $caminhoDestino)) {
                            controllerComprovantesFaltas('cria_comprovante_falta', [
                                'id_justificativa_comprovante' => $idNovaJustificativa,
                                'nome_arquivo_comprovante' => $nomeArquivo
                            ]);
                        } else {
                            return [
                                'sucesso' => false,
                                'msgErro' => 'Ocorreu um erro ao salvar o arquivo no diretório'
                            ];
                        }
                    } else {
                        return [
                            'sucesso' => false,
                            'msgErro' => 'Ocorreu um erro no upload do arquivo. Status: ' . $arquivo['error']
                        ];
                    }
                }

                header(
                    'Location: ' . caminhoAbsoluto('scripts/gera-pdf-formulario.php', true) .
                        '?id_justificativa=' . $idNovaJustificativa .
                        '&url_destino=' . caminhoAbsoluto('views/professor/confirmar-envio.php', true)
                );
                exit();
            } catch (Throwable $erro) {
                if (isset($idNovaJustificativa)) {
                    deleteJustificativaFalta($idNovaJustificativa);
                }

                return [
                    'sucesso' => false,
                    'msgErro' => 'Ocorreu um erro interno ao executar a requisição: ' . $erro->getMessage()
                ];
            }
            break;

        case 'exclui_justificativa_falta':
            deleteJustificativaFalta($params['id_justificativa']);
            if (isset($params['url_destino'])) {
                header('Location: ' . $params['url_destino']);
            }
            break;

            // case 'altera_justificativa_falta':
            //     updateJustificativaFalta([

            //     ]);

        case 'avalia_justificativa':
            if ($params['deferimento'] == 'deferido') {
                $feedback = null;
            } else {
                $feedback = $params['feedback'];
            }
            updateAvaliacaoJustificativa(
                [
                    'id_justificativa' => $params['id_justificativa'],
                    'status_justificativa' => $params['deferimento'],
                    'feedback_justificativa' => $feedback
                ]
            );
            break;

        case 'busca_faltas_coordenador':
            $formulariosCoordenador = selectFormulariosFaltasCoordenadores();
            return $formulariosCoordenador;
            break;

        default:
            return [
                'sucesso' => false,
                'msgErro' => "Ação para Justificativa de Falta inválida informada: '" . $acao_justificativas_faltas . "'"
            ];
    }
}
