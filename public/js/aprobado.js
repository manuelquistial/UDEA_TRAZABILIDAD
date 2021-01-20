import {
  setAprobadoVariables
  } from './functions.js'
  
(function(){
    const consecutivo = document.getElementsByName("consecutivo")[0].value
    const url = document.getElementsByTagName('base')[0].href
    const fecha_envio_documento = document.getElementById('button_fecha_envio_documento')
    const fecha_envio_decanatura = document.getElementById('button_fecha_envio_decanatura')
    const fecha_envio_presupuestos = document.getElementById('button_fecha_envio_presupuestos')
    const solpe = document.getElementById('button_solpe')


    fecha_envio_documento.addEventListener("click", function(event){
      const columna = event.target.getAttribute('data-column')
      const data = document.getElementById(columna).value
      setAprobadoVariables(url, consecutivo, columna, data)
      .then((res) => res.json())
      .then((data) => {
      console.log(data)
      })
      .catch((error) => console.log(error))
    });

    fecha_envio_decanatura.addEventListener("click", function(event){
      const columna = event.target.getAttribute('data-column')
      const data = document.getElementById(columna).value
      setAprobadoVariables(url, consecutivo, columna, data)
      .then((res) => res.json())
      .then((data) => {
      console.log(data)
      })
      .catch((error) => console.log(error))
    });

    fecha_envio_presupuestos.addEventListener("click", function(event){
      const columna = event.target.getAttribute('data-column')
      const data = document.getElementById(columna).value
      setAprobadoVariables(url, consecutivo, columna, data)
      .then((res) => res.json())
      .then((data) => {
      console.log(data)
      })
      .catch((error) => console.log(error))
    });

    solpe.addEventListener("click", function(event){
      const columna = event.target.getAttribute('data-column')
      const data = document.getElementById(columna).value
      setAprobadoVariables(url, consecutivo, columna, data)
      .then((res) => res.json())
      .then((data) => {
      console.log(data)
      })
      .catch((error) => console.log(error))
    });

})();