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
} else {
    echo json_encode(['erro' => 'Ação não definida.']);
}


function controllerJustificativasFaltas($acao_justificativas_faltas, $params = [])
{
    switch ($acao_justificativas_faltas) {
        case 'insert_justificativa_falta':
            $idNovaJustificativa = criaJustificativaFalta(
                $_POST['id_tipo_falta'],
                '',
                'em análise'
            );

            if ($_POST['tipo_intervalo'] == 'dias') {
                $diasFaltas = geraListaDiasFaltas($_POST['data_inicial'], $_POST['quantidade_dias']);
                foreach ($diasFaltas as $diaFalta) {
                    $aulasPerdidas = json_decode(controllerHorariosDisciplinas(
                        'selectAulasProfessorData', 
                        ['dataAula' => $diaFalta]
                    ));
                    foreach ($aulasPerdidas as $aulaPerdida) {
                        controllerHorariosAusencias('insertHorarioAusencia', [
                            'idJustificativa' => $idNovaJustificativa,
                            'dataFalta' => $diaFalta,
                            'idHorario' => $aulaPerdida['HRF_id']
                        ]);
                    }
                }
            }
            break;

        default:
            $msgErro = "Ação para Justificativa de Falta inválida informada: '" . $acao_justificativas_faltas . "'";
            return $msgErro;
    }
}

function geraListaDiasFaltas($dataInicial, $quantidadeDias)
{
    $diasFaltas = [];
    $datetime = new DateTimeImmutable($dataInicial);

    for ($incrementoDias = 0; $incrementoDias < $quantidadeDias; $incrementoDias++) {
        $strIncremento = 'P' . $incrementoDias . 'D';
        $dataStr = $datetime->add(new DateInterval($strIncremento))->format('Y-m-d');
        array_push($diasFaltas, $dataStr);
    }

    return $diasFaltas;
}
