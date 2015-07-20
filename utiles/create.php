<?php 
    if(!empty($_POST)) {
        // validation errors
        $nombreError = null;
        $descripcionError= null;
        $precioError= null;
        
        // post values
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
       
        
        // validate input
        $valid = true;
        if(empty($nombre)) {
            $nombreError = "Por favor ingrese el nombre .";
            $valid = false;
        }
        
        if(empty($descripcion)) {
            $descripcionError = "Por favor ingrese el docente";
            $valid = false;
        }
       
          if(empty($precio)) {
            $precioError = "Por favor ingrese la matricula";
            $valid = false;
        }
        // insert data
        if($valid) {
            require("db.php");
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO utiles(nombre_art, descripcion_art, precio_art) values(?, ?, ?)";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($nombre, $descripcion, $precio));
            $PDO = null;
            header("Location: index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang='es'>
<head>
    <title>CRUD con PHP</title>
    <meta charset='utf-8'>
    <link href='css/bootstrap.min.css' rel='stylesheet'>
    <script src='js/bootstrap.min.js'></script>
</head>
<body>
<div class='container'>
    <div class='row'>
        <div class='row'>
            <h2>Crear Util</h2>
        </div>
        <form method='POST'>
            <div class='form-group <?php print(!empty($nombreError)?"has-error":""); ?>'>             
                <label for='nombre'>nombre </label>
                <input title=" Se necesita un nombre" type='text' name='nombre' pattern="[a-zA-Z]*" placeholder='nombre' required='required' id='nombre' class='form-control' value='<?php print(!empty($nombre)?$nombre:""); ?>'>
                <?php print(!empty($nombreError)?"<span class='help-block'>$nombreError</span>":""); ?>
            </div>
            <div class='form-group <?php print(!empty($descripcionError)?"has-error":""); ?>'>
                <label for='descripcion'>descripcion</label>
                <input type='text' name='descripcion' placeholder='descripcion' required='required' id='descripcion' class='form-control' value='<?php print(!empty($descripcion)?$descripcion:""); ?>'>
                <?php print(!empty($descripcionError)?"<span class='help-block'>$descripcionError</span>":""); ?>
            </div>
              <div class='form-group <?php print(!empty($precioError)?"has-error":""); ?>'>
                <label for='precio'>precio</label>
                <input title="el numero debe ser menor a 1000 y mayor que 0" type='text' name='precio'  min="1" max="1000.00" maxlength="7" minlength="1"  placeholder='precio' required='required' id='precio' class='form-control' value='<?php print(!empty($precio)?$precio:""); ?>'>
                <?php print(!empty($precioError)?"<span class='help-block'>$precioError</span>":""); ?>
            </div>
           <div class='form-actions'>
                <button type='submit' class='btn btn-success'>Crear</button>
                <a class='btn btn btn-default' href='index.php'>Regresar</a>
            </div>
        </form>
    </div> <!-- /row -->
</div> <!-- /container -->
</body>
</html>