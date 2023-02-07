<?php

$mensaje = null;

//Comprobar que existen valores en el POST
if(isset($_POST["nombre"]) && isset($_POST["descripcion"])){
    //Capturar los valores
    $nombre = strtolower($_POST["nombre"]);
    $descripcion = $_POST["descripcion"];
    
    //Creación de una conexión
    try {
        $conexion = new PDO("mysql:host=localhost;dbname=rankingjuego", "root", "");
        $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $error){
        $conexion = null;
        $mensaje = "<p class='text-warning'>No existe conexión</p>";
    }

    //Comprobar que la conexión existe
    if($conexion != null){
        $comando = $conexion -> prepare("SELECT nombre FROM mazos");
        $comando -> execute();
        $resultado = $comando -> fetchAll(PDO::FETCH_COLUMN);

        if(in_array($nombre, $resultado)){
            $mensaje = "<p class='text-danger'>El mazo ya existe</p>";
            
        } else {
            $comando = $conexion -> prepare("INSERT INTO mazos VALUES (:nombre, :descripcion)");
            $comando -> execute(array(
                ":nombre" => $nombre,
                ":descripcion" => $descripcion
            ));
            $mensaje = "<p class='text-success'>Mazo creado correctamente</p>";
        }

        
    }

}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Timeline - Crear mazo</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="contenedorCentrado">
            <form method="POST">
                <h2>Crear un mazo</h2>
                <p>Escribe un nombre y una descripción para el mazo</p>
                <div class="row">
                    <div class="col">
                        <input class="form-control" type="text" name="nombre" placeholder="Nombre..." required>
                    </div>
                    <div class="col">
                        <input class="form-control" type="text" name="descripcion" placeholder="Descripción...">
                    </div>
                    <div class="col">
                        <button class="btn btn-primary">Crear mazo</button>
                    </div>
                    
                </div><br>
                <?php if($mensaje != null) echo $mensaje; ?>
            </form>
        </div>
    </body>
</html>

