<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('controllers/horarios-fatec.php');
require_once caminhoAbsoluto('controllers/horarios-disciplinas.php');

$horariosInicioFim = controllerHorariosFatec('busca_horarios_inicio_fim');
$horariosInicioFimSemana = controllerHorariosFatec('busca_horarios_inicio_fim_semana');
$aulasProfessorSemana = controllerHorariosDisciplinas('busca_aulas_professor_semana');
define('DIAS_DA_SEMANA', [
    'segunda',
    'terça',
    'quarta',
    'quinta',
    'sexta',
    'sábado'
]);

function haAulaNesseDiaDaSemanaEHorario($nomeDiaSemana, $horarioInicio)
{
    global $horariosInicioFimSemana;
    foreach ($horariosInicioFimSemana as $horarioAula) {
        if (
            $horarioAula['HRF_nome_dia_semana'] == $nomeDiaSemana &&
            $horarioAula['HRF_horario_inicio'] == $horarioInicio
        ) {
            return true;
        }
    }

    return false;
}

function buscaAulaProfessorHorario($nomeDiaSemana, $horarioInicio)
{
    global $aulasProfessorSemana;
    foreach ($aulasProfessorSemana as $aula) {
        if (
            $aula['HRF_nome_dia_semana'] == $nomeDiaSemana &&
            $aula['HRF_horario_inicio'] == $horarioInicio
        ) {
            return $aula;
        }
    }

    return null;
}
?>

<div>
    <table class="w-100" id="tableGradeHoraria">
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
            <?php foreach ($horariosInicioFim as $horarioInicioFim) : ?>
                <tr>
                    <td>
                        <strong>
                            <?= $horarioInicioFim['HRF_horario_inicio']
                                . ' - ' .
                                $horarioInicioFim['HRF_horario_fim']
                            ?>
                        </strong>
                    </td>
                    <?php foreach (DIAS_DA_SEMANA as $diaDaSemana) : ?>
                        <?php if (haAulaNesseDiaDaSemanaEHorario($diaDaSemana, $horarioInicioFim['HRF_horario_inicio'])) : ?>
                            <?php $aulaProfessor = buscaAulaProfessorHorario($diaDaSemana, $horarioInicioFim['HRF_horario_inicio']) ?>
                            <?php if (is_null($aulaProfessor)) : ?>
                                <td></td>
                            <?php else : ?>
                                <td class="professor-tem-aula">
                                    <span class="">
                                        <?= "({$aulaProfessor['CUR_sigla']}) {$aulaProfessor['DCP_sigla']}" ?>
                                    </span>
                                </td>
                            <?php endif; ?>
                        <?php else : ?>
                            <td>X</td>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>