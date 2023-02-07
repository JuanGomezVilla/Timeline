<?php

try {
    $conexion = new PDO("mysql:host=localhost;dbname=rankingJuego", "root", "");
    $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $error){
    $conexion = null;
}

if($conexion != null){
    $comando = $conexion -> prepare("SELECT nombre FROM mazos");
    $comando -> execute();
    $mazos = $comando -> fetchAll(PDO::FETCH_COLUMN);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Seleccionar mazo</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../styles.css">
    </head>
    <body>
        <form class="contenedor-centrado" method="POST" action="dummy.php">
            <select name="mazoRecibido"><?php foreach($mazos as $mazo){echo "<option>$mazo</option>";} ?></select>
            <button>Siguiente</button>
        </form>
    </body>
</html>
<?php

$conexion = null;

?>