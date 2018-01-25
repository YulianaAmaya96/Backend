var  items=[], ciu, tip;

function mostrarTodos(event){
  event.preventDefault();
  $(".colContenido").html(items);
}

function envio_de_datos(){
    var ciudad = $('#selectCiudad').val();
    var tipo = $('#selectTipo').val();
    var rango = $('#rangoPrecio').val();
    var datos= 'ciudad=' + ciudad  + '&tipo=' + tipo + '&precio=' + rango;
    $.ajax({
          type:  "POST",
          url: "php/buscador.php",
          data: datos,
          type: "json",
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

function datos(){
    $.ajax({
          url: "php/lib.php",
          type: "POST",
          dataType: "json",
          success:  function (response) {
            tituloContenido=response.tituloContenido;
            ciu = response.ciudades;
            tip= response.tipos;
            filtros_I(ciu,tip);
            for(i=0; i<100; i++){
              items[i] = response[i];
            }
          }
    });
}

function filtros_I(ci,ti){
  var filtro_1 = JSON.stringify(ci);
  var filtro_2 = JSON.stringify(ti);
  filtro_1 = filtro_1.substr(1, (filtro_1.length-2));
  filtro_2 = filtro_2.substr(1, (filtro_2.length-2));
  filtro_1 = filtro_1.replace(/['"]+/g, '');
  filtro_2 = filtro_2.replace(/['"]+/g, '');
  filtro_1 = filtro_1.split(',');
  filtro_2 = filtro_2.split(',');
    $('#selectCiudad').append('<option value="' + filtro_1[0] + '">' + filtro_1[0] + '</option>',
      '<option value="' + filtro_1[1] + '">' + filtro_1[1] + '</option>',
      '<option value="' + filtro_1[2] + '">' + filtro_1[2] + '</option>',
      '<option value="' + filtro_1[3] + '">' + filtro_1[3] + '</option>',
      '<option value="' + filtro_1[4] + '">' + filtro_1[4] + '</option>'
    );
    $('#selectTipo').append('<option value="' + filtro_2[0] + '">' + filtro_2[0] + '</option>',
      '<option value="' + filtro_2[1] + '">' + filtro_2[1] + '</option>',
      '<option value="' + filtro_2[2] + '">' + filtro_2[2] + '</option>'
    );
    $("select").material_select('update');
}

$(function(){
  datos();
  $("#mostrarTodos").click(mostrarTodos);
})
