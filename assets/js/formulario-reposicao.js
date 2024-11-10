const listaSelectsHorarios = document.getElementsByClassName(
    "select-horarios-disponiveis"
);

// Array.from(listaSelectsHorarios).forEach((selectHorarios) => {});

window.addEventListener("load", () => {
    buscaHorariosFatecData("2024-11-06");
});

async function buscaHorariosFatecData(dataFalta) {
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
                if (horariosDisponiveis.length > 0) {
                    Array.from(listaSelectsHorarios).forEach(
                        (selectHorarios) => {
                            horariosDisponiveis.forEach((horario) => {
                                console.log(horario.HRF_horario_inicio);
                                let optionHorario =
                                    document.createElement("option");
                                optionHorario.textContent =
                                    horario.HRF_horario_inicio +
                                    " - " +
                                    horario.HRF_horario_fim;
                                optionHorario.value = horario.HRF_id;
                                selectHorarios.appendChild(optionHorario);
                            });
                        }
                    );
                } else {
                    alert(
                        "Erro: O sistema não encontrou nenhuma disponível na data informada"
                    );
                }
            });
    } catch (erro) {
        console.error("Erro na requisição: ", erro);
    }
}
