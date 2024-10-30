const divFaltasLicencaMedica = document.getElementById(
    "divFaltasLicencaMedica"
);
const divFaltasLegislacao = document.getElementById("divFaltasLegislacao");
const divFaltasJustificadas = document.getElementById("divFaltasJustificadas");
const divFaltasInjustificadas = document.getElementById(
    "divFaltasInjustificadas"
);
const selectCategoriaFalta = document.getElementById("selectCategoriaFalta");
const periodoDias = document.getElementById("periodoDias");
const inputDataFalta = document.getElementById("inputDataFalta");
const inputDataFinal = document.getElementById("inputDataFinal");
const inputTipoIntervalo = document.getElementById("inputTipoIntervalo");
const divAnexo = document.getElementById("divAnexo");

selectCategoriaFalta.addEventListener("change", () => {
    const divDataFalta = document.getElementById("divDataFalta");
    const divPeriodoDias = document.getElementById("divPeriodoDias");
    const divPeriodoHoras = document.getElementById("divPeriodoHoras");
    const selectedOption =
        selectCategoriaFalta.options[selectCategoriaFalta.selectedIndex];
    const option = selectedOption.id;

    escondeTodasDivsFaltas();
    if (option == "optionNenhumaOpcao") {
        divDataFalta.classList.add("d-none");
        divPeriodoDias.classList.add("d-none");
        divPeriodoHoras.classList.add("d-none");
        divAnexo.classList.add("d-none");
    } else if (option == "optionlicencaMedica") {
        divFaltasLicencaMedica.classList.remove("d-none");
        divAnexo.remove("d-none"); //anexo obrigatório
    } else if (option == "optionLegislacao") {
        divFaltasLegislacao.classList.remove("d-none");
        divAnexo.remove("d-none"); //anexo obrigatório
    } else if (option == "optionJustificada") {
        divFaltasJustificadas.classList.remove("d-none");
        divAnexo.remove("d-none"); //anexo opcional
    } else if (option == "optionInjustificada") {
        divFaltasInjustificadas.classList.remove("d-none");
        divAnexo.add("d-none"); //não possui anexo
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
    const divDataFalta = document.getElementById("divDataFalta");
    const divPeriodoDias = document.getElementById("divPeriodoDias");
    const divPeriodoHoras = document.getElementById("divPeriodoHoras");
    const listaOptionsFaltas = document.getElementsByClassName("option-falta");

    function atualizarPeriodoDias(optionFalta) {
        divDataFalta.classList.remove("d-none");
        let intervaloFixo = optionFalta.dataset.intervaloFixo;
        let tipoIntervalo = optionFalta.dataset.tipoIntervalo;
        let maxDias = optionFalta.getAttribute("data-max-dias");

        if (tipoIntervalo == "dias") {
            divPeriodoDias.classList.remove("d-none");
            divPeriodoHoras.classList.add("d-none");
            periodoDias.max = maxDias;

            if (intervaloFixo == 1) {
                periodoDias.min = maxDias;
            } else {
                periodoDias.min = 1;
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
function calculaDataFinal(dataFalta) {
    const dias = parseInt(periodoDias.value, 10);
    const dataInicial = new Date(dataFalta);

    if (!isNaN(dias) && dataInicial instanceof Date && !isNaN(dataInicial)) {
        const dataCalculada = new Date(dataInicial);
        dataCalculada.setDate(dataCalculada.getDate() + dias - 1);
        inputDataFinal.value = dataCalculada.toISOString().split("T")[0];
    } else {
        inputDataFinal.value = "";
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
