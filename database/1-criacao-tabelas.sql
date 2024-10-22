DROP DATABASE IF EXISTS portal_reposicoes_aulas_fatec;
CREATE DATABASE portal_reposicoes_aulas_fatec;
USE portal_reposicoes_aulas_fatec;

CREATE TABLE CURSOS (
    CUR_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    CUR_nome VARCHAR(100) NOT NULL,
    CUR_sigla VARCHAR(5),
    CONSTRAINT UNQ_CURSOS_nome UNIQUE (CUR_nome)
);

CREATE TABLE USUARIOS (
    USR_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    USR_id_curso_coordenado INTEGER, -- Se usuário for do tipo "coordenador"
    USR_nome_completo VARCHAR(100) NOT NULL,
    USR_cpf CHAR(11) NOT NULL,
    USR_numero_matricula CHAR(13) NOT NULL,
    USR_tipo VARCHAR(30) NOT NULL,
    USR_email VARCHAR(100) NOT NULL,
    USR_senha VARCHAR(20) NOT NULL,

    CONSTRAINT UNQ_USUARIOS_cpf UNIQUE (USR_cpf),
    CONSTRAINT UNQ_USUARIOS_numero_matricula UNIQUE (USR_numero_matricula),
    CONSTRAINT CHK_USUARIOS_tipo 
        CHECK (USR_tipo IN (
            'admin',
            'professor', 
            'coordenador',
            'secretaria'
        )),
    CONSTRAINT UNQ_USUARIOS_email UNIQUE (USR_email),
    CONSTRAINT FK_CURSOS_USUARIOS
        FOREIGN KEY (USR_id_curso_coordenado)
        REFERENCES CURSOS (CUR_id)
        ON DELETE RESTRICT
);

CREATE TABLE DISCIPLINAS (
    DCP_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    DCP_id_professor INTEGER,
    DCP_id_curso INTEGER NOT NULL,
    DCP_nome VARCHAR(100) NOT NULL,
    DCP_sigla VARCHAR(5),
    DCP_semestre INTEGER,

    CONSTRAINT UNQ_DISCIPLINAS_id_curso_e_nome UNIQUE (DCP_id_curso, DCP_nome),
    CONSTRAINT FK_USUARIOS_DISCIPLINAS
        FOREIGN KEY (DCP_id_professor)
        REFERENCES USUARIOS (USR_id)
        ON DELETE SET NULL,
    CONSTRAINT FK_CURSOS_DISCIPLINAS
        FOREIGN KEY (DCP_id_curso)
        REFERENCES CURSOS (CUR_id)
        ON DELETE RESTRICT,
    CONSTRAINT CHK_DISCIPLINAS_semestre CHECK (DCP_semestre BETWEEN 1 AND 6)
);

CREATE TABLE TIPOS_FALTAS (
    TPF_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    TPF_categoria VARCHAR(100) NOT NULL,
    TPF_descricao VARCHAR(300) NOT NULL,
    TPF_tipo_intervalo VARCHAR(30) NOT NULL,
    TPF_max_dias INTEGER NOT NULL, -- Se for 0, não possui máximo
    TPF_intervalo_fixo BOOLEAN NOT NULL,
    
    CONSTRAINT UNQ_TIPOS_FALTAS_categoria_e_descricao UNIQUE (TPF_categoria, TPF_descricao),
    CONSTRAINT CHK_TIPOS_FALTAS_categoria 
        CHECK (TPF_categoria IN (
            'Licença e Falta Médica',
            'Falta Injustificada',
            'Falta Justificada',
            'Falta Prevista na Legislação Trabalhista'
        )),
    CONSTRAINT CHK_TIPOS_FALTAS_tipo_intervalo
    CHECK (TPF_tipo_intervalo IN (
        'dias',
        'horas'
    )),
    CONSTRAINT CHK_TIPOS_FALTAS_max_dias CHECK (TPF_max_dias >= 0)
);

CREATE TABLE JUSTIFICATIVAS_FALTAS (
    JUF_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    JUF_id_tipo_falta INTEGER NOT NULL,
    JUF_texto_justificativa VARCHAR(500),
    JUF_status VARCHAR(30) NOT NULL,
    JUF_data_envio TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    JUF_data_aprovacao TIMESTAMP NULL DEFAULT NULL,
    JUF_feedback_coordenador VARCHAR(300),

    CONSTRAINT CHK_JUSTIFICATIVAS_FALTAS_status
        CHECK (JUF_status IN (
            'deferido',
            'indeferido',
            'em análise'
        )),
    CONSTRAINT FK_TIPOS_FALTAS_JUSTIFICATIVAS_FALTAS
        FOREIGN KEY (JUF_id_tipo_falta)
        REFERENCES TIPOS_FALTAS (TPF_id)
        ON DELETE RESTRICT
);

