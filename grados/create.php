<?php 
require("db.php");
    if(!empty($_POST)) {
        // validation errors
        $gradoError = null;
        $id_docenteError= null;
        $id_maError= null;
        $id_menError= null;
        
        // post values
        $grado = $_POST['grado'];
        $id_docente = $_POST['id_docente'];
        $id_ma= $_POST['id_ma'];
        $id_men= $_POST['id_men'];
       
        
        // validate input
        $valid = true;
        if(empty($grado)) {
            $gradoError = "Por favor ingrese el grado .";
            $valid = false;
        }
        
        if(empty($id_docente)) {
            $id_docenteError = "Por favor ingrese el docente";
            $valid = false;
        }
       
          if(empty($id_ma)) {
            $id_ma = "Por favor ingrese la matricula";
            $valid = false;
        }
           if(empty($id_men)) {
            $id_menError = "Por favor ingrese la mensualidad";
            $valid = false;
        }
        
        // insert data
        if($valid) {
            
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO grados(grado, id_docente, id_matricula, id_mensualidad) values(?, ?, ?, ?)";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($grado, $id_docente, $id_ma, $id_men));
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
            <h2>Crear Grado</h2>
        </div>
        <form method='POST' enctype="multipart/form-data" >
            <div class='form-group <?php print(!empty($gradoError)?"has-error":""); ?>'>             
                <label for='grado'>grado completo</label>
                <input title=" Se necesita un grado" type='text' name='grado' placeholder='grado' required='required' id='grado' class='form-control' value='<?php print(!empty($grado)?$grado:""); ?>'>
                <?php print(!empty($gradoError)?"<span class='help-block'>$gradoError</span>":""); ?>
            </div>
        </div>
             <div class='form-group <?php print(!empty($id_docenteError)?"has-error":""); ?>'>
                <label for='id_docente'>docente</label>
                <select name='id_docente' required='required' id='id_docente' class='form-control'>
                    <option value=''></option>
                    <?php
                    $sql = "SELECT id_docente, nombre FROM docente ORDER BY id_docente DESC";
                    $data = "";
                    foreach($PDO->query($sql) as $row) {
                        $data .= "<option value='$row[id_docente]'";
                        if(isset($id_docente) && $row['id_docente'] == $id_docente) {
                            $data .= " selected";
                        }
                        $data .= ">$row[nombre]</option>";
                    }
                    print($data);
                    $PDO = null;
                    ?>
                </select>
                <?php print(!empty($id_docenteError)?"<span class='help-block'>$id_docenteError</span>":""); ?>
            </div>
             <div class='form-group <?php print(!empty($id_menError)?"has-error":""); ?>'>
                <label for='id_men'>mensualidad</label>
                <select name='id_men' required='required' id='id_men' class='form-control'>
                    <option value=''></option>
                    <?php
                    $sql = "SELECT id_men, nivel FROM mensualidad ORDER BY id_men DESC";
                    $data = "";
                    foreach($PDO->query($sql) as $row) {
                        $data .= "<option value='$row[id_men]'";
                        if(isset($id_men) && $row['id_men'] == $id_men) {
                            $data .= " selected";
                        }
                        $data .= ">$row[nivel]</option>";
                    }
                    print($data);
                    $PDO = null;
                    ?>
                </select>
                <?php print(!empty($id_menError)?"<span class='help-block'>$id_menError</span>":""); ?>
            </div>
             <div class='form-group <?php print(!empty($id_maError)?"has-error":""); ?>'>
                <label for='id_ma'>matricula</label>
                <select name='id_ma' required='required' id='id_ma' class='form-control'>
                    <option value=''></option>
                    <?php
                    $sql = "SELECT id_ma FROM matricula ORDER BY id_ma DESC";
                    $data = "";
                    foreach($PDO->query($sql) as $row) {
                        $data .= "<option value='$row[id_ma]'";
                        if(isset($id_ma) && $row['id_ma'] == $id_ma) {
                            $data .= " selected";
                        }
                        $data .= ">$row[id_ma]</option>";
                    }
                    print($data);
                    $PDO = null;
                    ?>
                </select>
                <?php print(!empty($id_maError)?"<span class='help-block'>$id_maError</span>":""); ?>
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