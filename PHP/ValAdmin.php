<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Estilos/ValAdmin.css">
</head>
<body>
    <?php

    $contra=$_POST=["contra"];

    if(empty($contra)){
        echo"<h1>ERROR: POR FAVOR LLENA EL CAMPO SOLICITADO</h1>";

    }else{
        header("Location:../HTML/bienvenida_admin.html");
    }

    ?>
</body>
</html>