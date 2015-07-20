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

        // update data
        if($valid) {
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE mensualidad  SET nivel = ?, precio = ? WHERE id_men= ?";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($nivel, $precio, $id));
            $PDO = null;
            header("Location: index.php");
        }
    }
    else {
        // read data
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT nivel, precio FROM mensualidad WHERE id_men = ?";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($id));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $PDO = null;
        if(empty($data)) {
            header("Location: index.php");
        }
        $nivel = $data['nivel'];
        $precio = $data['precio'];

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
            <h2>Actualizar Mensualidad</h2>
        </div>
        <form method='POST'>
            <div class='form-group <?php print(!empty($nivelError)?"has-error":""); ?>'>
                <label for='nivel'>nivel</label>
                <input type='text' name='nivel' placeholder='nivel' required='required' id='nivel' class='form-control' value='<?php print($nivel); ?>'>
                <?php print(!empty($nivelError)?"<span class='help-block'>$nivelError</span>":""); ?>
            </div>
              <div class='form-group <?php print(!empty($precioError)?"has-error":""); ?>'>
                <label for='precio'>precio</label>
                <input type='text' name='precio' placeholder='precio' required='required' id='precio' class='form-control' value='<?php print($precio); ?>'>
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