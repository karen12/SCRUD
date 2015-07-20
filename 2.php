<?php 
if(isset($_GET['nombre_usuario'])) {
    $nombre_usuario = $_GET['nombre_usuario'];
}
else {
    header("location: recuperar.php");
}
?>
<?php
if(isset($_POST["boton"])){
                $btn=$_POST["boton"];
                    if($btn=="recuperar"){
                         $respuesta_usuarioError = null;
                         $respuesta_usuario = $_POST['respuesta'];

                         $valid = true;
                                if(empty($respuesta_usuario)) {
                                    $respuesta_usuarioError = "Por favor ingrese la respuesta de la pregunta";
                                    $valid = false;
                                    echo "fas1";
                                }
                                else
                                {
                                     if($valid)
                                     { 
                                            require("db.php");
                                            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                            $sql = "SELECT  respuesta FROM usuarios WHERE respuesta = ?";
                                            $stmt = $PDO->prepare($sql);
                                            $stmt->execute(array($respuesta_usuario));
                                            $data = $stmt->fetch(PDO::FETCH_ASSOC);
                                            
                                        if(empty($data))
                                        {
                                             header("Location: 1.php");
                                        }
                                        else
                                         {
                                            require("db.php");
                                            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                            $sql = "UPDATE usuarios SET clave = ? WHERE respuesta = ?";
                                            $stmt = $PDO->prepare($sql);
                                            $stmt->execute(array($respuesta_usuario, $respuesta_usuario));
                                            $PDO = null;
                                            header("Location: 3.php"); 

                                         }         
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

             <fieldset class="registration-form">
                <div class="form-group">
                    <?php
                        require("db.php");
                        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "SELECT pregunta FROM usuarios WHERE usuario = ?";
                        $stmt = $PDO->prepare($sql);
                        $stmt->execute(array($nombre_usuario));
                        $data = $stmt->fetch(PDO::FETCH_ASSOC);
                        $PDO = null;
                        if(empty($data))
                        {
                            header("location: 1.php");
                        }
                        else {
                            print("<p>$data[pregunta]</p>");
                        }
                    ?>
           <div class='form-group <?php print(!empty($claveError)?"has-error":""); ?>'>
                <label for='clave'>Clave</label>
                <input type='password' name='respuesta' placeholder='respuesta' required='required' id='clave' class='form-control' value='<?php print(!empty($clave)?$clave:""); ?>'>
                <?php print(!empty($claveError)?"<span class='help-block'>$claveError</span>":""); ?>
            </div>
            <div class='form-actions'>
                <button name = "boton" value = "recuperar" type='submit' class='btn btn-primary'>Aceptar</button>
                <a class='btn btn btn-default' href='login.html'>Regresar</a>
            </div>
        </form>
    </div> <!-- /row -->
</div> <!-- /container -->
</body>
</html>