<?
	$titulo = "Tecnologías";

	$tabla = "tecnologias";
	$indice = "idtecnologia";
	$tipoindice = "a"; //s:string n:number a:autonumerico
	$sqlconsulta = "select * from tecnologias";
	
	$contenido = array(	
		array("idtecnologia","a","h","Código Servicios","","","","R","","","6","",""),
		array("tecnologia","s","i","Nombre Servicios","*","","","","","","150","Nombre del servicio",""),
		array("descripcion","s","t","Descripci&oacute;n","","","","","","","","Texto descriptivo de Servicios","")
	);
	
	$consulta = array(
		array("tecnologia","Nombre Servicios")
	);
?>