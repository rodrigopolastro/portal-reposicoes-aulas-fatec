<?php
require_once caminhoAbsoluto('database/conexao-banco.php');

function selectHorariosFatecData($dataAula)
{
    global $conexao;
    $sql = $conexao->prepare(
        "SELECT DISTINCT
            :data_aula AS 'data_aula',
            HRF_id,
            HRF_ordem_dia_semana,
            HRF_nome_dia_semana,
            HRF_horario_inicio,
            HRF_horario_fim
        FROM HORARIOS_FATEC
        WHERE HRF_ordem_dia_semana = DAYOFWEEK(:data_aula)"
    );

    $sql->bindValue(':data_aula', $dataAula);
    $sql->execute();

    $horariosFatec = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $horariosFatec;
}
