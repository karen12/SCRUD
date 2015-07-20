<?php
   require("db.php");
    if(!empty($_POST)) {
        // validation errors
        $claveError = null;
        $usuarioError = null;
        $clavesError = null;
        $confirError = null;
               
       
        // post values
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $claves = sha1($clave);
        $confir = $_POST['confir'];
        
        
        // validate input
        $valid = true;
         if(empty($clave)) {
            $claveError = "Por favor revise la clave ";
            $valid = false;
        }

          if(empty($usuario)) {
            $usuarioError = "Por favor revise el usuario";
            $valid = false;
        }
        if(empty($confir && $confir == $clave)) {
            $confirError = "Por favor revise confirmar clave";
            $valid = false;
        }
        //inventando start
        $conexion = mysql_connect("localhost", "root") or die("errorrrrrrrrrrr wachin");

        mysql_select_db("bradford", $conexion) or die("errorrr 2 XD");

        $god = mysql_query("SELECT id_usuario, usuario, clave FROM usuarios WHERE usuario = '".$usuario."'", $conexion);

        if ($row = mysql_fetch_array($god)) 
        {
            if($valid) {
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE usuarios SET clave = ?  WHERE usuario = ?";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($claves, $usuario));
            $PDO = null;
            header("Location: login.html");
        }
        } else {
            ?>

            <script language="JavaScript">
                alert("Usuario Incorrecto Wachin");
                location.href = "recuperar.php";
            </script>

        <?php
        }
//inventado end
        // update data
        
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
            <div class='form-group <?php print(!empty($usuarioError)?"has-error":""); ?>'>
                <label for='usuario'>Ingrese su nombre de Usuario</label>
                <input type='text' name='usuario' placeholder='usuario' required='required' id='usuario' class='form-control' value='<?php print(!empty($usuario)?$usuario:""); ?>'>
                <?php print(!empty($usuarioError)?"<span class='help-block'>$usuarioError</span>":""); ?>
            </div>
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
                <a class='btn btn btn-default' href='login.html'>Regresar</a>
            </div>
        </form>
    </div> <!-- /row -->
</div> <!-- /container -->
</body>
</html>