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
        $nombresError = null;
        $apellidosError = null;
        $duiError = null;
        $correoError = null;
        $fecha_nacError = null;
        $telefonoError = null;
       
        // post values
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $dui = $_POST['dui'];
        $correo = $_POST['correo'];
        $fecha_nac = $_POST['fecha_nac'];
        $telefono = $_POST['telefono'];
        
        // validate input
        $valid = true;
        if(empty($nombres)) {
            $nombresError = "Por favor ingrese sus nombres.";
            $valid = false;
        }
        
        if(empty($apellidos)) {
            $apellidosError = "Por favor ingrese sus apellidos.";
            $valid = false;
        }
        
          $valid = true;
        if(empty($dui)) {
            $duiError = "Por favor ingrese su dui.";
            $valid = false;
        }
        
        if(empty($correo)) {
            $correoError = "Por favor ingrese su correo.";
            $valid = false;
        }
          $valid = true;
        if(empty($fecha_nac)) {
            $fecha_nacError = "Por favor ingrese su fecha de nacimiento.";
            $valid = false;
        }
        
        if(empty($telefono)) {
            $telefonoError = "Por favor ingrese su telefono.";
            $valid = false;
        }
        // update data
        if($valid) {
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE docente SET nombre = ?, apellido = ? ,dui = ?, correo = ?, fecha_nac = ?, telefono = ? WHERE id_docente = ?";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($nombres,$apellidos,$dui,$correo,$fecha_nac,$telefono,$id));
            $PDO = null;
            header("Location: index.php");
        }
    }
    else {
        // read data
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT nombre,apellido,dui,correo,fecha_nac,telefono FROM docente WHERE id_docente = ?";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($id));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $PDO = null;
        if(empty($data)) {
            header("Location: index.php");
        }
        $nombres = $data['nombre'];
        $apellidos = $data['apellido'];
        $dui = $data['dui'];
        $correo = $data['correo'];
        $fecha_nac = $data['fecha_nac'];
        $telefono = $data['telefono'];

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
            <h2>Actualizar Docente</h2>
        </div>
        <form method='POST'>
            <div class='form-group <?php print(!empty($nombresError)?"has-error":""); ?>'>
                <label for='nombres'>Nombres</label>
                <input type='text' name='nombres' placeholder='nombres' pattern="[a-zA-Z]*" required='required' id='nombres' class='form-control' value='<?php print($nombres); ?>'>
                <?php print(!empty($nombresError)?"<span class='help-block'>$nombresError</span>":""); ?>
            </div>
             <div class='form-group <?php print(!empty($apellidosError)?"has-error":""); ?>'>
                <label for='apellidos'>Apellidos</label>
                <input type='text' name='apellidos' placeholder='apellidos' pattern="[a-zA-Z]*" required='required' id='apellidos' class='form-control' value='<?php print($apellidos); ?>'>
                <?php print(!empty($apellidosError)?"<span class='help-block'>$apellidosError</span>":""); ?>
            </div>
             <div class='form-group <?php print(!empty($duiError)?"has-error":""); ?>'>
                <label for='dui'>Dui</label>
                <input type='text' name='dui' placeholder='dui' min="1" max="99999999" maxlength="9" minlength="9" required='required' id='dui' class='form-control' value='<?php print($dui); ?>'>
                <?php print(!empty($duiError)?"<span class='help-block'>$duiError</span>":""); ?>
            </div>
             <div class='form-group <?php print(!empty($correoError)?"has-error":""); ?>'>
                <label for='correo'>correo</label>
                <input type='text' name='correo' placeholder='correo' required='required' id='correo' class='form-control' value='<?php print($correo); ?>'>
                <?php print(!empty($correoError)?"<span class='help-block'>$correoError</span>":""); ?>
            </div>
              <div class='form-group <?php print(!empty($fecha_nacError)?"has-error":""); ?>'>
                <label for='fecha_nac'>fecha_nac</label>
                <input type='date' name='fecha_nac' placeholder='fecha_nac' min="1970-01-01" max="1997-12-31" required='required' id='fecha_nac' class='form-control' value='<?php print($fecha_nac); ?>'>
                <?php print(!empty($fecha_nacError)?"<span class='help-block'>$fecha_nacError</span>":""); ?>
            </div>
            <div class='form-group <?php print(!empty($telefonoError)?"has-error":""); ?>'>
                <label for='telefono'>Telefono</label>
                <input type='text' name='telefono' placeholder='telefono' patter="^[7|6]\d{7}$" min="1" max="9999999" maxlength="8" minlength="8"required='required' id='telefono' class='form-control' value='<?php print($telefono); ?>'>
                <?php print(!empty($telefonoError)?"<span class='help-block'>$telefonoError</span>":""); ?>
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