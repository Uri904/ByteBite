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
    
    echo "actualizado correctamente";
    header("Location: ./verMesas.php");
}


$crud = new CrudMesa();
$objM = new mesa($id_mesa,$contra,$conficontra,$contraadmin);
$crud->actualizarMesa($objM);
