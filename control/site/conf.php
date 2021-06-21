<?
	$titulo = "Configuración Intranet";

	$tabla = "conf";
	$indice = "idconfiguracion";
	$tipoindice = "n"; //s:string n:number a:autonumerico
	$sqlconsulta = "select * from conf";
	
	$contenido = array(
		array("idconfiguracion","n","h","Código Configuración","","","","R","","","2","",""),
		array("entidad","s","i","Nombre Entidad","*","","","","","","100","Nombre de la entidad que administra el Gestor de Contenidos",""),
		array("logo","s","f","Logo Entidad <i>(180x65 pixels m&aacute;ximo)</i>","","","","","","control/images","40","Logotipo de la entidad que administra el Gestor de Contenidos","180x65"),
		array("colorfuente1","s","cp","Color Fuente Menú y Ayuda","","","","","","","7","Color de la fuente del exterior y botones del menú",""),
		array("colorfuente2","s","cp","Color Fuente Contenido","","","","","","","7","Color de la fuente del contenido",""),
		array("colorfondo","s","cp","Color Fondo","","","","","","","7","Color de fondo de la intranet",""),
		array("colorfondomenu","s","cp","Color Fondo Menú","","","","","","","7","Color de fondo del menú",""),
		array("colorfondobotones","s","cp","Color Fondo Botones","","","","","","","7","Color de fondo de los botones",""),
		array("colorfondocontenido","s","cp","Color Fondo Contenido","","","","","","","7","Color de fondo del contenido","")
	);
	
	$consulta = array(
		array("entidad","Nombre Entidad")
	);
?>