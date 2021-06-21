<?
	$titulo = "Aplicaciones Web";

	$tabla = "aplicacionesweb";
	$indice = "idaplicacion";
	$tipoindice = "a"; //s:string n:number a:autonumerico
	$sqlconsulta = "select * from aplicacionesweb";
	
	$contenido = array(	
		array("idaplicacion","a","h","C�digo Aplicaci&oacute;n","","","","R","","","6","",""),
		array("aplicacion","s","i","Nombre Aplicaci&oacute;n","*","","","","","","150","Nombre Aplicaci&oacute;n",""),
		array("icono","s","f","Icono Aplicaci&oacute;n <i>(300x200 pixels m&aacute;ximo)</i>","*","","","","","images","40","Icono de texto, con las medidas especificadas m�ximas para ancho y largo","300x200"),
		array("descripcion","s","t","Descripci&oacute;n Aplicaci&oacute;n","","","","","","","","Texto descriptivo de la aplicaci&oacute;n",""),
		array("fuente","s","i","Fuente Aplicaci&oacute;n","","","","","","","150","Fuente de la aplicaci&oacute;n",""),
		array("tecnologias","s","i","Tecnolog�as","","","","","","","150","Tecnolog�as empleadas",""),
		array("url","s","i","URL Aplicaci&oacute;n","","","","","","","150","URL de la aplicaci&oacute;n",""),
		array("orden","n","i","Orden","*","","","","","","10","Introduzca un n�mero para definir la ordenaci&oacute;n de los elementos visibles en la web",""),
		array("oculto","n","c","Oculto","","","","","","","1","Marque la casilla si desea que el trabajo no est� visible en la web","")
	);
	
	$consulta = array(
		array("aplicacion","Nombre Aplicaci&oacute;n"),
		array("orden","Orden"),
	);
?>