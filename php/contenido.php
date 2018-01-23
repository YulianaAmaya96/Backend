<?php
    $ruta ="../data-1.json";
    $file = fopen($ruta,"r");
    $contenido=fread($file, filesize("../data-1.json"));
    $data=json_decode($contenido, true);
?>
