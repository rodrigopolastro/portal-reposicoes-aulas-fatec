<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('controllers/justificativas-faltas.php');
require_once caminhoAbsoluto('controllers/disciplinas.php');

$formulariosCoordenador = controllerJustificativasFaltas('busca_faltas_coordenador');
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/estilo-geral.css">
    <title>Formulário enviados</title>

</head>

<body>
    <header>
        <div class="topo">
            <div class="fundo"><img src="../../assets/images/logo-governo-do-estado-sp.png" alt="logo" class="logo-governo"></div>
            <div class="fundo2"><img src="../../assets/images/logo-fatec_itapira.png" alt="logo" class="logo-fatec"></div>
        </div>
        <nav>
            <a href="index.php" class="botao-nav">Início</a>
            <a href="lista-recebidos-faltas.php" class="botao-nav">Justificativas de Falta</a>
            <a href="lista-recebidos-reposicao.php" class="botao-nav">Reposição de Aulas</a>
            <a href="informacoes.html" class="botao-nav">Informações do Curso</a>
            <a href="login.html" class="botao-nav">Sair</a>
        </nav>

    </header>
    <main>
        <h1>Justificativa de Faltas Recebidas</h1>


        <!-- <div id="recebidos">
            <div class="topo-form">
                <form id="filtro-form-recebidos" onsubmit="return aplicarFiltro()">
                    <div class="filtro-form">
                        <label for="filterProfessor">Professor:</label>
                        <select id="filterProfessor" class="filter-input">
                            <option value="">Todos</option>
                            <option value="Wladimir José Camillo Menegassi">Wladimir José Camillo Menegassi</option>
                            <option value="Janaina">Janaina</option>
                            <option value="Ana Célia Ribeiro Bizigato Portes">Ana Célia Ribeiro Bizigato Portes</option>
                            <option value="Thiago Salhab Alves">Thiago Salhab Alves</option>
                            <option value="José Gonçalves Pinto Junior">José Gonçalves Pinto Junior</option>
                            <option value="Edison Kazuo Igarashi">Edison Kazuo Igarashi</option>
                        </select>
    
                        <label for="filterDisciplina">Disciplina:</label>
                        <select id="filterDisciplina" class="filter-input">
                            <option value="">Todos</option>
                            <option value="Modelagem de Banco de Dados">Modelagem de Banco de Dados</option>
                            <option value="Inglês">Inglês</option>
                            <option value="Engenharia de Software I">Engenharia de Software I</option>
                            <option value="Design Digital">Design Digital</option>
                            <option value="Algoritmo e lógica de programação">Algoritmo e lógica de programação</option>
                            <option value="Sistemas Operacionais e Redes de Computadores">Sistemas Operacionais e Redes de Computadores</option>
                        </select>
    
                        <input type="submit" value="Aplicar filtro">
                        <input type="reset" value="Limpar filtro" onclick="limparFiltro()">
                    </div>
                </form>
            </div> -->

        <div class="table">
            <table id="tabela-recebidos">
                <thead>
                    <tr>
                        <th class="ordem">Número</th>
                        <th class="ordem">Data de recebimento</th>
                        <th class="componente">Professor</th>
                        <th class="componente">Disciplina</th>
                        <th class="status">Status</th>
                        <th class="ordem">Avaliar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $contador = 1; ?>
                    <?php foreach ($formulariosCoordenador as $formularioCoordenador): ?>
                        <?php
                        $dataEnvio = $formularioCoordenador['JUF_data_envio'];
                        $dataEnvioFormatada = (new DateTimeImmutable($dataEnvio))->format('d/m/y');
                        $disciplinas = controllerDisciplinas(
                            'busca_disciplinas_justificativa',
                            ['id_justificativa' => $formularioCoordenador['JUF_id']]
                        );

                        ?>
                        <tr>
                            <td><?= $contador ?></td>
                            <td><?= $dataEnvioFormatada ?></td>
                            <td><?= $formularioCoordenador['USR_nome_completo'] ?></td>
                            <td>

                                <ul>
                                    <?php foreach ($disciplinas as $disciplina) : ?>
                                        <li><?= '(' . $disciplina['CUR_sigla'] . ') ' . $disciplina['DCP_nome'] ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                            <td><?= ucfirst($formularioCoordenador['JUF_status']) ?></td>
                            <td>
                                <?php if ($formularioCoordenador['JUF_status'] == 'em análise') : ?>
                                    <a href="../../scripts/gera-pdf-formulario.php?id_justificativa=<?= $formularioCoordenador['JUF_id'] .
                                                                                                        '&url_destino=' . caminhoAbsoluto('views/coordenador/avaliar-falta.php', true) ?>">Avaliar</a>
                                <?php else: ?>
                                    <span>Analisado</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php $contador += 1; ?>
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