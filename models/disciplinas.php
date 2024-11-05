<?php
require_once caminhoAbsoluto('database/conexao-banco.php');

function selectDisciplinaProfessorHorario($idProfessor, $idHorario)
{
    global $conexao;
    $sql = $conexao->prepare(
        "SELECT DISTINCT
            CUR_sigla,
            DCP_sigla,
            DCP_nome,
            DCP_semestre
        FROM DISCIPLINAS
        INNER JOIN CURSOS ON CUR_id = DCP_id_curso
        INNER JOIN HORARIOS_DISCIPLINAS ON HRD_id_disciplina = DCP_id
        WHERE DCP_id_professor = :id_professor
          AND HRD_id_horario = :id_horario"
    );

    $sql->bindValue('id_professor', $idProfessor);
    $sql->bindValue('id_horario', $idHorario);
    $sql->execute();

    $disciplina = $sql->fetch(PDO::FETCH_ASSOC);
    return $disciplina;
}

function selectDisciplinasJustificativa($idJustificativa)
{
    global $conexao;
    $sql = $conexao->prepare(
        "SELECT DISTINCT
            CUR_sigla,
            DCP_sigla,
            DCP_nome,
            DCP_semestre
        FROM DISCIPLINAS
        INNER JOIN CURSOS ON CUR_id = DCP_id_curso
        INNER JOIN JUSTIFICATIVAS_FALTAS ON JUF_id_professor = DCP_id_professor
        WHERE JUF_id = :id_justificativa"
    );

    $sql->bindValue('id_justificativa', $idJustificativa);
    $sql->execute();

    $disciplinas = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $disciplinas;;
}
