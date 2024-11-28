const listaInputsDatasReposicoes = document.getElementsByClassName(
    "input-data-reposicao"
);
const listaSelectsHorarios = document.getElementsByClassName(
    "select-horarios-disponiveis"
);

Array.from(listaInputsDatasReposicoes).forEach((inputDataReposicao) => {
    inputDataReposicao.addEventListener("change", () => {
        let dataFalta = inputDataReposicao.value;
        let selectDestino = document.getElementById(
            "selectHorarioReposicao" + inputDataReposicao.dataset.ordemData
        );
        buscaHorariosFatecData(dataFalta, selectDestino);
        // console.log(inputDataReposicao.data);
    });
});

// window.addEventListener("load", () => {
//     buscaHorariosFatecData("2024-11-06");
// });

async function buscaHorariosFatecData(dataFalta, selectDestino) {
    try {
        fetch("../../controllers/horarios-fatec.php", {
            method: "POST",
            mode: "same-origin",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: JSON.stringify({
                acao_horarios_fatec: "busca_horarios_fatec_data",
                params: {
                    data_aula: dataFalta,
                },
            }),
        })
            .then((response) => response.json())
            .then((horariosDisponiveis) => {
                selectDestino.length = 0;

                if (horariosDisponiveis.length > 0) {
                    horariosDisponiveis.forEach((horario) => {
                        let optionHorario = document.createElement("option");
                        optionHorario.textContent =
                            horario.HRF_horario_inicio +
                            " - " +
                            horario.HRF_horario_fim;
                        optionHorario.value = horario.HRF_id;
                        selectDestino.appendChild(optionHorario);
                        selectDestino.disabled = false;
                    });
                } else {
                    let optionVazio = document.createElement("option");
                    optionVazio.textContent = "Informe uma data válida.";
                    selectDestino.appendChild(optionVazio);
                    selectDestino.disabled = true;
                }
            });
    } catch (erro) {
        console.error("Erro na requisição: ", erro);
    }
}

const btnExibirGradeHoraria = document.getElementById("btnExibirGradeHoraria");
const divGradeHoraria = document.getElementById("divGradeHoraria");
btnExibirGradeHoraria.addEventListener("click", () => {
    if (divGradeHoraria.dataset.estaExibida == "true") {
        divGradeHoraria.dataset.estaExibida = "false";
        document.getElementById("divGradeHoraria").classList.add("d-none");
        btnExibirGradeHoraria.textContent = "Exibir Grade Horária";
    } else {
        divGradeHoraria.dataset.estaExibida = "true";
        document.getElementById("divGradeHoraria").classList.remove("d-none");
        btnExibirGradeHoraria.textContent = "Ocultar Grade Horária";
    }
});
