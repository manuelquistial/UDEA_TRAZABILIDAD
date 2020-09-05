import {
  redirect
} from './functions.js'

document.getElementById('redirect').addEventListener("click", function(event){
  let url = window.location.href.replace('edit', event.target.id).replace('#','')
  let transaccion_id = document.getElementById('transaccion_id').querySelector("option:checked").value;
  redirect(url, transaccion_id)
  .then((res) => res.json())
    .then((data) => {
        console.log(data)
    })
    .catch((error) => console.log(error))
});