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
$usuario=$_POST["correo"];
$contra=$_POST["contras"];

if(empty($usuario) || empty($contra)){
    echo"<h1>ERROR: POR FAVOR INGRESA LOS DATOS CORRECTAMENTE</h1> <br>"; 

    echo'<a href="../HTML/InicioDeSesión.html" >
    <button>
    REGRESAR
    </button>
    </a>';
}else{



header("Location:../HTML/Bienvenida.html");
    exit();
}
?>
</body>
</html>