<?
	$titulo = "Comentarios Blogs";

	$tabla = "comentarios";
	$indice = "idcomentario";
	$tipoindice = "a"; //s:string n:number a:autonumerico
	$sqlconsulta = "select *, CONCAT(DATE_FORMAT(fecha, '%e-%m-%Y'), ' ', titulo) AS fechaytitulo from comentarios c, blog b, estado e where e.idestado=c.idestado and c.idpost=b.idpost order by b.fecha DESC, c.fechacomentario DESC";

	$contenido = array(	
		array("idcomentario","a","h","C&oacute;digo Comentario Noticia","","","","R","","","6","",""),
		array("idpost","n","s","Seleccionar la noticia del blog","*","select *, CONCAT(DATE_FORMAT(fecha, '%e-%m-%Y'), ' ', titulo) AS fechaytitulo from blog order by fecha","fechaytitulo","","","","6","Seleccione la Blog asociada al comentario",""),
		array("nombre","s","i","Nombre","*","","","","","","255","Nombre del comentario",""),
		array("asunto","s","i","Asunto en el Comentario en Blog","*","","","","","","255","Asunto del comentario",""),
		array("comentario","s","t","Comentario en Blog","*","","","","","","","Texto largo descriptivo del comentario",""),
		array("fechacomentario","d","d","Fecha comentario","*","","","","","","","Fecha de publicaci&oacute;n del comentario",""),
		array("horacomentario","s","tp","Hora comentario","*","","","","","","5","Hora de publicaci&oacute;n del comentario",""),
		array("idestado","n","s","Estado","*","select * from estado order by idestado","estado","","","","6","Seleccione el estado del comentario","")
	);
	
	$consulta = array(
		array("fechaytitulo","Noticia"),
		array("nombre","Usuario"),
		array("estado","Estado")
	);
?>