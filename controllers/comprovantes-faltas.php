<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('models/comprovantes-faltas.php');

$jsonRequest = json_decode(file_get_contents('php://input'), true);

if (isset($jsonRequest['acao_comprovantes_faltas'])) {
    $params = $jsonRequest['params'] ?? [];
    echo json_encode(controllerComprovantesFaltas($jsonRequest['acao_comprovantes_faltas'], $params));
} else if (isset($_POST['acao_comprovantes_faltas'])) {
    $params = $_POST ?? [];
    echo json_encode(controllerComprovantesFaltas($_POST['acao_comprovantes_faltas'], $params));
}

function controllerComprovantesFaltas($acao_comprovantes_faltas, $params = [])
{
    switch ($acao_comprovantes_faltas) {
        case 'cria_comprovante_falta':
            insertComprovanteFalta([
                'id_justificativa_comprovante' => $params['id_justificativa_comprovante'],
                'nome_arquivo_comprovante' => $params['nome_arquivo_comprovante']
            ]);
            return ['sucesso' => true];
            break;

        default:
            return [
                'sucesso' => false,
                'msgErro' => "Ação para Tipos de Faltas inválida informada: '" . $acao_comprovantes_faltas . "'"
            ];
    }
}
