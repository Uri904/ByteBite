<?php

include_once ('../SQL/conecPrueba.php');

session_start();

$mesa=$_POST['id_mesa'];
$contra=$_POST['contra'];



$query=("SELECT * FROM mesa WHERE id_mesa='$mesa' AND contra='$contra'");

$consulta=pg_query($conexion,$query);
$cantidad=pg_num_rows($consulta);

if($cantidad>0){
    $_SESSION['num_mesa']=$mesa;
    header('Location:../HTML/Bienvenida.html');
}
else{
    echo "Datos incorrectos.";
}