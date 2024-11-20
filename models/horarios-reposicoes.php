<?php
require_once caminhoAbsoluto('database/conexao-banco.php');

function selectDatasReposicoesJustificativa($idReposicao)
{
    global $conexao;
    $sql = $conexao->prepare(
        "SELECT DISTINCT
            HRR_data_reposicao,
            HRR_id_horario,
            HRF_nome_dia_semana,
            HRF_horario_inicio,
            HRF_horario_fim
        FROM HORARIOS_REPOSICOES
        INNER JOIN HORARIOS_FATEC ON HRF_id = HRR_id_horario
        WHERE HRR_id_reposicao = :id_reposicao
        ORDER BY HRR_data_reposicao, HRF_horario_inicio"
    );

    $sql->bindValue('id_reposicao', $idReposicao);
    $sql->execute();

    $datasReposicoes = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $datasReposicoes;
}

function insertHorarioReposicao($horarioReposicao)
{
    global $conexao;
    $sql = $conexao->prepare(
        "INSERT INTO HORARIOS_REPOSICOES (
	        HRR_id_reposicao, 
            HRR_data_reposicao, 
            HRR_id_horario 
        ) VALUES (
            :id_reposicao, 
            :data_reposicao, 
            :id_horario
        )"
    );

    $sql->bindValue('id_reposicao', $horarioReposicao['id_reposicao']);
    $sql->bindValue('data_reposicao', $horarioReposicao['data_reposicao']);
    $sql->bindValue('id_horario', $horarioReposicao['id_horario']);
    $sql->execute();
}
