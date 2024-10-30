<?php
require_once caminhoAbsoluto('database/conexao-banco.php');

// ============== SELECT QUERIES ==============
function buscaAulasProfessorData($idProfessor, $dataAula)
{
    global $conexao;
    $sql = $conexao->prepare(
        "SELECT
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
        WHERE USR_id = :idProfessor
          AND HRF_ordem_dia_semana = DAYOFWEEK(:dataAula)"
    );
    
    $sql->bindValue('idProfessor', $idProfessor);
    $sql->bindValue('dataAula', $dataAula);
    $sql->execute();

    $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $resultados;
}
