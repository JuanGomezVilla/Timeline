<?php

if(isset($_POST["mazoRecibido"])){
    $mazo = $_POST["mazoRecibido"];
} else {
    header("Location: seleccionarMazo.php");
    exit();
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
        <form class="contenedor-centrado" action="mostrarRanking.php" method="POST">
            <h2>Bienvenido al timeline de <?php echo $mazo; ?></h2>
            <input type="number" name="puntuacion" placeholder="Puntuación..." required>
            <button>Siguiente</button>
        </form>
    </body>
</html>