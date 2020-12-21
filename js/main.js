'use strict';


////////////////////// GET - COMPROVANTE CLIENTE////////////////////////

const comprovanteCliente = (id) =>{
  const url = `http://localhost/pedro/fastParking/api/index.php/cliente/${id}`;
  const option = {
      method : 'GET',
      headers: {
          'Content-Type' : 'application/json',
      }
  }
  fetch(url).then(response => response.json())
            .then(data=> repeticaoComprovante(data));
}

const insertToElementComprovante = (element) => {

  const div = document.createElement('div');
  
  div.classList.add('divFuncional');
  
  div.innerHTML = `
    <div class="div">${element.nomeCliente}</div>
    <div class="div">${element.numeroPlacaVeiculo}</div>     
    <div class="div">${element.dataHorarioEntrada}</div>
    <div class="div">
        <img class="atualizar" src="./img/imprimir.png" onclick="window.print();">
    </div>
    `;
  
    console.log(element.idEntradaSaidaCliente);
  
  return div;
  
  }

  const repeticaoComprovante = (data) => {

    const container = document.getElementById('visualizar_comprovante');
    data.forEach(element => {
      container.appendChild(insertToElementComprovante(element));
    
    });
    
    }

///////////////////////////// GET - RELATORIO DIARIO ///////////////////////////////////

    const relatorioDiario = () =>{
      const url = `http://localhost/pedro/fastParking/api/index.php/relatorioDiario`;
      const option = {
          method : 'GET',
          headers: {
              'Content-Type' : 'application/json',
          }
      }
      fetch(url).then(response => response.json())
                .then(data=> repeticaoDiario(data));
    }
    
    const insertDiario = (element) => {
    
      const div = document.createElement('div');
      
      div.classList.add('divFuncional');
      
      div.innerHTML = `
        <div class="div"><h1>${element.RendimentoDiario}</h1></div>
        `;
      
      return div;
      
      }
    
      const repeticaoDiario = (data) => {
    
        const container = document.getElementById('visualizar_comprovante');
        data.forEach(element => {
          container.appendChild(insertDiario(element));
        
        });
        
        }

//////////////////////////// GET - RELATORIO MENSAL ////////////////////////////////////

const relatorioMensal = () =>{
  const url = `http://localhost/pedro/fastParking/api/index.php/relatorioMensal`;
  const option = {
      method : 'GET',
      headers: {
          'Content-Type' : 'application/json',
      }
  }
  fetch(url).then(response => response.json())
            .then(data=> repeticaoMensal(data));
}

const insertMensal = (element) => {

  const div = document.createElement('div');
  
  div.classList.add('divFuncional');
  
  div.innerHTML = `
    <div class="div"><h1>${element.RendimentoMensal}</h1></div>
    `;
  
  return div;
  
}

const repeticaoMensal = (data) => {

  const container = document.getElementById('visualizar_comprovante');
  data.forEach(element => {
    container.appendChild(insertMensal(element));
  
  });
  
}

/////////////////////////// GET - RELATORIO ANUAL ////////////////////////////////////

const relatorioAnual = () =>{
  const url = `http://localhost/pedro/fastParking/api/index.php/relatorioAnual`;
  const option = {
      method : 'GET',
      headers: {
          'Content-Type' : 'application/json',
      }
  }
  fetch(url).then(response => response.json())
            .then(data=> repeticaoAnual(data));
}

const insertAnual = (element) => {

  const div = document.createElement('div');
  
  div.classList.add('divFuncional');
  
  div.innerHTML = `
    <div class="div"><h1>${element.RendimentoAnual}</h1></div>
    `;
  
  return div;
  
}

const repeticaoAnual = (data) => {

  const container = document.getElementById('visualizar_comprovante');
  data.forEach(element => {
    container.appendChild(insertAnual(element));
  
  });
  
}

///////////////////////// GET - LISTAR CLIENTES ///////////////////////////////

const clienteFastParking = () =>{
  const url = `http://localhost/pedro/fastParking/api/index.php/cliente`;
  const option = {
      method : 'GET',
      headers: {
          'Content-Type' : 'application/json',
      }
  }
  fetch(url).then(response => response.json())
            .then(data=> repeticaoCliente(data));
}

const insertToElementCliente = (element) => {

const tr = document.createElement('tr');

tr.classList.add('trFuncional');

tr.innerHTML = `
  <td class="td">${element.nomeCliente}</td>
  <td class="td">${element.numeroPlacaVeiculo}</td>   
  <td class="td">${element.idVaga}</td>   
  <td class="td">${element.dataHorarioEntrada}</td>
  <td class="td">${element.horarioSaida}</td>  
  <td class="td">${element.idValor}</td> 
  <td class="td">
      <img class="atualizar" src="./img/exit.png" onclick="updateCliente('${element.idEntradaSaidaCliente}'), clientes()">
      <img class="atualizar" src="./img/delete.png" onclick="deleteCliente('${element.idEntradaSaidaCliente}')">
      <img class="atualizar" src="./img/imprimir.png" onclick="comprovanteCliente('${element.idEntradaSaidaCliente}'), modal()">
  </td>
  `;

return tr;

}

const repeticaoCliente = (data) => {

const container = document.getElementById('table_cliente');
data.forEach(element => {
  container.appendChild(insertToElementCliente(element));

});

}

clienteFastParking();

////////////////////////////////DELETE - CLIENTES///////////////////////////////////

function deleteCliente( idCliente ) {
  window.location.reload();


    const url = `http://localhost/pedro/fastParking/api/index.php/cliente/${idCliente}`;
    const options = {
      method: 'DELETE'
    };
  
    fetch(url, options )
}


////////////////////////////POST - ENTRADA CLIENTE ///////////////////////////////////

function createCliente(){

  const cliente = {
    "nomeCliente": document.getElementById('input_nome_cliente').value,
    "numeroPlacaVeiculo": document.getElementById('input_placa').value,
    "dataHorarioEntrada": "current_timestamp()", 
    "idVaga": "1"
  };

  if (cliente.nomeCliente == "" || cliente.numeroPlacaVeiculo == "") {
    alert('Não pode inserir com dados nulos');
  }
  else{
    alert('Entrada efetuada com sucesso!');
    window.location.reload();

    const url = 'http://localhost/pedro/fastParking/api/index.php/cliente';
    const options = {
      method: 'POST',
      headers: {
        'Content-Type' : 'application/json',
    },
      body: JSON.stringify( cliente )
    };

    fetch(url, options )
  }
}

////////////////////////PUT - SAIDA CLIENTE////////////////////////////////

function updateCliente( idCliente ) {
  alert('Saída realizada com sucesso');
  window.location.reload();

  const url = `http://localhost/pedro/fastParking/api/index.php/cliente/${idCliente}`;
  const options = {
    method: 'PUT'}

  fetch(url, options )
}

////////////////////////////MODAL//////////////////////////////////////

function modal() {
    document.querySelector('.fundo_modal').style.display = "flex";
}

function closeModal() {
  window.location.reload();
  document.querySelector('.fundo_modal').style.display = "none";
}








 












