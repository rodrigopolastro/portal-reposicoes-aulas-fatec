<?php
require_once caminhoAbsoluto('database/conexao-banco.php');

function insertComprovanteFalta($comprovanteFalta)
{
    global $conexao;
    $sql = $conexao->prepare(
        "INSERT INTO COMPROVANTES_FALTAS (
            CVF_id_justificativa,
            CVF_nome_arquivo
            
        ) VALUES (
            :id_justificativa_comprovante, 
            :nome_arquivo_comprovante
        )"
    );

    $sql->bindValue('id_justificativa_comprovante', $comprovanteFalta['id_justificativa_comprovante']);
    $sql->bindValue('nome_arquivo_comprovante', $comprovanteFalta['nome_arquivo_comprovante']);
    $sql->execute();
}
