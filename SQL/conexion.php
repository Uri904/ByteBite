<?php
include_once("argumentosBD.php");

class Conexion{

    private $server = SERVIDOR;
        private $user = USUARIO;
        private $bd = BASE;
        private $password = CONTRASEÑA;
        private $port = PUERTO;
        private $conect; 

    function __construct(){
        try{
            $dns ="pgsql:host=$this->server;port=$this->port;dbname=$this->bd";
            $this->conect = new PDO($dns,$this->user,$this->password);
            $this->conect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
           // echo"<br>conectado a la base de datos Pagina_Integradora...";

        }catch(PDOException $objE){
            echo "<br>ERROR DURANTE LA CONEXION". $objE->getMessage();
        }
    }
    function getConexion(){
        return $this->conect;
    }
}
//$objc = new conexion();

?>