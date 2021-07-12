'use strict'

/* Funções para abrir e fechar os Models */

const openModalPrices = () => document.querySelector('#modal-Prices').classList.add('active');
const closeModalPrices = () => document.querySelector('#modal-Prices').classList.remove('active');

const openModalReceipt = () => document.querySelector('#modal-receipt').classList.add('active');
const closeModalReceipt = () => document.querySelector('#modal-receipt').classList.remove('active');

const openModalExit = () => document.querySelector('#modal-exit').classList.add('active');
const closeModalExit = () => document.querySelector('#modal-exit').classList.remove('active');

const getCar = async (url) => {
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
    console.log(index)
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
        <button data-index="${index+1}" id="button-receipt" class="button green" type="button">Comp.</button>
        <button data-index="${index+1}" id="button-edit" class="button blue" type="button">Editar</button>
        <button data-index="${index+1}" id="button-exit" class="button red" type="button">Saída</button>
    </td>`;
    
    tbody.appendChild(newRow)
}

/* Atualizando a tabela */

const updateTable = async () => {
    clearTable();
    const url = 'http://api.fastparking.com.br/Carros';
    const carros = await getCar(url);
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
            nome  : document.querySelector('#nome').value,
            placa : document.querySelector('#placa').value,
        }

        const idCarro = document.getElementById('nome').dataset.idcar
        if (idCarro == "new") {
            await createCar(newCarro)
        } else {
            newCarro.id = idCarro
            await updateCar(newCarro)
            
        }
        updateTable()
        
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
// //SALVAR PREÇO
// document.querySelector('#salvarPreco')
//     .addEventListener('click', savePrice);

updateTable();