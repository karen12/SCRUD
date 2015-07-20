<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header('location: login.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang='es'>
<head>
    <title>CRUD con PHP</title>
    <meta charset='utf-8'>
    <link href='css/bootstrap.min.css' rel='stylesheet'>
    <link type="text/css" href='css/estilo.css' rel='stylesheet'>
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="fonts.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src='js/bootstrap.min.js'></script>
</head>
<body>
    <header>
        <div class="menu_bar">
            <a href="" class="bt-menu"><span class="icon-menu">Menu</span></a>
        </div>
        <nav class="navbar-fixed-top">
            <ul>
                <li><a href="../institucion/index.php"><span class="icon-home3"></span>Institucion</a></li>
                <li><a href="../agenda/index.php"><span class="icon-table2"></span>Agenda</a></li>
                <li><a href="../docentes/index.php"><span class="icon-books"></span>Docentes</a></li>
                <li><a href="../matricula/index.php"><span class="icon-user-tie"></span>Matricula</a></li>
                <li><a href="../mensualidad/index.php"><span class="icon-coin-dollar"></span>Mensualidad</a></li>
                <li><a href="../redes/index.php"><span class="icon-feed2"></span>Redes</a></li>
                <li><a href="../Usuarios/index.php"><span class="icon-users"></span>Usuarios</a></li>
                <li><a href="../utiles/index.php"><span class="icon-pencil"></span>Utiles</a></li>        
            </ul>
        </nav>
    </header>
<br><br><br><br><br><br>
<div class='container'>
    <div class='row'>
        <h2>Mantenimiento de la Institucion</h2>
    </div>
    <div class='row'>
        <p><a class='btn btn-xs btn-warning' href='../login.html'>Cerrar Sesion</a></p>
        <p><a class='btn btn-xs btn-success' href='create.php'>Crear</a></p>
        <table class='table table-striped table-bordered table-hover'>
            <tr class='warning'>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>TELEFONO </th>
                <th>DIRECCION</th>
                <th>CORREO</th>
                <th>ACCION</th>
            </tr>
            <tbody>
            <?php
                require("db.php");
                $sql = "SELECT id_ins, nombre_ins,tel_ins, direccion_ins, correo_ins  FROM institucion ORDER BY id_ins DESC";
                $data = "";
                foreach($PDO->query($sql) as $row) {
                    $data .= "<tr>";
                    $data .= "<td>$row[id_ins]</td>";
                    $data .= "<td>$row[nombre_ins] </td>";
                    $data .= "<td>$row[tel_ins]</td>";
                    $data .= "<td>$row[direccion_ins]</td>";
                    $data .= "<td>$row[correo_ins]</td>";
                    $data .= "<td>";
                    $data .= "<a class='btn btn-xs btn-info' href='read.php?id_ins=$row[id_ins]'>Consultar</a>&nbsp;";
                    $data .= "<a class='btn btn-xs btn-primary' href='update.php?id_ins=$row[id_ins]'>Actualizar</a>&nbsp;";
                    $data .= "<a class='btn btn-xs btn-danger' href='delete.php?id_ins=$row[id_ins]'>Eliminar</a>";
                    $data .= "</td>";
                    $data .= "</tr>";
                }
                print($data);
                $PDO = null;
            ?>
            </tbody>
        </table>
    </div> <!-- /row -->
</div> <!-- /container -->
</body>
</html>