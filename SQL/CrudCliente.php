<?php
include_once("conexion.php");
include_once("cliente.php");

class CrudCliente extends Conexion{
    function __construct(){
        parent::__construct();
    }
    function readCliente($Cliente){
        $sql = "INSERT INTO Cliente(nombre_cliente)
        VALUES(?)"; 

$statement = parent::getConexion()->prepare($sql);
$statement->bindParam(1,$Cliente->nombre_cliente);

if($statement->execute()){
    echo"SE REALIZO CON EXITO EL REGISTRO";
    }else{
    echo"HUBO UN ERROR DURANTE EL REGISTRO";
    }

    }
}
$objC=new cliente(1,'Brian');
$crud= new CrudCliente();
$crud->readCliente($objC);
?>