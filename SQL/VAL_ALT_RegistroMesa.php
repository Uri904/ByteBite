<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta Mesa</title>
    <link rel="shortcut icon" href="../IMG/Logo_ByteBite.png">
    <link rel="stylesheet" href="../Estilos/EsVAL_ALT_MesaAdmin.css"><!--Para incluir los archivos de estilos CSS-->
</head>

<body>
<br>
<?php
include_once('./CrudMesa.php');
include_once('./mesa.php');

$contra = $_POST['contra'];
$contraConfi = $_POST['contraConfi'];
$contraAdmin = $_POST['contraAdmin'];

if (empty($contra) || empty($contraConfi) || empty($contraAdmin)) {
    echo "<h1>ERROR: POR FAVOR LLENA LOS CAMPOS CORRECTAMENTE</h1><br>";

    echo '<div class="botones"><form action="../HTML/registro.html">
    <input type="submit" class="btn-submit" value="REGRESAR" ><!--input para ir a la página "QuienesSomos"-->
    </form></div>';
} else {
    if ($contraConfi !== $contra || $contraAdmin !== "root") {
        echo "<h1>ERROR: Las contraseñas no coinciden o la contraseña de administrador es incorrecta</h1><br>";

        echo '<div class="botones"><form action="../HTML/registro.html">
        <input type="submit" class="btn-submit" value="REGRESAR" ><!--input para ir a la página "QuienesSomos"-->
        </form></div>';
    } else {
        $objMes = new mesa2($contra, $contraConfi, $contraAdmin);
        $crud = new CrudMesa();
        $crud->readMesa($objMes);
        header("Location: ./verMesas.php");
    }
}
?>
</body>
</html>




