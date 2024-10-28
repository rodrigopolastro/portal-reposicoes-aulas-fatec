-- Cria os tipos de faltas permitidos, os cursos da FATEC Itapira e 
-- todos os horários possíveis para aulas

USE portal_reposicoes_aulas_fatec;

INSERT INTO TIPOS_FALTAS (
    TPF_categoria,
    TPF_descricao,
    TPF_tipo_intervalo,
    TPF_max_dias,
    TPF_intervalo_fixo
) VALUES 
    ('Licença e Falta Médica', 'Falta Médica (Atestado médico de 1 dia)', 'dias', 1, TRUE),
    ('Licença e Falta Médica', 'Comparecimento ao Médico em período', 'horas', NULL, FALSE),
    ('Licença e Falta Médica', 'Licença-Saúde (Atestado médico igual ou superior a 2 dias)', 'dias', NULL, FALSE),
    ('Licença e Falta Médica', 'Licença-Maternidade (Atestado médico de até 15 dias)',  'dias', 15, FALSE),

    ('Falta Injustificada', 'Falta', 'dias', NULL, FALSE),
    ('Falta Injustificada', 'Atraso', 'horas', NULL, FALSE),
    ('Falta Injustificada', 'Saída Antecipada', 'horas', NULL, FALSE),

    ('Falta Justificada', 'Falta', 'dias', NULL, FALSE),
    ('Falta Justificada', 'Atraso', 'horas', NULL, FALSE),
    ('Falta Justificada', 'Saída Antecipada', 'horas', NULL, FALSE),

    ('Falta Prevista na Legislação Trabalhista', 'Falecimento de cônjuge, pai, mãe, filho', 'dias', 9, TRUE),
    ('Falta Prevista na Legislação Trabalhista', 'Falecimento ascendente (exceto pai e mãe), descendente (exceto filho), irmão ou pessoa declarada na CTPS, que viva sob sua dependência econômica', 'dias', 2, TRUE),
    ('Falta Prevista na Legislação Trabalhista', 'Casamento', 'dias', 9, TRUE),
    ('Falta Prevista na Legislação Trabalhista', 'Nascimento de filho, no decorrer da primeira semana', 'dias', 5, TRUE),
    ('Falta Prevista na Legislação Trabalhista', 'Acompanhar esposa ou companheira no período de gravidez, em consultas médicas e exames complementares', 'dias', 2, FALSE),
    ('Falta Prevista na Legislação Trabalhista', 'Acompanhar filho de até 6 anos em consulta médica', 'dias', 1, TRUE),
    ('Falta Prevista na Legislação Trabalhista', 'Doação voluntária de sangue', 'dias', 1, TRUE),
    ('Falta Prevista na Legislação Trabalhista', 'Alistamento como eleitor', 'dias', 2, FALSE),
    ('Falta Prevista na Legislação Trabalhista', 'Convocação para depoimento judicial', 'horas', NULL, FALSE),
    ('Falta Prevista na Legislação Trabalhista', 'Comparecimento como jurado no Tribunal do Júri', 'horas', NULL, FALSE),
    ('Falta Prevista na Legislação Trabalhista', 'Convocação para serviço eleitoral', 'horas', NULL, FALSE),
    ('Falta Prevista na Legislação Trabalhista', 'Dispensa dos dias devido à nomeação para compor as mesas receptoras ou juntas eleitorais nas eleições ou requisitado para auxiliar seus trabalhos (Lei nº 9.504/97)', 'dias', NULL, FALSE),
    ('Falta Prevista na Legislação Trabalhista', 'Realização de Prova de Vestibular para ingresso em estabelecimento de ensino superior', 'horas', NULL, FALSE),
    ('Falta Prevista na Legislação Trabalhista', 'Comparecimento necessário como parte na Justiça do Trabalho (Enunciado TST nº 155)', 'horas', NULL, FALSE),
    ('Falta Prevista na Legislação Trabalhista', 'Atrasos decorrentes de acidentes de transporte, com atestado da empresa concessionária', 'horas', NULL, FALSE);

