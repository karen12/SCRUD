<?php
    $id = null;
    if(!empty($_GET['id'])) {
        $id = $_GET['id'];
    }
    if($id == null) {
        header("Location: index.php");
    }
    require("db.php");
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

        // update data
        if($valid) {
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE utiles SET nombre_art = ?, descripcion_art = ?, precio_art = ? WHERE id_articulo = ?";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($nombre, $descripcion, $precio, $id));
            $PDO = null;
            header("Location: index.php");
        }
    }
    else {
        // read data
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT nombre_art, descripcion_art, precio_art FROM utiles WHERE id_articulo = ?";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($id));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $PDO = null;
        if(empty($data)) {
            header("Location: index.php");
        }
        $nombre = $data['nombre_art'];
        $descripcion = $data['descripcion_art'];
        $precio = $data['precio_art'];

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
            <h2>Actualizar Utiles</h2>
        </div>
        <form method='POST'>
            <div class='form-group <?php print(!empty($nombreError)?"has-error":""); ?>'>
                <label for='nombre'>Nombre</label>
                <input type='text' name='nombre' placeholder='nombre' pattern="[a-zA-Z]*" required='required' id='nombre' class='form-control' value='<?php print($nombre); ?>'>
                <?php print(!empty($nombreError)?"<span class='help-block'>$nombreError</span>":""); ?>
            </div>
              <div class='form-group <?php print(!empty($descripcionError)?"has-error":""); ?>'>
                <label for='descripcion'>descripcion</label>
                <input type='text' name='descripcion' placeholder='descripcion' required='required' id='descripcion' class='form-control' value='<?php print($descripcion); ?>'>
                <?php print(!empty($descripcionError)?"<span class='help-block'>$descripcionError</span>":""); ?>
            </div>
              <div class='form-group <?php print(!empty($precioError)?"has-error":""); ?>'>
                <label for='precio'>precio</label>
                <input title="el numero debe ser menor a 1000 y mayor que 0" type='text' name='precio' placeholder='precio'  min="1" max="1000.00" maxlength="7" minlength="1"   required='required' id='precio' class='form-control' value='<?php print($precio); ?>'>
                <?php print(!empty($precioError)?"<span class='help-block'>$precioError</span>":""); ?>
            </div>
            
            <div class='form-actions'>
                <button type='submit' class='btn btn-primary'>Actualizar</button>
                <a class='btn btn btn-default' href='index.php'>Regresar</a>
            </div>
        </form>
    </div> <!-- /row -->
</div> <!-- /container -->
</body>
</html>