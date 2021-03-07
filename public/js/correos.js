import {
    enviarCorreos
  } from './functions.js'
  
(function(){
    let correos = document.getElementById('correos');
    let selected_correos = document.getElementById('items_tabla');
    let enviar_correos = document.getElementById('enviar_correos')
    let url = document.getElementsByTagName('base')[0].href
    let paginacion = document.getElementById('paginacion');

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