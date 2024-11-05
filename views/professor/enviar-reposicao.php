<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/estilo-geral.css">
    <link rel="stylesheet" href="../../assets/css/utilidades.css">
    <title>Enviar Plano de Reposições</title>
</head>

<body>

</body>

</html>

<body>
    <?php
    require_once '../components/cabecalho-professor.php';
    ?>
    <main>
        <h1>Formulário para Reposição de Aulas</h1>
        <div class="topo-form">
            <form>

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


                <br><br>

                <title>Tabela de Horários</title>
                <style>
                    table {

                        text-align: center;
                    }

                    th,
                    td {
                        padding: 8px;
                        border: 1px solid #ddd;
                    }

                    th {
                        background-color: #4CAF50;
                        color: white;
                    }


                    .turma-em-aula {
                        background-color: #b60101;
                    }

                    .professor-em-aula {
                        background-color: #c900bf;
                    }

                    .legenda {
                        margin-top: 10px;
                        display: flex;
                        gap: 15px;
                    }

                    .legenda-item {
                        display: flex;
                        align-items: center;
                        gap: 5px;
                    }

                    .cor-legenda {
                        width: 15px;
                        height: 15px;
                        border: 1px solid #ddd;
                    }
                </style>
                </head>

                <body>

                    <h2>Tabela de Horários</h2>

                    <table>
                        <thead>
                            <tr>
                                <th>Horário</th>
                                <th>Segunda</th>
                                <th>Terça</th>
                                <th>Quarta</th>
                                <th>Quinta</th>
                                <th>Sexta</th>
                                <th>Sábado</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>07:40 - 08:30</td>
                                <td>X</td>
                                <td>X</td>
                                <td>X</td>
                                <td>X</td>
                                <td>X</td>
                                <td class="turma-em-aula"></td>
                            </tr>
                            <tr>
                                <td>08:30 - 09:20</td>
                                <td>X</td>
                                <td>X</td>
                                <td>X</td>
                                <td>X</td>
                                <td>X</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>09:20 - 10:10</td>
                                <td>X</td>
                                <td>X</td>
                                <td>X</td>
                                <td>X</td>
                                <td>X</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>10:10 - 11:00</td>
                                <td>X</td>
                                <td>X</td>
                                <td>X</td>
                                <td>X</td>
                                <td>X</td>
                                <td class="turma-em-aula"></td>
                            </tr>
                            <tr>
                                <td>11:10 - 12:00</td>
                                <td>X</td>
                                <td>X</td>
                                <td>X</td>
                                <td>X</td>
                                <td>X</td>
                                <td class="ocupado"></td>
                            </tr>
                            <tr>
                                <td>12:00 - 12:50</td>
                                <td>X</td>
                                <td>X</td>
                                <td>X</td>
                                <td>X</td>
                                <td>X</td>
                                <td class="professor-em-aula"></td>
                            </tr>

                            <tr>
                                <td>13:00 - 13:50</td>
                                <td></td>
                                <td class="ocupado"></td>
                                <td class="turma-em-aula"></td>
                                <td></td>
                                <td class="professor-em-aula"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>13:50 - 14:40</td>
                                <td></td>
                                <td></td>
                                <td class="ocupado"></td>
                                <td class="professor-em-aula"></td>
                                <td></td>
                                <td class="professor-em-aula"></td>
                            </tr>
                            <tr>
                                <td>14:50 - 15:40</td>
                                <td class="turma-em-aula"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="professor-em-aula"></td>
                                <td class="ocupado"></td>
                            </tr>
                            <tr>
                                <td>15:40 - 16:30</td>
                                <td></td>
                                <td></td>
                                <td class="professor-em-aula"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>16:40 - 17:30</td>
                                <td></td>
                                <td class="ocupado"></td>
                                <td></td>
                                <td class="turma-em-aula"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>17:30 - 18:20</td>
                                <td></td>
                                <td class="turma-em-aula"></td>
                                <td></td>
                                <td></td>
                                <td class="ocupado"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>18:10 - 19:00</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="professor-em-aula"></td>
                                <td></td>
                                <td>X</td>
                            </tr>
                            <tr>
                                <td>19:00 - 19:50</td>
                                <td></td>
                                <td></td>
                                <td class="professor-em-aula"></td>
                                <td></td>
                                <td class="turma-em-aula"></td>
                                <td>X</td>
                            </tr>
                            <tr>
                                <td>19:50 - 20:40</td>
                                <td></td>
                                <td class="professor-em-aula"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>X</td>
                            </tr>
                            <tr>
                                <td>20:50 - 21:40</td>
                                <td></td>
                                <td class="turma-em-aula"></td>
                                <td></td>
                                <td></td>
                                <td class="professor-em-aula"></td>
                                <td>X</td>
                            </tr>
                            <tr>
                                <td>21:40 - 22:30</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="turma-em-aula"></td>
                                <td></td>
                                <td>X</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Legenda -->
                    <div class="legenda">

                        <div class="legenda-item">
                            <div class="cor-legenda turma-em-aula"></div> Turma em Aula
                        </div>
                        <div class="legenda-item">
                            <div class="cor-legenda professor-em-aula"></div> Professor em Aula
                        </div>
                    </div>




                    <br><br>

                    <h3>Dados das Aulas de Reposição</h4>


                        <div class="table">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="data-rep">Data da(s) aula(s) não ministrada(s)</th>
                                        <th class="data-rep">Data da Reposição</th>
                                        <th class="data-rep">Horário</th>
                                        <th class="data-rep">Disciplina</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>19/08/2024</td>
                                        <td>
                                            <input type="date" name="data-reposicao" id="data-reposicao">
                                        </td>
                                        <td>
                                            <select id="hora-inicio">
                                                <option value="0">Selecione...</option>
                                                <option value="1">07h40min</option>
                                                <option value="2">08h30min</option>
                                                <option value="3">09h20min</option>
                                                <option value="4">10h10min</option>
                                                <option value="5">11h10min</option>
                                                <option value="6">12h00min</option>
                                                <option value="7">18h10min</option>
                                                <option value="8">19h00min</option>
                                                <option value="9">19h50min</option>
                                                <option value="10">20h50min</option>
                                                <option value="11">21h40min</option>
                                            </select>
                                        </td>
                                        <td>Engenharia de Software I</td>
                                    </tr>
                                    <tr>
                                        <td>19/08/2024</td>
                                        <td>
                                            <input type="date" name="data-reposicao" id="data-reposicao">
                                        </td>
                                        <td>
                                            <select id="hora-inicio" class="horario">
                                                <option value="0">Selecione...</option>
                                                <option value="1">07h40min</option>
                                                <option value="2">08h30min</option>
                                                <option value="3">09h20min</option>
                                                <option value="4">10h10min</option>
                                                <option value="5">11h10min</option>
                                                <option value="6">12h00min</option>
                                                <option value="7">18h10min</option>
                                                <option value="8">19h00min</option>
                                                <option value="9">19h50min</option>
                                                <option value="10">20h50min</option>
                                                <option value="11">21h40min</option>
                                            </select>
                                        </td>
                                        <td>Engenharia de Software I</td>
                                    </tr>
                                    <tr>
                                        <td>19/08/2024</td>
                                        <td>
                                            <input type="date" name="data-reposicao" id="data-reposicao">
                                        </td>
                                        <td>
                                            <select id="hora-inicio" class="horario">
                                                <option value="0">Selecione...</option>
                                                <option value="1">07h40min</option>
                                                <option value="2">08h30min</option>
                                                <option value="3">09h20min</option>
                                                <option value="4">10h10min</option>
                                                <option value="5">11h10min</option>
                                                <option value="6">12h00min</option>
                                                <option value="7">18h10min</option>
                                                <option value="8">19h00min</option>
                                                <option value="9">19h50min</option>
                                                <option value="10">20h50min</option>
                                                <option value="11">21h40min</option>
                                            </select>
                                        </td>
                                        <td>Engenharia de Software II</td>
                                    </tr>
                                    <tr>
                                        <td>19/08/2024</td>
                                        <td>
                                            <input type="date" name="data-reposicao" id="data-reposicao">
                                        </td>
                                        <td>
                                            <select id="hora-inicio" class="horario">
                                                <option value="0">Selecione...</option>
                                                <option value="1">07h40min</option>
                                                <option value="2">08h30min</option>
                                                <option value="3">09h20min</option>
                                                <option value="4">10h10min</option>
                                                <option value="5">11h10min</option>
                                                <option value="6">12h00min</option>
                                                <option value="7">18h10min</option>
                                                <option value="8">19h00min</option>
                                                <option value="9">19h50min</option>
                                                <option value="10">20h50min</option>
                                                <option value="11">21h40min</option>
                                            </select>
                                        </td>
                                        <td>Engenharia de Software II</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        <br><br>


                        <div class="parag">
                            <p>Observe as exigências legais: máximo de 8 horas diárias de trabalho, intervalo de 1 hora
                                entre um expediente e outro e de 6 horas em cada expediente.</p>
                            <br><br>
                            <p>*Campo obrigatório</p>
                            <br><br>
                        </div>
            </form>

            <form method="POST" action="gera-pdf-formulario-reposicao.php">
                <input type="hidden" name="file_name" value="pdf-reposicao.pdf">
                <input type="submit" value="Enviar">
            </form>

        </div>

    </main>

    <?php
    require_once '../components/rodape.php'
    ?>


</body>

</html>