<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Pedidos</title><!--Nombre de la pestaña-->
    <link rel="stylesheet" href="../Estilos/EsmesaAdmin.css"><!--Archivo de estilos-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"><!--Archivo de estilos-->
    <link rel="shortcut icon" href="../IMG/Logo_ByteBite.png"><!--Icono de la pestaña-->
</head>

<body>
<br>
    <div class="encabezado">
    <h1>Gestión Pedidos</h1><!--Nombre del encabezado-->
    </div>
    
    <?php
    echo "<center>";
        include_once('CrudPedido.php');

        $crud= new CrudPedido();
        $statement = $crud->consultarPedido();
        $res=$statement->rowCount();
        echo "<br> Encontrados : $res";
        echo "</center>";
    ?>
    
    <br><br>

    <div class="tabla">
    <div class="tabla_section">
    <table><!--Tabla para gestion de mesas-->
            <thead>
                <tr><!--Encabezados de la tabla-->               
                    <td>id_pedido</td>
                    <td>id_Mesa</td>
                    <td>id_Cliente</td>
                    <td>Costo</td>
                    <td>Fecha</td>
                    <td>Estado</td> 
                    <td>Eliminar</td> 
                </tr>
            </thead>

            <tbody>
                
            <?php
            
            if($res > 0){
                $resultados = $statement->fetchAll(PDO::FETCH_OBJ);
                foreach($resultados as $Pedido){
                echo "
                <tr>
                    <td>".$Pedido->id_pedido."</td>
                    <td>".$Pedido->id_mesa."</td>
                    <td>".$Pedido->id_cliente."</td>
                    <td>".$Pedido->costo."</td>
                    <td>".$Pedido->fecha."</td>
                    <td>".$Pedido->estado."</td>
                    <td> <button><i class='fa-solid fa-trash'></i></button><!--Boton para eliminar--> </td>
                </tr>
                ";
            }
            }else {
                echo "
                <tr>
                <th COLSPAN = '6'>
                <marquee>NO HAY REGISTROS</marquee>
                </tr>";

            }
        
            ?>
            </tbody>   
        </table>

        </div>
        <br></br>
        <div class="botones">
 
            <form action="../HTML/bienvenida_admin.html"><!--Form URL de la interfaz de bienvenida-->
            <input type="submit" class="btn-submit" value="Salir" ><!--Input de salir-->
            </form>

        </div>

    </div>

    <br><br>
    
</body>
</html>