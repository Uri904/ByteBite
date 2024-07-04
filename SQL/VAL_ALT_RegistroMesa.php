<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include_once('./CrudMesa.php');
include_once('./mesa.php');
$contra=$_POST['contra'];
$contraConfi=$_POST['contraConfi'];
$contraAdmin=$_POST['contraAdmin'];

if(empty($contra) || empty($contraConfi) || empty($contraAdmin)){
    echo"<h1>ERROR: POR FAVOR LLENA LOS CAMPOS CORRECTAMENTE</h1><br>";

    echo'<a href="../HTML/registro.html" >
    <br><br><br><br><br>
    <button>
    REGRESAR
    </button>
    </a>';
}else{
    $objMes=new mesa($contra,$contraConfi,$contraAdmin);
    $crud= new CrudMesa();
    $crud->readMesa($objMes);
    header("Location:../HTML/PedidosAdmin.html");
}

?>
</body>
</html>




