var path = 'http://localhost/udea_trazabilidad/public/index.php'
var token = document.getElementsByTagName('meta')['csrf-token'].getAttribute("content");

async function redirect(url, transaccion_id){
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
  let url = `${path}/${endpoint}`
  if(page != null){
    url = url+'/paginacion?page='+page
  }else{
    url = url+'/search/'+data
  }
  const response = await fetch(url, {
    method: 'GET', 
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-Token': token
    }
  });
  return response
}

async function getUsuarios(){
  let url = `${path}/usuarios/all`
  const response = await fetch(url, {
    method: 'GET', // *GET, POST, PUT, DELETE, etc.
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-Token': token
    }
  })
  return response
}

async function getTiposTransaccion(){
  let url = `${path}/tipostransaccion/all`
  const response = await fetch(url, {
    method: 'GET', // *GET, POST, PUT, DELETE, etc.
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-Token': token
    }
  })
  return response
}

async function modificarConfiguracion(endpoint, metodo, value, id){
  let url = `${path}/${endpoint}`
  if(metodo == "PUT"){
    url = url + '/update/' + id
  }
  console.log(value)
  const response = await fetch(url, {
    method: metodo, // *GET, POST, PUT, DELETE, etc.
    body: JSON.stringify(value),
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-Token': token
    }
  })
  return response
}

async function actualizarEstado(endpoint, value, columna, id){
  let url = `${endpoint}/estado`
  const response = await fetch(url, {
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
  redirect
}