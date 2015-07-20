<?php 
    if(!empty($_POST)) {
        // validation errors
        $precioError = null;
        $descripcionError= null;
        
        // post values
        // post values
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
       
        
        // validate input
        $valid = true;
        if(empty($descripcion)) {
            $descripcionError = "Por favor ingrese el descripcion .";
            $valid = false;
        }
        
        if(empty($precio >= 1)) {
            $precioError = "Por favor revise el precio";
            $valid = false;
        }

        
        // insert data
        if($valid) {
            require("db.php");
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO matricula(precio, descripcion) values(?, ?)";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($precio, $descripcion));
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
            <h2>Crear Matricula</h2>
        </div>
        <form method='POST'>
            <div class='form-group <?php print(!empty($precioError)?"has-error":""); ?>'>             
                <label for='precio'>precio </label>
                <input type='text' name='precio' placeholder='precio' min="1" max="1000.00" maxlength="6" minlength="1"  required='required' id='precio' class='form-control' value='<?php print(!empty($precio)?$precio:""); ?>'>
                <?php print(!empty($precioError)?"<span class='help-block'>$precioError</span>":""); ?>
            </div>
            <div class='form-group <?php print(!empty($descripcionError)?"has-error":""); ?>'>
                <label for='descripcion'>descripcion</label>
                <input type='text' name='descripcion' placeholder='descripcion' required='required' id='descripcion' class='form-control' value='<?php print(!empty($descripcion)?$descripcion:""); ?>'>
                <?php print(!empty($descripcionError)?"<span class='help-block'>$descripcionError</span>":""); ?>
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