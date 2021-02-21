import {
    optionSelect,
    getUsuarios
} from './functions.js'

import {
    configuracionUsuario
} from './modals.js'

var usuarios = [];
var idUsuario = 0;
var elUsuarios = document.getElementById('usuarios');

(function () {
    getUsuarios()
    .then((res) => res.json())
    .then((data) => {
        data.forEach(function(obj){
            let usuario = obj.nombre_apellido
            let id = obj.id
            usuarios.push([id, usuario])
            optionSelect(id, usuario, elUsuarios)
        })
    })
    .catch((error) => console.log(error))
})();

function modalInformation(data){
    document.getElementById('titulo').innerHTML = configuracionUsuario(data).title
    document.getElementById('modal_content').innerHTML = configuracionUsuario(data).body
    document.getElementById('modificar').innerText = configuracionUsuario(data).boton
}

document.getElementById('usuarios').addEventListener("click", function(event){
    if(event.target.tagName == 'OPTION'){
        document.getElementById('opciones_usuario').style.display = "block"
        document.getElementById('usuario').value = event.target.innerText
        idUsuario = event.target.value
    }
});

document.getElementById('usuario').addEventListener('keyup', function(event){
    let usuario = document.getElementById('usuario').value
    elUsuarios.innerHTML = ""
    usuarios.forEach(function(item){
        let nombre = item[1].toLowerCase()
        nombre = nombre.normalize("NFD").replace(/[\u0300-\u036f]/g, "")
        if(nombre.indexOf(usuario) > -1){
            optionSelect(item[0], item[1], elUsuarios)
        }
    })
});

document.getElementById('usuario').addEventListener('click', function(event){
    document.getElementById('opciones_usuario').style.display = "none";
});

document.getElementById('editar').addEventListener('click', function(event){

});

document.getElementById('eliminar').addEventListener('click', function(event){
    let usuario = document.getElementById('usuario').value
    modalInformation(usuario)
    document.getElementById('modificar').href = "#eliminar"
    $('#modal').modal('show')
});

document.getElementById('modificar').addEventListener('click', function(event){
    let urlModificar = event.target.href.replace('#','/')
    console.log(urlModificar)
});