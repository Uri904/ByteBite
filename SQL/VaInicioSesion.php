<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Estilos/ValidacionInicioSesion.css">
</head>
<body >
<?php
include_once('./CrudMesero.php');
include_once('./mesero.php');
$id=$_POST["id"];
$usuario=$_POST["correo"];
$contra=$_POST["contras"];

if(empty($usuario) || empty($contra) ||empty($id)){
    echo"<h1>ERROR: POR FAVOR INGRESA LOS DATOS CORRECTAMENTE</h1> <br>"; 

    echo'<a href="../HTML/InicioDeSesión.html" >
    <button>
    REGRESAR
    </button>
    </a>';
}else{


$objM=new mesero($id,$usuario,$contra);
$crud= new CrudMesero();
$crud->readMesero($objM); 
header("Location:../HTML/Bienvenida.html");
    exit();
}
?>
</body>
</html>