<?php
if(isset($_GET["boton"])){
                $btn=$_GET["boton"];
                    if($btn=="validar"){
                         $nombre_usuarioError = null;
                         $nombre_usuario = $_GET['usuario'];
                           $valid = true;
                                if(empty($nombre_usuario)) {
                                    $nombre_usuarioError = "Por favor ingrese el usuario";
                                    $valid = false;
                                    
                                }
                                else
                                {
                                     if($valid)
                                     { 
                                        require("db.php");
                                            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                            $sql = "SELECT  usuario FROM usuarios WHERE usuario = ?";
                                            $stmt = $PDO->prepare($sql);
                                            $stmt->execute(array($nombre_usuario));
                                            $data = $stmt->fetch(PDO::FETCH_ASSOC);
                                            $PDO = null;
                                        if(empty($data))
                                        {
                                            echo "Usuario no Existente";
                                        }
                                        else
                                         {
                                            header("Location: 2.php?nombre_usuario=$nombre_usuario"); 

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
        <form method='GET' enctype='multipart/form-data'>
            <div class='form-group <?php print(!empty($usuarioError)?"has-error":""); ?>'>
                <label for='usuario'>Ingrese su nombre de Usuario</label>
                <input type='text' name='usuario' placeholder='usuario' required='required' id='usuario' class='form-control' value='<?php print(!empty($usuario)?$usuario:""); ?>'>
                <?php print(!empty($usuarioError)?"<span class='help-block'>$usuarioError</span>":""); ?>
            </div>
            <div class='form-actions'>
                <button name = "boton" value = "validar"type='submit' class='btn btn-primary'>Aceptar</button>
                <a class='btn btn btn-default' href='login.html'>Regresar</a>
            </div>
        </form>
    </div> <!-- /row -->
</div> <!-- /container -->
</body>
</html>