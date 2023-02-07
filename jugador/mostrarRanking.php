<?php

if(isset($_POST["sigla1"]) && isset($_POST["sigla2"]) && isset($_POST["sigla3"])){
    try {
        $conexion = new PDO("mysql:host=localhost;dbname=rankingJuego", "root", "");
        $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $error){
        $conexion = null;
    }
    
    if($conexion != null){
        $sigla1 = $_POST["sigla1"];
        $sigla2 = $_POST["sigla2"];
        $sigla3 = $_POST["sigla3"];
        $comando = $conexion -> prepare("UPDATE jugadores SET nombre=:dato WHERE nombre IS NULL");
        $comando -> execute(array(":dato" => $sigla1 . $sigla2 . $sigla3));
    }
}

if(isset($_POST["puntuacion"])){
    $puntuacion = $_POST["puntuacion"];

    try {
        $conexion = new PDO("mysql:host=localhost;dbname=rankingJuego", "root", "");
        $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $error){
        $conexion = null;
    }
    
    if($conexion != null){
        $comando = $conexion -> prepare("INSERT INTO jugadores (nombre, puntos) VALUES (:nombre, :puntos)");
        $comando -> execute(array(":nombre" => null, ":puntos" => $puntuacion));
    }

}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Timeline - Mostrar ranking</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../styles.css">
    </head>
    <body>
    <div class="contenedorCentrado">
        <form method='POST'>
            <h2>Ranking</h2>
            <table>
                <tr>
                    <th>Orden</th>
                    <th>Nombre</th>
                    <th>Puntuación</th>
                </tr>
        <?php

            if($conexion != null){
                $comando = $conexion -> prepare("SELECT * FROM jugadores ORDER BY puntos DESC LIMIT 10");
                $comando -> execute();
                $jugadores = $comando -> fetchAll(PDO::FETCH_ASSOC);

                for($i=0; $i<count($jugadores); $i++){
                    $jugador = $jugadores[$i];
                    echo "<tr>";
                    echo "<td>". $i+1 ."</td>";
                    
                    if($jugador["nombre"] == null){
                        echo "<td><input type='text' name='sigla1' required><input type='text' name='sigla2' required><input type='text' name='sigla3' required></td>";
                    } else {
                    echo "<td>". $jugador["nombre"] ."</td>";
                    }
                    
                    echo "<td>". $jugador["puntos"] ."</td>";
                    echo "</tr>";
                }
                echo "</table><br>";
                echo "<button class='btn btn-primary'>Actualizar</button>";
                echo "</form>";
            }

        ?>
        </div>
    </body>
</html>
<?php

unset($_POST);
$conexion = null;

?>