'use strict'

/* Funções para abrir e fechar os Models */

const openModalPrices = () => document.querySelector('#modal-Prices').classList.add('active');
const closeModalPrices = () => document.querySelector('#modal-Prices').classList.remove('active');

const openModalReceipt = () => document.querySelector('#modal-receipt').classList.add('active');
const closeModalReceipt = () => document.querySelector('#modal-receipt').classList.remove('active');

const openModalExit = () => document.querySelector('#modal-exit').classList.add('active');
const closeModalExit = () => document.querySelector('#modal-exit').classList.remove('active');

const pegarCarro = async (url) => {
    const response = await fetch(url)
    const json = await response.json()
    return json
}

/* Adicionando um novo carro */

const createCar = async (carro) => {
    console.log(carro)
    const url = "http://api.fastparking.com.br/Carros"
    const options = {
        method: 'POST',
        body: JSON.stringify(carro)
    }
    await fetch(url, options)
}

/* Adicionar um novo preço */

const createPreco = async (preco) => {
    const url = "http://api.fastparking.com.br/Precos"
    const options = {
        method: 'POST',
        body: JSON.stringify(preco)
    }
    await fetch(url, options)
}

/* Editar carro */

const updateCar = async (carro, index) => {
    const url = `http://api.fastparking.com.br/Carros/${index}`
    
    const options = {
        method: 'PUT',
        body: JSON.stringify(carro)
    }
    await fetch(url, options)

}

/* Criando uma nova linha */

const createRow = (carro, index) => {

    const tbody = document.querySelector('#tableCars tbody')
    const newRow = document.createElement('tr')

    newRow.innerHTML = `
        <td>${carro.nome}</td>
        <td>${carro.placa}</td>
        <td>${carro.dataEntrada}</td>
        <td>${carro.horaEntrada}</td>

    <td>
        <button data-index="${carro.idCarros}" id="button-receipt" class="button green" type="button">Comp.</button>
        <button data-index="${carro.idCarros}" id="button-edit" class="button blue" type="button">Editar</button>
        <button data-index="${carro.idCarros}" id="button-exit" class="button red" type="button">Saída</button>
    </td>`;

    tbody.appendChild(newRow)
}

/* Atualizando a tabela */

const updateTable = async () => {
    clearTable();
    const url = 'http://api.fastparking.com.br/Carros';
    const carros = await pegarCarro(url);
    carros.forEach(createRow);
}

/* Limpar as tabelas  os inputs */

const clearTable = () => {
    const tbody = document.querySelector('#tableCars tbody')
    while (tbody.firstChild) {
        tbody.removeChild(tbody.lastChild)
    }
}

const clearInputs = () => {
    const inputs = Array.from(document.querySelectorAll('input'));
    inputs.forEach(input => input.value = "");
    document.getElementById('nome').dataset.idcar = "new";
}

const isValidForm = () => document.querySelector('#form-register').reportValidity()

/* salvar carro */

const saveCarro = async () => {
    if (isValidForm()) {
        const newCarro = {
            nome: document.querySelector('#nome').value,
            placa: document.querySelector('#placa').value,
        }

        const idCarro = document.getElementById('nome').dataset.idcar
        if (idCarro == "new") {
            await createCar(newCarro)
        } else {
            const qualquercoisa = idCarro
            
            await updateCar(newCarro, qualquercoisa)

        }
        updateTable()
    }
}

/* Salvar um novo preço */

const isValidFormPrice = () => document.querySelector('#form-price').reportValidity();

const savePreco = async () => {
    if (isValidFormPrice()) {
        const newPreco = {
            primeiraHora: document.querySelector('#primeira-hora').value,
            demaisHoras: document.querySelector('#demais-horas').value
        }
        await createPreco(newPreco);
        clearInputs();
        closeModalPrices();
    }
}

const setReceipt = async (index) => {
    const url = `http://api.fastparking.com.br/Carros/${index}`;
    const carro = await pegarCarro(url);
    const input = Array.from(document.querySelectorAll('#form-receipt input'));
    input[0].value = carro.nome;
    input[1].value = carro.placa;
    input[2].value = carro.dataEntrada;
    input[3].value = carro.horaEntrada;
}

/* Deletar carros */

const deletarCarro = async (index) => {
    const url = `http://api.fastparking.com.br/Carros/${index}`;
    const opitions = {
        method: 'DELETE'
    }
    await fetch(url, opitions);
}

// const deletarCarro = async () => {

//     const placaCarro = prompt("Digite a placa do carro que deseja excluir, para confimar")

//     if (placaCarro == placaCarro) {
//         const url = `http://api.fastparking.com.br/Carros/${placaCarro}`
//         const options = {
//             method: 'DELETE',
//         }
//         await fetch(url, options)
//     }
// }

const setExit = async (index) => {
    const carro = await pegarCarro(`http://api.fastparking.com.br/Carros/${index}`);
    
    console.log(carro)
    
    const input = Array.from(document.querySelectorAll('#form-exit input'));
    input[0].value = carro.nome;
    input[1].value = carro.placa;
    input[2].value = carro.horaEntrada;
    input[3].value = null;
    input[4].value = 'R$ 4.50';

    await deletarCarro(index);
    updateTable();
}

const fillInputsEdit = async (index) => {
    
    const url = `http://api.fastparking.com.br/Carros/${index}`;
    const carro = await pegarCarro(url);

    document.querySelector('#nome').value = carro.nome
    document.querySelector('#placa').value = carro.placa
    document.getElementById('nome').dataset.idcar = carro.idCarros;

}

const botoesAcoes = (event) => {
    const button = event.target;

    if (button.id == "button-receipt") {
        const index = button.dataset.index;
        openModalReceipt();
        setReceipt(index);

    } else if (button.id == "button-exit") {
        const teste = confirm("O cliente já foi embora ?")
        if (teste) {
            const index = button.dataset.index;
            openModalExit();
            setExit(index);
        }else{
            alert('tente novamente!!')
        }

    } else if (button.id == "button-edit") {
        const index = button.dataset.index;
        fillInputsEdit(index);
    }
}




// MODAL DE PREÇOS
document.querySelector('#precos')
    .addEventListener('click', () => { openModalPrices(); clearInputs() });

document.querySelector('#close-prices')
    .addEventListener('click', () => { closeModalPrices(); clearInputs() });

document.querySelector('#cancelar-prices')
    .addEventListener('click', () => { closeModalPrices(); clearInputs() });

//MODAL COMPROVANTE
document.querySelector('#close-receipt')
    .addEventListener('click', () => { closeModalReceipt(); clearInputs() });

document.querySelector('#cancelar-receipt')
    .addEventListener('click', () => { closeModalReceipt(); clearInputs() });

//MODAL SAÍDA
document.querySelector('#close-exit')
    .addEventListener('click', () => { closeModalExit(); clearInputs() });

document.querySelector('#cancelar-exit')
    .addEventListener('click', () => { closeModalExit(); clearInputs() });

//SALVAR CARRO
document.querySelector('#salvar')
    .addEventListener('click', saveCarro);

//SALVAR PREÇO
document.querySelector('#salvarPreco')
    .addEventListener('click', savePreco);


// SELETOR DOS BOTÕES
document.querySelector('#tableCars')
    .addEventListener('click', botoesAcoes);

updateTable();