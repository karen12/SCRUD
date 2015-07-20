<!DOCTYPE html>
<html lang='es'>
<head>
     <title>CRUD con PHP</title>
    <meta charset='utf-8'>
    <link href='css/bootstrap.min.css' rel='stylesheet'>
    <link type="text/csss" href='csss/estilo.css' rel='stylesheet'>
    <link rel="stylesheet" href="estilo.css">
    <link href="./csss/bootstrap.min.css" rel="stylesheet">
    <link href="./csss/main.css" rel="stylesheet">

    <link rel="stylesheet" href="fonts.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
</head>
<body>
     <nav class="navbar navbar-default" role="navigation">
  <!-- El logotipo y el icono que despliega el menú se agrupan
       para mostrarlos mejor en los dispositivos móviles -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse"
            data-target=".navbar-ex1-collapse">
      <span class="sr-only">Desplegar navegación</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">Logotipo</a>
  </div>
 
  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
       otro elemento que se pueda ocultar al minimizar la barra -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Enlace #1</a></li>
      <li><a href="#">Enlace #2</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Menú #1 <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="#">Acción #1</a></li>
          <li><a href="#">Acción #2</a></li>
          <li><a href="#">Acción #3</a></li>
          <li class="divider"></li>
          <li><a href="#">Acción #4</a></li>
          <li class="divider"></li>
          <li><a href="#">Acción #5</a></li>
        </ul>
      </li>
    </ul>
 
    <form class="navbar-form navbar-left" role="search">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Buscar">
      </div>
      <button type="submit" class="btn btn-default">Enviar</button>
    </form>
 
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#">Enlace #3</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Menú #2 <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="#">Acción #1</a></li>
          <li><a href="#">Acción #2</a></li>
          <li><a href="#">Acción #3</a></li>
          <li class="divider"></li>
          <li><a href="#">Acción #4</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
<div class='container'>
    <div class='row'>
        <h2>Mantenimiento de Grado</h2>
    </div>
    <div class='row'>
        <p><a class='btn btn-xs btn-success' href='create.php'>Crear</a></p>
        <table class='table table-striped table-bordered table-hover'>
            <tr class='warning'>
                <th>ID</th>
                <th>GRADO</th>
            </tr>
            <tbody>
            <?php
                require("db.php");
                $sql = "SELECT id_grado, grado FROM grados ORDER BY id_grado DESC";
                $data = "";
                foreach($PDO->query($sql) as $row) {
                    $data .= "<tr>";
                    $data .= "<td>$row[id_grado]</td>";
                    $data .= "<td>$row[grado] </td>";
                    $data .= "<td>";
                    $data .= "<a class='btn btn-xs btn-info' href='read.php?id=$row[id_grado]'>Consultar</a>&nbsp;";
                    $data .= "<a class='btn btn-xs btn-primary' href='update.php?id=$row[id_grado]'>Actualizar</a>&nbsp;";
                    $data .= "<a class='btn btn-xs btn-danger' href='delete.php?id=$row[id_grado]'>Eliminar</a>";
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