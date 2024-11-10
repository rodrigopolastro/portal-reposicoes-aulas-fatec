<?php
require_once caminhoAbsoluto('database/conexao-banco.php');

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
