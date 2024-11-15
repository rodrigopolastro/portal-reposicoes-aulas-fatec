<style>
    table {

        text-align: center;
    }

    th,
    td {
        padding: 8px;
        background-color: #fff;
        border: 1px solid #ddd;
    }

    th {
        background-color: #0B9247;
        color: white;
    }


    .turma-em-aula {
        background-color: #d0dead;
    }

    .professor-em-aula {
        background-color: #94AA5A;
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
            <div class="legenda">
            <div class="legenda-item">
                <div class="cor-legenda turma-em-aula"></div> Turma em Aula
            </div>
            <div class="legenda-item">
                <div class="cor-legenda professor-em-aula"></div> Professor em Aula
            </div>
        </div>
        <table class="d-none">
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
