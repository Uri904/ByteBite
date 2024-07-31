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

// Manejar la adición al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_bebida'])) {
    $id_bebida = $_POST['id_bebida'];
    $precio_bebida = $_POST['precio'];
    $cantidad = 1; // Ajusta esto si el usuario puede seleccionar una cantidad diferente

    // Obtener el ID del pedido desde la sesión o definir uno nuevo
    session_start();
    if (!isset($_SESSION['id_pedido'])) {
        // Crear un nuevo pedido si no hay uno en la sesión
        $sql_pedido = 'INSERT INTO pedido (id_mesa, costo, fecha, estado) VALUES (:id_mesa, :costo, :fecha, :estado) RETURNING id_pedido';
        $statement_pedido = $pdo->prepare($sql_pedido);
        $statement_pedido->execute([
            ':id_mesa' => 1, // Ajusta según sea necesario
            ':costo' => $precio_bebida * $cantidad,
            ':fecha' => date('Y-m-d'),
            ':estado' => 'Nuevo'
        ]);

        // Obtener el id_pedido del nuevo pedido
        $id_pedido = $statement_pedido->fetchColumn();

        // Guardar el ID del pedido en la sesión
        $_SESSION['id_pedido'] = $id_pedido;
    } else {
        // Usar el ID del pedido actual desde la sesión
        $id_pedido = $_SESSION['id_pedido'];
    }

    // Insertar en la tabla 'contiene'
    $sql_contiene = 'INSERT INTO contiene (id_pedido, id_bebida, cantidad) VALUES (:id_pedido, :id_bebida, :cantidad)';
    $statement_contiene = $pdo->prepare($sql_contiene);
    $statement_contiene->execute([
        ':id_pedido' => $id_pedido,
        ':id_bebida' => $id_bebida,
        ':cantidad' => $cantidad
    ]);

    echo 'La bebida se ha agregado al carrito correctamente.';

    // Redirigir de vuelta a la misma página para evitar el reenvío del formulario
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Obtener datos de la tabla bebida
$sql_bebidas = 'SELECT id_bebida, nombre_bebida, precio FROM bebida';
$statement_bebidas = $pdo->prepare($sql_bebidas);
$statement_bebidas->execute();
$bebidas = $statement_bebidas->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../Estilos/estilo.css">
    <link rel="shortcut icon" href="../IMG/Logo_ByteBite.png">
    <script src="../JS/app.js" async></script>
    <title>Bebidas</title>
</head>
<body>

<header class="header">
    <div class="encabezado">
        <nav class="nav">
            <a href="../HTML/Bienvenida.html" class="logo nav-link">ByteBite</a>
            <ul class="nav-menu">
                <li class="nav-menu-item"><a href="./verBebida.php" class="nav-menu-link nav-link">Bebida</a></li>
                <li class="nav-menu-item"><a href="./verPlatillo.php" class="nav-menu-link nav-link">Platillo</a></li>
                <li class="nav-menu-item"><a href="../HTML/Crear_pedido.html" class="nav-menu-link nav-link">Regresar</a></li>
            </ul>
        </nav>
    </div>
</header>

<br><br><br><br><br><br><br>

<header>
    <h1>Bebidas</h1>
    <?php
    echo "<center><span>";
    echo "<br> Disponibles : " . count($bebidas);
    echo "</center></span>";
    ?>
</header>

<section class="contenedor">
    <div class="contenedor-items">
    <?php
        foreach ($bebidas as $bebida) {
            echo "
            <div class='item'>
                <span class='titulo-item'>" . htmlspecialchars($bebida->nombre_bebida) . "</span>
                <img src='../IMG/Menu/bebidas/" . htmlspecialchars($bebida->nombre_bebida) . ".png' alt='' class='bebida-img'>
                <span class='precio-item'>$" . htmlspecialchars($bebida->precio) . "</span>
                <form method='post' action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "'>
                    <input type='hidden' name='id_bebida' value='" . htmlspecialchars($bebida->id_bebida) . "'>
                    <input type='hidden' name='precio' value='" . htmlspecialchars($bebida->precio) . "'>
                    <button type='submit' class='boton-item'>Agregar</button>
                </form>
            </div>
            ";
        }
    ?>
    </div>
    
    <div class="carrito" id="carrito">
        <div class="header-carrito">
            <h2>Tu Carrito</h2>
        </div>
        <div class="carrito-items">
            <!-- Items del carrito (Opcional) -->
        </div>
        <div class="carrito-total">
            <div class="fila">
                <strong>Tu Total</strong>
                <span class="carrito-precio-total">$0.00</span>
            </div>
            <button class="btn-pagar">Pedir <i class="fa-solid fa-bag-shopping"></i></button>
        </div>
    </div>
</section>
</body>
</html>