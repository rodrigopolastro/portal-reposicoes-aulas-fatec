<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('controllers/justificativas-faltas.php');
require_once caminhoAbsoluto('controllers/disciplinas.php');

$processosFinalizados = controllerJustificativasFaltas('busca_processos_finalizados');
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/estilo-geral.css">
    <link rel="stylesheet" href="../../assets/css/utilidades.css">
    <title>Processos Finalizados</title>
</head>

<body>
    <?php
    require_once '../components/cabecalho-secretaria.php';
    ?>
    <main>
        <div class="d-flex justify-content-center">
            <h1 class="w-75">Processos Finalizados</h1>
        </div>
        <div class="table">
            <table id="tabela-recebidos">
                <thead>
                    <tr>
                        <th class="ordem"></th>
                        <th class="ordem">Data de Início</th>
                        <th class="ordem">Data de Finalização</th>
                        <th class="ordem">Professor</th>
                        <th class="ordem">Disciplinas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($processosFinalizados as $processoFinalizado): ?>
                        <?php
                        $dataInicioProcesso = (new DateTimeImmutable($processoFinalizado['JUF_data_envio']))->format('d/m/y');
                        $dataFinalizacaoProcesso = (new DateTimeImmutable($processoFinalizado['PLR_data_avaliacao']))->format('d/m/y');
                        $disciplinas = controllerDisciplinas(
                            'busca_disciplinas_justificativa',
                            ['id_justificativa' => $processoFinalizado['JUF_id']]
                        );

                        ?>
                        <tr>
                            <td class="">
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="../../scripts/gera-pdf-formulario.php?id_justificativa=<?= $processoFinalizado['JUF_id'] ?>"
                                        target="_blank">
                                        <img src="../../assets/images/icone-pdf.png" alt="" width="25" class="icone-pdf">
                                    </a>
                                </div>
                            </td>
                            <td><?= $dataInicioProcesso ?></td>
                            <td><?= $dataFinalizacaoProcesso ?></td>
                            <td><?= $processoFinalizado['USR_nome_completo'] ?></td>
                            <td>
                                <ul>
                                    <?php foreach ($disciplinas as $disciplina) : ?>
                                        <li><?= '(' . $disciplina['CUR_sigla'] . ') ' . $disciplina['DCP_nome'] ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
    <?php
    require '../components/rodape.php';
    ?>
</body>

</html>