<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('models/justificativas-faltas.php');
require_once caminhoAbsoluto('controllers/horarios-disciplinas.php');
require_once caminhoAbsoluto('controllers/horarios-ausencias.php');

$idUsuarioLogado = 3;

$jsonRequest = json_decode(file_get_contents('php://input'), true);

if (isset($jsonRequest['acao_justificativas_faltas_justificativas_faltas'])) {
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
                    'texto_justificativa' => '',
                    'status_justificativa' => 'em análise'
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
                if (isset($_FILES['comprovante'])) {
                    $arquivo = $_FILES['comprovante'];
                    $numero = $idNovaJustificativa; // Pegando o número enviado pelo formulário
                    $diretorioDestino = caminhoAbsoluto('comprovante-justificativa');
                    // Verifique se houve algum erro no upload
                    if ($arquivo['error'] === UPLOAD_ERR_OK) {
                        // Defina o nome do arquivo usando "comprovanteJustificativa" e o número
                        $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION); // Obtém a extensão do arquivo original
                        $nomeArquivo = "comprovanteJustificativa{$numero}." . $extensao;
                        $caminhoDestino = $diretorioDestino . "/" . $nomeArquivo;
                
                        // Move o arquivo para o diretório de destino
                        if (move_uploaded_file($arquivo['tmp_name'], $caminhoDestino)) {
                            echo "Upload realizado com sucesso! O arquivo foi salvo como: " . $nomeArquivo;
                        } else {
                            echo "Erro ao mover o arquivo.";
                        }
                    } else {
                        echo "Erro no upload: " . $arquivo['error'];
                    }
                } else {
                    echo "Nenhum arquivo ou número foi enviado.";
                }

                header(
                    "Location: ../scripts/gera-pdf-formulario.php" .
                        "?id_justificativa=" . $idNovaJustificativa
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
        
        case 'avalia_justificativa':
            if($params['deferimento'] == 'deferido'){
                $feedback = null;
            }else{
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
