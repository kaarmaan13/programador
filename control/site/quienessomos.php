<?
	$titulo = "Qui�nes somos";

	$tabla = "quienes";
	$indice = "idquienes";
	$tipoindice = "a"; //s:string n:number a:autonumerico
	$sqlconsulta = "select * from quienes";
	
	$contenido = array(
		array("idquienes","a","h","C�digo Qui�nes","","","","R","","","1","",""),
		array("titulo","s","i","T�tulo","*","","","","","","255","T�tulo que se mostrar�",""),
		array("resumen","s","t","Resumen","*","","","","","","255","Texto de entrada",""),
		array("descripcion","s","fck","Descripci&oacute;n","*","","","","","","","Texto desarrollado",""),
		array("fotomini","s","f","Foto Thumbnail <i>(300x250 pixels m&aacute;ximo)</i>","","","","","","images","35","Foto en miniatura, que se reducir� con las medidas m�ximas especificadas para ancho y largo, que se ver� en la p�gina inicialmente","300x250"),
		array("foto","s","f","Foto Grande <i>(780x490 pixels m&aacute;ximo)</i>","","","","","","images","35","Foto de mayor tama�o, que se reducir� con las medidas m�ximas especificadas para ancho y largo, que se ver� cuando ampliamos el thumbnail","780x490")
	);
	
	$consulta = array(
		array("titulo","T�tulo")
	);
?>