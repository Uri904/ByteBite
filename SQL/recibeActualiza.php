<?php
include_once('CrudMesa.php');
$id_mesa = $_POST['id_mesa'];
$contra = $_POST['contra'];
$conficontra = $_POST['conficontra'];
$contraadmin = $_POST['contraadmin'];

echo "<br>Modificar $id_mesa";

if(empty($contra)||empty($conficontra ||empty($contraadmin))){
    echo "campos vacios, verifica";
}else{
    if($contra!==$conficontra){
        echo"ERROR:las contraseñas no son las mismas";
         echo"<button>
         <a href='./verMesas.php'>REGRESAR</a>
         </button>";
 
    }else{
        $crud = new CrudMesa();
$objM = new mesa($id_mesa,$contra,$conficontra,$contraadmin);
$crud->actualizarMesa($objM);
        echo "actualizado correctamente";
        header("Location: ./verMesas.php");
    }
    
   
}