INSERT INTO CURSOS (
    CUR_nome,
    CUR_sigla
) VALUES 
    ('Desenvolvimento de Software Multiplataforma', 'DSM'),
    ('Gestão da Produção Industrial', 'GPI'),
    ('Gestão Empresarial', 'GE');
    
INSERT INTO HORARIOS_FATEC (
    HRF_ordem_dia_semana,
    HRF_nome_dia_semana, 
    HRF_horario_inicio, 
    HRF_horario_fim
) VALUES 
    (1, 'segunda', '13:00', '13:50'),
    (1, 'segunda', '13:50', '14:40'),
    (1, 'segunda', '14:50', '15:40'),
    (1, 'segunda', '15:40', '16:30'),
    (1, 'segunda', '16:40', '17:30'),
    (1, 'segunda', '17:30', '18:20'), 
    (1, 'segunda', '18:10', '19:00'),
    (1, 'segunda', '19:00', '19:50'),
    (1, 'segunda', '19:50', '20:40'),
    (1, 'segunda', '20:50', '21:40'),
    (1, 'segunda', '21:40', '22:30'), 
    (2, 'terça', '13:00', '13:50'),
    (2, 'terça', '13:50', '14:40'),
    (2, 'terça', '14:50', '15:40'),
    (2, 'terça', '15:40', '16:30'),
    (2, 'terça', '16:40', '17:30'),
    (2, 'terça', '17:30', '18:20'),
    (2, 'terça', '18:10', '19:00'),
    (2, 'terça', '19:00', '19:50'),
    (2, 'terça', '19:50', '20:40'),
    (2, 'terça', '20:50', '21:40'),
    (2, 'terça', '21:40', '22:30'),
    (3, 'quarta', '13:00', '13:50'),
    (3, 'quarta', '13:50', '14:40'),
    (3, 'quarta', '14:50', '15:40'),
    (3, 'quarta', '15:40', '16:30'),
    (3, 'quarta', '16:40', '17:30'),
    (3, 'quarta', '17:30', '18:20'),
    (3, 'quarta', '18:10', '19:00'),
    (3, 'quarta', '19:00', '19:50'),
    (3, 'quarta', '19:50', '20:40'),
    (3, 'quarta', '20:50', '21:40'),
    (3, 'quarta', '21:40', '22:30'),
    (4, 'quinta', '13:00', '13:50'),
    (4, 'quinta', '13:50', '14:40'),
    (4, 'quinta', '14:50', '15:40'),
    (4, 'quinta', '15:40', '16:30'),
    (4, 'quinta', '16:40', '17:30'),
    (4, 'quinta', '17:30', '18:20'),
    (4, 'quinta', '18:10', '19:00'),
    (4, 'quinta', '19:00', '19:50'),
    (4, 'quinta', '19:50', '20:40'),
    (4, 'quinta', '20:50', '21:40'),
    (4, 'quinta', '21:40', '22:30'),
    (5, 'sexta', '13:00', '13:50'),
    (5, 'sexta', '13:50', '14:40'),
    (5, 'sexta', '14:50', '15:40'),
    (5, 'sexta', '15:40', '16:30'),
    (5, 'sexta', '16:40', '17:30'),
    (5, 'sexta', '17:30', '18:20'),
    (5, 'sexta', '18:10', '19:00'),
    (5, 'sexta', '19:00', '19:50'),
    (5, 'sexta', '19:50', '20:40'),
    (5, 'sexta', '20:50', '21:40'),
    (5, 'sexta', '21:40', '22:30'),
    (6, 'sábado', '07:40', '08:30'),
    (6, 'sábado', '08:30', '09:20'),
    (6, 'sábado', '09:20', '10:10'),
    (6, 'sábado', '10:10', '11:00'),
    (6, 'sábado', '11:10', '12:00'),
    (6, 'sábado', '12:00', '12:50'),
    (6, 'sábado', '13:00', '13:50'),
    (6, 'sábado', '13:50', '14:40'),
    (6, 'sábado', '14:50', '15:40'),
    (6, 'sábado', '15:40', '16:30'),
    (6, 'sábado', '16:40', '17:30'),
    (6, 'sábado', '17:30', '18:20');


