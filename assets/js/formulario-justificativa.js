// this is a js file

function visibilidadeAnexo(){
                
    // const classe = elemento.classList;

    const selectElement = document.getElementById('falta');
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const classe = selectedOption.classList;

    if(classe.contains('obrigatorioAnexo')){
        document.getElementById('fileInput').style.display = 'block'
        document.getElementById('fileName').style.display = 'block'
        document.getElementById('fileLabel').style.display = 'block'
    }
    else if (classe.contains('naoObrigatorioAnexo')){
        document.getElementById('fileInput').style.display = 'none'
        document.getElementById('fileName').style.display = 'none'
        document.getElementById('fileLabel').style.display = 'none'
    }
    else if (classe.contains('opcionalAnexo')){
        document.getElementById('fileInput').style.display = 'block'
        document.getElementById('fileName').style.display = 'block'
        document.getElementById('fileLabel').style.display = 'block'
    }
}


function visibilidadeCaixas() {

    const opcao1 = document.getElementById('faltaMedica').checked;
    const opcao2 = document.getElementById('comparecimento').checked;
    const opcao3 = document.getElementById('licencaSaude').checked;
    const opcao4 = document.getElementById('licencaMaternidade').checked;


    // Exibe a caixa numérica se o primeiro radio for selecionado
    if (opcao2) {
        document.getElementById('numericBox').style.display = 'none';
        document.getElementById('timeInput1').style.display = 'block';
        document.getElementById('timeInput2').style.display = 'block';
        document.getElementById('dataHoraAfastado').style.display = 'block';
        document.getElementById('das').style.display = 'block';

        
    }
    // Exibe a caixa de horas se o segundo radio for selecionado
    else if (opcao1 || opcao3 || opcao4) {
        document.getElementById('numericBox').style.display = 'block';
        document.getElementById('timeInput1').style.display = 'none';
        document.getElementById('timeInput2').style.display = 'none';
        document.getElementById('dataDiaAfastado').style.display = 'block';
        document.getElementById('dataHoraAfastado').style.display = 'none';
        document.getElementById('das').style.display = 'none';
    }
}

// Função para atualizar a opacidade dos elementos
function updateOpacity() {
    document.getElementById('motivo-falta').classList.toggle('disabled-opacity', document.getElementById('motivo-falta').disabled);
    document.getElementById('time-inicio').classList.toggle('disabled-opacity', document.getElementById('time-inicio').disabled);
    document.getElementById('time-fim').classList.toggle('disabled-opacity', document.getElementById('time-fim').disabled);
}

// Evento para quando a opção "faltaMedica" é selecionada
document.getElementById('faltaMedica').addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('motivo-falta').disabled = false;
        document.getElementById('time-inicio').disabled = true;
        document.getElementById('time-fim').disabled = true;
    }
    updateOpacity();
});

// Evento para quando a opção "comparecimento" é selecionada
document.getElementById('comparecimento').addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('motivo-falta').disabled = true;
        document.getElementById('time-inicio').disabled = false;
        document.getElementById('time-fim').disabled = false;
    }
    updateOpacity();
});

// Evento para quando a opção "licencaSaude" ou "licencaMaternidade" é selecionada
document.getElementById('licencaSaude').addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('motivo-falta').disabled = true;
        document.getElementById('time-inicio').disabled = true;
        document.getElementById('time-fim').disabled = true;
    }
    updateOpacity();
});

document.getElementById('licencaMaternidade').addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('motivo-falta').disabled = true;
        document.getElementById('time-inicio').disabled = true;
        document.getElementById('time-fim').disabled = true;
    }
    updateOpacity();
});

// Inicializa os campos como desabilitados
document.getElementById('motivo-falta').disabled = true;    
document.getElementById('time-inicio').disabled = true;
document.getElementById('time-fim').disabled = true;

// Função para atualizar a opacidade dos elementos
function updateOpacity() {
    document.getElementById('motivo-falta-inju').classList.toggle('disabled-opacity', document.getElementById('motivo-falta-inju').disabled);
    document.getElementById('time-inicio-inju').classList.toggle('disabled-opacity', document.getElementById('time-inicio-inju').disabled);
    document.getElementById('time-fim-inju').classList.toggle('disabled-opacity', document.getElementById('time-fim-inju').disabled);
}

// Evento para quando a opção "faltaMedica" é selecionada
document.getElementById('faltaMedica-inju').addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('motivo-falta-inju').disabled = false;
        document.getElementById('time-inicio-inju').disabled = true;
        document.getElementById('time-fim-inju').disabled = true;
    }
    updateOpacity();
});

// Evento para quando a opção "comparecimento" é selecionada
document.getElementById('comparecimento-inju').addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('motivo-falta-inju').disabled = true;
        document.getElementById('time-inicio-inju').disabled = false;
        document.getElementById('time-fim-inju').disabled = false;
    }
    updateOpacity();
});

// Evento para quando a opção "licencaSaude" é selecionada
document.getElementById('licencaSaude-inju').addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('motivo-falta-inju').disabled = true;
        document.getElementById('time-inicio-inju').disabled = true;
        document.getElementById('time-fim-inju').disabled = true;
    }
    updateOpacity();
});

