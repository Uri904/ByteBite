<?php
include_once("conexion.php");
include_once("contiene.php");

class CrudContiene extends Conexion{
    function __construct(){
        parent::__construct();
    }
    function readContiene($Contiene){
        $sql = "INSERT INTO Contiene(id_pedido,id_platillo,cantidad)
        VALUES(?,?,?)";

$statement = parent::getConexion()->prepare($sql);
$statement->bindParam(1,$Contiene->id_pedido);
$statement->bindParam(2,$Contiene->id_platillo);
$statement->bindParam(3,$Contiene->cantidad);

if($statement->execute()){
    echo"SE REALIZO CON EXITO EL REGISTRO";
    }else{
    echo"HUBO UN ERROR DURANTE EL REGISTRO";
    }

}
}

$objCO=new contiene(1,1,1,2);
$crud= new CrudContiene();
$crud->readContiene($objCO);
?>