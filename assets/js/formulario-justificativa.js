const divFaltasLicencaMedica = document.getElementById(
    "divFaltasLicencaMedica"
);
const divFaltasLegislacao = document.getElementById("divFaltasLegislacao");
const divFaltasJustificadas = document.getElementById("divFaltasJustificadas");
const divFaltasInjustificadas = document.getElementById(
    "divFaltasInjustificadas"
);
const selectCategoriaFalta = document.getElementById("selectCategoriaFalta");
const inputPeriodoDias = document.getElementById("inputPeriodoDias");
const inputDataInicialFalta = document.getElementById("inputDataInicialFalta");
const inputDataFinalFalta = document.getElementById("inputDataFinalFalta");
const inputTipoIntervalo = document.getElementById("inputTipoIntervalo");
const divAnexo = document.getElementById("divAnexo");

const listaOptionsFaltas = document.getElementsByClassName("option-falta");
selectCategoriaFalta.addEventListener("change", () => {
    escondeTodasDivsFaltas();
    exibeDivsCategoria();

    Array.from(listaOptionsFaltas).forEach((optionFalta) => {
        optionFalta.checked = false;
    });
});

function exibeDivsCategoria() {
    const divDataInicialFalta = document.getElementById("divDataInicialFalta");
    const divPeriodoDias = document.getElementById("divPeriodoDias");
    const divPeriodoHoras = document.getElementById("divPeriodoHoras");
    const divMotivoFalta = document.getElementById("divMotivoFalta");

    const selectedOption =
        selectCategoriaFalta.options[selectCategoriaFalta.selectedIndex];
    const idCategoriaSelecionada = selectedOption.id;

    if (idCategoriaSelecionada == "optionNenhumaOpcao") {
        divDataInicialFalta.classList.add("d-none");
        divPeriodoDias.classList.add("d-none");
        divPeriodoHoras.classList.add("d-none");
        divMotivoFalta.classList.add("d-none");
        divAnexo.classList.add("d-none"); //não possui anexo
    } else if (idCategoriaSelecionada == "optionlicencaMedica") {
        divFaltasLicencaMedica.classList.remove("d-none");
        divMotivoFalta.classList.add("d-none");
        divAnexo.classList.remove("d-none"); //anexo obrigatório
    } else if (idCategoriaSelecionada == "optionLegislacao") {
        divFaltasLegislacao.classList.remove("d-none");
        divAnexo.classList.remove("d-none"); //anexo obrigatório
        divMotivoFalta.classList.add("d-none");
    } else if (idCategoriaSelecionada == "optionJustificada") {
        divFaltasJustificadas.classList.remove("d-none");
        divMotivoFalta.classList.remove("d-none");
        divAnexo.classList.remove("d-none"); //anexo opcional
    } else if (idCategoriaSelecionada == "optionInjustificada") {
        divFaltasInjustificadas.classList.remove("d-none");
        divMotivoFalta.classList.add("d-none");
        divAnexo.classList.add("d-none"); //não possui anexo
    }
}

function escondeTodasDivsFaltas() {
    divFaltasLicencaMedica.classList.add("d-none");
    divFaltasLegislacao.classList.add("d-none");
    divFaltasJustificadas.classList.add("d-none");
    divFaltasInjustificadas.classList.add("d-none");
}

document.getElementById("fileInput").addEventListener("change", function () {
    var fileName = this.files[0]
        ? this.files[0].name
        : "Nenhum arquivo selecionado";
    document.getElementById("fileName").textContent = fileName;
});

window.addEventListener("load", () => {
    const divDataInicialFalta = document.getElementById("divDataInicialFalta");
    const labelDataInicialFalta = document.getElementById(
        "labelDataInicialFalta"
    );
    const divPeriodoDias = document.getElementById("divPeriodoDias");
    const divPeriodoHoras = document.getElementById("divPeriodoHoras");

    function atualizarPeriodoDias(optionFalta) {
        divDataInicialFalta.classList.remove("d-none");
        let intervaloFixo = optionFalta.dataset.intervaloFixo;
        let tipoIntervalo = optionFalta.dataset.tipoIntervalo;
        let maxDias = optionFalta.getAttribute("data-max-dias");

        if (tipoIntervalo == "dias") {
            labelDataInicialFalta.textContent = "Data Inicial da Falta";
            divPeriodoDias.classList.remove("d-none");
            divPeriodoHoras.classList.add("d-none");
            inputPeriodoDias.max = maxDias;

            if (intervaloFixo == 1) {
                inputPeriodoDias.min = maxDias;
            } else {
                inputPeriodoDias.min = 1;
            }

            inputPeriodoDias.value = intervaloFixo === "1" ? maxDias : "1";
        } else if (tipoIntervalo == "horas") {
            labelDataInicialFalta.textContent = "Data da Falta";
            divPeriodoDias.classList.add("d-none");
            divPeriodoHoras.classList.remove("d-none");
            inputPeriodoDias.value = 1;
        }
    }
    Array.from(listaOptionsFaltas).forEach((optionFalta) => {
        optionFalta.addEventListener("click", () => {
            atualizarPeriodoDias(optionFalta);
            inputTipoIntervalo.value = optionFalta.dataset.tipoIntervalo;
        });
    });
});
function calculaDataFinal() {
    const dias = parseInt(inputPeriodoDias.value, 10);
    const dataInicial = new Date(inputDataInicialFalta.value);

    if (!isNaN(dias) && dataInicial instanceof Date && !isNaN(dataInicial)) {
        const dataCalculada = new Date(dataInicial);
        dataCalculada.setDate(dataCalculada.getDate() + dias - 1);
        inputDataFinalFalta.value = dataCalculada.toISOString().split("T")[0];
    } else {
        inputDataFinalFalta.value = "";
    }
}

