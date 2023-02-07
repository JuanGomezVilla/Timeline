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
    if(isset($_FILES["imagen"]) && isset($_POST["tiempo"]) && isset($_POST["mazo"]) && isset($_POST["evento"])){
        //Extensiones y obtiene todos los datos
        $extensiones = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $archivo_nombre = $_FILES["imagen"]["name"];
        $archivo_type = $_FILES["imagen"]["type"];
        $archivo_size = $_FILES["imagen"]["size"];
        
        //Verifica la extensión del archivo
        $extension = pathinfo($archivo_nombre, PATHINFO_EXTENSION);
        
        //Si el formato es válido
        if(array_key_exists($extension, $extensiones)){
            //Verifica el tamaño máximo permitido (2 MB)
            $maxsize = 2 * 1024 * 1024;
            if($archivo_size < $maxsize){
                // Verify MYME type of the file
                if (in_array($archivo_type, $extensiones)){
                    //Comprueba si el archivo existe
                    if (!file_exists("assets/". $_FILES["imagen"]["name"])){
                        move_uploaded_file($_FILES["imagen"]["tmp_name"], "assets/". $_POST["mazo"] . $_POST["tiempo"] .".png" );//$_FILES["imagen"]["name"]);
                    }
                }
            }
        }  
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Timeline - Crear carta</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="contenedorCentrado">
            <form method="POST" enctype="multipart/form-data">
                <h2>Crear una carta</h2>
                <p>Selecciona un mazo, un año, y un evento como descripción</p>
                <div class="row">
                    <div class="col">
                        <select class="form-control" name="mazo">
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
                        <input class="form-control" type="number" placeholder="Año..." name="tiempo" required>
                    </div>
                    <div class="col">
                        <input class="form-control" type="text" name="evento" placeholder="Evento..." required>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col">
                        <input class="form-control" name="imagen" type="file" required>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary">Crear carta</button>
                    </div>
                </div>
                <?php if($mensaje != null) echo $mensaje; ?>
            </form>
        </div>
    </body>
</html>

