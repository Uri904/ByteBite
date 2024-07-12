<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERROR</title>
    <link rel="stylesheet" href="../Estilos/ValidacionInicioSesion.css">
</head>
<body>
<?php
include_once("./CrudMesa.php");
 $id= $_POST["id_mesa"];
 $contra= $_POST["contra"];

 if(empty($contra) || empty($id)){

    echo"<h1>ERROR: POR FAVOR LLENA EL CAMPO SOLICITADO</h1> <br>";

    echo '<div class="botones"><form action="../HTML/InicioDeSesión.html">
    <input type="submit" class="btn-submit" value="REGRESAR" >
  </form></div>';


}else {
    $statement=$crud->readMes($id, $contra);   
    $res=$statement->rowCount();
    if ($res == 0){
        
        echo "<br>Sesión NO Iniciada";
        echo "<br><a href='../HTML/InicioDeSesión.html'>Regresar al Inicio</a>";
    }else {
        
                    
        header("Location:../HTML/Bienvenida.html");
    }
}

   ?> 
</body>
</html>


<?php
/*include_once ('../SQL/conecPrueba.php');

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
} */
?> 