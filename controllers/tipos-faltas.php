<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('models/tipos-faltas.php');

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
        case 'selectTiposFaltas':
            $tiposFaltas = buscaTiposFaltas();
            return $tiposFaltas;
            break;

        default:
            $msgErro = "Ação inválida informada: '" . $acao . "'";
            return $msgErro;
    }
}