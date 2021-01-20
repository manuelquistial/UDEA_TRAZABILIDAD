import {
  configuracion
} from './strings.js'

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

export{
  configuracionUsuario, 
  configuracionModals
}