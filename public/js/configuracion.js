import { 
    getItems,
    modificarConfiguracion,
    actualizarEstado
} from './functions.js'

import {
    configuracionModals
} from './modals.js'

let data = {
    "opcion": 0,
    "value": ""
};
var letters = /^[A-Za-z]+$/;
var endpoint;
var columna_tabla;

(function (){
    endpoint = document.getElementById('active_opcion').href.split('/').pop()
    if(endpoint == "tipostransaccion"){
        columna_tabla = "tipo_transaccion"
    }else if(endpoint == "proyectos"){
        columna_tabla = "proyecto"
    }else if(endpoint = "centrocostos"){
        columna_tabla = "centro_costo"
    }
})();

(function (){
    document.getElementById('paginacion').style.display = "block"
    let ul = document.getElementById('paginacion').children[0];
    if(document.getElementById('paginacion').children.length != 0){
        ul.className = "pagination justify-content-center"
        for(const element in ul.children){
            let li = ul.children[element]
            if(li.tagName == "LI"){
                if(li.className == ""){
                    li.className = "page-item"
                }else{
                    if(li.className == "active"){
                        li.id = "active"
                    }
                    li.className = "page-item" + " " + li.className
                }
                li.children[0].className = "page-link"
            }
        }
    }
})();

function modalInformation(data){
    document.getElementById('titulo').innerHTML = configuracionModals(data).boton
    document.getElementById('modificar').innerText = configuracionModals(data).boton
    document.getElementById('modificar').href = '#'+configuracionModals(data).href
}

function busqueda(data){
    let sap = ''
    let habilitado = ''
    let items_tabla = document.getElementById('items_tabla')
    items_tabla.innerHTML = ''
    if(columna_tabla == "tipo_transaccion"){
        data.forEach(function(obj){
            if(obj.estado_id == 4){
                habilitado = 'selected'
            }else{
                habilitado = ''
            }

            if(obj.etapa_id == 3){
                sap = 'selected'
            }else{
                sap = ''
            }

            items_tabla .innerHTML += `
            <tr>
                <td><a href="#${obj.id}">${obj[columna_tabla]}</a></td>
                <td>
                    <label class="switch">
                        <input type="checkbox" name="sap" value="${obj.id}" ${sap}>
                        <span class="slider round"></span>
                    </label>
                </td>
                <td>
                    <label class="switch">
                        <input type="checkbox" name="habilitar" value="${obj.id}" ${habilitado}>
                        <span class="slider round"></span>
                    </label>
                </td>
            </tr>
            `
        });
    }else{
        data.forEach(function(obj){
            if(obj.estado_id == 4){
                habilitado = 'selected'
            }
            items_tabla .innerHTML += `
            <tr>
                <td><a href="#${obj.id}">${obj[columna_tabla]}</a></td>
                <td>
                    <label class="switch">
                        <input type="checkbox" name="habilitar" value="${obj.id}" ${habilitado}>
                        <span class="slider round"></span>
                    </label>
                </td>
            </tr>
            `
        });
    }
}

document.getElementById('nuevo_item').addEventListener('click', function(event){
    data.opcion = 1
    modalInformation(data)
    document.getElementById('input_group').style.display = "block"
    document.getElementById('input_group').value = ''
    $('#modal').modal('show')
});

document.getElementById('items_tabla').addEventListener('click', function(event){
    if(event.target.tagName == 'A'){
        data.opcion = 2
        modalInformation(data)
        document.getElementById('input_group').style.display = "block"
        let value = event.target.innerText
        let id = event.target.href.split("#")[1]
        document.getElementById('item_id').value = id
        document.getElementById('item_value').value = value
        $('#modal').modal('show')
    }else if(event.target.type == "checkbox"){
        let endpoint = window.location.href
        if(event.target.name == "sap"){
            let columna = event.target.name
            let id = event.target.value
            let etapa = 3;
            if(!event.target.checked){
                etapa = null;
            }
            actualizarEstado(endpoint, etapa, columna, id)
            .then((res) => res.json())
            .then((data) => {
                console.log(data)
            })
            .catch((error) => console.log(error))
        }
        else if(event.target.name == "habilitar"){
            let columna = event.target.name
            let id = event.target.value
            let habilitado = 4;
            if(!event.target.checked){
                habilitado = 5;
            }
            actualizarEstado(endpoint, habilitado, columna, id)
            .then((res) => res.json())
            .then((data) => {
                console.log(data)
            })
            .catch((error) => console.log(error))
        }
    }
});

document.getElementById('modificar').addEventListener('click', function(event){
    let option = event.target.href.split("#")[1]
    let metodo = 0
    let data = document.getElementById('item_value').value
    if(option == 'agregar'){
        if(columna_tabla == "tipo_transaccion"){
            data = {
                sap: document.getElementById('sap').checked,
                item: document.getElementById('item_value').value
            }
        }
        metodo = 'POST'
        modificarConfiguracion(endpoint, metodo, data, null)
        .then((res) => res.json())
        .then((data) => {
            console.log(data)
        })
        .catch((error) => console.log(error))
    }else if(option == 'actualizar'){
        metodo = 'PUT'
        let id = document.getElementById('item_id').value
        modificarConfiguracion(endpoint,metodo, data, id)
        .then((res) => res.json())
        .then((data) => {
            console.log(data)
        })
        .catch((error) => console.log(error))
    }
});

document.getElementById('buscar_item').addEventListener('keyup', function(event){
    let value = event.target.value
    if(value.match(letters)){
        getItems(endpoint, null, value)
        .then((res) => res.json())
        .then((data) => {
            busqueda(data.data)
        })
        .catch((error) => console.log(error))
    }else if(value == ''){
        let page = 1
        if(document.getElementById('paginacion').children.length != 0){
            page = document.getElementById('active').children[0].innerText
        }
        getItems(endpoint, page, null)
        .then((res) => res.json())
        .then((data) => {
            busqueda(data.data)
        })
    }
});