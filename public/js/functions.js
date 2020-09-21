var path = 'http://localhost/udea_trazabilidad/public/index.php' //Windows
var path = 'http://localhost:8080/UDEA_TRAZABILIDAD/public/index.php' //Mac
var token = document.getElementsByTagName('meta')['csrf-token'].getAttribute("content");

async function redirect(rurl, transaccion_id){
  const response = await fetch(url, {
    method: 'PUT', // *GET, POST, PUT, DELETE, etc.
    body: JSON.stringify({
      value: transaccion_id
    }),
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-Token': token
    }
  })
  return response // parses JSON response into native JavaScript objects
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
    route = route + '/update/' + id
  }
  const response = await fetch(route, {
    method: metodo, // *GET, POST, PUT, DELETE, etc.
    body: JSON.stringify(value),
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

async function getEstados(url,endpoint,consecutivo){
  let route = `${url}/${endpoint}`
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
  redirect,
  getEtapas,
  getEstados
}