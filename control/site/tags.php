<?
	$titulo = "Tags";

	$tabla = "tags";
	$indice = "idtag";
	$tipoindice = "n"; //s:string n:number a:autonumerico
	$sqlconsulta = "select * from tags where prioridad asc";
	
	$contenido = array(
		array("idtag","a","h","Código tag","","","","R","","","3","",""),
		array("tag","s","i","Nombre del tag","*","","","","","","100","Nombre del Cliente",""),
		array("prioridad","n","i","Prioridad <i style='color:#f00;'>(1, 2, 3, 4)</i>","*","","","","","","100","Establecer prioridad del tag","")
	);
	
	$consulta = array(
		array("tag","Tags"),
		array("prioridad","Orden de Prioridad")
	);
?>