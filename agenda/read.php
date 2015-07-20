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
        $sql = "SELECT id_agenda, fecha_inico, fecha_final, hora, telefono, direccion, nacimiento  FROM clientes WHERE id_cliente = ?";
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
            <h2>Consultar Clientes</h2>
        </div>
        <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">Nombres</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['nombres']); ?></p>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">Apellidos</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['apellidos']); ?></p>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">Correo</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['correo']); ?></p>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">Telefono</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['telefono']); ?></p>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">Direccion</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['direccion']); ?></p>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">Nacimiento</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['nacimiento']); ?></p>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <a class="btn btn btn-default" href="index.php">Regresar</a>
        </div>
    </div> <!-- /row -->
</div> <!-- /container -->
</body>
</html>