<?php
    $id = null;
    if(!empty($_GET['id'])) {
        $id = $_GET['id'];
    }
    if($id == null) { 
        header("Location: index.php");
    }
    require("db.php");
    $fecha_inicioError = null;
        $fecha_finalError = null;
        $horaError = null; 
        $actividadError = null;
        
        // post values
        
        $fecha_inicio = date('Y-m-d', strtotime($_POST['fecha_inicio']));
        $fecha_final = $_POST['fecha_final'];
        $hora = $_POST['hora'];
        $actividad = $_POST['actividad'];
        
        // validate input
        $valid = true;
        if(empty($fecha_inicio)) {
            $fecha_inicioError = "Por favor ingrese su fecha_inicio.";
            $valid = false;
        }
        
        if(empty($fecha_final)) {
            $fecha_finalError = "Por favor ingrese el fecha_final.";
            $valid = false;
        }
        
        if(empty($hora)) {
            $horaError = "Por favor ingrese la hora.";
            $valid = false;
        }
        
        if(empty($actividad)) {
            $actividadError = "Por favor ingrese la actividad.";
            $valid = false;
        }
        // update data
        if($valid) {

            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE agenda SET fecha_inicio = ?, apellidos = ?, correo = ?, telefono = ?, direccion = ?, nacimiento = ? WHERE id_cliente = ?";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($nombres, $apellidos, $correo, $telefono, $direccion, $nacimiento, $id));
            $PDO = null;
            header("Location: index.php");
        }
    }
    else {
        // read data
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT id_cliente, nombres, apellidos, correo, telefono, direccion, nacimiento  FROM clientes WHERE id_cliente =? ";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($id));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $PDO = null;
        if(empty($data)) {
            header("Location: index.php");
        }
        $nombres = $data['nombres'];
        $apellidos = $data['apellidos'];
        $correo = $data['correo'];
        $telefono = $data['telefono'];
        $direccion = $data['direccion'];
        $nacimiento = $data['nacimiento'];
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
            <h2>Actualizar Agendas</h2>
        </div>
        <form method='POST'>
           <div class='form-group <?php print(!empty($fecha_inicioError)?"has-error":""); ?>'>
                <label for='fecha_inicio'>fecha_inicio</label>
                <input type='date' name='fecha_inicio' placeholder='fecha_inicio' min="2015-06-01" max="2015-12-31" required='required' id='fecha_inicio' class='form-control' value='<?php print($fecha_inicio); ?>'>
                <?php print(!empty($fecha_inicioError)?"<span class='help-block'>$fecha_inicioError</span>":""); ?>
            </div>
            <div class='form-group <?php print(!empty($fecha_finalError)?"has-error":""); ?>'>
                <label for='fecha_final'>fecha_final</label>
                <input type='date' name='fecha_final' placeholder='fecha_final' required='required' min="2015-06-01" max="2015-12-31" id='fecha_final' class='form-control' value='<?php print($fecha_final); ?>'>
                <?php print(!empty($fecha_finalError)?"<span class='help-block'>$fecha_finalError</span>":""); ?>
            </div>
            <div class='form-group <?php print(!empty($horaError)?"has-error":""); ?>'>
                <label for='hora'>hora</label>
                <input type='number' name='hora' placeholder='hora' required='required' id='hora' min="1" max="24" maxlength="4" class='form-control' value='<?php print($hora); ?>'>
                <?php print(!empty($horaError)?"<span class='help-block'>$horaError</span>":""); ?>
            </div>
              <div class='form-group <?php print(!empty($actividadError)?"has-error":""); ?>'>
                <label for='actividad'>actividad</label>
                <input type='text' name='actividad'  placeholder='actividad' required='required' id='actividad' class='form-control' value='<?php print($actividad)); ?>'>
                <?php print(!empty($actividadError)?"<span class='help-block'>$actividadError</span>":""); ?>
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