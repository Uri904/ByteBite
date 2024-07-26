<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Mesas</title><!--Nombre de la pestaña-->
    <link rel="stylesheet" href="../Estilos/EsmesaAdmin.css"><!--Archivo de estilos-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"><!--Archivo de estilos-->
    <link rel="shortcut icon" href="../IMG/Logo_ByteBite.png"><!--Icono de la pestaña-->
    <script type="text/javascript">
        function confirmar(){
            return confirm('¿Estas seguro?, Se eliminarán los datos');
        }
        </script>
</head>

<body>
<br>
    <div class="encabezado">
    <h1>Gestión Mesas</h1><!--Nombre del encabezado-->
    </div>
    
    <?php
    echo "<center>";
        include_once('CrudMesa.php');

        //$crud = new CrudMesa();
        $statement = $crud->consultarMesa();
        $res=$statement->rowCount();
      
    ?>
    
    <br><br>

    <div class="tabla">
    <div class="tabla_section">
    <table><!--Tabla para gestion de mesas-->
            <thead>
                <tr><!--Encabezados de la tabla-->
                    <td>id_Mesa</td>
                    <td>Contraseña</td>
                    <td>Confirmar Contraseña</td>
                    <td>Contraseña admin</td>
                    <td>Eliminar</td> 
                    <td>Actualizar</td> 
                </tr>
            </thead>

            <tbody>
                
            <?php
            
            if($res > 0){
                $resultados = $statement->fetchAll(PDO::FETCH_OBJ);
                foreach($resultados as $Mesa){
                echo "
                <tr>
                    <td>".$Mesa->id_mesa."</td>
                    <td>".$Mesa->contra."</td>
                    <td>".$Mesa->conficontra."</td>
                    <td>".$Mesa->contraadmin."</td>
                    
                    <td>
                        <form action='eliminar_mesa.php' method='post' onclick='return confirmar()'>
                        <input type='hidden' name='id_mesa'value='".$Mesa->id_mesa."'>
                        <button type='submit' class='btn-submit-icon' name='delete' >
                          <i class='fa-solid fa-trash'></i>
                        </button>
                        </form>
                    </td>


                     <td>
                     <button class='btn-submit-icon'>
                        <a href='./actMesa.php?id_mesa=".$Mesa->id_mesa."'>
                          <i class='fa-regular fa-pen-to-square'></i>
                        </a>
                     </button>
                    </td>
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
 
            <form action="../HTML/registro.html"><!--Form de URL de la interfaz de registro-->
            <input type="submit" class="btn-submit" value="Agregar Mesa" ><!--Input de agregar mesa-->
            </form>

            <form action="../HTML/bienvenida_admin.html"><!--Form URL de la interfaz de bienvenida-->
            <input type="submit" class="btn-submit" value="Salir" ><!--Input de salir-->
            </form>

        </div>

    </div>

    <br><br>
    
</body>
</html>