<?php
    $id = null;
    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
    }
    if($id == null)
    {
        header("Location: index.php");
    }
    
    // borrar XDDD 
    if(!empty($_POST)) {
        require("db.php");   
        $id = $_POST['id'];
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM agenda WHERE id_agenda = ?";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($id));
        $PDO = null;
        header("Location: index.php");
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
            <h2>Eliminar Fecha Agendada</h2>
        </div>
        <form method='POST'>
            <input type='hidden' name='id' value='<?php print($id); ?>'>
            <p class='alert bg-danger'>¿Borrar datos?</p>
            <div class='form-actions'>
                <button type='submit' class='btn btn-danger'>Si</button>
                <a class='btn btn btn-default' href='index.php'>No</a>
            </div>
        </form>
    </div> <!-- /row -->
</div> <!-- /container -->
</body>
</html>