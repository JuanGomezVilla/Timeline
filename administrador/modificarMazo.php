<?php

//Creación de una conexión
try {
    $conexion = new PDO("mysql:host=localhost;dbname=rankingjuego", "root", "");
    $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $error){
    $conexion = null;
    $mensaje = "<p class='text-warning'>No existe conexión</p>";
}

$filas = $mensaje = null;

if($conexion != null){
    //Capturar todos los mazos
    $comando = $conexion -> prepare("SELECT nombre FROM mazos");
    $comando -> execute();
    $filas = $comando -> fetchAll(PDO::FETCH_COLUMN);

    //Comprobar si existen datos en POST
    if(isset($_POST["nombre"]) && isset($_POST["descripcion"])){
        //Capturar datos
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];

        //Actualizar los datos
        $comando = $conexion -> prepare("UPDATE mazos SET descripcion=:descripcion WHERE nombre=:nombre;");
        $comando -> execute(array(":descripcion" => $descripcion, ":nombre" => $nombre));
        header("Location: modificarMazo.php");
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Timeline - Modificar mazo</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="contenedorCentrado">
            <form method="POST">
                <h2>Modificar un mazo</h2>
                <p>Selecciona un mazo y escribe una descripción nueva</p>
                <div class="row">
                    <div class="col">
                        <select class="form-control" name="nombre">
                        <?php
                            if($filas){
                                foreach($filas as $fila){
                                    echo "<option value='$fila'>$fila</option>";
                                }
                            }
                        ?>
                        </select>
                    </div>
                    <div class="col">
                        <input class="form-control" type="text" name="descripcion" placeholder="Descripción nueva...">
                    </div>
                    <div class="col">
                        <button class="btn btn-primary">Modificar mazo</button>
                    </div>
                    
                </div><br>
                <?php if($mensaje != null) echo $mensaje; ?>
            </form>
        </div>
    </body>
</html>