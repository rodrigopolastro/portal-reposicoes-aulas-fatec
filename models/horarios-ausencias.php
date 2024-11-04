<?php
require_once caminhoAbsoluto('database/conexao-banco.php');

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
