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
        $precioError = null;
        $descripcionError= null;
        
        // post values
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
       
        
        // validate input
        $valid = true;
        if(empty($precio >= 1)) {
            $precioError = "Por favor revise el precio";
            $valid = false;
        }
        
        if(empty($descripcion)) {
            $descripcionError = "Por favor ingrese el descripcion";
            $valid = false;
        }

        // update data
        if($valid) {
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE matricula  SET precio = ?, descripcion = ? WHERE id_ma= ?";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($precio, $descripcion, $id));
            $PDO = null;
            header("Location: index.php");
        }
    }
    else {
        // read data
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT precio, descripcion FROM matricula WHERE id_ma = ?";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($id));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $PDO = null;
        if(empty($data)) {
            header("Location: index.php");
        }
        $precio = $data['precio'];
        $descripcion = $data['descripcion'];

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
            <h2>Actualizar Matricula</h2>
        </div>
        <form method='POST'>
            <div class='form-group <?php print(!empty($precioError)?"has-error":""); ?>'>
                <label for='precio'>precio</label>
                <input type='number' name='precio' placeholder='precio' min="1" max="1000.00" maxlength="6" minlength="1"  required='required' id='precio' class='form-control' value='<?php print($precio); ?>'>
                <?php print(!empty($precioError)?"<span class='help-block'>$precioError</span>":""); ?>
            </div>
              <div class='form-group <?php print(!empty($descripcionError)?"has-error":""); ?>'>
                <label for='descripcion'>descripcion</label>
                <input type='text' name='descripcion' placeholder='descripcion' required='required' id='descripcion' class='form-control' value='<?php print($descripcion); ?>'>
                <?php print(!empty($descripcionError)?"<span class='help-block'>$descripcionError</span>":""); ?>
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