import {
    getCodigoSigep
  } from './functions.js'
  
(function(){
    let url = document.getElementsByTagName('base')[0].href
    let codigo_sigep = document.getElementById('codigo_sigep')
    let codigo_sigep_id = document.getElementById('codigo_sigep_id')
    let table_sigep = document.getElementById('table_sigep')

    codigo_sigep.addEventListener("click", function(event){
        let proyecto_id = event.target.getAttribute('data-project')
        table_sigep.innerHTML = ''
        getCodigoSigep(url, proyecto_id)
        .then((res) => res.json())
        .then((data) => {
            data.data.forEach(element => {
                table_sigep.innerHTML += `
                <tr>
                    <td><p class="links" data-codigo="codigo" data-value="${element.Codigo}">${element.Codigo}</p></td>
                    <td>${element.Nombre}</td>
                    <td>${element.CentroCosto}</td>
                    <td>${element.pp_inicial}</td>
                    <td>${element.egreso}</td>
                    <td>${element.reserva}</td>
                    <td>${parseInt(element.pp_inicial) - parseInt(element.egreso) - parseInt(element.reserva)}</td>
                </tr>
                `
            });
            $('#modal').modal('show')
        })
        .catch((error) => console.log(error))
    });

    table_sigep.addEventListener("click", function(event){
      if(event.target.getAttribute('data-codigo') == "codigo"){
        codigo_sigep_id.value = event.target.getAttribute('data-value')
        $('#modal').modal('hide')
      }
    });
})();