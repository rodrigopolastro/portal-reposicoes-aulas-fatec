<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('models/justificativas-faltas.php');
require_once caminhoAbsoluto('controllers/horarios-disciplinas.php');
require_once caminhoAbsoluto('controllers/horarios-ausencias.php');

$idUsuarioLogado = 3; // Ana Célia

$jsonRequest = json_decode(file_get_contents('php://input'), true);

if (isset($jsonRequest['acao'])) {
    $params = $jsonRequest['params'] ?? [];
    $response = controllerTiposFaltas($jsonRequest['acao'], $params);
    echo json_encode($response);
} else if (isset($_POST['acao'])) {
    $params = $_POST['params'] ?? [];
    $response = controllerTiposFaltas($_POST['acao'], $params);
    echo json_encode($response);
} else {
    echo json_encode(['erro' => 'Ação não definida.']);
}

function controllerTiposFaltas($acao, $params = [])
{
    switch ($acao) {
        case 'insertJustificativaFalta':
            print_r($_POST);
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
            $msgErro = "Ação inválida informada: '" . $acao . "'";
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
