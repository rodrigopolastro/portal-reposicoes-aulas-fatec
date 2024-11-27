async function buscaDadosJustificativa(idJustificativaFalta) {
    try {
        const response = await fetch(
            "../../controllers/justificativas-faltas.php",
            {
                method: "POST",
                mode: "same-origin",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: JSON.stringify({
                    acao_justificativas_faltas: "busca_justificativa_falta",
                    params: {
                        id_justificativa: idJustificativaFalta,
                    },
                }),
            }
        );
        const justificativaFalta = await response.json();
        return justificativaFalta;
    } catch (erro) {
        return erro;
    }
}

async function buscaDatasAusenciasJustificativa(idJustificativaFalta) {
    try {
        const response = await fetch(
            "../../controllers/horarios-ausencias.php",
            {
                method: "POST",
                mode: "same-origin",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: JSON.stringify({
                    acao_horarios_ausencias:
                        "busca_datas_ausencias_justificativa",
                    params: {
                        id_justificativa: idJustificativaFalta,
                    },
                }),
            }
        );

        const datasAusencias = response.json();
        return datasAusencias;
    } catch (erro) {
        console.error(
            "Erro na busca pelas datas da ausências da justificativa: ",
            erro
        );
    }
}

const urlParams = new URLSearchParams(window.location.search);
const idJustificativaFalta = urlParams.get("editar_justificativa");

async function carregaFormulario() {
    if (idJustificativaFalta) {
        const justificativaFalta = await buscaDadosJustificativa(
            idJustificativaFalta
        );
        const datasAusencias = await buscaDatasAusenciasJustificativa(
            idJustificativaFalta
        );

        if (justificativaFalta && datasAusencias) {
            preencheDadosFormulario(justificativaFalta, datasAusencias);
        } else {
            console.error(
                "Ocorreu um erro ao carregar os dados da justificativa de falta"
            );
        }
    }
}

async function preencheDadosFormulario(justificativaFalta, datasAusencias) {
    console.log(justificativaFalta);
    console.log(datasAusencias);
    //Seleciona categoria da falta
    let selectCategoriaFalta = document.getElementById("selectCategoriaFalta");
    let indexFaltaSelecionado = Array.from(
        selectCategoriaFalta.options
    ).findIndex(
        (option) => option.textContent == justificativaFalta.TPF_categoria
    );
    selectCategoriaFalta.selectedIndex = indexFaltaSelecionado;

    exibeDivsCategoria();

    //Exibe opções de tipos de falta da categoria
    let divCategoriaFaltaSelecionada = Array.from(
        document.getElementsByClassName("divCategoriaFalta")
    ).find(
        (div) => div.dataset.categoriaFalta == justificativaFalta.TPF_categoria
    );
    divCategoriaFaltaSelecionada.classList.remove("d-none");

    //Seleciona o tipo de falta
    let tipoFaltaSelecionada = document.getElementById(
        "radioTipoFalta" + justificativaFalta.TPF_id
    );
    tipoFaltaSelecionada.checked = true;

    //Preenche input que armazena o tipo de intervalo da falta ("dias" ou "horas")
    document.getElementById("inputTipoIntervalo").value =
        tipoFaltaSelecionada.dataset.tipoIntervalo;

    //Preenche data final, periodo de dias e data da faltqa
    let divDataInicialFalta = document.getElementById("divDataInicialFalta");
    divDataInicialFalta.classList.remove("d-none");
    let dataInicial = datasAusencias[0].HRA_data_falta;
    let dataFinal = datasAusencias[datasAusencias.length - 1].HRA_data_falta;
    let periodoDias = justificativaFalta.JUF_quantidade_dias;
    document.getElementById("inputDataInicialFalta").value = dataInicial;
    document.getElementById("inputPeriodoDias").value = periodoDias;
    document.getElementById("inputDataFinalFalta").value = dataFinal;

    //Verifica se o professor tem aulas no periodo selecionado
    await buscaAulasProfessorData(dataInicial, periodoDias);

    //Exibe componente relativo a tipo de intervalo selecionado
    if (justificativaFalta.TPF_tipo_intervalo == "dias") {
        document.getElementById("divPeriodoDias").classList.remove("d-none");
    } else if (justificativaFalta.TPF_tipo_intervalo == "horas") {
        document.getElementById("divPeriodoHoras").classList.remove("d-none");
    }
}

carregaFormulario();
