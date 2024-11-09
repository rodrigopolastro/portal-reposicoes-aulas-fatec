<?php
require_once caminhoAbsoluto('database/conexao-banco.php');

// ============== SELECT QUERIES ==============
function selectAulasProfessorData($idProfessor, $dataAula)
{
    global $conexao;
    $sql = $conexao->prepare(
        "SELECT
            :data_aula AS 'data_aula',
            HRF_id,
            HRF_nome_dia_semana,
            CUR_sigla,
            CUR_nome,
            DCP_semestre,
            DCP_sigla, 
            DCP_nome,
            HRF_horario_inicio,
            HRF_horario_fim
        FROM HORARIOS_FATEC
        INNER JOIN HORARIOS_DISCIPLINAS ON HRD_id_horario = HRF_id
        INNER JOIN DISCIPLINAS ON DCP_id = HRD_id_disciplina
        INNER JOIN CURSOS ON CUR_id = DCP_id_curso
        INNER JOIN USUARIOS ON USR_id = DCP_id_professor
        WHERE USR_id = :id_professor
          AND HRF_ordem_dia_semana = DAYOFWEEK(:data_aula)
        ORDER BY HRF_id"
    );

    $sql->bindValue('id_professor', $idProfessor);
    $sql->bindValue('data_aula', $dataAula);
    $sql->execute();

    $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $resultados;
}
