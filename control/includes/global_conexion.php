<?
	session_start();

	$login=$_REQUEST["login"];$clave=$_REQUEST["clave"];

	if (($login=="pa") && ($clave=="sporting")) {
		$_SESSION[$global_id_aplicacion] = "true";
	}
	else {
	  	$loginerror="si";
	}
	
	$db = mysql_connect($global_db_servidor, $global_db_usuario, $global_db_clave);
	if (!$db) {
   		die('No es posible conectar con la base de datos: ' . mysql_error());
	}
	mysql_select_db($global_db_db,$db)
?>