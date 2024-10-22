<?php
require_once caminhoAbsoluto('database/conexao-banco.php');

// ============== SELECT QUERIES ==============
function buscaTiposFaltas()
{
    global $conexao;
    $sql = $conexao->prepare(
        "SELECT 
            TPF_id,
            TPF_categoria,
            TPF_descricao,
            TPF_tipo_intervalo,
            TPF_max_dias,
            TPF_intervalo_fixo 
        FROM TIPOS_FALTAS
        ORDER BY TPF_id"
    );

    $sql->execute();

    $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $resultados;
}
