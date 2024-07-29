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

// Obtener el nombre de la bebida a eliminar
if (isset($_POST['nombre_bebida'])) {
    $nombre_bebida = $_POST['nombre_bebida'];

    try {
        // Preparar la consulta para obtener el id_bebida
        $sql_bebida = 'SELECT id_bebida FROM bebida WHERE nombre_bebida = :nombre_bebida LIMIT 1';
        $statement_bebida = $pdo->prepare($sql_bebida);
        $statement_bebida->execute([':nombre_bebida' => $nombre_bebida]);
        $bebida = $statement_bebida->fetch(PDO::FETCH_ASSOC);

        if ($bebida) {
            $id_bebida = $bebida['id_bebida'];

            // Preparar la consulta para obtener el id_pedido más reciente para esta bebida
            $sql_pedido = 'SELECT c.id_pedido, c.cantidad FROM contiene c
                           JOIN pedido pe ON c.id_pedido = pe.id_pedido
                           WHERE c.id_bebida = :id_bebida AND pe.estado = :estado
                           ORDER BY pe.fecha DESC
                           LIMIT 1';
            $statement_pedido = $pdo->prepare($sql_pedido);
            $statement_pedido->execute([':id_bebida' => $id_bebida, ':estado' => 'Nuevo']);
            $pedido = $statement_pedido->fetch(PDO::FETCH_ASSOC);

            if ($pedido) {
                $id_pedido = $pedido['id_pedido'];
                $cantidad_actual = $pedido['cantidad'];

                // Reducir la cantidad de la bebida en el pedido
                if ($cantidad_actual > 1) {
                    $sql_update = 'UPDATE contiene SET cantidad = cantidad - 1 
                                   WHERE id_pedido = :id_pedido AND id_bebida = :id_bebida';
                    $statement_update = $pdo->prepare($sql_update);
                    $statement_update->execute([':id_pedido' => $id_pedido, ':id_bebida' => $id_bebida]);
                } else {
                    // Eliminar el registro si la cantidad es 1
                    $sql_delete = 'DELETE FROM contiene WHERE id_pedido = :id_pedido AND id_bebida = :id_bebida';
                    $statement_delete = $pdo->prepare($sql_delete);
                    $statement_delete->execute([':id_pedido' => $id_pedido, ':id_bebida' => $id_bebida]);
                }
            } else {
                echo "Pedido no encontrado.";
            }

            // Redirigir de vuelta a la página de resumen de pedidos
            header('Location: ResumenPedido.php');
            exit();
        } else {
            echo "Bebida no encontrada.";
        }
    } catch (PDOException $e) {
        echo 'Error al actualizar el pedido: ' . $e->getMessage();
    }
} else {
    echo "Nombre de la bebida no especificado.";
}
?>