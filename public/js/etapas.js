import {
  getEtapas,
  getEstados,
  setEstados,
  //setAprobadoVariables,
  deleteDocumento,
  getFinancieroProyecto,
  redirectTransaccion
} from './functions.js'

let file_path = ''
let element_file = ''

window.onload = function() {
  let url = document.getElementsByTagName('base')[0].href
  let redirect = document.getElementById('redirect')
  let etapas_menu = document.getElementById('etapas-menu')
  let consecutivo_cambio_estado = document.getElementById('cambio-estado')
  let etapas_confirmar_declinar = document.getElementById('etapas-confirmar-declinar')
  let status = document.getElementById('status')
  let valor = document.getElementById('valor');
  let financiero_proyecto = document.getElementById('financiero_proyecto');
  let documento_button = document.getElementById('documento_button');
  let aceptar = document.getElementById('aceptar')

  if(documento_button){
    documento_button.addEventListener('click', function(event){
      if(event.target.parentElement.children[0].type == 'button'){
        element_file = event.target.parentElement
        file_path = event.target.parentElement.children[1].href
        file_path = file_path.split('=')[1]
        $('#modal_documento').modal('show')
      }
    })
  }

  if(aceptar){
    aceptar.addEventListener('click', function(event){
      deleteDocumento(url, file_path)
      .then((res) => res.json())
      .then((data) => {
        element_file.remove()
        $('#modal_documento').modal('hide')
      })
    })
  }

  if(financiero_proyecto){
    financiero_proyecto.addEventListener('click', function(event){
      let proyecto_id = document.getElementById('proyecto_id').querySelector('option:checked').value;
      let total_ingreso = document.getElementById('ingreso');
      let total_ingreso_3t = document.getElementById('inNeto_3t');
      let total_egreso = document.getElementById('egreso');
      let total_reserva = document.getElementById('reserva');
      let total_reserva_egreso = document.getElementById('reEg');
      let total_cuentaxcobrar = document.getElementById('cuentapc');
      let disponible_efectivo = document.getElementById('dispEfec');
      let disponible_real = document.getElementById('dispReal');
      let recurso_disponible = document.getElementById('reDi');
      let disponible_recursos = document.getElementById('dis');
      let presupuesto_total = document.getElementById('pTotal');

      if(proyecto_id){
        let table_sigep = document.getElementById('table_sigep')
        getFinancieroProyecto(url, proyecto_id)
        .then((res) => res.json())
        .then((data) => {
          let ingreso = parseInt(data.total_ingreso == null ? 0 : data.total_ingreso)
          let reserva = parseInt(data.total_reserva == null ? 0 : data.total_reserva)
          let egreso = parseInt(data.total_egreso == null ? 0 : data.total_egreso)
          let cuentaxcobrar = parseInt(data.total_cuentaxcobrar == null ? 0 : data.total_cuentaxcobrar)
          let ppTotal = parseInt(data.pp_total == null ? 0 : data.pp_total)

          total_ingreso.innerHTML = ingreso.toLocaleString('de-DE')
          total_ingreso_3t.innerHTML = ingreso.toLocaleString('de-DE')
          total_egreso.innerHTML = egreso.toLocaleString('de-DE')
          total_reserva.innerHTML = reserva.toLocaleString('de-DE')
          total_cuentaxcobrar.innerHTML = cuentaxcobrar.toLocaleString('de-DE')
          disponible_efectivo.innerHTML = (ingreso - egreso).toLocaleString('de-DE')
          total_reserva_egreso.innerHTML = (egreso + reserva).toLocaleString('de-DE')
          disponible_real.innerHTML = (ingreso - egreso - reserva).toLocaleString('de-DE')
          recurso_disponible.innerHTML = (ingreso - egreso - reserva).toLocaleString('de-DE')
          disponible_recursos.innerHTML = (ingreso - egreso - reserva).toLocaleString('de-DE')
          presupuesto_total.innerHTML = ppTotal.toLocaleString('de-DE')

          table_sigep.innerHTML = ''

          data.pp_inicial.forEach(element => {
            let tabla_valor = parseInt(element.Valor == null ? 0 : element.Valor)
            let tabla_reserva = parseInt(element.reserva == null ? 0 : element.reserva)
            let tabla_egreso = parseInt(element.egreso == null ? 0 : element.egreso)
            let tabla_disponible = tabla_valor - tabla_reserva - tabla_egreso

            table_sigep.innerHTML += `
              <tr>
                  <td>${element.Nombre}</td>
                  <td>${tabla_valor.toLocaleString('de-DE')}</td>
                  <td>${tabla_reserva.toLocaleString('de-DE')}</td>
                  <td>${tabla_egreso.toLocaleString('de-DE')}</td>
                  <td>${tabla_disponible.toLocaleString('de-DE')}</td>
              </tr>
              `
          });
          $('#modal').modal('show')
        })
        .catch((error) => {
          console.log(error)
        })
      }
    })
  }

  if(valor){
    valor.addEventListener("keyup", function(event){
      let value = valor.value.replace(/\./g,'')
      let new_value = Number(value).toLocaleString('de-DE')
      if(new_value != 0){
        valor.value = new_value
      }else{
        valor.value = ''
      }
    });
  }

  if(redirect){
      redirect.addEventListener("click", function(event){
        let consecutivo = document.getElementsByName("consecutivo")[0].value
        let transaccion_id = document.getElementById('transaccion_id').querySelector("option:checked").value;
        redirectTransaccion(url, transaccion_id, consecutivo)
        .then((res) => res.json())
        .then((data) => {
          if(data.data == 'redirect'){
            window.location.replace(url + 'transacciones/gestores');
          }else{
            console.log(data.data)
          }
        })
        .catch((error) => console.log(error))
      });
  } 

  if(etapas_menu){
    let consecutivo = document.getElementsByName("consecutivo")[0].value
    getEtapas(url)
    .then((res) => res.json())
    .then((data) => {
      data.data.forEach(element => {
        getEstados(url, element.endpoint, consecutivo)
        .then((res) => res.json())
        .then((value) => {
          let estado = ""
          let href = ""
          let estado_id = value.data
          if(estado_id == null){
            estado_id = 0
          }else{
            estado_id = value.data.estado_id
          }
          switch(estado_id) {
            case 0:
              href = `index.php/${element.endpoint}/index/${consecutivo}`
              estado = ''
              break;
            case 1:
              href = `index.php/${element.endpoint}/edit/${consecutivo}`
              if(element.endpoint == 'presolicitud'){
                href = `index.php/${element.endpoint}/show/${consecutivo}`
              }
              estado = "lateral-inprogress"
              break;
            case 2:
              href = `index.php/${element.endpoint}/show/${consecutivo}`
              estado = "lateral-done"
              break;
            default:
              href = `index.php/${element.endpoint}/show/${consecutivo}`
              estado = "lateral-cancel"
          }
          document.getElementById(element.endpoint).href = href
          if(estado != ''){
            document.getElementById(element.endpoint).classList.add(estado)
          }
        })
        .catch((error) => console.log(error))
      });
    })
    .catch((error) => console.log(error))
  }

  if(consecutivo_cambio_estado){
    let consecutivo = document.getElementsByName("consecutivo")[0].value
    consecutivo_cambio_estado.addEventListener("click", function(event){
      getEtapas(url)
      .then((res) => res.json())
      .then((data) => {
        data.data.forEach(element => {
          getEstados(url, element.endpoint, consecutivo)
          .then((res) => res.json())
          .then((value) => {
            let estado_id = value.data
            if(estado_id == null){
              estado_id = 0
            }else{
              estado_id = value.data.estado_id
            }
            if(estado_id == 1){
              document.getElementById(element.endpoint+'_checkbox').checked = false
            }else if(estado_id == 2){
              document.getElementById(element.endpoint+'_checkbox').checked = true
            }else{
              document.getElementById(element.endpoint+'_checkbox').disabled = true
            }
          })
          .catch((error) => console.log(error))
        })
        $('#cambio_estado').modal('show')
      })
      .catch((error) => console.log(error))
    })
  }

  if(etapas_confirmar_declinar){
    let consecutivo = document.getElementsByName("consecutivo")[0].value
    etapas_confirmar_declinar.addEventListener("click", function(event){
      if(event.target.type == "checkbox"){
        let endpoint = event.target.id.split("_")[0]
        let estado = 0;
        if(document.getElementById(event.target.id).checked){
          estado = 2;
          setEstados(url, endpoint, consecutivo, estado)
          .then((res) => res.json())
          .then((value) => {
            if(document.getElementById(endpoint).classList.contains('lateral-inprogress')){
              document.getElementById(endpoint).classList.remove('lateral-inprogress')
            }
            document.getElementById(endpoint).classList.add('lateral-done')
          })
          .catch((error) => console.log(error))
          
        }else{
          estado = 1;
          setEstados(url, endpoint, consecutivo, estado)
          .then((res) => res.json())
          .then((value) => {
            if(document.getElementById(endpoint).classList.contains('lateral-done')){
              document.getElementById(endpoint).classList.remove('lateral-done')
            }
            document.getElementById(endpoint).classList.add('lateral-inprogress')
          })
          .catch((error) => console.log(error))
        }
      }
    })
  }

  if(status){
    setTimeout(function(){ 
      $("#status").alert('close')
    }, 3000);
  }
}