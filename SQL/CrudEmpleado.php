<?php
include_once("conexion.php");
include_once("empleado.php");

class CrudEmpleado extends Conexion{
    function __construct(){
        parent::__construct();
    }
    function readEmpleado($Empleado){
    $sql = "INSERT INTO empleado(nombre_empleado,apellido_paterno,apellido_materno,calle,municipio,colonia,codigo_postal,salario,telefono)
    VALUES(?,?,?,?,?,?,?,?,?)"; 

    $statement = parent::getConexion()->prepare($sql);
    $statement->bindParam(1,$Empleado->nombre_empleado);
    $statement->bindParam(2,$Empleado->apellido_paterno);
    $statement->bindParam(3,$Empleado->apellido_materno);
    $statement->bindParam(4,$Empleado->calle);
    $statement->bindParam(5,$Empleado->municipio);
    $statement->bindParam(6,$Empleado->colonia);
    $statement->bindParam(7,$Empleado->codigo_postal);
    $statement->bindParam(8,$Empleado->salario);
    $statement->bindParam(9,$Empleado->telefono);
    

    if($statement->execute()){
        echo"SE REALIZO CON EXITO EL REGISTRO";
        }else{
        echo"HUBO UN ERROR DURANTE EL REGISTRO";
        }
    }

    
}
$objE= new empleado(2,'SERRESIETE','Sepulveda','Romero','San Roberto','Manzana 24','La Trinidad',55614,1700,5566338588);
$crud= new CrudEmpleado();
$crud->readEmpleado($objE);   