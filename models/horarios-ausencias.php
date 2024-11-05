<?php
require_once caminhoAbsoluto('database/conexao-banco.php');

function selectDatasAusenciasJustificativa($idJustificativa)
{
    global $conexao;
    $sql = $conexao->prepare(
        "SELECT DISTINCT
            HRA_data_falta,
            HRA_id_horario,
            HRF_nome_dia_semana,
            HRF_horario_inicio,
            HRF_horario_fim
        FROM HORARIOS_AUSENCIAS
        INNER JOIN HORARIOS_FATEC ON HRF_id = HRA_id_horario
        WHERE HRA_id_justificativa = :id_justificativa
        ORDER BY HRA_data_falta"
    );

    $sql->bindValue('id_justificativa', $idJustificativa);
    $sql->execute();

    $datasAusencias = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $datasAusencias;
}

// ============== ACTION QUERIES ==============
function insertHorarioAusencia($idJustificativa, $dataFalta, $idHorario)
{
    global $conexao;
    $sql = $conexao->prepare(
        "INSERT INTO HORARIOS_AUSENCIAS (
	        HRA_id_justificativa, 
            HRA_data_falta, 
            HRA_id_horario 
        ) VALUES (
            :id_justificativa, 
            :data_falta, 
            :id_horario
        )"
    );

    $sql->bindValue('id_justificativa', $idJustificativa);
    $sql->bindValue('data_falta', $dataFalta);
    $sql->bindValue('id_horario', $idHorario);
    $sql->execute();
}
