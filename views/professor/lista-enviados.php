<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('controllers/justificativas-faltas.php');
require_once caminhoAbsoluto('controllers/disciplinas.php');
require_once caminhoAbsoluto('controllers/horarios-ausencias.php');

$formularios = controllerJustificativasFaltas('busca_formularios_professor');
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Formulário enviados</title>

</head>

<body>
    <?php
    require_once '../components/cabecalho-professor.php';
    ?>
    <main>
        <h1>Formulário Enviados</h1>
        <div class="topo-form">
            <form id="filterForm" onsubmit="return aplicarFiltro()">
                <div class="filtro-form">
                    <label for="filterTipo">Tipo de Formulário:</label>
                    <select id="filterTipo" class="filter-input">
                        <option value="">Todos</option>
                        <option value="Justificativa de Falta">Justificativa de Falta</option>
                        <option value="Reposição de Aulas">Reposição de Aulas</option>
                    </select>
                    <label for="filterStatus">Status:</label>
                    <select id="filterStatus" class="filter-input">
                        <option value="">Todos</option>
                        <option value="Em análise">Em análise</option>
                        <option value="Deferido">Deferido</option>
                        <option value="Indeferido">Indeferido</option>
                    </select>
                    <input type="submit" value="Aplicar filtro">
                    <input type="reset" value="Limpar filtro" onclick="limparFiltro()">
                </div>
            </form>
            <div class="d-flex justify-content-end w-75">
                <button id="btnExportar">Exportar como PDF</button>
                <button id="btnCancelar">Cancelar</button>
            </div>
        </div>
        <div class="table">
            <table id="formTable">
                <thead>
                    <tr>
                        <th class="ordem colunaImprimir d-none"></th>
                        <th class="ordem">Período da Falta</th>
                        <th class="ordem">Motivo</th>
                        <th class="tipo">Disciplinas</th>
                        <th class="ordem">Status Justificativa</th>
                        <th class="ordem">Status Reposição</th>
                        <th class="ordem">Feedback</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($formularios as $formulario): ?>
                        <?php
                        $disciplinas = controllerDisciplinas(
                            'busca_disciplinas_justificativa',
                            ['id_justificativa' => $formulario['JUF_id']]
                        );
                        if ($formulario['TPF_tipo_intervalo'] == 'dias') {
                            $datasAusencias = controllerHorariosAusencias(
                                'busca_datas_ausencias_justificativa',
                                ['id_justificativa' => $formulario['JUF_id']]
                            );
                            $dataInicial = $datasAusencias[0]['HRA_data_falta'];
                            $dataFinal = end($datasAusencias)['HRA_data_falta'];

                            if ($dataInicial == $dataFinal) {
                                $strDataFormatada = (new DateTimeImmutable($dataInicial))->format('d/m/y');
                            } else {
                                $dataInicialFormatada = (new DateTimeImmutable($dataInicial))->format('d/m/y');
                                $dataFinalFormatada = (new DateTimeImmutable($dataFinal))->format('d/m/y');
                                $strDataFormatada = $dataInicialFormatada . ' a ' . $dataFinalFormatada;
                            }
                        } else if ($formulario['TPF_tipo_intervalo'] == 'horas') {
                            $dataFalta = $datasAusencias[0]['HRA_data_falta'];
                            $horarioInicial = $datasAusencias[0]['HRF_horario_inicio'];
                            $horarioFinal = end($datasAusencias)['HRF_horario_fim'];

                            $strDataFormatada =
                                (new DateTimeImmutable($dataInicial))->format('d/m/y') .
                                ', das ' . $horarioInicial . ' às ' . $horarioFinal;
                        }
                        ?>
                        <tr>
                            <td class="colunaImprimir d-none">
                                <a href="../../scripts/gera-pdf-formulario.php
                                    ?id_justificativa=<?= $formulario['JUF_id'] ?>"
                                    target="_blank">
                                    <button class="btnImprimirFormulario">Imprimir</button>
                                </a>
                            </td>
                            <td id="tdPeriodo"><?= $strDataFormatada ?></td>
                            <td id="tdMotivo"><?= $formulario['TPF_categoria'] ?></td>
                            <td id="tdDisciplinas">
                                <ul>
                                    <?php foreach ($disciplinas as $disciplina) : ?>
                                        <li><?= '(' . $disciplina['CUR_sigla'] . ') ' . $disciplina['DCP_nome'] ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                            <td id="tdStatusJustificativa">
                                <div>
                                    <span><?= $formulario['JUF_status'] ?></span>
                                </div>
                                <?php if ($formulario['JUF_status'] == 'indeferido') : ?>
                                    <div>
                                        <span>
                                            <a href="./enviar-justificativa.php?editar=<?= $formulario['JUF_id'] ?>">Editar</a>
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td id="tdStatusReposicao" class="centro">
                                <?php if (is_null($formulario['PLR_id'])) : ?>
                                    <?php if ($formulario['JUF_status'] == 'deferido') : ?>
                                        <div>
                                            <span>
                                                <a href="./enviar-reposicao.php?id_justificativa=" <?= $formulario['JUF_id'] ?>>Enviar</a>
                                            </span>
                                        </div>
                                    <?php else : ?>
                                        <div>
                                            <span>...</span>
                                        </div>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <div>
                                        <span><?= $formulario['PLR_status'] ?></span>
                                    </div>
                                    <?php if ($formulario['PLR_status'] == 'indeferido') : ?>
                                        <div>
                                            <span>
                                                <a href="./enviar-reposicao.php?editar=<?= $formulario['PLR_id'] ?>">Editar</a>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td id=""><?= $formulario['JUF_feedback_coordenador'] ?? "Não possui" ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- <script>
            function aplicarFiltro() {
                var tipoFiltro = document.getElementById('filterTipo').value;
                var statusFiltro = document.getElementById('filterStatus').value;

                var tabela = document.getElementById('formTable');
                var linhas = tabela.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

                for (var i = 0; i < linhas.length; i++) {
                    var tipo = linhas[i].getAttribute('data-tipo');
                    var status = linhas[i].getAttribute('data-status');

                    if ((tipoFiltro === "" || tipo === tipoFiltro) &&
                        (statusFiltro === "" || status === statusFiltro)) {
                        linhas[i].classList.remove('hidden');
                    } else {
                        linhas[i].classList.add('hidden');
                    }
                }
                return false; // Evitar o envio do formulÃ¡rio
            }

            function limparFiltro() {
                var tabela = document.getElementById('formTable');
                var linhas = tabela.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

                for (var i = 0; i < linhas.length; i++) {
                    linhas[i].classList.remove('hidden');
                }
            }
        </script> -->
        <script src="../../assets/js/lista-enviados.js"></script>
    </main>
    <?php
    require_once '../components/rodape.php'
    ?>
</body>

</html>