<?php
if(isset($_POST["boton"])){
                $btn=$_POST["boton"];
                    if($btn=="cambiar"){
                         $contra_actualError = null;
                         $contra_nuevaError = null;
                         $contra_nueva_confirmError = null;


                         $contra_actual = $_POST['contra_actual'];
                         $contra_nueva = $_POST['contra_nueva'];
                         $contra_nueva_confirm = $_POST['contra_nueva_confirm'];
                         $contra_encrip = sha1($contra_nueva);

                         $valid = true;
                                if(empty($contra_actual)) {
                                    $contra_actualError = "Por favor ingrese su contraseña actual";
                                    $valid = false;
                                    echo "fas1";
                                }
                                $valid = true;
                                if(empty($contra_nueva)) {
                                    $contra_nuevaError = "Por favor ingrese su nueva contraseña";
                                    $valid = false;
                                    echo "fas1";
                                }
                                $valid = true;
                                if(empty($contra_nueva_confirm)) {
                                    $contra_nueva_confirmError = "Por favor ingrese la confirmacion de su contraseña";
                                    $valid = false;
                                    echo "fas1";
                                }
                                if ($contra_nueva != $contra_nueva_confirm) {
                                    echo "Contraseñas Diferentes";
                                }
                                else
                                {
                                    if ($valid) {
                                         require("db.php");
                                            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                            $sql = "UPDATE usuarios SET clave = ? WHERE clave = ?";
                                            $stmt = $PDO->prepare($sql);
                                            $stmt->execute(array($contra_encrip, $contra_actual));
                                            $PDO = null;
                                            header("Location: login.html"); 
                                    }
                                }
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
                <label for='contra_actual'>Clave</label>
                <input type='password' name='contra_actual' placeholder='clave' required='required' id='contra_actual' class='form-control' value='<?php print(!empty($clave)?$clave:""); ?>'>
                <?php print(!empty($claveError)?"<span class='help-block'>$claveError</span>":""); ?>
            </div>
           <div class='form-group <?php print(!empty($claveError)?"has-error":""); ?>'>
                <label for='contra_nueva'>Clave</label>
                <input type='password' name='contra_nueva' placeholder='clave' required='required' id='contra_nueva' class='form-control' value='<?php print(!empty($clave)?$clave:""); ?>'>
                <?php print(!empty($claveError)?"<span class='help-block'>$claveError</span>":""); ?>
            </div>
            <div class='form-group <?php print(!empty($confirError)?"has-error":""); ?>'>
                <label for='contra_nueva_confirm'>Confirmar clave</label>
                <input type='password' name='contra_nueva_confirm' placeholder='confirmar clave' required='required' id='contra_nueva_confirm' class='form-control' value='<?php print(!empty($confir)?$confir:""); ?>'>
                <?php print(!empty($confirError)?"<span class='help-block'>$confirError</span>":""); ?>
            </div>
            <div class='form-actions'>
                <button type='submit' class='btn btn-primary'>Aceptar</button>
                <a class='btn btn btn-default' href='login.html'>Regresar</a>
            </div>
        </form>
    </div> <!-- /row -->
</div> <!-- /container -->
</body>
</html>