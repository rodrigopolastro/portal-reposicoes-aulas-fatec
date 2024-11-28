<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('controllers/justificativas-faltas.php');
require_once caminhoAbsoluto('controllers/horarios-ausencias.php');
require_once caminhoAbsoluto('controllers/disciplinas.php');

$justificativaFalta = controllerJustificativasFaltas(
    'busca_justificativa_falta',
    ['id_justificativa' => $_GET['id_justificativa']]
);

$horariosAusencias = controllerHorariosAusencias(
    'busca_datas_ausencias_justificativa',
    ['id_justificativa' => $_GET['id_justificativa']]
);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/estilo-geral.css">
    <link rel="stylesheet" href="../../assets/css/utilidades.css">
    <link rel="stylesheet" href="../../assets/css/grade-horaria.css">
    <link rel="stylesheet" href="../../assets/css/enviar-reposicao.css">
    <title>Enviar Plano de Reposições</title>
</head>

<body>
    <?php
    require_once '../components/cabecalho-professor.php';
    ?>
    <main>
        <div class="d-flex justify-content-center">
            <div class="w-75">
                <h1>Formulário para Reposição de Aulas</h1>
                <div class="topo-form d-none">
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
                    <div class="d-flex justify-content-end">
                        <button id="btnExibirGradeHoraria">Exibir Grade Horária</button>
                    </div>
                    <div id="divGradeHoraria" data-esta-exibida="false" class="d-none d-flex justify-content-center">
                        <div class="w-75 py-20">
                            <?php
                            require_once caminhoAbsoluto('views/components/grade-horaria.php');
                            ?>
                        </div>
                    </div>
                </div>
                <form action="../../controllers/planos-reposicoes.php" method="POST" class=" py-20">
                    <input type="hidden" name="acao_planos_reposicoes" value="cria_plano_reposicao">
                    <input type="hidden" name="id_justificativa" value="<?= $_GET['id_justificativa'] ?>">
                    <div class="">
                        <table class="w-100">
                            <thead>
                                <tr>
                                    <th class="data-rep centro">Data da(s) aula(s) não ministrada(s)</th>
                                    <th class="data-rep centro">Disciplina</th>
                                    <th class="data-rep centro">Data da Reposição</th>
                                    <th class="data-rep centro">Horário</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($horariosAusencias as $horarioAusencia): ?>
                                    <tr>
                                        <?php
                                        $dataFalta = (new DateTimeImmutable($horarioAusencia['HRA_data_falta']))->format('d/m/y');
                                        $horarioInicial = (new DateTimeImmutable($horarioAusencia['HRF_horario_inicio']))->format('H:i');
                                        $horarioFinal = (new DateTimeImmutable($horarioAusencia['HRF_horario_fim']))->format('H:i');
                                        ?>
                                        <td style="text-align: center;">
                                            <div>
                                                <span><?= $dataFalta ?></span>
                                            </div>
                                            <div>
                                                <span><?= $horarioInicial . ' - ' . $horarioFinal ?></span>
                                            </div>
                                        </td>
                                        <?php
                                        $disciplinaAusencia = controllerDisciplinas('busca_disciplina_professor_horario', [
                                            'id_professor' => $justificativaFalta['JUF_id_professor'],
                                            'id_horario' => $horarioAusencia['HRA_id_horario']
                                        ]);
                                        ?>
                                        <td><?= '(' . $disciplinaAusencia['CUR_sigla'] . ') ' . $disciplinaAusencia['DCP_nome'] ?></td>
                                        <td>
                                            <input type="date" name="datas-reposicoes[]" id="data-reposicao">
                                        </td>
                                        <td>
                                            <select name="horarios-reposicoes[]" class="select-horarios-disponiveis" style="width:80%;">
                                                <option value="">Informe a data da reposição</option>
                                            </select>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="parag d-none">
                        <br /><br />
                        <p>Observe as exigências legais: máximo de 8 horas diárias de trabalho, intervalo de 1 hora
                            entre um expediente e outro e de 6 horas em cada expediente.
                        </p>
                        <p>*Campo obrigatório</p>
                    </div>
                    <div class="w-100 d-flex justify-content-center py-20">
                        <input type="submit" value="Enviar" style="width: 200px; padding: 20px;">
                    </div>
                </form>

            </div>
        </div>
    </main>
    <?php
    require_once '../components/rodape.php'
    ?>
    <script src="../../assets/js/formulario-reposicao.js"></script>
</body>

</html>