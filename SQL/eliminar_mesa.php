<?php
if (isset($_POST['delete'])) {
    $id_mesa = $_POST['id_mesa'];

    // Aquí debes incluir la lógica para conectar a tu base de datos y eliminar el registro
    include_once('CrudMesa.php');
    $crud = new CrudMesa();
    $crud->eliminarMesa($id_mesa);

    // Redirigir de vuelta a la página principal después de eliminar
    header('Location:verMesas.php');
    exit();
}
?>