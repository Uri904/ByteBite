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
$statement->bindParam(2,$Mesa->conficontra);
$statement->bindParam(3,$Mesa->contraadmin);

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

function buscarMesa($id_mesa){
    $sql = "SELECT * FROM mesa where id_mesa= $id_mesa";
    $statement=parent::getConexion()->prepare($sql);
    $statement->execute();//devuelve el registro encontrado o no encontrado
    return $statement;
}
function eliminarMesa($id_mesa) {
    try {
        $sql = "DELETE FROM mesa WHERE id_mesa = :id";
        $statement = $this->getConexion()->prepare($sql);
        $statement->bindParam(':id', $id_mesa, PDO::PARAM_INT); // Asegúrate de especificar el tipo de dato si es necesario

        if ($statement->execute()) {
            echo "<br>ELIMINADO";
        } else {
            echo "<br>ERROR... NO ELIMINADO";
        }
    } catch (PDOException $e) {
        echo "Error al eliminar: " . $e->getMessage();
    }
}

function actualizarMesa($Mesa){
    $sql = "UPDATE mesa SET contra=?, conficontra=?, contraadmin=? WHERE id_mesa=".$Mesa->id_mesa;

    $statement = parent::getConexion()->prepare($sql);

 
    $statement -> bindParam(1,$Mesa->contra);
    $statement -> bindParam(2,$Mesa->conficontra);
    $statement -> bindParam(3,$Mesa->contraadmin);


    if ($statement->execute()) {
        echo "<br> ID: ".$Mesa->id_mesa." actualizado";
    } else {
        echo "<br> No se pudo actualizar";
    }
    
}


}
//$objMes=new mesa('HolaQueHac3','HolaQueHac3','root');
$crud= new CrudMesa();
//$objMes=new mesa(4,1233,234,85);
//$crud->actualizarMesa($objMes);
//$crud->readMesa($objMes);
?>