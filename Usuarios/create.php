<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header('location: login.html');
    exit();
}
?>
<?php 
    require("db.php");
    if(!empty($_POST)) {
        // validation errors
        $nombreError = null;
        $correoError = null;
        $usuarioError = null;
        $claveError = null;
        $clavesError = null;
        $confirError = null;
        $tipoError = null;
       
        
        // post values
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $claves = sha1($clave);
        $confir = $_POST['confir'];
        $tipo = $_POST['tipo'];
       
        
        // validate input
        $valid = true;
        if(empty($nombre)) {
            $nombreError = "Por favor ingrese el nombre de usuario.";
            $valid = false;
        }
        
        if(empty($correo)) {
            $correoError = "Por favor ingrese su correo";
            $valid = false;
        }
       
          if(empty($usuario)) {
            $usuarioError = "Por favor ingrese el usuario";
            $valid = false;
        }
           if(empty($clave)) {
            $claveError = "Por favor ingrese la clave";
            $valid = false;
        }
        if(empty($confir && $confir == $clave)) {
            $confirError = "Por favor revise confirmar clave";
            $valid = false;
        }
         if(empty($tipo)) {
            $confirError = "Por favor revise confirmar clave";
            $valid = false;
        }
        
        
        // insert data
        if($valid) {
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO usuarios(nombre, correo, id_tipo,usuario, clave) values(?, ?, ?,?, ?)";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($nombre, $correo, $tipo,$usuario, $claves));
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
            <h2>Crear usuario</h2>
        </div>
        <form method='POST' enctype='multipart/form-data'>
            <div class='form-group <?php print(!empty($nombreError)?"has-error":""); ?>'>             
                <label for='nombre'>Nombre completo</label>
                <input title=" Se necesita un nombre" type='text' name='nombre' pattern="[a-zA-Z]*" placeholder='nombre' required='required' id='nombre' class='form-control' value='<?php print(!empty($nombre)?$nombre:""); ?>'>
                <?php print(!empty($nombreError)?"<span class='help-block'>$nombreError</span>":""); ?>
            </div>
            <div class='form-group <?php print(!empty($correoError)?"has-error":""); ?>'>
                <label for='correo'>Correo</label>
                <input type='mail' name='correo' placeholder='Correo' required='required' id='correo' class='form-control' value='<?php print(!empty($correo)?$correo:""); ?>'>
                <?php print(!empty($correoError)?"<span class='help-block'>$correoError</span>":""); ?>
            </div>
              <div class='form-group <?php print(!empty($usuarioError)?"has-error":""); ?>'>
                <label for='usuario'>Nombre de Usuario</label>
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
            <div class='form-group <?php print(!empty($tipoError)?"has-error":""); ?>'>
                <label for='tipo'>Tipo</label>
                <select name='tipo' required='required' id='tipo' class='form-control'>
                    <option value=''></option>
                    <?php
                    $sql = "SELECT id_tipo, nombre FROM tipos_usuarios ORDER BY id_tipo DESC";
                    $data = "";
                    foreach($PDO->query($sql) as $row) {
                        $data .= "<option value='$row[id_tipo]'";
                        if(isset($id_tipo) && $row['id_tipo'] == $id_tipo) {
                            $data .= " selected";
                        }
                        $data .= ">$row[nombre]</option>";
                    }
                    print($data);
                    $PDO = null;
                    ?>
                </select>
                <?php print(!empty($tipoError)?"<span class='help-block'>$tipoError</span>":""); ?>
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