// Evento para quando a opção "licencaMaternidade" é selecionada
document.getElementById('licencaMaternidade-inju').addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('motivo-falta-inju').disabled = true;
        document.getElementById('time-inicio-inju').disabled = true;
        document.getElementById('time-fim-inju').disabled = true;
    }
    updateOpacity();
});

// Inicializa os campos como desabilitados
document.getElementById('motivo-falta-inju').disabled = true;    
document.getElementById('time-inicio-inju').disabled = true;
document.getElementById('time-fim-inju').disabled = true;

function updateOpacity() {
    document.getElementById('motivo-falta-just').classList.toggle('disabled-opacity', document.getElementById('motivo-falta-just').disabled);
    document.getElementById('time-inicio-just').classList.toggle('disabled-opacity', document.getElementById('time-inicio-just').disabled);
    document.getElementById('time-fim-just').classList.toggle('disabled-opacity', document.getElementById('time-fim-just').disabled);
    document.getElementById('motivo-atraso-saida-just').classList.toggle('disabled-opacity', document.getElementById('motivo-atraso-saida-just').disabled);
}

// Evento para quando a opção "faltaMedica" é selecionada
document.getElementById('faltaMedica-just').addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('motivo-falta-just').disabled = false;
        document.getElementById('time-inicio-just').disabled = true;
        document.getElementById('time-fim-just').disabled = true;
        document.getElementById('motivo-atraso-saida-just').disabled = true;
    }
    updateOpacity();
});

// Evento para quando a opção "comparecimento" é selecionada
document.getElementById('comparecimento-just').addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('motivo-falta-just').disabled = true;
        document.getElementById('time-inicio-just').disabled = false;
        document.getElementById('time-fim-just').disabled = false;
        document.getElementById('motivo-atraso-saida-just').disabled = false;
    }
    updateOpacity();
});

// Evento para quando a opção "licencaSaude" é selecionada
document.getElementById('licencaSaude-just').addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('motivo-falta-just').disabled = true;
        document.getElementById('time-inicio-just').disabled = true;
        document.getElementById('time-fim-just').disabled = true;
        document.getElementById('motivo-atraso-saida-just').disabled = true;
    }
    updateOpacity();
});

// Evento para quando a opção "licencaMaternidade" é selecionada
document.getElementById('licencaMaternidade-just').addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('motivo-falta-just').disabled = true;
        document.getElementById('time-inicio-just').disabled = true;
        document.getElementById('time-fim-just').disabled = true;
        document.getElementById('motivo-atraso-saida-just').disabled = true;
    }
    updateOpacity();
});

// Inicializa os campos como desabilitados
document.getElementById('motivo-falta-just').disabled = true;    
document.getElementById('time-inicio-just').disabled = true;
document.getElementById('time-fim-just').disabled = true;
document.getElementById('motivo-atraso-saida-just').disabled = true;

document.getElementById('falta').addEventListener('change', function() {
    var selectedValue = this.value;

    // Esconde todas as divs
    document.getElementById('licenca').classList.add('hidden-content');
    document.getElementById('injustificada').classList.add('hidden-content');
    document.getElementById('justificada').classList.add('hidden-content');
    document.getElementById('trabalhista').classList.add('hidden-content');

    // Mostra a div correspondente ao valor selecionado
    if (selectedValue === 'licenca_medica') {
        document.getElementById('licenca').classList.remove('hidden-content');
    } else if (selectedValue === 'falta_injustificada') {
        document.getElementById('injustificada').classList.remove('hidden-content');
    } else if (selectedValue === 'falta_justificada') {
        document.getElementById('justificada').classList.remove('hidden-content');
    } else if (selectedValue === 'legislacao_trabalhista') {
        document.getElementById('trabalhista').classList.remove('hidden-content');
    }
});

// Função para atualizar a opacidade dos elementos
function updateOpacity() {
    document.getElementById('dataDia').classList.toggle('disabled-opacity', document.getElementById('dataDia').disabled);
    document.getElementById('dias').classList.toggle('disabled-opacity', document.getElementById('dias').disabled);
    document.getElementById('dateStart').classList.toggle('disabled-opacity', document.getElementById('dateStart').disabled);
    document.getElementById('dateEnd').classList.toggle('disabled-opacity', document.getElementById('dateEnd').disabled);
}

document.getElementById('faltaReferenteDia').addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('dataDia').disabled = false;
        document.getElementById('dias').disabled = true;
        document.getElementById('dateStart').disabled = true;
        document.getElementById('dateEnd').disabled = true;
    }
    updateOpacity();
});

document.getElementById('faltaReferentePeriodo').addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('dataDia').disabled = true;
        document.getElementById('dias').disabled = false;
        document.getElementById('dateStart').disabled = false;
        document.getElementById('dateEnd').disabled = false;
    }
    updateOpacity();
});

// Inicializa os campos como desabilitados
document.getElementById('dataDia').disabled = true;    
document.getElementById('dias').disabled = true;
document.getElementById('dateStart').disabled = true;
document.getElementById('dateEnd').disabled = true;

document.getElementById('fileInput').addEventListener('change', function() {
    var fileName = this.files[0] ? this.files[0].name : 'Nenhum arquivo selecionado';
    document.getElementById('fileName').textContent = fileName;
});

