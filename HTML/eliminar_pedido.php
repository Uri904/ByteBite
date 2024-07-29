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
    die('Conexión fallida: ' . $e->getMessage());
}

// Obtener el nombre del platillo a reducir
if (isset($_POST['nombre_platillo'])) {
    $nombre_platillo = $_POST['nombre_platillo'];

    try {
        // Preparar la consulta para obtener el id_platillo
        $sql = 'SELECT id_platillo FROM platillo WHERE nombre_platillo = :nombre_platillo LIMIT 1';
        $statement = $pdo->prepare($sql);
        $statement->execute([':nombre_platillo' => $nombre_platillo]);
        $platillo = $statement->fetch(PDO::FETCH_ASSOC);

        if ($platillo) {
            $id_platillo = $platillo['id_platillo'];

            // Preparar la consulta para obtener el id_pedido más reciente para este platillo
            $sql = 'SELECT c.id_pedido FROM contiene c
                    JOIN pedido pe ON c.id_pedido = pe.id_pedido
                    WHERE c.id_platillo = :id_platillo AND pe.estado = :estado
                    ORDER BY pe.fecha DESC
                    LIMIT 1';
            $statement = $pdo->prepare($sql);
            $statement->execute([':id_platillo' => $id_platillo, ':estado' => 'Nuevo']);
            $pedido = $statement->fetch(PDO::FETCH_ASSOC);

            if ($pedido) {
                $id_pedido = $pedido['id_pedido'];

                // Reducir la cantidad del platillo en el pedido
                $sql = 'UPDATE contiene SET cantidad = cantidad - 1 
                        WHERE id_pedido = :id_pedido AND id_platillo = :id_platillo';
                $statement = $pdo->prepare($sql);
                $statement->execute([':id_pedido' => $id_pedido, ':id_platillo' => $id_platillo]);

                // Eliminar el registro de contiene si la cantidad se reduce a 0
                $sql = 'DELETE FROM contiene WHERE cantidad <= 0';
                $statement = $pdo->prepare($sql);
                $statement->execute();
            }

            // Redirigir de vuelta a la página de resumen de pedidos
            header('Location: ResumenPedido.php');
            exit();
        } else {
            echo "Platillo no encontrado.";
        }
    } catch (PDOException $e) {
        echo 'Error al actualizar el pedido: ' . $e->getMessage();
    }
} else {
    echo "Nombre del platillo no especificado.";
}
?>