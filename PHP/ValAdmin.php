<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERROR</title>
    <link rel="stylesheet" href="../Estilos/ValAdmin.css">
</head>

<body>
<br>  
<div class="valadmin">

    <?php

    $contra = $_POST["contra"];

    if(empty($contra)){

        echo"<h1>ERROR: POR FAVOR LLENA EL CAMPO SOLICITADO</h1> <br>";

        echo '<div class="botones"><form action="../HTML/InicioDeSesión.html">
        <input type="submit" class="btn-submit" value="REGRESAR" >
      </form></div>';
    }else {


        header("Location:../HTML/bienvenida_admin.html");
    }

    ?>
    </div>


</body>
</html>