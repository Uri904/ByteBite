<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERROR</title>
    <link rel="stylesheet" href="../Estilos/ValidacionInicioSesion.css">
</head>

<body >
<br>
<div class="Validacion">

    <?php
$usuario=$_POST["correo"];
$contra=$_POST["contras"];

if(empty($usuario) || empty($contra)){
    echo"<h1>ERROR: POR FAVOR INGRESA LOS DATOS CORRECTAMENTE</h1> <br>"; 

    echo '<div class="botones"><form action="../HTML/InicioDeSesión.html">
    <input type="submit" class="btn-submit" value="REGRESAR" > <!--input para ir a la página QuienesSomos-->
  </form></div>';
}else{



header("Location:../HTML/Bienvenida.html");
    exit();
}
?>
</div>
</body>
</html>