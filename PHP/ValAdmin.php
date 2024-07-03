<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O</title>
   
</head>
<body>
    <?php

    $contra = $_POST["contra"];

    if(empty($contra)){
        echo"<h1>ERROR: POR FAVOR LLENA EL CAMPO SOLICITADO</h1>";

        echo'<a href="../HTML/InicioDeSesión.html" >
    <button>
    REGRESAR
    </button>
    </a>';

    }else{
        header("Location:../HTML/bienvenida_admin.html");
    }

    ?>
</body>
</html>