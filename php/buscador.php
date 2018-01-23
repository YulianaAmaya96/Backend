<?php
  require('contenido.php');
  $response=array();

  if($_POST['ciudad'] != "null"){
      $ciudad = $_POST['ciudad'];
  }
  if($_POST['tipo'] != "null"){
      $tipo = $_POST['tipo'];
  }
    $p = $_POST['precio'];
    $precio = explode(";",$p);
    $precion_minimo = intval($precio[0]);
    $precion_maximo = intval($precio[1]);

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

    function valorPrecio($arg_n){
      $arreglar = array("$",",");
      $valor = str_replace($arreglar,"",$arg_n['Precio']);
      $valor = intval($valor);
      return $valor;
    }

    if($ciudad != "null" && $tipo != "null"){
      foreach ($data as $key => $value) {
        $valor =   valorPrecio($value);
        if($precion_minimo<=$valor && $valor<= $precion_maximo){
          if($ciudad == $value['Ciudad'] && $tipo == $value['Tipo'] ){
            $response[$key] = addHTML($value);
          }
        }
      }
    }else if($ciudad !=null xor $tipo !=null){
      foreach ($data as $key => $value) {
        $valor =   valorPrecio($value);
        if($precion_minimo<=$valor && $valor<= $precion_maximo){
          if($ciudad == null){
            if($tipo == $value['Tipo']){
              $response[$key] = addHTML($value);
            }
          }else if($tipo == null){
            if($ciudad == $value['Ciudad']){
              $response[$key] = addHTML($value);
            }
          }
        }
      }
    }else{
      foreach ($data as $key => $value) {
        $valor =   valorPrecio($value);
        if($precion_minimo<=$valor && $valor<= $precion_maximo){
          $response[$key] = addHTML($value);
        }
      }
    }

    $respuesta=array_unique($response);
    $respuesta= array_values($respuesta);
    echo json_encode($respuesta);
?>
