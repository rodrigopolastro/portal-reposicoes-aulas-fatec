<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('controllers/planos-reposicoes.php');
require_once caminhoAbsoluto('controllers/disciplinas.php');

$planosReposicoes = controllerPlanosReposicoes('busca_planos_reposicoes_coordenador');
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/estilo-geral.css">
    <link rel="stylesheet" href="../../assets/css/utilidades.css">
    <title>Planos de Reposições Recebidos</title>

</head>

<body>
    <?php
    require_once '../components/cabecalho-coordenador.php';
    ?>
    <main>
        <div class="d-flex justify-content-center">
            <h1 class="w-75">Planos de Reposições Recebidos</h1>
        </div>
        <div class="table">
            <table id="tabela-recebidos">
                <thead>
                    <tr>
                        <th class="ordem"></th>
                        <th class="ordem">Data de Aprovação Justificativa</th>
                        <th class="ordem">Data de recebimento</th>
                        <th class="componente">Professor</th>
                        <th class="componente">Disciplinas</th>
                        <th class="status">Status</th>
                        <th class="ordem">Feedback Enviado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($planosReposicoes as $planoReposicao): ?>
                        <?php
                        $dataAprovacaoJustificativa = (new DateTimeImmutable($planoReposicao['JUF_data_avaliacao']))->format('d/m/y');
                        $dataEnvioReposicao = (new DateTimeImmutable($planoReposicao['PLR_data_envio']))->format('d/m/y');
                        $disciplinas = controllerDisciplinas(
                            'busca_disciplinas_justificativa',
                            ['id_justificativa' => $planoReposicao['JUF_id']]
                        );
                        ?>
                        <tr>
                            <td class="">
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="../../scripts/gera-pdf-formulario.php?id_justificativa=<?= $planoReposicao['JUF_id'] ?>"
                                        target="_blank">
                                        <img src="../../assets/images/icone-pdf.png" alt="" width="25" class="icone-pdf">
                                    </a>
                                </div>
                            </td>
                            <td><?= $dataAprovacaoJustificativa ?></td>
                            <td><?= $dataEnvioReposicao ?></td>
                            <td><?= $planoReposicao['USR_nome_completo'] ?></td>
                            <td>
                                <ul>
                                    <?php foreach ($disciplinas as $disciplina) : ?>
                                        <li><?= '(' . $disciplina['CUR_sigla'] . ') ' . $disciplina['DCP_nome'] ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                            <td>
                                <?php if ($planoReposicao['PLR_status'] == 'em análise') : ?>
                                    <a
                                        href="../../scripts/gera-pdf-formulario.php?id_justificativa=<?= $planoReposicao['JUF_id'] . '&url_destino=' .
                                                                                                            caminhoAbsoluto('views/coordenador/avaliar-falta.php', true) ?>">
                                        Avaliar
                                    </a>
                                <?php else: ?>
                                    <div><span>Analisado:</span></div>
                                    <div><span style="font-weight: bold"><?= ucfirst($planoReposicao['JUF_status']) ?></span></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?= empty($planoReposicao['JUF_feedback_coordenador']) ? '...'
                                    : $planoReposicao['JUF_feedback_coordenador'] ?>
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