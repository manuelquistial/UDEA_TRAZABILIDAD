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