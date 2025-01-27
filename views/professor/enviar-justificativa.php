<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('controllers/tipos-faltas.php');

$tiposFaltas = controllerTiposFaltas('busca_tipos_faltas');
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/estilo-geral.css">
    <link rel="stylesheet" href="../../assets/css/utilidades.css">
    <link rel="stylesheet" href="../../assets/css/form-justificativa.css">
    <title>Formulário de Justificativa de Falta</title>
</head>

<body>
    <?php
    require_once '../components/cabecalho-professor.php';
    ?>
    <main>
        <h1>Formulário para Justificativa de Faltas:</h1>
        <div class="topo-form">
            <form method="POST" action="../../controllers/justificativas-faltas.php" enctype="multipart/form-data">
                <input type="hidden" name="acao_justificativas_faltas" value="cria_justificativa_falta">
                <input id="inputTipoIntervalo" type="hidden" name="tipo_intervalo" value="">
                <input id="inputIdsHorariosFalta" type="hidden" name="ids_horarios_falta" value="">
                <?php if (isset($_GET['editar_justificativa'])): ?>
                    <input id="" type="hidden" name="id_justificativa_editada" value="<?= $_GET['editar_justificativa'] ?>">
                <?php endif; ?>
                <div class="formcomeço">
                    <div class="item-pequeno">
                        <p><strong>Nome:</strong> </p>
                        <p>Ana Célia Ribeiro Bizigato Portes</p>
                    </div>

                    <div class="item-pequeno">
                        <p><strong>Matrícula:</strong> </p>
                        <p>0000000000005</p>
                    </div>

                    <div class="item-pequeno">
                        <p><strong>Função:</strong></p>
                        <p>Professor de Ensino Superior</p>
                    </div>
                    <div class="item-pequeno">
                        <p><strong>Regime jurídico:</strong></p>
                        <p>CLT</p>
                    </div>
                </div>

                <div>
                    <label for="categoria_falta">Categoria da Falta:</label>
                    <select id="selectCategoriaFalta" name="categoria_falta" class="">
                        <option id="optionNenhumaOpcao" value="">Selecione...</option>
                        <option id="optionlicencaMedica" value="licenca_medica">Licença e Falta Médica</option>
                        <option id="optionLegislacao" value="legislacao_trabalhista">Falta Prevista na Legislação Trabalhista</option>
                        <option id="optionJustificada" value="falta_justificada">Falta Justificada</option>
                        <option id="optionInjustificada" value="falta_injustificada">Falta Injustificada</option>
                    </select>
                    <br /><br />
                </div>
                <div id="divFaltasLicencaMedica"
                    data-categoria-falta="Licença e Falta Médica"
                    class="divCategoriaFalta d-none">
                    <?php foreach ($tiposFaltas as $tipoFalta) : ?>
                        <?php if ($tipoFalta['TPF_categoria'] == 'Licença e Falta Médica') : ?>
                            <div>
                                <input type="radio" class="option-falta"
                                    id="radioTipoFalta<?= $tipoFalta['TPF_id'] ?>"
                                    data-intervalo-fixo="<?= $tipoFalta['TPF_intervalo_fixo'] ?>"
                                    data-max-dias="<?= $tipoFalta['TPF_max_dias'] ?>"
                                    data-tipo-intervalo="<?= $tipoFalta['TPF_tipo_intervalo'] ?>"
                                    value="<?= $tipoFalta['TPF_id'] ?>"
                                    name="id_tipo_falta">
                                <label for="radioTipoFalta<?= $tipoFalta['TPF_id'] ?>">
                                    <?= $tipoFalta['TPF_descricao'] ?>
                                </label>
                                <br /><br />
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>
                </div>

                <div id="divFaltasLegislacao"
                    data-categoria-falta="Falta Prevista na Legislação Trabalhista"
                    class="divCategoriaFalta d-none">
                    <?php foreach ($tiposFaltas as $tipoFalta) : ?>
                        <?php if ($tipoFalta['TPF_categoria'] == 'Falta Prevista na Legislação Trabalhista') : ?>
                            <div>
                                <input type="radio" class="option-falta"
                                    id="radioTipoFalta<?= $tipoFalta['TPF_id'] ?>"
                                    data-intervalo-fixo="<?= $tipoFalta['TPF_intervalo_fixo'] ?>"
                                    data-max-dias="<?= $tipoFalta['TPF_max_dias'] ?>"
                                    data-tipo-intervalo="<?= $tipoFalta['TPF_tipo_intervalo'] ?>"
                                    value="<?= $tipoFalta['TPF_id'] ?>"
                                    name="id_tipo_falta">
                                <label for="radioTipoFalta<?= $tipoFalta['TPF_id'] ?>">
                                    <?= $tipoFalta['TPF_descricao'] ?>
                                </label>
                                <br /><br />
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>
                </div>

                <div id="divFaltasJustificadas"
                    data-categoria-falta="Falta Justificada"
                    class="divCategoriaFalta d-none">
                    <?php foreach ($tiposFaltas as $tipoFalta) : ?>
                        <?php if ($tipoFalta['TPF_categoria'] == 'Falta Justificada') : ?>
                            <div>
                                <input type="radio" class="option-falta"
                                    id="radioTipoFalta<?= $tipoFalta['TPF_id'] ?>"
                                    data-intervalo-fixo="<?= $tipoFalta['TPF_intervalo_fixo'] ?>"
                                    data-max-dias="<?= $tipoFalta['TPF_max_dias'] ?>"
                                    data-tipo-intervalo="<?= $tipoFalta['TPF_tipo_intervalo'] ?>"
                                    value="<?= $tipoFalta['TPF_id'] ?>"
                                    name="id_tipo_falta">
                                <label for="radioTipoFalta<?= $tipoFalta['TPF_id'] ?>">
                                    <?= $tipoFalta['TPF_descricao'] ?>
                                </label>
                                <br /><br />
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>
                </div>

                <div id="divFaltasInjustificadas"
                    data-categoria-falta="Falta Injustificada"
                    class="divCategoriaFalta d-none">
                    <?php foreach ($tiposFaltas as $tipoFalta) : ?>
                        <?php if ($tipoFalta['TPF_categoria'] == 'Falta Injustificada') : ?>
                            <div>
                                <input type="radio" class="option-falta"
                                    id="radioTipoFalta<?= $tipoFalta['TPF_id'] ?>"
                                    data-intervalo-fixo="<?= $tipoFalta['TPF_intervalo_fixo'] ?>"
                                    data-max-dias="<?= $tipoFalta['TPF_max_dias'] ?>"
                                    data-tipo-intervalo="<?= $tipoFalta['TPF_tipo_intervalo'] ?>"
                                    value="<?= $tipoFalta['TPF_id'] ?>"
                                    name="id_tipo_falta">
                                <label for="radioTipoFalta<?= $tipoFalta['TPF_id'] ?>">
                                    <?= $tipoFalta['TPF_descricao'] ?>
                                </label>
                                <br /><br />
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>
                </div>
                <div>
                    <div>
                        <div id="divDataInicialFalta" class="d-none">
                            <br />
                            <label id="labelDataInicialFalta" for="inputDataInicialFalta">Data Inicial da Falta: </label>
                            <input type="date" id="inputDataInicialFalta" name="data_inicial_falta" class="dataFalta">
                        </div>
                        <br /><br />
                        <div id="divPeriodoDias" class="d-none">
                            <label for="inputPeriodoDias">Dias Afastado: </label>
                            <input type="number" id="inputPeriodoDias" name="quantidade_dias" min="1" step="1" value="1" class="dias">
                            <label for="inputDataFinalFalta">Data Final da Falta: </label>
                            <input type="date" id="inputDataFinalFalta" disabled>
                            <br /><br />
                        </div>
                        <div id="divPeriodoHoras" class="d-none">
                            <div>
                                <span>Tipo da Falta por Horário</span>
                                <br /><br />
                                <div>
                                    <input type="radio" name="tipo_falta_horas" id="inputRadioAtraso" value="atraso" checked>
                                    <label for="inputRadioAtraso">Atraso</label>
                                </div>
                                <br /><br />
                                <div>
                                    <input type="radio" name="tipo_falta_horas" id="inputRadioSaida" value="saida_antecipada">
                                    <label for="inputRadioSaida">Saída Antecipada</label>
                                </div>
                                <br />
                            </div>
                            <div>
                                <label id="labelHorarioFalta" for="inputHorarioFalta">Chegada Entre:</label>
                                <select id="selectHorarioFalta" disabled>
                                    <option value="">Informe a data primeiro</option>
                                </select>
                                <br /><br />
                            </div>
                        </div>
                    </div>
                    <div id="divAnexo" class="d-none">
                        <label for="fileInput" id="fileLabel" class="file-label">Anexar comprovante</label>
                        <input type="file" id="fileInput" class="file-input" name="comprovante" accept="image/*">
                        <span id="fileName" class="file-name">Nenhum arquivo selecionado</span>
                    </div>
                    <div id="divMotivoFalta" class="d-none">
                        <label for="textareaMotivoFalta">Motivo da Falta</label>
                        <textarea name="texto_justificativa" id="textareaMotivoFalta"></textarea>
                    </div>
                    <div>
                        <p id="pCadastroNegado" class="d-none">Cadastro negado: Você não ministra nenhuma aula no período!</p>
                    </div>
                    <div>
                        <input type="submit" value="Enviar" id="btnEnviar">
                    </div>
                </div>
            </form>
        </div>
    </main>
    <?php
    require_once '../components/rodape.php'
    ?>
    <script src="../../assets/js/formulario-justificativa.js"></script>
    <?php if (isset($_GET['editar_justificativa'])) : ?>
        <script src='../../assets/js/reenvio-justificativa.js'></script>
    <?php endif; ?>
</body>

</html>