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

selectCategoriaFalta.addEventListener("change", () => {
    const divDataInicialFalta = document.getElementById("divDataInicialFalta");
    const divPeriodoDias = document.getElementById("divPeriodoDias");
    const divPeriodoHoras = document.getElementById("divPeriodoHoras");
    const selectedOption =
        selectCategoriaFalta.options[selectCategoriaFalta.selectedIndex];
    const option = selectedOption.id;

    escondeTodasDivsFaltas();
    if (option == "optionNenhumaOpcao") {
        divDataInicialFalta.classList.add("d-none");
        divPeriodoDias.classList.add("d-none");
        divPeriodoHoras.classList.add("d-none");
        divAnexo.classList.add("d-none"); //não possui anexo
    } else if (option == "optionlicencaMedica") {
        divFaltasLicencaMedica.classList.remove("d-none");
        divAnexo.classList.remove("d-none"); //anexo obrigatório
    } else if (option == "optionLegislacao") {
        divFaltasLegislacao.classList.remove("d-none");
        divAnexo.classList.remove("d-none"); //anexo obrigatório
    } else if (option == "optionJustificada") {
        divFaltasJustificadas.classList.remove("d-none");
        divAnexo.classList.remove("d-none"); //anexo opcional
    } else if (option == "optionInjustificada") {
        divFaltasInjustificadas.classList.remove("d-none");
        divAnexo.classList.add("d-none"); //não possui anexo
    }
});

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
    const listaOptionsFaltas = document.getElementsByClassName("option-falta");

    function atualizarPeriodoDias(optionFalta) {
        divDataInicialFalta.classList.remove("d-none");
        let intervaloFixo = optionFalta.dataset.intervaloFixo;
        let tipoIntervalo = optionFalta.dataset.tipoIntervalo;
        let maxDias = optionFalta.getAttribute("data-max-dias");

        if (tipoIntervalo == "dias") {
            divPeriodoDias.classList.remove("d-none");
            divPeriodoHoras.classList.add("d-none");
            inputPeriodoDias.max = maxDias;

            if (intervaloFixo == 1) {
                inputPeriodoDias.min = maxDias;
            } else {
                inputPeriodoDias.min = 1;
            }

            periodoDias.value = intervaloFixo === "1" ? maxDias : "";
        } else if (tipoIntervalo == "horas") {
            divPeriodoDias.classList.add("d-none");
            divPeriodoHoras.classList.remove("d-none");
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

periodoDias.addEventListener("input", calculaDataFinal);
inputDataFalta.addEventListener("change", () => {
    buscaAulasProfessorData();
    calculaDataFinal();
});

async function buscaAulasProfessorData() {
    let dataFalta = inputDataFalta.value;
    try {
        fetch("../../controllers/horarios-disciplinas.php", {
            method: "POST",
            mode: "same-origin",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: JSON.stringify({
                acao: "selectAulasProfessorData",
                params: { dataAula: dataFalta },
            }),
        })
            .then((response) => response.json())
            .then((aulasProfessor) => {
                console.log(JSON.stringify(aulasProfessor));
            })
    } catch (erro) {
        console.error("Erro na requisição: ", erro);
    }
}

document.getElementById("inputRadioAtraso").addEventListener("click", () => {
    document.getElementById("labelHorarioFalta").textContent =
        "Horário Chegada";
});

document
    .getElementById("inputRadioSaidaAntecipada")
    .addEventListener("click", () => {
        document.getElementById("labelHorarioFalta").textContent =
            "Horário Saída";
    });
