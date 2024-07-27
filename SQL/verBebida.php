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
    <title>Platillos </title>
</head>
<body>

<header class="header">
        <div class="encabezado">
            <nav class="nav">
                <a href="../HTML/Bienvenida.html" class="logo nav-link">ByteBite</a><!--Link para regresar a la página de "Bienvenida"-->
                <ul class="nav-menu">
                    <li class="nav-menu-item"><a href="./verPlatillo.php" class="nav-menu-link nav-link">Platillo</a></li><!--Link para visualizar las bebidas-->
                    <li class="nav-menu-item"><a href="../HTML/Crear_pedido.html" class="nav-menu-link nav-link">Regresar</a></li><!--link para regresar a crear un pedido-->
                </ul>
            </nav>
        </div>
    </header>

    <br><br><br><br><br><br><br>

    <header>
        <h1>Bebidas</h1>
       
       <?php
    echo "<center><span>";
        include_once('CrudBebida.php');

        $crud = new CrudBebida();
        $statement = $crud->consultarBebida();
        $res=$statement->rowCount();
        echo "<br> Disponibles : $res";
        echo "</center></span>";
    ?>
    </header>
    
    <section class="contenedor">
        <!-- Contenedor de elementos -->
        <div class="contenedor-items">
    <?php

        $resultados = $statement->fetchAll(PDO::FETCH_OBJ);
        foreach($resultados as $bebida){
        echo "
            <div class='item'>
                <span class='titulo-item'>".$bebida -> nombre_bebida."</span>
                <img src='../IMG/Menu/platillos/postres/Cheesecake.png' alt='' class='img-item'>
                <span class='precio-item'>$".$bebida -> precio."</span>
                <button class='boton-item'>Agregar</button>
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
                    <span class="carrito-precio-total">
                        $0.00
                    </span>
                </div>
                <button class="btn-pagar">Pagar <i class="fa-solid fa-bag-shopping"></i> </button>
            </div>
        </div>
    </section>
</body>
</html>