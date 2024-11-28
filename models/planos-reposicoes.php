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

function selectPlanosReposicoesCoordenador()
{
    global $conexao;
    $sql = $conexao->prepare(
        "SELECT   
            PLR_id,
            PLR_id_professor,
            PLR_status,
            PLR_data_envio,
            PLR_data_avaliacao,
            PLR_feedback_coordenador,
            PLR_id,
            JUF_id,
            JUF_data_avaliacao, 
            USR_nome_completo
        FROM PLANOS_REPOSICOES
        INNER JOIN USUARIOS ON USR_id = PLR_id_professor
        INNER JOIN JUSTIFICATIVAS_FALTAS ON JUF_id = PLR_id_justificativa"
    );

    $sql->execute();
    $planosReposicoes = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $planosReposicoes;
}
