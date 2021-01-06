var path = document.getElementsByTagName('base')[0].href
var token = document.getElementsByTagName('meta')['csrf-token'].getAttribute("content");

async function enviarCorreos(){
  let route = `${url}/${endpoint}/estado`
  const response = await fetch(route, {
    method: 'PUT', // *GET, POST, PUT, DELETE, etc.
    body: JSON.stringify({
      consecutivo: consecutivo,
      estado_id: estado
    }),
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-Token': token
    }
  })
  return response
}

async function redirectTransaccion(url, transaccion_id, consecutivo){
  let route = `${url}/presolicitud/redirect`
  const response = await fetch(route, {
    method: 'POST', // *GET, POST, PUT, DELETE, etc.
    body: JSON.stringify({
      consecutivo: consecutivo,
      value: transaccion_id
    }),
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-Token': token
    }
  })
  return response // parses JSON response into native JavaScript objects
}

async function getCodigoSigep(url, proyecto){
  let route = `${url}/solicitud/rubros`
  const response = await fetch(route, {
    method: 'POST', // *GET, POST, PUT, DELETE, etc.
    body: JSON.stringify({
        proyecto: proyecto
    }),
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-Token': token
    }
  })
  return response
}

async function getItems(endpoint, page, data){
  let route = `${path}/${endpoint}`
  if(page != null){
    route = route+'/paginacion?page='+page
  }else{
    route = route+'/search/'+data
  }
  const response = await fetch(route, {
    method: 'GET', 
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-Token': token
    }
  });
  return response
}

async function getUsuarios(){
  let route = `${path}/usuarios/all`
  const response = await fetch(route, {
    method: 'GET', // *GET, POST, PUT, DELETE, etc.
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-Token': token
    }
  })
  return response
}

async function getTiposTransaccion(){
  let route = `${path}/tipostransaccion/all`
  const response = await fetch(route, {
    method: 'GET', // *GET, POST, PUT, DELETE, etc.
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-Token': token
    }
  })
  return response
}

async function modificarConfiguracion(endpoint, metodo, value, id){
  let route = `${path}/${endpoint}`
  if(metodo == "PUT"){
    route = route + '/update'
  }
  const response = await fetch(route, {
    method: metodo, // *GET, POST, PUT, DELETE, etc.
    body: JSON.stringify({
      value,
      id
    }),
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-Token': token
    }
  })
  return response
}

async function actualizarEstado(url, value, columna, id){
  let route = `${url}/estado`
  const response = await fetch(route, {
    method: 'PUT', // *GET, POST, PUT, DELETE, etc.
    body: JSON.stringify({
        id: id,
        value: value,
        columna: columna
    }),
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-Token': token
    }
  })
  return response
}

async function setAprobadoVariables(url, consecutivo, columna, data){
  let route = `${url}aprobado/elements`
  const response = await fetch(route, {
    method: 'POST', // *GET, POST, PUT, DELETE, etc.
    body: JSON.stringify({
        columna: columna,
        consecutivo: consecutivo,
        data: data
    }),
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-Token': token
    }
  })
  return response
}

async function getEtapas(url){
  let route = `${url}/etapas`
  const response = await fetch(route, {
    method: 'GET', // *GET, POST, PUT, DELETE, etc.
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-Token': token
    }
  })
  return response
}

async function getEstados(url, endpoint, consecutivo){
  let route = `${url}${endpoint}`
  const response = await fetch(route, {
    method: 'POST', // *GET, POST, PUT, DELETE, etc.
    body: JSON.stringify({
      consecutivo:consecutivo
    }),
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-Token': token
    }
  })
  return response
}

async function setEstados(url, endpoint, consecutivo, estado){
  let route = `${url}/${endpoint}/estado`
  const response = await fetch(route, {
    method: 'PUT', // *GET, POST, PUT, DELETE, etc.
    body: JSON.stringify({
      consecutivo: consecutivo,
      estado_id: estado
    }),
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-Token': token
    }
  })
  return response
}

function tildesEspacios(word){
  let word_short = word.toLowerCase()
  word_short.normalize("NFD").replace(/[\u0300-\u036f]/g, "")
  word_short = word_short.replace(/ /g,"_");
  return word_short
}

export{
  getUsuarios, 
  getTiposTransaccion,
  getItems,
  tildesEspacios,
  modificarConfiguracion,
  actualizarEstado,
  redirectTransaccion,
  getEtapas,
  getEstados,
  setEstados,
  getCodigoSigep,
  setAprobadoVariables,
  enviarCorreos
}