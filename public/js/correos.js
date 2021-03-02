import {
    enviarCorreos
  } from './functions.js'
  
(function(){
    let correos = document.getElementById('correos');
    let selected_correos = document.getElementById('items_tabla');
    let enviar_correos = document.getElementById('enviar_correos')
    let url = document.getElementsByTagName('base')[0].href

    correos.addEventListener("click", function(event){
        let checkboxes = selected_correos.querySelectorAll(`input[type=checkbox]`);
        let checkboxes_disabled = selected_correos.querySelectorAll(`input[type=checkbox]:disabled`);

        if(event.target.checked){
            if(checkboxes_disabled.length != checkboxes.length){
                enviar_correos.disabled = false
                checkboxes.forEach(function(item){
                    if(!item.disabled){
                        item.checked = true;
                    }
                });
            }
        }else{
            if(checkboxes_disabled.length != checkboxes.length){
                enviar_correos.disabled = true
                checkboxes.forEach(function(item){
                    if(!item.disabled){
                        item.checked = false;
                    }
                });
            }
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
        var data = {
            ids: [],
            consecutivos: []
        }
        checkboxes.forEach(element => {
            data.ids.push(element.getAttribute('data-id'))
            data.consecutivos.push(
                {
                    consecutivo: element.getAttribute('data-consecutivo'),
                    etapa: element.getAttribute('data-etapa'),
                    codigo: element.getAttribute('data-codigo')
                }
            )
        });
        enviarCorreos(url, data)
        .then((res) => res.json())
        .then((data) => {
            location.reload();
        })
    });

})();