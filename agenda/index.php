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
        <h2>Mantenimiento de Agendas</h2>
    </div>
    <div class='row'>
        <p><a class='btn btn-xs btn-success' href='create.php'>Crear</a></p>
        <table class='table table-striped table-bordered table-hover'>
            <tr class='warning'>
                <th>ID</th>
                <th>FECHA INICIO</th>
                <th>FECHA FINAL</th>
                <th>HORA</th>
                <th>ACTIVIDAD</th>
                <th>ACCION</th>
            </tr>
            <tbody>
            <?php
                require("db.php");
                $sql = "SELECT id_agenda, fecha_inicio, fecha_final, hora, actividad FROM agenda ORDER BY id_agenda DESC";
                $data = "";
                foreach($PDO->query($sql) as $row) {
                    $data .= "<tr>";
                    $data .= "<td>$row[id_agenda]</td>";
                    $data .= "<td>$row[fecha_inicio] </td>";
                    $data .= "<td>$row[fecha_final]</td>";
                    $data .= "<td>$row[hora]</td>";
                    $data .= "<td>$row[actividad]</td>";
                    $data .= "<td>";
                    $data .= "<a class='btn btn-xs btn-primary' href='update.php?id=$row[id_agenda]'>Actualizar</a>&nbsp;";
                    $data .= "<a class='btn btn-xs btn-danger' href='delete.php?id=$row[id_agenda]'>Eliminar</a>";
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