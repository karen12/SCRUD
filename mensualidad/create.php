<?php 
    if(!empty($_POST)) {
        // validation errors
        $nivelError = null;
        $precioError= null;
        
        // post values
        $nivelError = null;
        $precioError= null;
        
        // post values
        $nivel = $_POST['nivel'];
        $precio = $_POST['precio'];
       
        
        // validate input
        $valid = true;
        if(empty($nivel)) {
            $nivelError = "Por favor ingrese el nivel .";
            $valid = false;
        }
        
        if(empty($precio)) {
            $precioError = "Por favor ingrese el precio";
            $valid = false;
        }

        
        // insert data
        if($valid) {
            require("db.php");
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO mensualidad(nivel, precio) values(?, ?)";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($nivel, $precio));
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
            <h2>Crear Mensualidad</h2>
        </div>
        <form method='POST'>
            <div class='form-group <?php print(!empty($nivelError)?"has-error":""); ?>'>             
                <label for='nivel'>Nivel </label>
                <input type='text' name='nivel' placeholder='nivel' required='required' id='nivel' class='form-control' value='<?php print(!empty($nivel)?$nivel:""); ?>'>
                <?php print(!empty($nivelError)?"<span class='help-block'>$nivelError</span>":""); ?>
            </div>
            <div class='form-group <?php print(!empty($precioError)?"has-error":""); ?>'>
                <label for='precio'>Precio</label>
                <input type='textz' name='precio' placeholder='precio' required='required' id='precio' class='form-control' value='<?php print(!empty($precio)?$precio:""); ?>'>
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