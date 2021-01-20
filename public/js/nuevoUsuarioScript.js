import {
    getTiposTransaccion,
    getUsuarios,
    tildesEspacios
} from './functions.js'

var checkbox_tipo_transaccion = 'tipos_transaccion[]';
var checkbox_etapa = 'etapa';
var elTipoTransaccionBadge;
var elTipoTransaccion = document.getElementById('tipos_transaccion');
//console.log(document.getElementById('status').className);

var elRoles = document.getElementById('roles');
var elEtapas = document.getElementById('etapas');

window.onload = function() {
    let status = document.getElementById('status')
    elTipoTransaccionBadge = document.getElementById('tipos_transaccion_badge')

    if(status){
        setTimeout(function(){ 
          $("#status").alert('close')
        }, 3000);
    }

    if(elTipoTransaccionBadge){
        elTipoTransaccion.addEventListener('click', function(event){
            if(event.target.name == checkbox_tipo_transaccion){
                elTipoTransaccionBadge.innerHTML = ''
                badge_tipo_transaccion()
            }
        })
    }
}


function badge_tipo_transaccion(){
    let checkboxes = elTipoTransaccion.querySelectorAll(`input[type=checkbox]:checked`);
    checkboxes.forEach(function(item){
        let id = item.id
        let tipo_transaccion = item.getAttribute('data-name')
        elTipoTransaccionBadge.innerHTML += `
            <span class="badge badge-pill badge-info">${tipo_transaccion}<label class="fas fa-times badge_tipo_transaccion" for="${id}"></label></span>
        `
    })
}

/*$('body').on("click", ".dropdown-menu", function (e) {
    $(this).parent().is(".show") && e.stopPropagation();
});*/