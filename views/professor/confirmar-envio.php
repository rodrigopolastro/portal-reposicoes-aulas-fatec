<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Envio</title>
</head>

<body>
    <h1>Revise os Dados Preenchidos antes de prosseguir</h1>
    <iframe src="../../pdfs-formularios/temp_file.pdf" width="100%" height="600px">
        Seu navegador não suporta visualização de PDF.
        <a href="../../pdfs-formularios/temp_file.pdf">Clique aqui para visualizar o PDF</a>.
    </iframe>
    <br>
    <br>
    <form action="../../controllers/justificativas-faltas.php" method="POST">
        <input type="hidden" name="acao_justificativas_faltas" value="exclui_justificativa_falta">
        <input type="hidden" name="id_justificativa" value="<?= $_GET['id_justificativa'] ?>">
        <input type="hidden" name="url_destino" value="<?= caminhoAbsoluto('views/professor/enviar-justificativa.php', true) ?>">
        <input type="submit" value="Retornar para o Cadastro">
    </form>
    <a href="./formulario-enviado.html">
        <button>Confirmar Envio</button>
    </a>
</body>

</html>