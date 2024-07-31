<?php
include_once ('conexion.php');

class imagen{
public $photo;

function __construct($photo){
    $this->photo = $photo;

    echo 'Atributos inicializados';
}

}

$ruta_foto="fotos/";
$imagen=$ruta_foto.basename($_FILES["img"]["name"]);

if(move_uploaded_file($_FILES["img"]["tmp_name"],$imagen)){
echo"<br>FOTO SUBIDA CORRECTAMENTE...";
}else{
    echo"<br>ERROR; LA FOTO NO SE SUBIO CORRECTAMENTE...";

}


?>
