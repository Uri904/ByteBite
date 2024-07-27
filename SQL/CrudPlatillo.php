<?php
include_once("conexion.php");
include_once("platillo.php");


class CrudPlatillo extends Conexion{
    function __construct(){
        parent::__construct();
    }
    function readPlatillo($Platillo){
        $sql = "INSERT INTO platillo(nombre_platillo,precio,descripcion)
        VALUES(?,?,?)";

$statement = parent::getConexion()->prepare($sql);
$statement->bindParam(1,$Platillo->nombre_platillo);
$statement->bindParam(2,$Platillo->precio);
$statement->bindParam(3,$Platillo->descripcion);


if($statement->execute()){
    echo"SE REALIZO CON EXITO EL REGISTRO";
    }else{
    echo"HUBO UN ERROR DURANTE EL REGISTRO";
    } 
}

function consultarPlatillo(){
    $sql = "SELECT * FROM Platillo";
    $statement = parent::getConexion()->prepare($sql);//statmen recibe los resultados despúes de ejecutar una sentencia sql
    $statement->execute();
    return $statement;
}

}

//$objP=new pedido(1,2500,'2024-03-03',1,1,'Finalizado');
//$crud= new CrudPlatillo();
//$crud->readPedido($objP);
?>