inputDataInicialFalta.addEventListener("change", () => {
    calculaDataFinal();
    buscaAulasProfessorData(
        inputDataInicialFalta.value,
        inputPeriodoDias.value
    );
});
inputPeriodoDias.addEventListener("input", () => {
    calculaDataFinal();
    buscaAulasProfessorData(
        inputDataInicialFalta.value,
        inputPeriodoDias.value
    );
});

async function buscaAulasProfessorData(dataFalta, quantidadeDias) {
    function desabilitaHorarioFalta() {
        let btnEnviar = document.getElementById("btnEnviar");
        let selectHorarioFalta = document.getElementById("selectHorarioFalta");

        selectHorarioFalta.disabled = true;
        btnEnviar.disabled = true;
        btnEnviar.classList.add("btn-disabled");

        selectHorarioFalta.length = 0;
        let option = document.createElement("option");
        option.textContent = "Informe a data primeiro";
        selectHorarioFalta.appendChild(option);
    }

    function geraListaHorariosFalta(idHorarioSelecionado) {
        let selectHorarioFalta = document.getElementById("selectHorarioFalta");
        let listaIdsHorarios = Array.from(selectHorarioFalta.options).map(
            (option) => Number(option.dataset.idHorario)
        );

        if (document.getElementById("inputRadioAtraso").checked) {
            //Teve falta na aula selecionada e nas anteriores
            idsAulasPerdidas = listaIdsHorarios.filter(
                (idHorario) => idHorario <= idHorarioSelecionado
            );
        } else if (document.getElementById("inputRadioSaida").checked) {
            //Teve falta na aula selecionada e nas próximas
            idsAulasPerdidas = listaIdsHorarios.filter(
                (idHorario) => idHorario >= idHorarioSelecionado
            );
        }

        //Grava em elemento invisível do form para enviar ao backend
        document.getElementById("inputIdsHorariosFalta").value =
            JSON.stringify(idsAulasPerdidas);
    }

    // let dataFalta = inputDataInicialFalta.value;
    // let quantidadeDias = inputPeriodoDias.value;
    if (!dataFalta || !quantidadeDias) {
        desabilitaHorarioFalta();
    }
    try {
        fetch("../../controllers/horarios-disciplinas.php", {
            method: "POST",
            mode: "same-origin",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: JSON.stringify({
                acao_horarios_disciplinas: "busca_aulas_professor_periodo",
                params: {
                    data_inicial: dataFalta,
                    quantidade_dias: quantidadeDias,
                },
            }),
        })
            .then((response) => response.json())
            .then((aulasProfessor) => {
                if (aulasProfessor.length > 0) {
                    console.log(JSON.stringify(aulasProfessor, null, 4));
                    btnEnviar.disabled = false;
                    btnEnviar.classList.remove("btn-disabled");
                    selectHorarioFalta.disabled = false;

                    selectHorarioFalta.length = 0;
                    aulasProfessor.forEach((aula) => {
                        let option = document.createElement("option");
                        option.textContent =
                            aula.HRF_horario_inicio +
                            " - " +
                            aula.HRF_horario_fim;
                        option.dataset.idHorario = aula.HRF_id;
                        selectHorarioFalta.appendChild(option);
                    });

                    selectHorarioFalta.addEventListener("change", () => {
                        let opcaoSelecionada =
                            selectHorarioFalta.options[
                                selectHorarioFalta.selectedIndex
                            ];
                        let idHorarioSelecionado =
                            opcaoSelecionada.dataset.idHorario;
                        geraListaHorariosFalta(Number(idHorarioSelecionado));
                    });
                } else {
                    alert(
                        "Cadastro negado: Você não ministra nenhuma aula no período!"
                    );
                    desabilitaHorarioFalta();
                }
            });
    } catch (erro) {
        console.error("Erro na requisição: ", erro);
    }
}

document.getElementById("inputRadioAtraso").addEventListener("click", () => {
    document.getElementById("labelHorarioFalta").textContent = "Chegada entre";
});

document.getElementById("inputRadioSaida").addEventListener("click", () => {
    document.getElementById("labelHorarioFalta").textContent = "Saída entre";
});
