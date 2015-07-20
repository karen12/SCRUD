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
        $nombre_redError = null;
        $id_usuarioError= null;
        $imagenError= null;

        
        // post values
        $nombre_red = $_POST['nombre_red'];
        $id_usuario = $_POST['id_usuario'];
       
        
        // validate input
        $valid = true;
        if(empty($nombre_red)) {
            $nombre_redError = "Por favor ingrese el nombre_red .";
            $valid = false;
        }
        
        if(empty($id_usuario)) {
            $id_usuarioError = "Por favor ingrese el id_usuario";
            $valid = false;
        }



        if(!isset($_FILES['archivo']) ){
        echo 'Ha habido un error, tienes que elegir un archivo<br/>';
        echo '<a href="index.php">subir</a>';
      }
      else {
        $nombre = $_FILES['archivo']['name'];
        $nombre_tmp = $_FILES['archivo']['tmp_name'];
        $tipo = $_FILES['archivo']['type'];
        $tamano = $_FILES['archivo']['size'];
       
        $ext_permitidas = array('jpg','jpeg','gif','png');
        $partes_nombre = explode('.', $nombre);
        $extension = end( $partes_nombre );
        $ext_correcta = in_array($extension, $ext_permitidas);
       
        $tipo_correcto = preg_match('/^image\/(pjpeg|jpeg|gif|png)$/', $tipo);
       
        $limite = 800 * 1024;
       
      if( $ext_correcta && $tipo_correcto && $tamano <= $limite ){
          if( $_FILES['archivo']['error'] > 0 ){
            echo 'Error: ' . $_FILES['archivo']['error'] . '<br/>';
          }
          else {
                  
            if( file_exists( 'subidas/'.$nombre)) {
              echo '<br/>El archivo ya existe: ' . $nombre;
            }
            else {
              move_uploaded_file($nombre_tmp,
                "subidas/" . $nombre);
       
              echo "<br/>Guardado en: " . "subidas/" . $nombre;
            }
          }
        }
        else {
          echo 'Archivo inválido';
        }
      }
        
        // update data
        if($valid) {
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE redes_sociales  SET nombre = ?, id_usuario = ? ,logo = ?WHERE id_red= ?";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($nombre_red, $id_usuario,$nombre, $id));
            $PDO = null;
            header("Location: index.php");
        }
    }
    else {
        // read data
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT nombre, id_usuario, logo FROM redes_sociales WHERE id_red = ?";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($id));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $PDO = null;
        if(empty($data)) {
            header("Location: index.php");
        }
        $nombre_red = $data['nombre'];
        $id_usuario = $data['id_usuario'];

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
            <h2>Actualizar Redes Sociales</h2>
        </div>
        <form method='POST' enctype="multipart/form-data">
            <div class='form-group <?php print(!empty($nombre_redError)?"has-error":""); ?>'>             
                <label for='nombre_red'>Nombre Red </label>
               <input type='text' name='nombre_red' pattern="[a-zA-Z]*"  placeholder='nombre red' required='required' id='nombre_red' class='form-control' value='<?php print($nombre_red); ?>'>
                <?php print(!empty($nombre_redError)?"<span class='help-block'>$nombre_redError</span>":""); ?>
            </div>
            </div>
             <div class='form-group <?php print(!empty($id_usuarioError)?"has-error":""); ?>'>
                <label for='id_usuario'>usuario</label>
                <select name='id_usuario' required='required' id='id_usuario' class='form-control'>
                    <option value=''></option>
                    <?php
                    $sql = "SELECT id_usuario, nombre FROM usuarios ORDER BY id_usuario DESC";
                    $data = "";
                    foreach($PDO->query($sql) as $row) {
                        $data .= "<option value='$row[id_usuario]'";
                        if(isset($id_usuario) && $row['id_usuario'] == $id_usuario) {
                            $data .= " selected";
                        }
                        $data .= ">$row[nombre]</option>";
                    }
                    print($data);
                    $PDO = null;
                    ?>
                </select>
                <?php print(!empty($id_usuarioError)?"<span class='help-block'>$id_usuarioError</span>":""); ?>
            </div>
            <div class='form-group <?php print(!empty($imagenError)?"has-error":""); ?>'>
                  <label for="archivo">Archivo:</label>
                  <input type="file" name="archivo" id="archivo" />
                  <br/>
            </div>
                <div class='form-actions'>
                <button type='submit' class='btn btn-primary'>ACtualizar</button>
                <a class='btn btn btn-default' href='index.php'>Regresar</a>
            </div>
        </form>
    </div> <!-- /row -->
</div> <!-- /container -->
</body>
</html>