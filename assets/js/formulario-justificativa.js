const divFaltasLicencaMedica = document.getElementById(
    "divFaltasLicencaMedica"
);
const divFaltasLegislacao = document.getElementById("divFaltasLegislacao");
const divFaltasJustificadas = document.getElementById("divFaltasJustificadas");
const divFaltasInjustificadas = document.getElementById(
    "divFaltasInjustificadas"
);
const selectCategoriaFalta = document.getElementById("selectCategoriaFalta");
const caixaDiasMaximos = document.getElementById('periodoDias');
const dataFalta = document.getElementById("dataFalta");
const dataFinal = document.getElementById("dataFinal");

selectCategoriaFalta.addEventListener("change", () => {
    escondeTodasDivsFaltas();

    const selectedOption =
        selectCategoriaFalta.options[selectCategoriaFalta.selectedIndex];
    const option = selectedOption.id;

    if (option == "optionNenhumaOpcao") {
        document.getElementById("fileInput").classList.add("d-none");
        document.getElementById("fileName").classList.add("d-none");
        document.getElementById("fileLabel").classList.add("d-none");
    } else if (option == "optionlicencaMedica") {
        divFaltasLicencaMedica.classList.remove("d-none");
        //anexo obrigatório
        document.getElementById("fileInput").classList.remove("d-none");
        document.getElementById("fileName").classList.remove("d-none");
        document.getElementById("fileLabel").classList.remove("d-none");
    } else if (option == "optionLegislacao") {
        divFaltasLegislacao.classList.remove("d-none");
        //anexo obrigatório
        document.getElementById("fileInput").classList.remove("d-none");
        document.getElementById("fileName").classList.remove("d-none");
        document.getElementById("fileLabel").classList.remove("d-none");
    } else if (option == "optionJustificada") {
        divFaltasJustificadas.classList.remove("d-none");
        //anexo opcional
        document.getElementById("fileInput").classList.remove("d-none");
        document.getElementById("fileName").classList.remove("d-none");
        document.getElementById("fileLabel").classList.remove("d-none");
    } else if (option == "optionInjustificada") {
        divFaltasInjustificadas.classList.remove("d-none");
        //não possui anexo
        document.getElementById("fileInput").classList.add("d-none");
        document.getElementById("fileName").classList.add("d-none");
        document.getElementById("fileLabel").classList.add("d-none");
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
    Array.from(listaOptionsFaltas).forEach((optionFalta) => {
        optionFalta.addEventListener("click", () => {
            divDataFalta.classList.remove("d-none");

            let tipoIntervalo = optionFalta.dataset.tipoIntervalo;
            console.log(optionFalta)
            if (tipoIntervalo == "dias") {
                divPeriodoDias.classList.remove("d-none");
                divPeriodoHoras.classList.add("d-none");
            } else if (tipoIntervalo == "horas") {
                divPeriodoDias.classList.add("d-none");
                divPeriodoHoras.classList.remove("d-none");
            }
            const maxDias = optionFalta.getAttribute("data-max-dias");
            caixaDiasMaximos.max = maxDias;
        });
    });
});
function calculaDataFinal() {
    const dias = parseInt(caixaDiasMaximos.value, 10); 
    const dataInicial = new Date(dataFalta.value);

   
    if (!isNaN(dias) && dataInicial instanceof Date && !isNaN(dataInicial)) {
        const dataCalculada = new Date(dataInicial); 
        dataCalculada.setDate(dataCalculada.getDate() + dias - 1); 
        dataFinal.value = dataCalculada.toISOString().split("T")[0];
    } else {
        dataFinal.value = "";
    }
}


caixaDiasMaximos.addEventListener("input", calculaDataFinal);
dataFalta.addEventListener("change", calculaDataFinal);