<?
	$titulo = "Usuarios";

	$tabla = "usuarios";
	$indice = "idusuario";
	$tipoindice = "a"; //s:string n:number a:autonumerico
	$sqlconsulta = "select * from usuarios";
	
	$contenido = array(	
		array("idusuario","a","h","Código Usuario","","","","R","","","6","",""),
		array("usuario","s","i","Nombre Usuario","*","","","","","","150","Nombre del usuario",""),
		array("email","s","i","Email","","","","","","","255","Email del usuario","")
	);
	
	$consulta = array(
		array("usuario","Nombre Usuario"),
		array("email","Email")
	);
?>