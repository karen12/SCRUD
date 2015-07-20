<?php
	$sesion= $_POST["usuarios"];
	$usuario = $_POST["usuarios"];
	$clave = sha1($_POST["claves"]);

	$conexion = mysql_connect("localhost", "root") or die("errorrrrrrrrrrr wachin");

	mysql_select_db("bradford", $conexion) or die("errorrr 2 XD");

	$god = mysql_query("SELECT id_usuario, usuario, clave FROM usuarios WHERE usuario = '".$usuario."' and clave = '".$clave."'", $conexion);


	if ($row = mysql_fetch_array($god)) 
	{
		session_start();
            //Almacenamos el nombre de usuario en una variable de sesión usuario
            $_SESSION['nombre_usuario'] = $usuario;
            $_SESSION['id_usuario'] = $row['id_usuario'];
            //Redireccionamos a la pagina: index.php
           header("Location: utiles/index.php");
	}
	else 
	{
		echo "USUARIO INCORRECTO";
	}

?>