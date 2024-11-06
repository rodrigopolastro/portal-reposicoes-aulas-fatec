<?php
require_once caminhoAbsoluto('database/conexao-banco.php');

// ============== ACTION QUERIES ==============
function insertPlanoReposicao($planoReposicao)
{
    global $conexao;
    $sql = $conexao->prepare(
        "INSERT INTO PLANOS_REPOSICOES (
            PLR_id_justificativa,
            PLR_id_professor, 
            PLR_status
        ) VALUES (
            :id_justificativa,
            :id_professor, 
            :status_reposicao
        )"
    );

    $sql->bindValue('id_justificativa', $planoReposicao['id_justificativa']);
    $sql->bindValue('id_professor', $planoReposicao['id_professor']);
    $sql->bindValue('status_reposicao', $planoReposicao['status_reposicao']);
    $sql->execute();

    return $conexao->lastInsertId();
}

function deletePlanoReposicao($idPlanoReposicao)
{
    global $conexao;
    $sql = $conexao->prepare(
        "DELETE FROM PLANOS_REPOSICOES 
            WHERE PLR_id = :id_plano_reposicao"
    );

    $sql->bindValue(':id_plano_reposicao', $idPlanoReposicao);
    $sql->execute();
}
