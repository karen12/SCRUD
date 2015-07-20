<?php
    $usuario2 = $_POST["usuarios"];
    require("db.php");
    if(!empty($_POST)) {
        // validation errors
        $claveError = null;
        $clavesError = null;
        $confirError = null;
               
       
        // post values
        $clave = $_POST['clave'];
        $claves = sha1($clave);
        $confir = $_POST['confir'];
        
        
        // validate input
         if(empty($clave)) {
            $claveError = "Por favor revise confirmar clave usuario";
            $valid = false;
        }
        

        // update data
        if($valid) {
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE usuarios SET clave = ? WHERE usuario = ?";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($claves, $usuario2));
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
            <h2>Recuperar Clave</h2>
        </div>
        <form method='POST' enctype='multipart/form-data'>
           <div class='form-group <?php print(!empty($claveError)?"has-error":""); ?>'>
                <label for='clave'>Clave</label>
                <input type='password' name='clave' placeholder='clave' required='required' id='clave' class='form-control' value='<?php print(!empty($clave)?$clave:""); ?>'>
                <?php print(!empty($claveError)?"<span class='help-block'>$claveError</span>":""); ?>
            </div>
            <div class='form-group <?php print(!empty($confirError)?"has-error":""); ?>'>
                <label for='confir'>Confirmar clave</label>
                <input type='password' name='confir' placeholder='confirmar clave' required='required' id='confir' class='form-control' value='<?php print(!empty($confir)?$confir:""); ?>'>
                <?php print(!empty($confirError)?"<span class='help-block'>$confirError</span>":""); ?>
            </div>
            <div class='form-actions'>
                <button type='submit' class='btn btn-primary'>Aceptar</button>
                <a class='btn btn btn-default' href='index.php'>Regresar</a>
            </div>
        </form>
    </div> <!-- /row -->
</div> <!-- /container -->
</body>
</html>