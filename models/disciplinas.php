<?php
require_once caminhoAbsoluto('database/conexao-banco.php');

function selectDisciplinasJustificativa($idJustificativa)
{
    global $conexao;
    $sql = $conexao->prepare(
        "SELECT DISTINCT
            CUR_sigla,
            DCP_sigla,
            DCP_nome,
            DCP_semestre
        FROM JUSTIFICATIVAS_FALTAS
        INNER JOIN HORARIOS_AUSENCIAS ON HRA_id_justificativa = JUF_id
        INNER JOIN HORARIOS_FATEC ON HRF_id = HRA_id_horario
        INNER JOIN HORARIOS_DISCIPLINAS ON HRD_id_horario = HRF_id
        INNER JOIN DISCIPLINAS ON DCP_id = HRD_id_disciplina
        INNER JOIN CURSOS ON CUR_id = DCP_id_curso
        WHERE DCP_id_professor = JUF_id_professor
          AND JUF_id = :id_justificativa"
    );

    $sql->bindValue('id_justificativa', $idJustificativa);
    $sql->execute();

    $disciplinas = $sql->fetch(PDO::FETCH_ASSOC);
    return $disciplinas;;
}
