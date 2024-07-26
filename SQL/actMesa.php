<?php
$id = $_REQUEST["id_mesa"];
include_once("CrudMesa.php");
$crud = new CrudMesa();
$statement = $crud->buscarMesa($id);
$fila = $statement ->rowCount();
echo "<br> $fila";
$resulset = $statement->fetch(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
    <h1>actualizar mesa</h1>
    <?php
    echo "$id";
    ?>
    <form action="recibeActualiza.php" method='post'>

    <p>
        <input type="text" name="id_mesa" id="id_mesa" readonly value='<?php echo $resulset->id_mesa;  ?>'>
    </p>

    <p>
        <input type="text" name="contra" id="contra" value='<?php echo $resulset->contra;  ?>'>
    </p>
    <p>
        <input type="text" name="conficontra" id="conficontra" value='<?php echo $resulset->conficontra;  ?>'>
    </p>
    <p>
        <input type="text" name="contraadmin" id="contraadmin" value='<?php echo $resulset->contraadmin;  ?>'>
    </p>

    <input type="submit" VALUE="actualiza">

    </form>
</body>
</html>