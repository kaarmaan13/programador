<?
	$titulo = "Quiénes somos";

	$tabla = "quienes";
	$indice = "idquienes";
	$tipoindice = "a"; //s:string n:number a:autonumerico
	$sqlconsulta = "select * from quienes";
	
	$contenido = array(
		array("idquienes","a","h","Código Quiénes","","","","R","","","1","",""),
		array("titulo","s","i","Título","*","","","","","","255","Título que se mostrará",""),
		array("resumen","s","t","Resumen","*","","","","","","255","Texto de entrada",""),
		array("descripcion","s","fck","Descripci&oacute;n","*","","","","","","","Texto desarrollado",""),
		array("fotomini","s","f","Foto Thumbnail <i>(300x250 pixels m&aacute;ximo)</i>","","","","","","images","35","Foto en miniatura, que se reducirá con las medidas máximas especificadas para ancho y largo, que se verá en la página inicialmente","300x250"),
		array("foto","s","f","Foto Grande <i>(780x490 pixels m&aacute;ximo)</i>","","","","","","images","35","Foto de mayor tamaño, que se reducirá con las medidas máximas especificadas para ancho y largo, que se verá cuando ampliamos el thumbnail","780x490")
	);
	
	$consulta = array(
		array("titulo","Título")
	);
?>