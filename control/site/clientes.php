<?
	$titulo = "Clientes";

	$tabla = "clientes";
	$indice = "idcliente";
	$tipoindice = "a"; //s:string n:number a:autonumerico
	$sqlconsulta = "select * from clientes order by orden";
	
	$contenido = array(	
		array("idcliente","a","h","C�digo Cliente","","","","R","","","6","",""),
		array("cliente","s","i","Nombre Cliente","*","","","","","","150","Nombre del cliente",""),
		array("descripcion","s","t","Descripci&oacute;n","","","","","","","","Descripci&oacute;n del �mbito del cliente",""),
		array("fotomini","s","f","Foto Thumbnail <i>(120x100 pixels m&aacute;ximo)</i>","","","","","","images","40","Foto en miniatura, con las medidas especificadas m�ximas para ancho y largo, que se ver� en la p�gina inicialmente","120X100"),
		array("orden","n","i","Orden","*","","","","","","10","Introduzca un n�mero para definir la ordenaci&oacute;n de los elementos visibles en la web",""),
		array("oculto","n","c","Oculto","","","","","","","1","Marque la casilla si desea que el trabajo no est� visible en la web","")
	);
	
	$consulta = array(
		array("cliente","Nombre Cliente"),
		array("orden","Orden")
	);
?>