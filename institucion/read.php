<?php
    require("db.php");
    $id = null;
    if(!empty($_GET['id_ins'])) {
        $id = $_GET['id_ins'];
    }
    if($id == null) {
        header("Location: index.php");
    }
    else {
        // read data
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT nombre_ins , tel_ins , direccion_ins , correo_ins , objetivo_ins , mision_ins , vision_ins , principios_ins , director_ins ,id_redes_s , valores , id_usuario  FROM institucion WHERE id_ins = ?";
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
                <p class="form-control-static"><?php print($data['nombre_ins']); ?></p>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">Telefono</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['tel_ins']); ?></p>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">Direccion</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['direccion_ins']); ?></p>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">Correo</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['correo_ins']); ?></p>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">Objetivos</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['objetivo_ins']); ?></p>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">Mision</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['mision_ins']); ?></p>
            </div>
                    <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">Vision</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['vision_ins']); ?></p>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">Principios</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['principios_ins']); ?></p>
            </div>
        </div>
            <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">Director</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['director_ins']); ?></p>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">Red Social</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['id_redes_s']); ?></p>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">Valores</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['valores']); ?></p>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <label class="col-sm-2 control-label">Usuario</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php print($data['id_usuario']); ?></p>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <a class="btn btn btn-default" href="index.php">Regresar</a>
        </div>
    </div> <!-- /row -->
</div> <!-- /container -->
</body>
</html>