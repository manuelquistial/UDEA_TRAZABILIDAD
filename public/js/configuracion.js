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
var endpoint;
var columna_tabla;

(function (){
    endpoint = document.getElementById('active_opcion').href.split('/').pop()
    if(endpoint == "tipostransaccion"){
        columna_tabla = "tipo_transaccion"
    }else if(endpoint == "proyectos"){
        columna_tabla = "proyecto"
    }else if(endpoint == "centrocostos"){
        columna_tabla = "centro_costo"
    }else if(endpoint == "usuarios"){
        columna_tabla = "nombre_apellido"
    }
})();

window.onload = function() {
    
    let nuevo_item = document.getElementById('nuevo_item');
    let paginacion = document.getElementById('paginacion');
    let items_tabla = document.getElementById('items_tabla');
    let modificar = document.getElementById('modificar');
    let buscar_button = document.getElementById('buscar_button');
    let buscar_item = document.getElementById('buscar_item');

    if(paginacion){
        paginacion.style.display = "block"
        let ul = paginacion.children[0];
        if(paginacion.children.length != 0){
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
    }
    
    if(nuevo_item){
        nuevo_item.addEventListener('click', function(event){
            data.opcion = 1
            modalInformation(data)
            document.getElementById('item_value').value = ''
            document.getElementById('input_group').style.display = "block"
            document.getElementById('input_group').value = ''
            $('#modal').modal('show')
        });
    }

    if(items_tabla){
        items_tabla.addEventListener('click', function(event){
            if((event.target.tagName == 'TD')){
                if((event.target.children.length == 0)){
                    data.opcion = 2
                    modalInformation(data)
                    document.getElementById('input_group').style.display = "block"
                    let value = event.target.innerText
                    let id = event.target.getAttribute('data-id')
                    let sap = event.target.getAttribute('data-sap')
                    
                    document.getElementById('item_id').value = id
                    document.getElementById('item_value').value = value
                    if(sap){
                        document.getElementById('sap').checked = sap
                    }
                    $('#modal').modal('show')
              
                }
            }else if(event.target.type == "checkbox"){
                let endpoint = window.location.href
                if(endpoint.includes('page')){
                    endpoint = endpoint.replace(/(\?.*)/,'')
                }
                if(event.target.name == "sap"){
                    let columna = event.target.name
                    let id = event.target.value
                    let cargo = 2;
                    if(!event.target.checked){
                        cargo = null;
                    }
                    actualizarEstado(endpoint, cargo, columna, id)
                    .then((res) => res.json())
                    .then((data) => {
                        location.reload();
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
                        location.reload();
                    })
                    .catch((error) => console.log(error))
                }
            }
        });
    }
    
    if(modificar){
        modificar.addEventListener('click', function(event){
            let option = event.target.getAttribute('data-action')
            let metodo = ''
            let input = document.getElementById('item_value').value 
            if(option == 'agregar'){
                if(columna_tabla == "tipo_transaccion"){
                    data = {
                        sap: document.getElementById('sap').checked,
                        item: input
                    }
                }else{
                    data = {
                        item: input
                    }
                }
                metodo = 'POST'
                modificarConfiguracion(endpoint, metodo, data, null)
                .then((res) => res.json())
                .then((data) => {
                    location.reload();
                })
                .catch((error) => console.log(error))
            }else if(option == 'actualizar'){
                metodo = 'PUT'
                let id = document.getElementById('item_id').value
                modificarConfiguracion(endpoint, metodo, input, id)
                .then((res) => res.json())
                .then((data) => {
                    location.reload();
                })
                .catch((error) => console.log(error))
            }
        });
    }
    
    if(buscar_button){
        buscar_button.addEventListener('click', function(event){
            let value = document.getElementById('buscar_item').value;
            if(value != ''){
                getItems(endpoint, null, value)
                .then((res) => res.json())
                .then((data) => {
                    busqueda(data.data)
                })
                .catch((error) => console.log(error))
            }else{
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
    }
    
    if(buscar_item){
        buscar_item.addEventListener('keyup', function(event){
            let value = document.getElementById('buscar_item').value;
            if(value == ''){
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
    }
}

function modalInformation(data){
    document.getElementById('titulo').innerHTML = configuracionModals(data).boton
    document.getElementById('modificar').innerText = configuracionModals(data).boton
    document.getElementById('modificar').setAttribute('data-action', configuracionModals(data).href)
}

function busqueda(data){
    let sap = ''
    let habilitado = ''
    let items_tabla = document.getElementById('items_tabla')
    items_tabla.innerHTML = ''
    if(columna_tabla == "tipo_transaccion"){
        data.forEach(function(obj){
            if(obj.estado_id == 4){
                habilitado = 'checked'
            }else{
                habilitado = ''
            }

            if(obj.cargo_id == 2){
                sap = 'checked'
            }else{
                sap = ''
            }

            items_tabla .innerHTML += `
            <tr>
                <td class="links" data-id="${obj.id}">${obj[columna_tabla]}</td>
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
                habilitado = 'checked'
            }
            items_tabla.innerHTML += `
            <tr>
                <td class="links" data-id="${obj.id}">${obj[columna_tabla]}</td>
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