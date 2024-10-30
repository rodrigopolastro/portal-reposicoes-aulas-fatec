<?php
require_once caminhoAbsoluto('database/conexao-banco.php');

// ============== ACTION QUERIES ==============
function criaJustificativaFalta($idTipoFalta, $textoJustificativa, $statusJustificativa)
{
    global $conexao;
    $sql = $conexao->prepare(
        "INSERT INTO JUSTIFICATIVAS_FALTAS (
            JUF_id_tipo_falta, 
            JUF_texto_justificativa, 
            JUF_status
        ) VALUES (
            :id_tipo_falta, 
            :texto_justificativa, 
            :status_justificativa
        )"
    );

    $sql->bindValue('id_tipo_falta', $idTipoFalta);
    $sql->bindValue('texto_justificativa', $textoJustificativa);
    $sql->bindValue('status_justificativa', $statusJustificativa);
    $sql->execute();

    return $conexao->lastInsertId();
}
