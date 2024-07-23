<?php
include_once("conexion.php");
include_once("mesa.php");

class CrudMesa extends Conexion{
    function __construct(){
        parent::__construct();
    }
    function readMesa($Mesa){
        $sql = "INSERT INTO mesa(contra,confiContra,contraAdmin)
        VALUES(?,?,?)"; 

$statement = parent::getConexion()->prepare($sql);
$statement->bindParam(1,$Mesa->contra);
$statement->bindParam(2,$Mesa->confiContra);
$statement->bindParam(3,$Mesa->contraAdmin);

if($statement->execute()){
    echo"SE REALIZO CON EXITO EL REGISTRO";
    }else{
    echo"HUBO UN ERROR DURANTE EL REGISTRO";
    }

    }
    //validacion de Inicio de sesión
    function readMesas($id,$contra){
        $sql="SELECT * FROM Mesa WHERE id_mesa=? AND  contra=?";
        $statement=parent::getConexion()->prepare($sql);
        $statement->bindParam(1,$id);
        $statement->bindParam(2,$contra);
        $statement->execute();
        return $statement;
    }

    function consultarMesa(){
        $sql = "SELECT * FROM Mesa";
        $statement = parent::getConexion()->prepare($sql);//statmen recibe los resultados despúes de ejecutar una sentencia sql
        $statement->execute();
        return $statement;
}
}
//$objMes=new mesa('HolaQueHac3','HolaQueHac3','root');
$crud= new CrudMesa();
//$crud->readMesa($objMes);
?>