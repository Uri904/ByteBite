<?php
include_once("conexion.php");
include_once("bebida.php");


class CrudBebida extends Conexion{
    function __construct(){
        parent::__construct();
    }
    function readBebida($Bebida){
        $sql = "INSERT INTO bebida(nombre_bebida,precio,descripcion)
        VALUES(?,?,?)";

$statement = parent::getConexion()->prepare($sql);
$statement->bindParam(1,$Bebida->nombre_bebida);
$statement->bindParam(2,$Bebida->precio);
$statement->bindParam(3,$Bebida->descripcion);


if($statement->execute()){
    echo"SE REALIZO CON EXITO EL REGISTRO";
    }else{
    echo"HUBO UN ERROR DURANTE EL REGISTRO";
    } 
}

function consultarBebida(){
    $sql = "SELECT * FROM bebida";
    $statement = parent::getConexion()->prepare($sql);//statmen recibe los resultados despúes de ejecutar una sentencia sql
    $statement->execute();
    return $statement;
}

}

//$objP=new pedido(1,2500,'2024-03-03',1,1,'Finalizado');
//$crud= new CrudBebida();
//$crud->readPedido($objP);
?>