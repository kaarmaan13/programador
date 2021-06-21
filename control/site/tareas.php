<?
	$titulo = "Tareas";

	$tabla = "tareas";
	$indice = "idtarea";
	$tipoindice = "a"; //s:string n:number a:autonumerico
	$sqlconsulta = "select * from tareas t, clientes c, usuarios u where t.idusuario1=u.idusuario and t.idcliente=c.idcliente order by t.fechafin desc";
	
	$contenido = array(	
		array("idtarea","a","h","Código Tarea","","","","R","","","6","",""),
		array("idcliente","n","s","Nombre Cliente","*","select * from clientes order by cliente","cliente","","","","2","Seleccione, el cliente para el que se va a realizar la tarea",""),
		array("idusuario1","n","s","Usuario 1","*","select idusuario as idusuario1, usuario from usuarios","usuario","","","","2","Seleccione, el usuario que va a realizar la tarea",""),
		array("idusuario2","n","s","Usuario 2","","select idusuario as idusuario2, usuario from usuarios","usuario","","","","2","Seleccione, el usuario que va a realizar la tarea",""),
		array("idusuario3","n","s","Usuario 3","","select idusuario as idusuario3, usuario from usuarios","usuario","","","","2","Seleccione, el usuario que va a realizar la tarea",""),		
		array("fechacomienzo","d","d","Fecha Comienzo","","","","","","","","Fecha de comienzo del trabajo",""),
		array("fechafin","d","d","Fecha Finalizaci&oacute;n","","","","","","","","Fecha de finalizaci&oacute;n del trabajo",""),
		array("tarea","s","i","Tarea","*","","","","","","150","Nombre de la tarea a realizar",""),
		array("descripciontarea","s","t","Descripci&oacute;n Tarea","*","","","","","","","Descripci&oacute;n de la tarea a realizar",""),
		array("archivo","s","f","Archivo Adjunto","","","","","","control/archivos","70","Archivo Adjunto",""),
		array("finalizado","n","c","Finalizado","","","","","","","1","Marque la casilla si el trabajo ha sido finalizado","")
	);
	
	$consulta = array(
		array("cliente","Nombre Cliente"),
		array("usuario","Usuario 1"),
		array("tarea","Tarea"),
		array("fechafin","Fecha Fin")
	);
?>