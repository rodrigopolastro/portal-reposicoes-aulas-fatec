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
        <h1>Justificativa de Faltas Recebidas</h1>
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
        </div>

        <script>
            // Função para aplicar os filtros
            function aplicarFiltro() {
                var professorFiltro = document.getElementById('filterProfessor').value;
                var disciplinaFiltro = document.getElementById('filterDisciplina').value;

                var tabela = document.getElementById('tabela-recebidos');
                var linhas = tabela.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

                for (var i = 0; i < linhas.length; i++) {
                    var professor = linhas[i].getAttribute('data-professor');
                    var disciplina = linhas[i].getAttribute('data-disciplina');

                    if ((professorFiltro === "" || professor === professorFiltro) &&
                        (disciplinaFiltro === "" || disciplina === disciplinaFiltro)) {
                        linhas[i].classList.remove('hidden');
                    } else {
                        linhas[i].classList.add('hidden');
                    }
                }
                return false; // Evita o envio do formulário
            }

            // Função para limpar os filtros
            function limparFiltro() {
                var tabela = document.getElementById('tabela-recebidos');
                var linhas = tabela.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

                for (var i = 0; i < linhas.length; i++) {
                    linhas[i].classList.remove('hidden');
                }
            }
        </script>


        <script>
            // Função para aplicar os filtros
            function aplicarFiltroFinalizados() {
                var professorFiltro = document.getElementById('filterProfessorF').value;
                var disciplinaFiltro = document.getElementById('filterDisciplinaF').value;
                var statusFiltro = document.getElementById('filterStatusF').value;

                var tabela = document.getElementById('tabela-finalizados');
                var linhas = tabela.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

                for (var i = 0; i < linhas.length; i++) {
                    var professor = linhas[i].getAttribute('data-professor');
                    var disciplina = linhas[i].getAttribute('data-disciplina');
                    var status = linhas[i].getAttribute('data-status');

                    if ((professorFiltro === "" || professor === professorFiltro) &&
                        (disciplinaFiltro === "" || disciplina === disciplinaFiltro) &&
                        (statusFiltro === "" || status === statusFiltro)) {
                        linhas[i].classList.remove('hidden');
                    } else {
                        linhas[i].classList.add('hidden');
                    }
                }
                return false; // Evita o envio do formulário
            }

            // Função para limpar os filtros
            function limparFiltroFinalizados() {
                var tabela = document.getElementById('tabela-finalizados');
                var linhas = tabela.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

                for (var i = 0; i < linhas.length; i++) {
                    linhas[i].classList.remove('hidden');
                }
            }
        </script>

        <script>
            document.getElementById('botao-recebidos').addEventListener('click', function() {
                document.getElementById('recebidos').style.display = 'block';
                document.getElementById('finalizados').style.display = 'none';
            });

            document.getElementById('botao-finalizados').addEventListener('click', function() {
                document.getElementById('recebidos').style.display = 'none';
                document.getElementById('finalizados').style.display = 'block';
            });
        </script>

    </main>
    <footer class="site-footer">
        <div class="footer">
            <img src="../../assets/images/logo-governo-do-estado-sp.png" alt="logo" class="logo-governo-rodape">
            <p class="rodape">Fatec Ogari de Castro Pacheco - Rua Tereza Lera Paoletti, 570/590 - Jardim Bela Vista - CEP: 13974-080</p>
            <p class="rodape">Telefone: (19) 3843-1996 | (19) 3863-5210 (WhatsApp)</p>
            <p class="rodape">&copy; Equipe 6Tec. Todos os direitos reservados.</p>
        </div>
    </footer>

</body>

</html>