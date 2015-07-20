<?php 
require("db.php");
if(!empty($_POST)) {
        // validation errors
        $nombre_insError = null;
        $tel_insError = null;
        $direccion_insError = null;
        $correo_insError = null;
        $objetivo_insError = null;
        $mision_insError = null;
        $vision_insError = null;
        $principios_insError = null;
        $director_insError = null;
        $id_redes_sError = null;
        $valoresError = null;
        $id_usuarioError = null;
        // post values

        $nombre_ins = $_POST['nombre_ins'];
        $tel_ins = $_POST['tel_ins'];
        $direccion_ins = $_POST['direccion_ins'];
        $correo_ins = $_POST['correo_ins'];
        $objetivo_ins = $_POST['objetivo_ins'];
        $mision_ins= $_POST['mision_ins'];
        $vision_ins = $_POST['vision_ins'];
        $principios_ins = $_POST['principios_ins'];
        $director_ins = $_POST['director_ins'];
        $id_redes_s = $_POST['id_redes_s'];
        $valores = $_POST['valores'];
        $id_usuario = $_POST['id_usuario'];


        $valid = true;
        if(empty($nombre_ins)) {
            $nombre_insError = "Por favor ingrese el nombre de la institucion.";
            $valid = false;
            echo "1";
        }
        
        if(empty($tel_ins)) {
            $tel_insError = "Por favor ingrese el telefono de la institucion.";
            $valid = false;
            echo "2";
        }
        
        if(empty($direccion_ins)) {
            $direccion_insError = "Por favor ingrese la direccion de la institucion.";
            $valid = false;
            echo "3";
        }
        if(empty($correo_ins)) {
            $correo_insError = "Por favor ingrese el correo de la institucion.";
            $valid = false;
            echo "4";
        }

        if(empty($objetivo_ins)) {
            $objetivo_insError = "Por favor ingrese el objetivo de la institucion.";
            $valid = false;
            echo "5";
        }
        if(empty($mision_ins)) {
            $mision_insError = "Por favor ingrese la mision de la institucion.";
            $valid = false;
            echo "6";
        }
        
        if(empty($vision_ins)) {
            $vision_insError = "Por favor ingrese la vision de la institucion.";
            $valid = false;
            echo "7";
        }
        
        if(empty($principios_ins)) {
            $principios_insError = "Por favor ingrese los principios de la institucion.";
            $valid = false;
            echo "8";
        }
        
        if(empty($director_ins)) {
            $director_insError = "Por favor ingrese el nombre del director de la institucion.";
            $valid = false;
            echo "9";
        }        
        if(empty($id_redes_s)) {
            $id_redes_sError = "Por favor ingrese la red social.";
            $valid = false;
            echo "10";
        }
        
        if(empty($valores)) {
            $valoresError = "Por favor ingrese el  valor de la institucion.";
            $valid = false;
            echo "11";
        }
        
        if(empty($id_usuario)) {
            $id_usuarioError = "Por favor ingrese el usuario de la institucion.";
            $valid = false;
            echo "12";
        }


        //validacion de campos

        // insert data

        if($valid) {
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO institucion(nombre_ins , tel_ins , direccion_ins , correo_ins , objetivo_ins , mision_ins , vision_ins , principios_ins , director_ins ,id_redes_s , valores , id_usuario) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($nombre_ins, $tel_ins, $director_ins, $correo_ins, $objetivo_ins, $mision_ins, $vision_ins, $principios_ins, $director_ins, $id_redes_s, $valores, $id_usuario ));
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
            <h2>Crear Institucion</h2>
        </div>
        <form method='POST'>
           <div class='form-group <?php print(!empty($nombre_insError)?"has-error":""); ?>'>
                <label for='nombre_ins'>Nombre de la Institucion</label>
                <input type='text' name='nombre_ins' placeholder='nombre_ins' required='required' id='nombre_ins' class='form-control' value='<?php print(!empty($nombre_ins)?$nombre_ins:""); ?>'>
                <?php print(!empty($nombre_insError)?"<span class='help-block'>$nombre_insError</span>":""); ?>
            </div>
            <div class='form-group <?php print(!empty($tel_insError)?"has-error":""); ?>'>
                <label for='tel_ins'>Telefono </label>
                <input type='text' name='tel_ins' placeholder='tel_ins' pattern="^[7|6]\d{7}$" min="1" max="9999999" maxlength="8" minlength="8" required='required' id='tel_ins' class='form-control' value='<?php print(!empty($tel_ins)?$tel_ins:""); ?>'>
                <?php print(!empty($tel_insError)?"<span class='help-block'>$tel_insError</span>":""); ?>
            </div>
            <div class='form-group <?php print(!empty($direccion_insError)?"has-error":""); ?>'>
                <label for='direccion_ins'>Direccion</label>
                <input type='text' name='direccion_ins' placeholder='direccion_ins' required='required' id='direccion_ins' class='form-control' value='<?php print(!empty($director_ins)?$direccion_ins:""); ?>'>
                <?php print(!empty($direccion_insError)?"<span class='help-block'>$direccion_insError</span>":""); ?>
            </div>
            <div class='form-group <?php print(!empty($correo_insError)?"has-error":""); ?>'>
                <label for='correo_ins'>Correo Electronico</label>
                <input type='mail' name='correo_ins' placeholder='correo_ins' required='required' id='correo_ins' class='form-control' value='<?php print(!empty($correo_ins)?$correo_ins:""); ?>'>
                <?php print(!empty($correo_insError)?"<span class='help-block'>$correo_insError</span>":""); ?>
            </div>
             <div class='form-group <?php print(!empty($objetivo_insError)?"has-error":""); ?>'>
                <label for='objetivo_ins'>Objetivo Institucional</label>
                <input type='text' name='objetivo_ins' placeholder='objetivo_ins'  pattern="[a-zA-Z]*" required='required' id='objetivo_ins' class='form-control' value='<?php print(!empty($objetivo_ins)?$objetivo_ins:""); ?>'>
                <?php print(!empty($objetivo_insError)?"<span class='help-block'>$objetivo_insError</span>":""); ?>
            </div>
            <div class='form-group <?php print(!empty($mision_insError)?"has-error":""); ?>'>
                <label for='mision_ins'>Mision</label>
                <input type='text' name='mision_ins' placeholder='mision_ins'  pattern="[a-zA-Z]*" required='required' id='mision_ins' class='form-control' value='<?php print(!empty($mision_ins)?$mision_ins:""); ?>'>
                <?php print(!empty($mision_insError)?"<span class='help-block'>$mision_insError</span>":""); ?>
            </div>
             <div class='form-group <?php print(!empty($vision_insError)?"has-error":""); ?>'>
                <label for='vision_ins'>Vision</label>
                <input type='text' name='vision_ins' placeholder='vision_ins'  pattern="[a-zA-Z]*" required='required' id='vision_ins' class='form-control' value='<?php print(!empty($vision_ins)?$vision_ins:""); ?>'>
                <?php print(!empty($vision_insError)?"<span class='help-block'>$vision_insError</span>":""); ?>
            </div>
            <div class='form-group <?php print(!empty($principios_insError)?"has-error":""); ?>'>
                <label for='principios_ins'>Principios</label>
                <input type='text' name='principios_ins' placeholder='principios_ins'  pattern="[a-zA-Z]*" required='required' id='principios_ins' class='form-control' value='<?php print(!empty($principios_ins)?$principios_ins:""); ?>'>
                <?php print(!empty($principios_insError)?"<span class='help-block'>$principios_insError</span>":""); ?>
            </div>
            <div class='form-group <?php print(!empty($director_insError )?"has-error":""); ?>'>
                <label for='director_ins'>Director</label>
                <input type='text' name='director_ins' placeholder='director_ins' pattern="[a-zA-Z]*"  required='required' id='director_ins' class='form-control' value='<?php print(!empty($director_ins)?$director_ins:""); ?>'>
                <?php print(!empty($director_insError)?"<span class='help-block'>$director_insError</span>":""); ?>
            </div>
             <div class='form-group <?php print(!empty($id_redes_sError)?"has-error":""); ?>'>
                <label for='id_redes_s'>Red Social</label>
               <select name='id_redes_s' required='required' id='id_redes_s' class='form-control'>
                    <option></option>
                    <?php
                    $sql="SELECT id_red, nombre FROM redes_sociales";
                    foreach ($PDO->query($sql) as $row) {
                        echo "<option value ='$row[id_red]'";
                        if (isset($id_redes_s) && $id_redes_s == $row["id_red"])
                        {
                            echo " selected";
                        }
                        echo ">";
                        echo $row["nombre"];
                        echo "</option>";
                    }
                    ?>
                </select>
            </div>
           <div class='form-group <?php print(!empty($valoresError)?"has-error":""); ?>'>
                <label for='valores'>Valores</label>
                <input type='text' name='valores' placeholder='valores'  pattern="[a-zA-Z]*" required='required' id='valores' class='form-control' value='<?php print(!empty($valores)?$valores:""); ?>'>
                <?php print(!empty($valoresError)?"<span class='help-block'>$valoresError</span>":""); ?>
            </div>
            <div class='form-group <?php print(!empty($id_usuarioError)?"has-error":""); ?>'>
                <label for='id_usuario'>Usuario</label>
                <select name='id_usuario' required='required' id='id_usuario' class='form-control'>
                    <option></option>
                    <?php
                    $sql="SELECT id_usuario, nombre FROM usuarios";
                    foreach ($PDO->query($sql) as $row) {
                        echo "<option value ='$row[id_usuario]'";
                        if (isset($id_usuario) && $id_usuario == $row["id_usuario"])
                        {
                            echo " selected";
                        }
                        echo ">";
                        echo $row["nombre"];
                        echo "</option>";
                    }
                    ?>
                </select>
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