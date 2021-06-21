<?
	$titulo = "Blog";

	$tabla = "blog";
	$indice = "idblog";
	$tipoindice = "n"; //s:string n:number a:autonumerico
	$sqlconsulta = "select * from blog a, tags b where a.idtag1 = b.idtag";
	
	$contenido = array(
		array("idblog","a","h","Código post","","","","R","","","5","",""),
		array("usuario","s","i","Usuario que escribe la noticia","*","","","","","","100","Escriba nombre del usuario que escribe la noticia",""),
		array("titulo","s","i","Titular de la noticia","*","","","","","","100","Escriba el titular de la otcia que se vera en el apartado de blog",""),
		array("fecha","d","d","Fecha de la publicaci&oacute;n","","","","","","","","Fecha de la publicaci&oacute;n del post",""),
		array("foto","s","f","Imagen que se mostrara en el apartado de blog (500x320 px exactos)","","","","","","images/blog","255","Tamaño maximo de la imagen 580x320 px","500X320","1"),
		array("introduccion","s","t","Texto introducci&oacute;n","","","","","","","","Escriba la informaci&oacute;n de la noticia",""),
		array("informacion","s","ck2","Informaci&oacute;n","","","","","","","","Escriba la informaci&oacute;n de la noticia",""),
		array("idtag1","n","s","Seleccione tag","","select idtag as idtag1, tag from tags","tag","","","","3","Seleccione la palabra clave que este relacionado con esta noticia",""),
		array("idtag2","n","s","Seleccione tag","","select idtag as idtag2, tag from tags","tag","","","","3","Seleccione la palabra clave que este relacionado con esta noticia",""),
		array("idtag3","n","s","Seleccione tag","","select idtag as idtag3, tag from tags","tag","","","","3","Seleccione la palabra clave que este relacionado con esta noticia",""),
		array("idtag4","n","s","Seleccione tag","","select idtag as idtag4, tag from tags","tag","","","","3","Seleccione la palabra clave que este relacionado con esta noticia",""),
		array("oculto","n","c","Oculto","","","","","","","1","Seleccione si la noticia del blog se muestra o no.","")
	);
	
	$consulta = array(
		array("fecha","Fecha de publicaci&oacute;n"),
		array("titulo","Titulo Blog"),
		array("usuario","Usuario"),
		array("tag","Tag Principapl")
	);
?>