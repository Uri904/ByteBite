<?php
// Conectar a la base de datos
$dsn = 'pgsql:host=localhost;dbname=bytebite';
$username = 'postgres';
$password = 'root';
$options = [];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Conexión fallida: ' . $e->getMessage();
}

// Obtener datos del formulario
$precio_platillo = $_POST['precio'];
$id_platillo = $_POST['id_platillo'];
$cantidad = 1; // Ajusta esto si el usuario puede seleccionar una cantidad diferente

// Insertar un nuevo pedido
$sql_pedido = 'INSERT INTO pedido (id_mesa, costo, fecha, estado) VALUES (:id_mesa, :costo, :fecha, :estado) RETURNING id_pedido';
$statement_pedido = $pdo->prepare($sql_pedido);
$statement_pedido->execute([
    ':id_mesa' => 1, // Ajusta según sea necesario
    ':costo' => $precio_platillo * $cantidad,
    ':fecha' => date('Y-m-d'),
    ':estado' => 'Nuevo'
]);

// Obtener el id_pedido del nuevo pedido
$id_pedido = $statement_pedido->fetchColumn();

// Insertar en la tabla 'contiene'
$sql_contiene = 'INSERT INTO contiene (id_pedido, id_platillo, cantidad) VALUES (:id_pedido, :id_platillo, :cantidad)';
$statement_contiene = $pdo->prepare($sql_contiene);
$statement_contiene->execute([
    ':id_pedido' => $id_pedido,
    ':id_platillo' => $id_platillo,
    ':cantidad' => $cantidad
]);

echo 'El platillo se ha agregado al carrito correctamente.';

// Redirigir de vuelta al menú (ajusta la URL según tu estructura)
header('Location: ../SQL/verPlatillo.php');
exit();
?>