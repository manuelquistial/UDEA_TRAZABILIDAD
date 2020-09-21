import {
  getEtapas,
  getEstados
} from './functions.js'

window.onload = function() {
  let url = document.getElementsByTagName('base')[0].href
  let redirect = document.getElementById('redirect')
  let etapas_menu = document.getElementById('etapas-menu')
  let consecutivo_cambio_estado = document.getElementById('consecutivo-cambio-estado')
  let etapas_confirmar_declinar = document.getElementById('etapas-confirmar-declinar')

  if(redirect){
      redirect.addEventListener("click", function(event){
        //let url = window.location.href.replace('show', event.target.id).replace('#','')
        let transaccion_id = document.getElementById('transaccion_id').querySelector("option:checked").value;
        redirect(url, transaccion_id)
        .then((res) => res.json())
        .then((data) => {
            console.log(data)
        })
        .catch((error) => console.log(error))
      });
  } 

  if(etapas_menu){
    //let estados = {}
    let consecutivo = document.getElementsByName("consecutivo")[0].value
    getEtapas(url)
    .then((res) => res.json())
    .then((data) => {
      data.data.forEach(element => {
        getEstados(url, element.endpoint, consecutivo)
        .then((res) => res.json())
        .then((value) => {
            //estados[element.endpoint] = value.data.etapa_id
            //if(Object.keys(estados).length == 2){
            ////  data.data.forEach(el => {
                let estado = ""
                let href = ""
                //switch(estados[el.endpoint]) {
                switch(value.data.estado_id) {
                  case 0:
                    href = `${element.endpoint}/index/${consecutivo}`
                    estado = ""
                    break;
                  case 1:
                    href = `${element.endpoint}/edit/${consecutivo}`
                    estado = "lateral-inprogress"
                    break;
                  case 2:
                    href = `${element.endpoint}/show/${consecutivo}`
                    estado = "lateral-done"
                    break;
                  default:
                    href = `${element.endpoint}/show/${consecutivo}`
                    estado = "lateral-cancel"
                }
                document.getElementById(element.endpoint).href = href
                document.getElementById(element.endpoint).classList.add(estado)
            //  })
            //}
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
            if(value.data.estado_id == 2){
              document.getElementById(element.endpoint+'_checkbox').checked = true
            }else{
              document.getElementById(element.endpoint+'_checkbox').checked = false
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
        if(document.getElementById(event.target.id).checked){
          if(document.getElementById(endpoint).classList.contains('lateral-inprogress')){
            document.getElementById(endpoint).classList.remove("lateral-inprogress")
          }
          document.getElementById(endpoint).classList.add('lateral-done')
          
        }else{
          if(document.getElementById(endpoint).classList.contains('lateral-inprogress')){
            document.getElementById(endpoint).classList.add('lateral-inprogress')
          }
          document.getElementById(endpoint).classList.remove("lateral-done")
          
        }
      }
    })
  }
}