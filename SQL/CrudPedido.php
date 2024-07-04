<?php
include_once("conexion.php");
include_once("pedido.php");

class CrudPedido extends Conexion{
    function __construct(){
        parent::__construct();
    }
    function readPedido($Pedido){
        $sql = "INSERT INTO Pedido(costo,fecha,id_mesero,id_cliente,estado)
        VALUES(?,now(),?,?,?)";

$statement = parent::getConexion()->prepare($sql);
$statement->bindParam(1,$Pedido->costo);
$statement->bindParam(2,$Pedido->id_mesero);
$statement->bindParam(3,$Pedido->id_cliente);
$statement->bindParam(4,$Pedido->estado);

if($statement->execute()){
    echo"SE REALIZO CON EXITO EL REGISTRO";
    }else{
    echo"HUBO UN ERROR DURANTE EL REGISTRO";
    }
}
}

$objP=new pedido(1,2500,'2024-03-03',3,1,'Finalizado');
$crud= new CrudPedido();
$crud->readPedido($objP);
?>