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

$comando = $conexion -> prepare("SELECT nombre FROM mazos");
$comando -> execute();
$mazos = $comando -> fetchAll(PDO::FETCH_COLUMN);

$comando = $conexion -> prepare("SELECT * FROM cartas");
$comando -> execute();
$cartas = $comando -> fetchAll(PDO::FETCH_ASSOC);

echo "<script>\n";
echo "let cartas = [\n";

foreach($cartas as $carta){
    echo "\t{id:". $carta["id"] .", mazo:\"". $carta["mazo"] ."\", tiempo:". $carta["tiempo"] .", evento:\"". $carta["evento"] ."\"},\n";
}

echo "];\n";
echo "</script>";

?>
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
        <title>Timeline - Modificar carta</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="contenedorCentrado">
            <form method="POST">
                <h2>Modificar carta</h2>
                <p>Selecciona una carta</p>
                <div class="row">
                    <div class="col">
                        <select class="form-control" name="nombre" id="selectorMazo">
                        <?php
                            if($filas){
                                foreach($mazos as $mazo){
                                    echo "<option value='$mazo'>$mazo</option>";
                                }
                            }
                        ?>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-control" name="carta" id="selectorCarta"></select>
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
        <script>

            let selectorMazo, selectorCarta;

            window.onload = function(){
                //Capturar elementos
                selectorMazo = document.querySelector("#selectorMazo");
                selectorCarta = document.querySelector("#selectorCarta");

                selectorMazo.addEventListener("change", function(evento){
                    
                    let cartasFiltradas = cartas.filter((carta) => carta.mazo == evento.target.value);
                    let resultado = "";
                    cartasFiltradas.forEach((carta) => {
                        resultado += `<option value="${carta.id}">${carta.tiempo}</option>`;
                    });
                    console.log(resultado);
                    selectorCarta.innerHTML = resultado;
                });
            }

        </script>
    </body>
</html>