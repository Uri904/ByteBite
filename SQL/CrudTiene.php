<?php
include_once("conexion.php");
include_once("tiene.php");

class CrudTiene extends Conexion{
    function __construct(){
        parent::__construct();
    }
    function readTiene($Tiene){
        $sql = "INSERT INTO Tiene(id_pedido,id_bebida,cantidad)
        VALUES(?,?,?)";

$statement = parent::getConexion()->prepare($sql);
$statement->bindParam(1,$Tiene->id_pedido);
$statement->bindParam(2,$Tiene->id_bebida);
$statement->bindParam(3,$Tiene->cantidad);

if($statement->execute()){
    echo"SE REALIZO CON EXITO EL REGISTRO";
    }else{
    echo"HUBO UN ERROR DURANTE EL REGISTRO";
    }

}
}

$objT=new tiene(1,1,1,3);
$crud= new CrudTiene();
$crud->readTiene($objT);
?>