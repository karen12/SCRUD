<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header('location: login.html');
    exit();
}
?>
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
        $tipoError = null;
               
       
        // post values
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $usuario = $_POST['usuario'];
        $tipo = $_POST['tipo'];
        
        
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
         if(empty($tipo)) {
            $confirError = "Por favor revise confirmar tipo usuario";
            $valid = false;
        }
        

        // update data
        if($valid) {
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE usuarios SET nombre = ?, correo = ?, id_tipo = ?, usuario = ? WHERE id_usuario = ?";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($nombre, $correo, $tipo,$usuario, $id));
            $PDO = null;
            header("Location: index.php");
        }
    }
    else {
        // read data
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT nombre, correo, usuario FROM usuarios WHERE id_usuario = ?";
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
        <form method='POST' enctype='multipart/form-data'>
            <div class='form-group <?php print(!empty($nombreError)?"has-error":""); ?>'>
                <label for='nombre'>Nombre</label>
                <input type='text' name='nombre' placeholder='nombre'   pattern="[a-zA-Z]*" required='required' id='nombre' class='form-control' value='<?php print($nombre); ?>'>
                <?php print(!empty($nombreError)?"<span class='help-block'>$nombreError</span>":""); ?>
            </div>
              <div class='form-group <?php print(!empty($correoError)?"has-error":""); ?>'>
                <label for='correo'>correo</label>
                <input type='mail' name='correo' placeholder='correo' required='required' id='correo' class='form-control' value='<?php print($correo); ?>'>
                <?php print(!empty($correoError)?"<span class='help-block'>$correoError</span>":""); ?>
            </div>
              <div class='form-group <?php print(!empty($usuarioError)?"has-error":""); ?>'>
                <label for='usuario'>usuario</label>
                <input type='text' name='usuario' placeholder='usuario' required='required' id='usuario' class='form-control' value='<?php print($usuario); ?>'>
                <?php print(!empty($usuarioError)?"<span class='help-block'>$usuarioError</span>":""); ?>
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
                <button type='submit' class='btn btn-primary'>Actualizar</button>
                <a class='btn btn btn-default' href='index.php'>Regresar</a>
            </div>
        </form>
    </div> <!-- /row -->
</div> <!-- /container -->
</body>
</html>