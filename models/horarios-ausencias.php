<?php
require_once caminhoAbsoluto('database/conexao-banco.php');

function selectDatasAusenciasJustificativa($idJustificativa)
{
    global $conexao;
    $sql = $conexao->prepare(
        "SELECT
            HRA_data_falta,
            HRA_id_horario,
            HRF_nome_dia_semana,
            HRF_horario_inicio,
            HRF_horario_fim,
            DCP_id,
            DCP_nome
        FROM HORARIOS_AUSENCIAS
        INNER JOIN JUSTIFICATIVAS_FALTAS ON JUF_ID = HRA_id_justificativa
        INNER JOIN HORARIOS_FATEC ON HRF_id = HRA_id_horario
        INNER JOIN HORARIOS_DISCIPLINAS ON HRD_id_horario = HRF_id
        INNER JOIN DISCIPLINAS ON DCP_id = HRD_id_disciplina 
                            AND DCP_id_professor = JUF_id_professor
        WHERE HRA_id_justificativa = :id_justificativa
        ORDER BY HRA_data_falta, HRF_horario_inicio"
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
