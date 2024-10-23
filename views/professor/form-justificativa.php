<?php
require_once $_SERVER['DOCUMENT_ROOT'] .
    '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';

require_once caminhoAbsoluto('controllers/tipos-faltas.php');
$tiposFaltas = controllerTiposFaltas('selectTiposFaltas')
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/estilo-geral.css">
    <link rel="stylesheet" href="../../assets/css/utilidades.css">
    <title>Formulário de Justificativa de Falta</title>

</head>

<body>
    <header>
        <div class="topo">
            <div class="fundo"><img src="img/logo-governo-do-estado-sp.png" alt="logo" class="logo-governo"></div>
            <div class="fundo2"><img src="img/logo-fatec_itapira.png" alt="logo" class="logo-fatec"></div>
        </div>
        <nav>
            <a href="index-professor.html" class="botao-nav">Início</a>
            <a href="enviar-formularios.html" class="botao-nav">Enviar formulário</a>
            <a href="lista-enviados.html" class="botao-nav">Formulários enviados</a>
            <a href="login.html" class="botao-nav">Sair</a>
        </nav>
    </header>
    <main>
        <h1>Formulário para Justificativa de Faltas:</h1>
        <div class="corpo">
            <form method="POST" action="./gera-pdf-formulario.php" enctype="multipart/form-data">
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

                <label for="categoria_falta">Categoria da Falta:</label>
                <select id="selectCategoriaFalta" name="categoria_falta">
                    <option id="optionNenhumaOpcao" value="">Selecione...</option>
                    <option id="optionlicencaMedica" value="licenca_medica">Licença e Falta Médica </option>
                    <option id="optionLegislacao" value="legislacao_trabalhista">Faltas Previstas na Legislação Trabalhista</option>
                    <option id="optionJustificada" value="falta_justificada">Faltas Justificadas (Se deferido, não implicam em desconto do Descanso Semanal Remunerado – DSR)</option>
                    <option id="optionInjustificada" value="falta_injustificada">Faltas Injustificadas (Com desconto do Descanso Semanal Remunerado – DSR) </option>
                </select>

                <div id="divFaltasLicencaMedica" class="d-none">
                    <?php foreach ($tiposFaltas as $tipoFalta) : ?>
                        <?php if ($tipoFalta['TPF_categoria'] == 'Licença e Falta Médica') : ?>
                            <div>
                                <input type="radio" class="option-falta" 
                                    data-tipo-intervalo="<?= $tipoFalta['TPF_tipo_intervalo'] ?>"  
                                    value="<?= $tipoFalta['TPF_id'] ?>" 
                                    name="tipoFalta">
                                <label><?= $tipoFalta['TPF_descricao'] ?></label>
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>
                </div>

                <div id="divFaltasLegislacao" class="d-none">
                    <?php foreach ($tiposFaltas as $tipoFalta) : ?>
                        <?php if ($tipoFalta['TPF_categoria'] == 'Falta Prevista na Legislação Trabalhista') : ?>
                            <div>
                                <input type="radio" class="option-falta" 
                                    data-tipo-intervalo="<?= $tipoFalta['TPF_tipo_intervalo'] ?>"  
                                    value="<?= $tipoFalta['TPF_id'] ?>" 
                                    name="tipoFalta">
                                <label><?= $tipoFalta['TPF_descricao'] ?></label>
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>
                </div>

                <div id="divFaltasJustificadas" class="d-none">
                    <?php foreach ($tiposFaltas as $tipoFalta) : ?>
                        <?php if ($tipoFalta['TPF_categoria'] == 'Falta Justificada') : ?>
                            <div>
                                <input type="radio" class="option-falta" 
                                    data-tipo-intervalo="<?= $tipoFalta['TPF_tipo_intervalo'] ?>"  
                                    value="<?= $tipoFalta['TPF_id'] ?>" 
                                    name="tipoFalta">
                                <label><?= $tipoFalta['TPF_descricao'] ?></label>
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>
                </div>

                <div id="divFaltasInjustificadas" class="d-none">
                    <?php foreach ($tiposFaltas as $tipoFalta) : ?>
                        <?php if ($tipoFalta['TPF_categoria'] == 'Falta Injustificada') : ?>
                            <div>
                                <input type="radio" class="option-falta" 
                                    data-tipo-intervalo="<?= $tipoFalta['TPF_tipo_intervalo'] ?>"  
                                    value="<?= $tipoFalta['TPF_id'] ?>" 
                                    name="tipoFalta">
                                <label><?= $tipoFalta['TPF_descricao'] ?></label>
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>
                </div>
                <div>
                    <div class="d-flex">
                        <div id="divDataFalta" class="d-none">
                            <label for="dataFalta">Data Falta: </label>
                            <input type="date" id="dataFalta" name="data_dia">
                        </div>
                        <div id="divPeriodoDias" class="d-none d-flex">
                            <label for="periodoDias">Dias Afastado: </label>
                            <input type="number" id="periodoDias" name="numericBox" min="1" step="1" value="1">
                            <label for="dataFinal">Dia final: </label>
                            <input type="date" id="dataFinal" name="data_dia" disabled>
                        </div>
                        <div id="divPeriodoHoras" class="d-none d-flex">
                            <label id="horarioInicial" for="dataHora">Horário Inicial: </label>
                            <input type="time" id="horarioInicial" name="timeInput">
                            <label for="horarioFinal">Horário Final</label>
                            <input type="time" id="horarioFinal" name="timeInput">
                        </div>
                    </div>
                    <div id="divAnexo">
                        <label for="fileInput" id="fileLabel" class="d-none file-label">Anexar comprovante</label>
                        <input type="file" id="fileInput" class="d-none file-input" name="comprovante" accept="image/*">
                        <span id="fileName" class="d-none file-name">Nenhum arquivo selecionado</span>
                    </div>
                    <div>
                        <input type="submit" value="Enviar">
                        <input type="reset" name="Limpar">
                    </div>
                </div>
            </form>
        </div>
    </main>
    <footer class="site-footer">
        <div class="footer">
            <img src="img/logo-governo-do-estado-sp.png" alt="logo" class="logo-governo-rodape">
            <p class="rodape">Fatec Ogari de Castro Pacheco - Rua Tereza Lera Paoletti, 570/590 - Jardim Bela Vista - CEP: 13974-080</p>
            <p class="rodape">Telefone: (19) 3843-1996 | (19) 3863-5210 (WhatsApp)</p>
            <p class="rodape">&copy; 2024 Equipe 6Tec. Todos os direitos reservados.</p>
        </div>
    </footer>
    <script src="../../assets/js/formulario-justificativa.js"></script>
</body>

</html>