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

// Manejar la adición al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_platillo'])) {
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

    // Redirigir de vuelta a la misma página para evitar el reenvío del formulario
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Obtener datos de los platillos
$sql_platillos = 'SELECT id_platillo, nombre_platillo, precio FROM platillo';
$statement_platillos = $pdo->prepare($sql_platillos);
$statement_platillos->execute();
$platillos = $statement_platillos->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../Estilos/estilo.css">
    <link rel="stylesheet" href="../Estilos/EsBebidas.css">
    <link rel="shortcut icon" href="../IMG/Logo_ByteBite.png">
    <script src="../JS/app.js" async></script>
    <title>Platillos</title>
</head>

<body>

    <header class="header">
        <div class="encabezado">
            <nav class="nav">
                <a href="../HTML/Bienvenida.html" class="logo nav-link">ByteBite</a><!--Link para regresar a la página de "Bienvenida"-->
                <ul class="nav-menu">
                    <li class="nav-menu-item"><a href="./verBebida.php" class="nav-menu-link nav-link">Bebida</a></li><!--Link para visualizar las bebidas-->
                    <li class="nav-menu-item"><a href="../HTML/Crear_pedido.html" class="nav-menu-link nav-link">Regresar</a></li><!--link para regresar a crear un pedido-->
                </ul>
            </nav>
        </div>
    </header>

    <br><br><br><br><br><br><br>

    <header>
        <h1>Platillo</h1>

        <?php
        echo "<center><span>";
        echo "<br> Disponibles : " . count($platillos);
        echo "</center></span>";
        ?>
    </header>

    <section class="contenedor">
        <div class="contenedor-items">
            <?php
            foreach ($platillos as $platillo) {
                echo "
            <div class='item'>
                <span class='titulo-item'>" . htmlspecialchars($platillo->nombre_platillo) . "</span>
                <img src='../IMG/Menu/platillos/" . htmlspecialchars($platillo->nombre_platillo) . ".png' alt='' class='img-item' width=125px height=125px align='center'>
                <span class='precio-item'>$" . htmlspecialchars($platillo->precio) . "</span>
                <form method='post' action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "'>
                    <input type='hidden' name='id_platillo' value='" . htmlspecialchars($platillo->id_platillo) . "'>
                    <input type='hidden' name='precio' value='" . htmlspecialchars($platillo->precio) . "'>
                    <button type='submit' class='boton-item'>Agregar</button>
                </form>
            </div>
            ";
            }
            ?>
        </div>

        <!-- Carrito de Compras -->
        <div class="carrito" id="carrito">
            <div class="header-carrito">
                <h2>Tu Carrito</h2>
            </div>

            <div class="carrito-items">
                <!-- 
                <div class="carrito-item">
                    <img src="img/boxengasse.png" width="80px" alt="">
                    <div class="carrito-item-detalles">
                        <span class="carrito-item-titulo">Box Engasse</span>
                        <div class="selector-cantidad">
                            <i class="fa-solid fa-minus restar-cantidad"></i>
                            <input type="text" value="1" class="carrito-item-cantidad" disabled>
                            <i class="fa-solid fa-plus sumar-cantidad"></i>
                        </div>
                        <span class="carrito-item-precio">$15.000,00</span>
                    </div>
                   <span class="btn-eliminar">
                        <i class="fa-solid fa-trash"></i>
                   </span>
                </div>
                <div class="carrito-item">
                    <img src="img/skinglam.png" width="80px" alt="">
                    <div class="carrito-item-detalles">
                        <span class="carrito-item-titulo">Skin Glam</span>
                        <div class="selector-cantidad">
                            <i class="fa-solid fa-minus restar-cantidad"></i>
                            <input type="text" value="3" class="carrito-item-cantidad" disabled>
                            <i class="fa-solid fa-plus sumar-cantidad"></i>
                        </div>
                        <span class="carrito-item-precio">$18.000,00</span>
                    </div>
                   <button class="btn-eliminar">
                        <i class="fa-solid fa-trash"></i>
                   </button>
                </div>
                 -->
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