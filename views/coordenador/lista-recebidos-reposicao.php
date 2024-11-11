<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/estilo-geral.css">
    <title>Reposição de aulas</title>

</head>

<body>
    <header>
        <div class="topo">
            <div class="fundo"><img src="../../assets/images/logo-governo-do-estado-sp.png" alt="logo"
                    class="logo-governo"></div>
            <div class="fundo2"><img src="../../assets/images/logo-fatec_itapira.png" alt="logo" class="logo-fatec">
            </div>
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
        <h1>Reposição de Aulas Recebidas</h1>
        

        <!-- <div id="recebidos">
            <div class="topo-form">
                <form id="filtro-form-recebidos">
                    <div class="filtro-form">
                        <label for="filterTipo">Professor: </label>
                        <select id="filterTipo" class="filter-input">
                            <option value="">Todos</option>
                            <option value="Wladimir José Camillo Menegassi">Wladimir José Camillo Menegassi</option>
                            <option value="Janaina">Janaina</option>
                            <option value="Ana Célia Ribeiro Bizigato Portes">Ana Célia Ribeiro Bizigato Portes</option>
                            <option value="José Gonçalves Pinto Juniors">José Gonçalves Pinto Juniors</option>
                            <option value="Edison Kazuo Igarashi">Edison Kazuo Igarashi</option>
                            <option value="Thiago Salhab Alves">Thiago Salhab Alves</option>
                        </select>

                        <input type="submit" value="Aplicar filtro">
                        <input type="reset" name="Limpar" value="Limpar filtro">
                    </div>
                </form>
            </div> -->

            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th class="ordem">Data de recebimento</th>
                            <th class="ordem">Data de falta</th>
                            <th class="componente">Professor</th>
                            <th class="componente">Disciplina</th>
                            <th class="status">Data da reposição</th>
                            <th class="ordem"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>12/05/2024</td>
                            <td>10/04/2024</td>
                            <td>Wladimir José Camillo Menegassi</td>
                            <td>Modelagem de Banco de Dados</td>
                            <td>15/04/2024</td>
                            <td class="centro"><a href="avaliar-reposicao.html"><img
                                        src="../../assets/images/analisar.png" class="iconeAnalisar"></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        


        <script>
            document.getElementById('botao-recebidos').addEventListener('click', function () {
                document.getElementById('recebidos').style.display = 'block';
                document.getElementById('finalizados').style.display = 'none';
            });

            document.getElementById('botao-finalizados').addEventListener('click', function () {
                document.getElementById('recebidos').style.display = 'none';
                document.getElementById('finalizados').style.display = 'block';
            });

        </script>

    </main>
    <footer class="site-footer">
        <div class="footer">
            <img src="../../assets/images/logo-governo-do-estado-sp.png" alt="logo" class="logo-governo-rodape">
            <p class="rodape">Fatec Ogari de Castro Pacheco - Rua Tereza Lera Paoletti, 570/590 - Jardim Bela Vista -
                CEP: 13974-080</p>
            <p class="rodape">Telefone: (19) 3843-1996 | (19) 3863-5210 (WhatsApp)</p>
            <p class="rodape">&copy; 2024 Equipe 6Tec. Todos os direitos reservados.</p>
        </div>
    </footer>

</body>

</html>