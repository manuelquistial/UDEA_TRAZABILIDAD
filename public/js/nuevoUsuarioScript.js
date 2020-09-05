import {
    getTiposTransaccion,
    getUsuarios,
    tildesEspacios
} from './functions.js'

var checkbox_tipo_transaccion = 'tipos_transaccion[]';
var checkbox_etapa = 'etapa';
var tiposTransaccion = {};
var elTipoTransaccion = document.getElementById('tipos_transaccion');
//console.log(document.getElementById('status').className);
var elTipoTransaccionBadge = document.getElementById('tipos_transaccion_badge');
var elRoles = document.getElementById('roles');
var elEtapas = document.getElementById('etapas');

(function () {
    getTiposTransaccion()
    .then((res) => res.json())
    .then((data) => {
        data.data.forEach(function(obj){
            let tipo_transaccion = obj.tipo_transaccion
            let id = obj.id
            dropdown_tipo_transaccion(id, tipo_transaccion)
        })
    })
    .catch((error) => console.log(error))
})();

function dropdown_tipo_transaccion(id, tipo_transaccion){
    let tipo_transaccion_short = tildesEspacios(tipo_transaccion)
    tiposTransaccion[id] = tipo_transaccion
    elTipoTransaccion.innerHTML += `
        <div class="form-check tipo_transaccion_item">
            <input type="checkbox" class="form-check-input" name="${checkbox_tipo_transaccion}" id="${tipo_transaccion_short}" value="${id}">
            <label class="form-check-label" for="${tipo_transaccion_short}">${tipo_transaccion}</label>
        </div>
    `
}

function badge_tipo_transaccion(){
    let checkboxes = elTipoTransaccion.querySelectorAll(`input[type=checkbox]:checked`);
    checkboxes.forEach(function(item){
        //let tipo_transaccion = item.value.split('_')[1]
        let id = item.value
        let tipo_transaccion = tiposTransaccion[id]
        elTipoTransaccionBadge.innerHTML += `
            <span class="badge badge-pill badge-info">${tipo_transaccion}<label class="fas fa-times badge_tipo_transaccion" for="${item.id}"></label></span>
        `
    })
}

/*document.getElementById('tipo_transaccion').addEventListener('keyup', function(event){
    let tipoTransaccion = document.getElementById('tipo_transaccion').value
    elTipoTransaccion.innerHTML = ""
    tiposTransaccion.forEach(function(item){
        if(item[1].indexOf(tipoTransaccion) > -1){
            dropdown_tipo_transaccion(item[0], item[1])
        }
    })
});*/

elTipoTransaccion.addEventListener('click', function(event){
    if(event.target.name == checkbox_tipo_transaccion){
        elTipoTransaccionBadge.innerHTML = ''
        badge_tipo_transaccion()
    }
})

$('body').on("click", ".dropdown-menu", function (e) {
    $(this).parent().is(".show") && e.stopPropagation();
});