CREATE TABLE COMPROVANTES_FALTAS (
    CVF_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    CVF_id_justificativa INTEGER NOT NULL,
    CVF_nome_arquivo VARCHAR(100) NOT NULL,

    CONSTRAINT UNQ_COMPROVANTES_FALTAS_nome_arquivo UNIQUE (CVF_nome_arquivo),
    CONSTRAINT FK_JUSTIFICATIVAS_FALTAS_COMPROVANTES_FALTAS
        FOREIGN KEY (CVF_id_justificativa)
        REFERENCES JUSTIFICATIVAS_FALTAS (JUF_id)
        ON DELETE CASCADE
);

CREATE TABLE PLANOS_REPOSICOES (
    PLR_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    PLR_id_justificativa INTEGER NOT NULL,
    PLR_status VARCHAR(30) NOT NULL,
    PLR_data_envio TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PLR_data_aprovacao TIMESTAMP NULL DEFAULT NULL,
    PLR_feedback_coordenador VARCHAR(300),

    CONSTRAINT CHK_PLANOS_REPOSICOES_status
        CHECK (PLR_status IN (
            'deferido',
            'indeferido',
            'em análise'
        )),
    CONSTRAINT FK_JUSTIFICATIVAS_FALTAS_PLANOS_REPOSICOES
        FOREIGN KEY (PLR_id_justificativa)
        REFERENCES JUSTIFICATIVAS_FALTAS (JUF_id)
        ON DELETE RESTRICT
);

CREATE TABLE HORARIOS_FATEC (
    HRF_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    HRF_ordem_dia_semana INTEGER NOT NULL,
    HRF_nome_dia_semana VARCHAR(10) NOT NULL,
    HRF_horario_inicio CHAR(5) NOT NULL, -- Format: "HH:mm"
    HRF_horario_fim CHAR(5) NOT NULL, -- Format: "HH:mm"

    CONSTRAINT UNQ_HORARIOS_FATEC_dia_semana_e_horarios 
        UNIQUE (HRF_nome_dia_semana, HRF_horario_inicio, HRF_horario_fim),
    CONSTRAINT CHK_HORARIOS_FATEC_ordem_dia_semana
        CHECK (HRF_ordem_dia_semana BETWEEN 1 AND 6),
    CONSTRAINT CHK_HORARIOS_FATEC_nome_dia_semana
        CHECK (HRF_nome_dia_semana IN (
            'segunda',
            'terça',
            'quarta',
            'quinta',
            'sexta',
            'sábado'
        ))
);

CREATE TABLE HORARIOS_DISCIPLINAS (
    HRD_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    HRD_id_horario INTEGER NOT NULL,
    HRD_id_disciplina INTEGER NOT NULL,

    CONSTRAINT FK_HORARIOS_FATEC_HORARIOS_DISCIPLINAS
        FOREIGN KEY (HRD_id_horario)
        REFERENCES HORARIOS_FATEC (HRF_id)
        ON DELETE RESTRICT,
    CONSTRAINT FK_DISCIPLINAS_HORARIOS_DISCIPLINAS
        FOREIGN KEY (HRD_id_disciplina)
        REFERENCES DISCIPLINAS (DCP_id)
        ON DELETE CASCADE
);

CREATE TABLE HORARIOS_FALTAS (
    HRF_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    HRF_id_horario INTEGER NOT NULL,
    HRF_id_justificativa INTEGER NOT NULL,
    HRF_data_falta DATE NOT NULL,

    CONSTRAINT FK_HORARIOS_FATEC_HORARIOS_FALTAS
        FOREIGN KEY (HRF_id_horario)
        REFERENCES HORARIOS_FATEC (HRF_id)
        ON DELETE RESTRICT,
    CONSTRAINT FK_JUSTIFICATIVAS_FALTAS_HORARIOS_FALTAS
        FOREIGN KEY (HRF_id_justificativa)
        REFERENCES JUSTIFICATIVAS_FALTAS (JUF_id)
        ON DELETE CASCADE
);

CREATE TABLE HORARIOS_REPOSICOES (
    HRR_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    HRR_id_horario INTEGER NOT NULL,
    HRR_id_reposicao INTEGER NOT NULL,
    HRR_data_reposicao DATE NOT NULL,

    CONSTRAINT FK_HORARIOS_FATEC_HORARIOS_REPOSICOES
        FOREIGN KEY (HRR_id_horario)
        REFERENCES HORARIOS_FATEC (HRF_id)
        ON DELETE RESTRICT,
    CONSTRAINT FK_PLANOS_REPOSICOES_HORARIOS_REPOSICOES
        FOREIGN KEY (HRR_id_reposicao)
        REFERENCES PLANOS_REPOSICOES (PLR_id)
        ON DELETE CASCADE
);