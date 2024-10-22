<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$nomeBanco = "portal_reposicoes_aulas_fatec";

try {
    $conexao = new PDO(
        "mysql:host=$servidor;dbname=$nomeBanco",
        $usuario,
        $senha
    );
} catch (PDOException $excecao) {
    throw new PDOException($excecao->getMessage(), (int) $excecao->getCode());
}
