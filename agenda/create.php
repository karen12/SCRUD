<?php 
    if(!empty($_POST)) {
        // validation errors
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
        if(empty($fecha_inicio <= $fecha_final)) {
            $fecha_inicioError = "Por favor revise fecha_inicio.";
            $valid = false;
        }
        
        if(empty($fecha_final >= $fecha_inicio)) {
            $fecha_finalError = "Por favor revise fecha_final.";
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
        //validacion de campos

        // insert data
        if($valid) {
            require("db.php");
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO agenda(fecha_inicio, fecha_final, hora, actividad) values(?, ?, ?, ?)";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($fecha_inicio, $fecha_final, $hora, $actividad));
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
            <h2>Crear Agenda</h2>
        </div>
        <form method='POST'>
           <div class='form-group <?php print(!empty($fecha_inicioError)?"has-error":""); ?>'>
                <label for='fecha_inicio'>fecha_inicio</label>
                <input type='date' name='fecha_inicio' placeholder='fecha_inicio' min="2015-06-01" max="2015-12-31" required='required' id='fecha_inicio' class='form-control' value='<?php print(!empty($fecha_inicio)?$fecha_inicio:""); ?>'>
                <?php print(!empty($fecha_inicioError)?"<span class='help-block'>$fecha_inicioError</span>":""); ?>
            </div>
            <div class='form-group <?php print(!empty($fecha_finalError)?"has-error":""); ?>'>
                <label for='fecha_final'>fecha_final</label>
                <input type='date' name='fecha_final' placeholder='fecha_final' required='required' min="2015-06-01" max="2015-12-31" id='fecha_final' class='form-control' value='<?php print(!empty($fecha_final)?$fecha_final:""); ?>'>
                <?php print(!empty($fecha_finalError)?"<span class='help-block'>$fecha_finalError</span>":""); ?>
            </div>
            <div class='form-group <?php print(!empty($horaError)?"has-error":""); ?>'>
                <label for='hora'>hora</label>
                <input type='number' name='hora' placeholder='hora' required='required' id='hora' min="1" max="24" maxlength="4" class='form-control' value='<?php print(!empty($hora)?$hora:""); ?>'>
                <?php print(!empty($horaError)?"<span class='help-block'>$horaError</span>":""); ?>
            </div>
              <div class='form-group <?php print(!empty($actividadError)?"has-error":""); ?>'>
                <label for='actividad'>actividad</label>
                <input type='text' name='actividad'  placeholder='actividad' required='required' id='actividad' class='form-control' value='<?php print(!empty($actividad)?$actividad:""); ?>'>
                <?php print(!empty($actividadError)?"<span class='help-block'>$actividadError</span>":""); ?>
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