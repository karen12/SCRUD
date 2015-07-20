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
        $sql = "SELECT nombre_art, descripcion_art, precio_art FROM utiles where id_articulo = ?";
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
            <h2>Consultar Utiles</h2>
        </div>
        <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['nombre_art']); ?></p>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">Descripcion</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['descripcion_art']); ?></p>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">Precio</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['precio_art']); ?></p>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <a class="btn btn btn-default" href="index.php">Regresar</a>
        </div>
    </div> <!-- /row -->
</div> <!-- /container -->
</body>
</html>