<?
$dbhost="localhost";  // host del MySQL (generalmente localhost)
$bbdd="programa_programadorautonomo";        // Seleccionamos la base con la cual trabajar
$dbusuario="programa_pa"; // aqui debes ingresar el nombre de usuario
                      // para acceder a la base
$dbpassword="VxqG(hZGRsPM"; // password de acceso para el usuario de la
                      // linea anterior
$db = mysql_connect($dbhost, $dbusuario, $dbpassword);
mysql_select_db($bbdd, $db);
?>
<?
if ( ($_SERVER['REMOTE_ADDR']=="85.59.44.20")  ){ // IP CASA
	$ACTIVARPRUEBAS=1;
}else{
	$ACTIVARPRUEBAS=0;
}
?>