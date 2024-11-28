<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('controllers/justificativas-faltas.php');
require_once caminhoAbsoluto('controllers/disciplinas.php');

$justificativasFaltas = controllerJustificativasFaltas('busca_justificativas_faltas_coordenador');
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/estilo-geral.css">
    <link rel="stylesheet" href="../../assets/css/utilidades.css">
    <title>Justificativas de Faltas Recebidas</title>

</head>

<body>
    <?php
    require_once '../components/cabecalho-coordenador.php';
    ?>
    <main>
        <div class="d-flex justify-content-center">
            <h1 class="w-75">Justificativas de Faltas Recebidas</h1>
        </div>
        <div class="table">
            <table id="tabela-recebidos">
                <thead>
                    <tr>
                        <th class="ordem"></th>
                        <th class="ordem">Data de recebimento</th>
                        <th class="componente">Professor</th>
                        <th class="componente">Disciplinas</th>
                        <th class="status">Status</th>
                        <th class="ordem">Feedback Enviado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($justificativasFaltas as $justificativaFalta): ?>
                        <?php
                        $dataEnvioFormatada = (new DateTimeImmutable($justificativaFalta['JUF_data_envio']))->format('d/m/y');
                        $disciplinas = controllerDisciplinas(
                            'busca_disciplinas_justificativa',
                            ['id_justificativa' => $justificativaFalta['JUF_id']]
                        );

                        ?>
                        <tr>
                            <td class="">
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="../../scripts/gera-pdf-formulario.php?id_justificativa=<?= $justificativaFalta['JUF_id'] ?>"
                                        target="_blank">
                                        <img src="../../assets/images/icone-pdf.png" alt="" width="25" class="icone-pdf">
                                    </a>
                                </div>
                            </td>
                            <td><?= $dataEnvioFormatada ?></td>
                            <td><?= $justificativaFalta['USR_nome_completo'] ?></td>
                            <td>
                                <ul>
                                    <?php foreach ($disciplinas as $disciplina) : ?>
                                        <li><?= '(' . $disciplina['CUR_sigla'] . ') ' . $disciplina['DCP_nome'] ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                            <td>
                                <?php if ($justificativaFalta['JUF_status'] == 'em análise') : ?>
                                    <a href="../../scripts/gera-pdf-formulario.php?id_justificativa=<?= $justificativaFalta['JUF_id'] .
                                                                                                        '&url_destino=' . caminhoAbsoluto('views/coordenador/avaliar-falta.php', true) ?>">Avaliar</a>
                                <?php else: ?>
                                    <div><span>Analisado:</span></div>
                                    <div><span style="font-weight: bold"><?= ucfirst($justificativaFalta['JUF_status']) ?></span></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?= empty($justificativaFalta['JUF_feedback_coordenador']) ? '...'
                                    : $justificativaFalta['JUF_feedback_coordenador'] ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
    <?php
    require '../components/rodape';
    ?>
</body>

</html>