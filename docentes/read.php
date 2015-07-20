<?php
    $id = null;
    if(!empty($_GET['id'])) {
        $id = $_GET['id'];
    }
    if($id == null) {
        header("Location: index.php");
    }
    else {
        // read data
        require("db.php");
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT nombre,apellido,dui,correo,fecha_nac,telefono FROM docente where id_docente = ?";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($id));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $PDO = null;
        if(empty($data)) {
            header("Location: index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>CRUD con PHP</title>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="col-sm-12">
        <div class="row">
            <h2>Consultar Docentes</h2>
        </div>
        <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['nombre']); ?></p>
            </div>
        </div>
         <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">Apellido</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['apellido']); ?></p>
            </div>
        </div>
         <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">DUI</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['dui']); ?></p>
            </div>
        </div>
         <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">CORREO</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['correo']); ?></p>
            </div>
        </div>
         <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">F</label>FECHA DE NACIMIENTO
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['fecha_nac']); ?></p>
            </div>
        </div>
         <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">TELEFONO</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['telefono']); ?></p>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <a class="btn btn btn-default" href="index.php">Regresar</a>
        </div>
    </div> <!-- /row -->
</div> <!-- /container -->
</body>
</html>