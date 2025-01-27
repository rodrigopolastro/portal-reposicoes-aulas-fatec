<?php
require_once caminhoAbsoluto('database/conexao-banco.php');

function selectFormulariosProfessor($idProfessor)
{
    global $conexao;
    $sql = $conexao->prepare(
        "SELECT   
            JUF_id,
            TPF_categoria,
            TPF_tipo_intervalo,
            JUF_quantidade_dias,
            JUF_status,
            JUF_data_envio,
            JUF_data_avaliacao,
            JUF_feedback_coordenador,
            PLR_id,
            PLR_status
        FROM JUSTIFICATIVAS_FALTAS
        INNER JOIN TIPOS_FALTAS ON TPF_id = JUF_id_tipo_falta 
        LEFT JOIN PLANOS_REPOSICOES ON PLR_id_justificativa = JUF_id
        WHERE JUF_id_professor = :id_professor
        ORDER BY JUF_data_envio DESC"
    );

    $sql->bindValue('id_professor', $idProfessor);
    $sql->execute();

    $formularios = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $formularios;
}

function selectJustificativaFalta($idJustificativa)
{
    global $conexao;
    $sql = $conexao->prepare(
        "SELECT   
            JUF_id,
            PLR_id,
            PLR_data_envio,
            JUF_id_tipo_falta,
            TPF_id,
            TPF_categoria,
            TPF_descricao,
            TPF_tipo_intervalo,
            JUF_texto_justificativa,
            JUF_quantidade_dias,
            JUF_status,
            JUF_data_envio,
            JUF_data_avaliacao,
            JUF_feedback_coordenador,
            JUF_id_professor,
            USR_nome_completo,
            USR_cpf,
            USR_numero_matricula
        FROM JUSTIFICATIVAS_FALTAS
        INNER JOIN TIPOS_FALTAS ON TPF_id = JUF_id_tipo_falta 
        INNER JOIN USUARIOS ON USR_id = JUF_id_professor
        LEFT JOIN PLANOS_REPOSICOES ON PLR_id_justificativa = JUF_id
        WHERE JUF_id = :id_justificativa"
    );

    $sql->bindValue('id_justificativa', $idJustificativa);
    $sql->execute();

    $justificativa = $sql->fetch(PDO::FETCH_ASSOC);
    return $justificativa;
}

// ============== ACTION QUERIES ==============
function insertJustificativaFalta($justificativaFalta)
{
    global $conexao;
    $sql = $conexao->prepare(
        "INSERT INTO JUSTIFICATIVAS_FALTAS (
            JUF_id_professor,
            JUF_id_tipo_falta, 
            JUF_texto_justificativa, 
            JUF_quantidade_dias,
            JUF_status
        ) VALUES (
            :id_professor,
            :id_tipo_falta, 
            :texto_justificativa, 
            :quantidade_dias,
            :status_justificativa
        )"
    );

    $sql->bindValue('id_professor', $justificativaFalta['id_professor']);
    $sql->bindValue('id_tipo_falta', $justificativaFalta['id_tipo_falta']);
    $sql->bindValue('texto_justificativa', $justificativaFalta['texto_justificativa']);
    $sql->bindValue('quantidade_dias', $justificativaFalta['quantidade_dias']);
    $sql->bindValue('status_justificativa', $justificativaFalta['status_justificativa']);
    $sql->execute();

    return $conexao->lastInsertId();
}

function deleteJustificativaFalta($idJustificativa)
{
    global $conexao;
    $sql = $conexao->prepare(
        "DELETE FROM JUSTIFICATIVAS_FALTAS 
            WHERE JUF_id = :id_justificativa"
    );

    $sql->bindValue(':id_justificativa', $idJustificativa);
    $sql->execute();
}

function updateAvaliacaoJustificativa($avaliacaoJustificativa)
{
    global $conexao;
    $sql = $conexao->prepare(
        "UPDATE JUSTIFICATIVAS_FALTAS SET
            JUF_status = :status_justificativa,
            JUF_feedback_coordenador = :feedback_justificativa,
            JUF_data_avaliacao = CURRENT_TIMESTAMP()
            WHERE JUF_id = :id_justificativa"
    );

    $sql->bindValue(':id_justificativa', $avaliacaoJustificativa['id_justificativa']);
    $sql->bindValue(':status_justificativa', $avaliacaoJustificativa['status_justificativa']);
    $sql->bindValue(':feedback_justificativa', $avaliacaoJustificativa['feedback_justificativa']);
    $sql->execute();
}

function selectJustificativasFaltasCoordenador()
{
    global $conexao;
    $sql = $conexao->prepare(
        "SELECT   
            JUF_id,
            JUF_id_professor,
            JUF_status,
            JUF_data_envio,
            JUF_data_avaliacao,
            JUF_feedback_coordenador,
            PLR_id,
            USR_nome_completo
        FROM JUSTIFICATIVAS_FALTAS
        INNER JOIN USUARIOS ON USR_id = JUF_id_professor
        LEFT JOIN PLANOS_REPOSICOES ON PLR_id_justificativa = JUF_id
        WHERE PLR_id IS NULL"
    );

    $sql->execute();
    $justificativasFaltas = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $justificativasFaltas;
}

// Formulários que serão exibidos para a secretaria.
// Um processo está finalizado quando o plano de reposição estiver deferido.
function selectProcessosFinalizados()
{
    global $conexao;
    $sql = $conexao->prepare(
        "SELECT   
            JUF_id,
            JUF_id_professor,
            JUF_data_envio,     -- Início do Processo
            PLR_id,
            PLR_data_avaliacao, -- Finalização do Processo
            USR_nome_completo
        FROM JUSTIFICATIVAS_FALTAS
        INNER JOIN USUARIOS ON USR_id = JUF_id_professor
        INNER JOIN PLANOS_REPOSICOES ON PLR_id_justificativa = JUF_id
                                    AND PLR_status = 'deferido'"
    );

    $sql->execute();
    $processosFinalizados = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $processosFinalizados;
}
