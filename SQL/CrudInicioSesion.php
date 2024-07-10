<?php
include_once 'User.php';
include_once 'userSesion.php';

$userSesion = new UserSession();
$id_mesa = new User();

if(isset($_SESSION['id_mesa'])){
    echo "Hay sesión";
} else if (isset($_POST['id_mesa']) && isset($_POST['contra'])){
//echo "Validación de login";

$id_mesaForm = $_POST['id_mesa'];
$contraForm = $_POST['contra'];
if( $id_mesa->id_mesaExists($id_mesaForm, $contraForm)){
    echo "Usuario validado";
}else{
    echo "Usuario Incorrecto";
}
} else{
    //echo "<br>Login";
    echo '<a href = "../HTML/InicioDeSesión.html">REGRESAR AL FORMULARIO</a>';
}