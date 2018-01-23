function envio_de_datos(){
    var ciudad = $('#selectCiudad').val();
    var tipo = $('#selectTipo').val();
    var rango = $('#rangoPrecio').val();
    var filtro= 'ciudad=' + ciudad +'&tipo=' + tipo + '&precio=' + rango;
    $.ajax({
          type:  "POST",
          url: "./php/buscador.php",
          data: filtro,
          dataType: "json",
          success:  function (response) {
            if(response!=""){
              $(".colContenido").html(response);
            }else {
              $(".colContenido").html('<div class="tituloContenido card"><h5>No se encuentran resultados de la búsqueda!</h5><div class="divider"></div><button type="button" name="todos" class="btn-flat waves-effect" id="mostrarTodos">Mostrar Todos</button></div>');
            }
          }
    });
return false;
}
