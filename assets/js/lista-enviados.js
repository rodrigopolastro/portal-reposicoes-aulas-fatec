const btnExportar = document.getElementById("btnExportar");
const btnCancelar = document.getElementById("btnCancelar");
const botoesImprimirFormulario = document.getElementsByClassName(
    "btnImprimirFormulario"
);
const elementosColumaImprimir =
    document.getElementsByClassName("colunaImprimir");

btnExportar.addEventListener("click", exibeBotoesImprimir);
btnCancelar.addEventListener("click", escondeBotoesImprimir);
Array.from(botoesImprimirFormulario).forEach((botao) => {
    botao.addEventListener("click", escondeBotoesImprimir);
});

function exibeBotoesImprimir() {
    Array.from(elementosColumaImprimir).forEach((elm) => {
        elm.classList.remove("d-none");
    });

    btnCancelar.classList.remove("d-none");
}

function escondeBotoesImprimir() {
    Array.from(elementosColumaImprimir).forEach((elm) => {
        elm.classList.add("d-none");
    });

    btnCancelar.classList.add("d-none");
}
