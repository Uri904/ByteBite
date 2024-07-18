<?php
include_once("conexion.php");
include_once("pedido.php");

class CrudPedido extends Conexion{
    function __construct(){
        parent::__construct();
    }
    function readPedido($Pedido){
        $sql = "INSERT INTO Pedido(id_mesa,id_cliente,costo,fecha,estado)
        VALUES(?,now(),?,?,?)";

$statement = parent::getConexion()->prepare($sql);
$statement->bindParam(1,$Pedido->id_mesa);
$statement->bindParam(2,$Pedido->id_cliente);
$statement->bindParam(3,$Pedido->costo);
$statement->bindParam(4,$Pedido->fecha);
$statement->bindParam(5,$Pedido->estado);

if($statement->execute()){
    echo"SE REALIZO CON EXITO EL REGISTRO";
    }else{
    echo"HUBO UN ERROR DURANTE EL REGISTRO";
    }
}
function consultarPedido(){
    $sql = "SELECT * FROM Pedido";
    $statement = parent::getConexion()->prepare($sql);//statmen recibe los resultados despúes de ejecutar una sentencia sql
    $statement->execute();
    return $statement;
}
}

//$objP=new pedido(1,2500,'2024-03-03',1,1,'Finalizado');
//$crud= new CrudPedido();
//$crud->readPedido($objP);
?>