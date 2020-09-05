import {
  form, 
  etapas, 
  configuracion
} from './strings.js'

function modalEtapasStructure(data){
  let modal = 
  `
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">${data.title}</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-header info-header">
      <div class="col-6">
        <p class="info-header"><strong>${form.generalForm.solicitante}:&nbsp;</strong>${data.solicitante}</p>
      </div>
      <div class="col-6">
        <p class="info-header"><strong>${form.generalForm.fechaS}:&nbsp;</strong>${data.fechaS}</p>
        <p class="info-header"><strong>${form.generalForm.fechaC}:&nbsp;</strong>${data.fechaC}</p>
      </div>
    </div>
    <div class="modal-body">
      ${data.body}
    </div>
  </div>
  `
  return modal
}

function presolicitud(data){
  let presolicitud = {
    "title": etapas.presolicitud,
    "solicitante": data.nombre + ' ' + data.apellidos,
    "fechaS": data.fecha_inicial,
    "fechaC": data.fecha_final,
    "body": `
      <h6><strong>${form.presolicitudForm.proyecto}:&nbsp;</strong>${data.proyecto}</h6>
      <h6><strong>${form.presolicitudForm.transaccion}:&nbsp;</strong>${data.tipo_transaccion}</h6>
      <h6><strong>${form.generalForm.valor}:&nbsp;</strong>${data.valor}</h6>
      <h6><strong>${form.presolicitudForm.fechaI}:&nbsp;</strong>${data.fecha_inicial}</h6>
      <h6><strong>${form.presolicitudForm.fechaF}:&nbsp;</strong>${data.fecha_final}</h6>
      <h6><strong>${form.presolicitudForm.descripcion}:&nbsp;</strong>${data.descripcion}</h6>
    `
  }
  presolicitud = modalEtapasStructure(presolicitud)
  return presolicitud
}

function configuracionUsuario(data){

  let detalles = {
    "title": configuracion.detalles.eliminar  + ' ' + configuracion.usuario.valor,
    "body": configuracion.usuario.eliminar.replace("%%", data),
    "boton": configuracion.detalles.eliminar
  }
  
  return detalles
}

function configuracionModals(data){

  let detalles = {};

  if(data.opcion == 1){
    detalles = {
      "boton": configuracion.detalles.agregar,
      "href": configuracion.href.agregar
    }
  }else if(data.opcion == 2){
    detalles = {
      "boton": configuracion.detalles.actualizar,
      "href": configuracion.href.actualizar
    }
  }else if(data.opcion == 3){
    detalles = {
      "boton": configuracion.detalles.eliminar,
      "href": configuracion.href.eliminar
    }
  }
  
  return detalles
}

export{presolicitud, configuracionUsuario, configuracionModals}