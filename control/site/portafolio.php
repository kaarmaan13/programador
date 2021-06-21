<?
	$titulo = "Portfolio";

	$tabla = "trabajos";
	$indice = "idtrabajo";
	$tipoindice = "a"; //s:string n:number a:autonumerico
	$sqlconsulta = "select * from trabajos t, clientes c where t.idcliente=c.idcliente order by t.orden";
	
	$contenido = array(	
		array("idtrabajo","a","h","Código Trabajo","","","","R","","","6","",""),
		array("trabajo","s","i","Nombre Trabajo","*","","","","","","150","Nombre del trabajo realizado",""),
		array("idcliente","n","s","Nombre Cliente","*","select * from clientes order by cliente","cliente","","","","2","Seleccione, el cliente para el que se ha realizado el trabajo",""),
		array("fechafin","d","d","Fecha Finalizaci&oacute;n","","","","","","","","Fecha de finalizaci&oacute;n del trabajo",""),
		array("descripcion","s","t","Descripci&oacute;n","*","","","","","","","Descripci&oacute;n del trabajo realizado",""),
		array("requisitos","s","t","Requisitos del proyecto","","","","","","","","Requisitos del proyecto realizado",""),
		array("tecnologias","s","t","Tecnologías empleadas","","","","","","","","Tecnologías empleadas en el trabajo",""),
		array("url","s","i","URL Web","","","","","","","150","URL de la web realizada",""),
		array("fotohome","s","f","Foto Thumbnail <i>(280x108 pixels m&aacute;ximo)</i>","","","","","","images","40","Foto en miniatura, con las medidas especificadas máximas para ancho y largo, que se verá en la página inicialmente","280x108"),
		array("orden","n","i","Orden","*","","","","","","10","Introduzca un número para definir la ordenaci&oacute;n de los elementos visibles en la web",""),
		array("oculto","n","c","Oculto","","","","","","","1","Marque la casilla si desea que el trabajo no esté visible en la web",""),
		array("fotomini1","s","f","Foto Thumbnail 1 <i>(240x140 pixels m&aacute;ximo)</i>","*","","","","","images","40","Foto en miniatura, con las medidas especificadas máximas para ancho y largo, que se verá en la página inicialmente","240x140"),
		array("foto1","s","f","Foto Grande 1 <i>(770x570 pixels m&aacute;ximo)</i>","*","","","","","images","40","Foto de mayor tamaño, de las medidas especificadas máximas para ancho y largo, que se verá cuando ampliamos el thumbnail","770x570"),
		array("fotomini2","s","f","Foto Thumbnail 2 <i>(240x140 pixels m&aacute;ximo)</i>","","","","","","images","40","Foto en miniatura, con las medidas especificadas máximas para ancho y largo, que se verá en la página inicialmente","240x140"),
		array("foto2","s","f","Foto Grande 2 <i>(770x570 pixels m&aacute;ximo)</i>","","","","","","images","40","Foto de mayor tamaño, de las medidas especificadas máximas para ancho y largo, que se verá cuando ampliamos el thumbnail","770x570"),
		array("fotomini3","s","f","Foto Thumbnail 3 <i>(240x140 pixels m&aacute;ximo)</i>","","","","","","images","40","Foto en miniatura, con las medidas especificadas máximas para ancho y largo, que se verá en la página inicialmente","240x140"),
		array("foto3","s","f","Foto Grande 3 <i>(770x570 pixels m&aacute;ximo)</i>","","","","","","images","40","Foto de mayor tamaño, de las medidas especificadas máximas para ancho y largo, que se verá cuando ampliamos el thumbnail","770x570"),
		array("fotomini4","s","f","Foto Thumbnail 4 <i>(240x140 pixels m&aacute;ximo)</i>","","","","","","images","40","Foto en miniatura, con las medidas especificadas máximas para ancho y largo, que se verá en la página inicialmente","240x140"),
		array("foto4","s","f","Foto Grande 4 <i>(770x570 pixels m&aacute;ximo)</i>","","","","","","images","40","Foto de mayor tamaño, de las medidas especificadas máximas para ancho y largo, que se verá cuando ampliamos el thumbnail","770x570"),
		array("fotomini5","s","f","Foto Thumbnail 5 <i>(240x140 pixels m&aacute;ximo)</i>","","","","","","images","40","Foto en miniatura, con las medidas especificadas máximas para ancho y largo, que se verá en la página inicialmente","240x140"),
		array("foto5","s","f","Foto Grande 5 <i>(770x570 pixels m&aacute;ximo)</i>","","","","","","images","40","Foto de mayor tamaño, de las medidas especificadas máximas para ancho y largo, que se verá cuando ampliamos el thumbnail","770x570")
	);
	
	$consulta = array(
//		array("trabajo","Nombre Trabajo"),
		array("fechafin","Fecha Finalizaci&oacute;n"),
		array("cliente","Nombre Cliente"),
		array("url","URL Web")
	);
?>