<?php
  require('contenido.php');
  $response=array();
  $ciudades=array();
  $tipos=array();

  function addHTML($arg_n){
    $cadenaHTML = '<div class="itemMostrado card">
      <img src="img/home.jpg">
        <div class="card-stacked">
          <span><strong>&nbsp;&nbsp;&nbsp;Direccion :</strong>'.$arg_n['Direccion'].'</span><br />
          <span><strong>&nbsp;&nbsp;&nbsp;Ciudad : </strong>'.$arg_n['Ciudad'].'</span><br />
          <span><strong>&nbsp;&nbsp;&nbsp;Telefono : </strong>'.$arg_n['Telefono'].'</span><br />
          <span><strong>&nbsp;&nbsp;&nbsp;Codigo Postal : </strong>'.$arg_n['Codigo_Postal'].'</span><br />
          <span><strong>&nbsp;&nbsp;&nbsp;Tipo : </strong>'.$arg_n['Tipo'].'</span><br />
          <span><strong>&nbsp;&nbsp;&nbsp;Precio : </strong><span class="precioTexto">'.$arg_n['Precio'].'</span></span><br /><br />
        <div class="divider"></div>
        <div class="card-action">VER MAS</div>
        </div>
      </div>';
      return $cadenaHTML;
  }

  foreach ($data as $key => $value) {
    $ciudades[$key]=$value['Ciudad'];
    $tipos[$key]=$value['Tipo'];
    $response[$key] = addHTML($value);
  }
  $ciudades=array_unique($ciudades);
  $tipos= array_unique($tipos);
  $response['ciudades'] = array_values($ciudades);
  $response['tipos'] = array_values($tipos);
  echo json_encode($response);
  fclose($file);
?>
