<?php
include_once("conexion.php");
include_once("mesero.php");

class CrudMesero extends Conexion{
    function __construct(){
        parent::__construct();
    }
    function readMesero($Mesero){
        $sql = "INSERT INTO Mesero(id_empleado,correo,contra)
        VALUES(?,?,?)"; 
   
    $statement = parent::getConexion()->prepare($sql);
    $statement->bindParam(1,$Mesero->id_empleado);
    $statement->bindParam(2,$Mesero->correo);
    $statement->bindParam(3,$Mesero->contra);
   


    if($statement->execute()){
        echo"SE REALIZO CON EXITO EL REGISTRO";
        }else{
        echo"HUBO UN ERROR DURANTE EL REGISTRO";
        }
    }
       
 
}
$objM=new mesero(1,1,'Holaquehace','elbriansr@gmail.com');
$crud= new CrudMesero();
$crud->readMesero($objM); 
?>