<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body >
<?php
$usuario=$_POST["us"];
$contra=$_POST["pass"];

if(empty($usuario) || empty($contra)){
    echo"ERROR: POR FAVOR INGRESA LOS DATOS CORRECTAMENTE";
}else{
    header("Location:../HTML/Bienvenida.html");
}
?>
</body>
</html>