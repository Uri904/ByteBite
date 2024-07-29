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

// Obtener datos de platillos
$sql_pedidos = 'SELECT 
                    p.nombre_platillo, 
                    SUM(c.cantidad) as cantidad_total, 
                    SUM(c.cantidad * p.precio) as costo_total, 
                    MIN(pe.fecha) as fecha
                FROM 
                    contiene c
                JOIN 
                    pedido pe ON c.id_pedido = pe.id_pedido
                JOIN 
                    platillo p ON c.id_platillo = p.id_platillo
                WHERE 
                    pe.estado = :estado
                GROUP BY 
                    p.nombre_platillo
                ORDER BY 
                    fecha DESC';
$statement_pedidos = $pdo->prepare($sql_pedidos);
$statement_pedidos->execute([':estado' => 'Nuevo']);
$pedidos = $statement_pedidos->fetchAll(PDO::FETCH_ASSOC);

// Obtener datos de bebidas
$sql_bebidas = 'SELECT 
                    b.nombre_bebida, 
                    SUM(t.cantidad) as cantidad_total, 
                    SUM(t.cantidad * b.precio) as costo_total, 
                    MIN(pe.fecha) as fecha
                FROM 
                    contiene t
                JOIN 
                    pedido pe ON t.id_pedido = pe.id_pedido
                JOIN 
                    bebida b ON t.id_bebida = b.id_bebida
                WHERE 
                    pe.estado = :estado
                GROUP BY 
                    b.nombre_bebida
                ORDER BY 
                    fecha DESC';
$statement_bebidas = $pdo->prepare($sql_bebidas);
$statement_bebidas->execute([':estado' => 'Nuevo']);
$bebidas = $statement_bebidas->fetchAll(PDO::FETCH_ASSOC);

// Calcular totales combinados
$totalProductosPlatillo = 0;
$totalCostoPlatillo = 0;
foreach ($pedidos as $pedido) {
    $totalProductosPlatillo += $pedido['cantidad_total'];
    $totalCostoPlatillo += $pedido['costo_total'];
}

$totalProductosBebida = 0;
$totalCostoBebida = 0;
foreach ($bebidas as $bebida) {
    $totalProductosBebida += $bebida['cantidad_total'];
    $totalCostoBebida += $bebida['costo_total'];
}

$totalProductos = $totalProductosPlatillo + $totalProductosBebida;
$totalCosto = $totalCostoPlatillo + $totalCostoBebida;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen Pedidos</title>
    <link rel="stylesheet" href="../Estilos/EsResumenPedido.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="shortcut icon" href="../IMG/Logo_ByteBite.png">
</head>

<body>

    <br>

    <div class="encabezado">
        <h1>Resumen Pedidos</h1>
    </div>

    <br><br>

    <!-- Tabla de Platillos -->
    <div class="tabla">
        <div class="tabla_section">
            <h2>Platillos</h2>
            <table>
                <thead>
                    <tr>
                        <th>Productos</th>
                        <th>Cantidad</th>
                        <th>Costo</th>
                        <th>Fecha</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($pedidos as $pedido) {
                        $nombre_platillo = htmlspecialchars($pedido['nombre_platillo']);
                        $cantidad_total = $pedido['cantidad_total'];
                        $costo_total = $pedido['costo_total'];
                        $fecha = $pedido['fecha'];

                        echo "<tr>";
                        echo "<td>{$nombre_platillo}</td>";
                        echo "<td>{$cantidad_total}</td>";
                        echo "<td>\${$costo_total}</td>";
                        echo "<td>{$fecha}</td>";

                        echo "<td>
                                <form action='eliminar_pedido.php' method='post' style='display:inline;'>
                                    <input type='hidden' name='nombre_platillo' value=\"{$nombre_platillo}\">
                                    <button type='submit'>Eliminar</button>
                                </form>
                              </td>";

                    }
                    ?>

                    <tr>
                        <td>Total de platillos:</td>
                        <td><?php echo $totalProductosPlatillo; ?></td>
                        <td>Total:</td>
                        <td>$<?php echo $totalCostoPlatillo; ?></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Tabla de Bebidas -->
        <div class="tabla_section">
            <h2>Bebidas</h2>
            <table>
                <thead>
                    <tr>
                        <th>Productos</th>
                        <th>Cantidad</th>
                        <th>Costo</th>
                        <th>Fecha</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($bebidas as $bebida) {
                        $nombre_bebida = htmlspecialchars($bebida['nombre_bebida']);
                        $cantidad_total = $bebida['cantidad_total'];
                        $costo_total = $bebida['costo_total'];
                        $fecha = $bebida['fecha'];

                        echo "<tr>";
                        echo "<td>{$nombre_bebida}</td>";
                        echo "<td>{$cantidad_total}</td>";
                        echo "<td>\${$costo_total}</td>";
                        echo "<td>{$fecha}</td>";

                        echo "<td>
                                <form action='eliminar_bebida.php' method='post' style='display:inline;'>
                                    <input type='hidden' name='nombre_bebida' value=\"{$nombre_bebida}\">
                                    <button type='submit'>Eliminar</button>
                                </form>
                              </td>";

                    }
                    ?>

                    <tr>
                        <td>Total de bebidas:</td>
                        <td><?php echo $totalProductosBebida; ?></td>
                        <td>Total:</td>
                        <td>$<?php echo $totalCostoBebida; ?></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <br>

            <!-- Fila de Totales Combinados -->
            <div class="total_combinado">
                <h3>Total de Compra:</h3>
                <table>
                    <tbody>
                        <tr>
                            <td>Total de productos:</td>
                            <td><?php echo $totalProductos; ?></td>
                        </tr>
                        <tr>
                            <td>Total:</td>
                            <td>$<?php echo $totalCosto; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <br>
            <div class="botones">
                <form action="./Bienvenida.html">
                    <input type="submit" class="btn-submit" value="Finalizar">
                </form>

                <form action="./Crear_pedido.html">
                    <input type="submit" class="btn-submit" value="Agregar Platillos">
                </form>

                <form action="./Bienvenida.html">
                    <input type="submit" class="btn-submit" value="Regresar">
                </form>
            </div>
        </div>
    </div>

    <br><br>

</body>

</html>