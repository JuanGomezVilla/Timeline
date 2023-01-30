<?php

try {
    $conexion = new PDO("mysql:host=localhost;dbname=rankingJuego", "root", "");
    $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $error){
    $conexion = null;
}

$comando = $conexion -> prepare("SELECT nombre, descripcion FROM mazos");
$comando -> execute();
$resultado = $comando -> fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Timeline - AD</title>
        <meta charset="UTF-8">
        <meta name="google" content="notranslate">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>

        <form>
            <p>
                Selecciona un mazo
                <select id="mazos">
                    <?php
                        foreach($resultado as $mazo){
                            echo "<option>". $mazo["nombre"] ."</option>";
                        }
                    ?>
                </select>
            </p>
        </form>
        
    </body>
</html>
<?php

$conexion = null;

?>