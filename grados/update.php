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
        $correoError = null;
        $usuarioError = null;
        $claveError = null;
               
       
        // post values
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        
        
        // validate input
        $valid = true;
        if(empty($nombre)) {
            $nombreError = "Por favor ingrese  el nombre de ususario.";
            $valid = false;
        }
        
        if(empty($correo)) {
            $correoError = "Por favor ingrese su correo.";
            $valid = false;
        }
        
         if(empty($usuario)) {
            $usuarioError = "Por favor ingrese su nombre de usuario.";
            $valid = false;
        }
         if(empty($clave)) {
            $claveError = "Por favor ingrese la clave.";
            $valid = false;
        }

        // update data
        if($valid) {
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE usuarios SET nombre = ?, correo = ?, usuario = ?, clave = ? WHERE id_usuario = ?";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($nombre, $correo, $usuario, $clave, $id));
            $PDO = null;
            header("Location: index.php");
        }
    }
    else {
        // read data
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT nombre, correo, usuario, clave FROM usuarios WHERE id_usuario = ?";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($id));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $PDO = null;
        if(empty($data)) {
            header("Location: index.php");
        }
        $nombre = $data['nombre'];
        $correo = $data['correo'];
        $usuario = $data['usuario'];
        $clave = $data['clave'];

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
            <h2>Actualizar usuario</h2>
        </div>
        <form method='POST'>
            <div class='form-group <?php print(!empty($nombreError)?"has-error":""); ?>'>
                <label for='nombre'>Nombre</label>
                <input type='text' name='nombre' placeholder='nombre' required='required' id='nombre' class='form-control' value='<?php print($nombre); ?>'>
                <?php print(!empty($nombreError)?"<span class='help-block'>$nombreError</span>":""); ?>
            </div>
              <div class='form-group <?php print(!empty($correoError)?"has-error":""); ?>'>
                <label for='correo'>correo</label>
                <input type='text' name='correo' placeholder='correo' required='required' id='correo' class='form-control' value='<?php print($correo); ?>'>
                <?php print(!empty($correoError)?"<span class='help-block'>$correoError</span>":""); ?>
            </div>
              <div class='form-group <?php print(!empty($usuarioError)?"has-error":""); ?>'>
                <label for='usuario'>usuario</label>
                <input type='text' name='usuario' placeholder='usuario' required='required' id='usuario' class='form-control' value='<?php print($usuario); ?>'>
                <?php print(!empty($usuarioError)?"<span class='help-block'>$usuarioError</span>":""); ?>
            </div>
            <div class='form-group <?php print(!empty($claveError)?"has-error":""); ?>'>
                <label for='clave'>clave</label>
                <input type='text' name='clave' placeholder='clave' required='required' id='clave' class='form-control' value='<?php print($clave); ?>'>
                <?php print(!empty($claveError)?"<span class='help-block'>$claveError</span>":""); ?>
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