import {
    enviarCorreos
  } from './functions.js'
  
(function(){
    let correos = document.getElementById('correos');
    let selected_correos = document.getElementById('items_tabla');
    let enviar_correos = document.getElementById('enviar_correos')

    correos.addEventListener("click", function(event){
        let checkboxes = selected_correos.querySelectorAll(`input[type=checkbox]`);
        if(event.target.checked){
            enviar_correos.disabled = false
            checkboxes.forEach(function(item){
                item.checked = true;
            });
        }else{
            enviar_correos.disabled = true
            checkboxes.forEach(function(item){
                item.checked = false;
            });
        }

    });

    document.getElementById('items_tabla').addEventListener('click', function(event){
        let checkboxes = selected_correos.querySelectorAll(`input[type=checkbox]:checked`);
        if(event.target.tagName == 'INPUT'){
            if(event.target.checked){
                if(checkboxes.length == 1){
                    enviar_correos.disabled = false
                }
            }else{
                if((checkboxes.length == 0) && (!enviar_correos.disabled)){
                    enviar_correos.disabled = true
                }
            }
        }
    });

    enviar_correos.addEventListener('click', function(event){
        let checkboxes = selected_correos.querySelectorAll(`input[type=checkbox]:checked`);
        console.log(checkboxes)
    });

})();